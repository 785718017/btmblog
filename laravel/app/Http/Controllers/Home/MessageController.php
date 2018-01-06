<?php

namespace App\Http\Controllers\Home;

use App\Constants;
use App\Service\MessageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * 展示留言页面
     */
    public function index(){
        return view('Home/Message/index' , ['page_title' => '留言']);
    }

    /**
     * 添加留言
     */
    public function addMessage(Request $request, MessageService $messageService){
        $message = $request->input('message');
        $email = $request->input('email');
        if(empty($message)){
            return $this->error('留言内容不能为空');
        }

        $uid = session('uid'); //用户id
        if(empty($uid)){
            return $this->error('请登录之后再进行留言!');
        }
        $time = date('Y-m-d H:i:s');
        //开启事务
        $this->startTrans();
        $res = $messageService->addMessage($message, $email, $uid, $time);
        if(empty($res)){
            return $this->error('留言失败');
        }

        //返回留言的内容,时间
        $nick_name = session('nick_name'); //用户昵称
        $head = session('head'); //用户头像
        $info = [
            'uid' => $uid,
            'nick_name' => $nick_name,
            'head' => $head,
            'content' => $message,
            'time' => $time
        ];
        return $this->success($info);
    }

    /**
     * 获取更多留言
     */
    public function getMoreMessage(Request $request, MessageService $messageService){
        $last_id = $request->input('last_id');
        if(empty($last_id)){
            $last_id = 0;
        }
        $data = $messageService->getMoreMessage($last_id);
        if(empty($data)){
            return $this->error('获取数据失败!');
        }
        return $this->success($data);
    }

    /**
     * 添加留言评论
     */
    public function replyForMessage(Request $request, MessageService $messageService){
        $reply_content = $request->input('reply_content');
        $reply_email = $request->input('reply_email');
        $message_id = $request->input('message_id');
        $reply_for_uid = $request->input('reply_for_uid');

        if(empty($reply_content) || empty($message_id) || empty($reply_for_uid)){
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
        $message = $messageService->getMessageById($message_id);
        if(empty($message)){
            return $this->error('留言不存在');
        }
        if($message->user_id != $reply_for_uid){
            return $this->error('留言和用户信息不匹配');
        }

        if($message->status == Constants::MESSAGE_STATUS_UNENABLE){
            return $this->error('该留言已关闭,请勿回复!');
        }

        $this->startTrans();
        //添加回复
        $res = $messageService->addMessageReply($reply_content, $reply_email, $message_id, $reply_for_uid, $uid);
        if(empty($res)){
            return $this->error('回复失败');
        }
        return $this->success($res);
    }

    /**
     * 添加留言评论
     */
    public function replyForReply(Request $request, MessageService $messageService){
        $reply_content = $request->input('reply_content');
        $reply_email = $request->input('reply_email');
        $message_id = $request->input('message_id');
        $reply_for_uid = $request->input('reply_for_uid');

        if(empty($reply_content) || empty($message_id) || empty($reply_for_uid)){
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
        $message = $messageService->getMessageById($message_id);
        if(empty($message)){
            return $this->error('留言不存在');
        }

        if($message->status == Constants::MESSAGE_STATUS_UNENABLE){
            return $this->error('该留言已关闭,请勿回复!');
        }

        $this->startTrans();
        //添加回复
        $res = $messageService->addMessageReply($reply_content, $reply_email, $message_id, $reply_for_uid, $uid);
        if(empty($res)){
            return $this->error('回复失败');
        }
        return $this->success($res);
    }
}
