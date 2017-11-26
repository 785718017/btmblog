<?php

namespace App\Http\Controllers\Home;

use App\Service\CommentService;
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
}
