<?php

namespace App\Http\Controllers\Home;

use App\Constants;
use App\Service\CommentService;
use App\Service\ReplyService;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //评论控制器

    /**
     * 提交评论
     */
    public function comment(Request $request, CommentService $commentService){
        //文章id
        $article_id = $request->input('article_id');
        $comment = $request->input('comment');
        $email = $request->input('email');

        if(empty($article_id) || empty($comment)){
            return $this->error('参数不正确');
        }

        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('用户未登录');
        }
        $time = date('Y-m-d H:i:s');
        //开启事务
        $this->startTrans();
        $res = $commentService->addComment($uid, $article_id, $comment, $email, $time);
        if(empty($res)){
            return $this->error('添加评论失败');
        }

        //返回评论的内容,时间
        $nick_name = session('nick_name'); //用户昵称
        $head = session('head'); //用户头像
        $info = [
            'uid' => $uid,
            'nick_name' => $nick_name,
            'head' => $head,
            'content' => $comment,
            'time' => $time
        ];
        return $this->success($info);
    }

    /**
     * 回复评论
     */
    public function replyForComment(Request $request, CommentService $commentService, ReplyService $replyService){
        $reply_content = $request->input('reply_content');
        $reply_email = $request->input('reply_email');
        $comment_id = $request->input('comment_id');
        $reply_for_uid = $request->input('reply_for_uid');

        if(empty($reply_content) || empty($comment_id) || empty($reply_for_uid)){
            return $this->error('缺少参数');
        }

        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('用户未登录');
        }

        if(empty($reply_email)){
            $reply_email = '';
        }

        //判断评论是否属于该用户,判断评论是否被删除
        $comment = $commentService->getCommentById($comment_id);
        if($comment->user_id != $reply_for_uid){
            return $this->error('评论和用户信息不匹配');
        }

        if($comment->status == Constants::ARTICLE_COMMENT_STATUS_NOT_SHOW){
            return $this->error('该评论已关闭,请勿回复!');
        }

        $this->startTrans();
        //添加回复
        $res = $replyService->addReply($reply_content, $reply_email, $comment_id, $reply_for_uid, $uid);
        if(empty($res)){
            return $this->error('回复失败');
        }
        return $this->success($res);
    }

    /**
     * 回复评论的回复
     */
    public function replyForReply(Request $request, CommentService $commentService, ReplyService $replyService){
        $reply_content = $request->input('reply_content');
        $reply_email = $request->input('reply_email');
        $comment_id = $request->input('comment_id');
        $reply_for_uid = $request->input('reply_for_uid');

        if(empty($reply_content) || empty($comment_id) || empty($reply_for_uid)){
            return $this->error('缺少参数');
        }

        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('用户未登录');
        }

        if(empty($reply_email)){
            $reply_email = '';
        }

        //判断评论是否属于该用户,判断评论是否被删除
        $comment = $commentService->getCommentById($comment_id);
//        if($comment->user_id != $reply_for_uid){
//            return $this->error('评论和用户信息不匹配');
//        }

        if($comment->status == Constants::ARTICLE_COMMENT_STATUS_NOT_SHOW){
            return $this->error('该评论已关闭,请勿回复!');
        }

        $this->startTrans();
        //添加回复
        $res = $replyService->addReply($reply_content, $reply_email, $comment_id, $reply_for_uid, $uid);
        if(empty($res)){
            return $this->error('回复失败');
        }
        return $this->success($res);
    }

    /**
     * 用户点赞评论
     */
    public function addCommentAgree(Request $request, CommentService $commentService){
        //判断用户是否已登录
        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('请登录后再操作!');
        }
        $comment_id = $request->input('comment_id');

        $had_agree = $commentService->hadUserAgreeComment($comment_id, $uid);
        if(!empty($had_agree)){
            return $this->error('您已经对这篇文章点过赞或者点过踩了!');
        }
        $this->startTrans();
        $res = $commentService->addCommentAgree($comment_id, $uid);
        if(empty($res)){
            return $this->error('操作失败!');
        }
        return $this->success(['comment_id' => $comment_id]);
    }

    /**
     * 用户点赞评论
     */
    public function addCommentDisagree(Request $request, CommentService $commentService){
        //判断用户是否已登录
        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('请登录后再操作!');
        }
        $comment_id = $request->input('comment_id');

        $had_agree = $commentService->hadUserAgreeComment($comment_id, $uid);
        if(!empty($had_agree)){
            return $this->error('您已经对这篇文章点过赞或者点过踩了!');
        }
        $this->startTrans();
        $res = $commentService->addCommentDisagree($comment_id, $uid);
        if(empty($res)){
            return $this->error('操作失败!');
        }
        return $this->success(['comment_id' => $comment_id]);
    }
}
