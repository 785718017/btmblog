<?php

namespace App\Service;

use App\Constants;
use App\Model\ArticleCommentAgreeModel;
use App\Model\ArticleCommentModel;
use App\Model\ArticleCommentReplyAgreeModel;
use App\Model\ArticleCommentReplyModel;
use App\Model\UserModel;
use App\Util\Util;

class CommentService extends CommonService
{
    /**
     * 分页数据
     */
    public $pages = '';

    /**
     * 获取分页数据
     */
    public function getPages(){
        return $this->pages;
    }

    /**
     * 添加文章评论
     * @param $uid 用户id
     * @param $article_id 文章id
     * @param $comment 评论内容
     * @param $email 邮箱地址
     */
    public function addComment($uid, $article_id, $comment, $email, $time){
        //如果没有邮箱地址,则判断用户是否有默认邮箱
        if(empty($email)){
            $UserService = new UserService();
            $user = $UserService->getUserById($uid);
            if(empty($user)){
                return array();
            }
            //如果邮箱为空,则不发送邮件
            if(empty($user->email)){
                $email = 0;
            }else{
                $email = $user->email;
            }
        }

        $ArticleCommentModel = new ArticleCommentModel();
        $res = $ArticleCommentModel->addComment($uid, $article_id, $comment, $email, $time);

        //将评论加入消息队列,推送给我自己


        return $res;
    }

    /**
     * @param $article_id 文章id
     * @param $uid  用户id
     */
    public function getCommentsAndReplys($article_id, $uid){
        //获取所有的可见评论---分页
        $ArticleCommentModel = new ArticleCommentModel();
        $data = $ArticleCommentModel->getShowCommentsByArticleId($article_id);
        if(empty($data['comments'])){
            //没有评论
            return array();
        }
        $comments = $data['comments'];
        $this->pages = $data['pages'];

        //获取所有评论的id
        $comment_ids = array_column($comments, 'id');
        $comment_agrees = array();
        if($uid != 0){
            //非游客用户,获取用户关于这篇文章的评论点赞情况和回复点赞情况
            $ArticleCommentAgreeModel = new ArticleCommentAgreeModel();
            $comment_agrees = $ArticleCommentAgreeModel->getUserArticleCommentAgrees($article_id, $uid);
            if(!empty($comment_agrees)){
                $comment_agrees = Util::array_convert($comment_agrees, 'comment_id');
            }
//            $reply_agrees = $ArticleCommentReplyAgreeModel->getUserArticleCommentReplyAgrees($article_id, $uid);
//            if(empty($reply_agrees)){
//                $reply_agrees = array();
//            }else{
//                $reply_agrees = Util::array_convert($reply_agrees, 'reply_id');
//            }
        }

        //获取所有评论的回复
        $ArticleCommentReplyModel = new ArticleCommentReplyModel();
        $replys = $ArticleCommentReplyModel->getReplysByCommentIds($comment_ids);

        //获取所有评论和回复用户的信息
        $comment_uids = array_column($comments, 'user_id');
        $UserModel = new UserModel();
        if(empty($replys)){
            //获取所有评论和回复用户的信息
            $uids = array_unique($comment_uids);
            $users = $UserModel->getUserByIds($uids);
            $users = Util::array_convert($users, 'id');

            //所有评论都没有回复
            foreach($comments as $key=>$comment){
                $comments[$key]['replys'] = array();
                $comments[$key]['user_name'] = $users[$comment['user_id']]['nick_name'];
                $comments[$key]['user_head'] = $users[$comment['user_id']]['head'];
                //判断该评论用户是否是当前用户
                if($comment['user_id'] == $uid){
                    $comments[$key]['user_self'] = 'yes';
                }else{
                    $comments[$key]['user_self'] = 'no';
                }

                //评论的点赞状况
                if(!empty($comment_agrees)){
                    if(!empty($comment_agrees[$comment['id']])){
                        $comments[$key]['agree_type'] = $comment_agrees[$comment['id']]['agree_type'];
                    }else{
                        $comments[$key]['agree_type'] = 0;
                    }
                }else{
                    $comments[$key]['agree_type'] = 0;
                }
            }
        }else{
            //获取所有评论和回复用户的信息
            $reply_uids = array_column($replys, 'user_id');
            $reply_for_uids = array_column($replys, 'reply_for_user_id');
            $uids = array_unique(array_merge($comment_uids, $reply_uids, $reply_for_uids));
            $users = $UserModel->getUserByIds($uids);
            $users = Util::array_convert($users, 'id');

            //回复按照评论id分组
            $comment_replys = Util::array_group($replys, 'comment_id');
            foreach($comments as $key=>$comment){
                //如果这个评论没有回复
                if(empty($comment_replys[$comment['id']])){
                    $comments[$key]['replys'] = array();
                    $comments[$key]['user_name'] = $users[$comment['user_id']]['nick_name'];
                    $comments[$key]['user_head'] = $users[$comment['user_id']]['head'];
                    //判断该评论用户是否是当前用户
                    if($comment['user_id'] == $uid){
                        $comments[$key]['user_self'] = 'yes';
                    }else{
                        $comments[$key]['user_self'] = 'no';
                    }

                    //评论的点赞状况
                    if(!empty($comment_agrees)){
                        if(!empty($comment_agrees[$comment['id']])){
                            $comments[$key]['agree_type'] = $comment_agrees[$comment['id']]['agree_type'];
                        }else{
                            $comments[$key]['agree_type'] = 0;
                        }
                    }else{
                        $comments[$key]['agree_type'] = 0;
                    }
                }else{
                    $comments[$key]['replys'] = $comment_replys[$comment['id']];
                    $comments[$key]['user_name'] = $users[$comment['user_id']]['nick_name'];
                    $comments[$key]['user_head'] = $users[$comment['user_id']]['head'];
                    //判断该评论用户是否是当前用户
                    if($comment['user_id'] == $uid){
                        $comments[$key]['user_self'] = 'yes';
                    }else{
                        $comments[$key]['user_self'] = 'no';
                    }

                    //评论的点赞状况
                    if(!empty($comment_agrees)){
                        if(!empty($comment_agrees[$comment['id']])){
                            $comments[$key]['agree_type'] = $comment_agrees[$comment['id']]['agree_type'];
                        }else{
                            $comments[$key]['agree_type'] = 0;
                        }
                    }else{
                        $comments[$key]['agree_type'] = 0;
                    }

                    foreach($comment_replys[$comment['id']] as $k=>$reply){
                        $comments[$key]['replys'][$k]['user_name'] = $users[$reply['user_id']]['nick_name'];
                        $comments[$key]['replys'][$k]['user_head'] = $users[$reply['user_id']]['head'];
                        $comments[$key]['replys'][$k]['reply_for_user_name'] = $users[$reply['reply_for_user_id']]['nick_name'];
                        //判断该回复用户是否是当前用户
                        if($reply['user_id'] == $uid){
                            $comments[$key]['replys'][$k]['user_self'] = 'yes';
                        }else{
                            $comments[$key]['replys'][$k]['user_self'] = 'no';
                        }
//                        if(!empty($reply_agrees)){
//                            if(!empty($reply_agrees[$reply['id']])){
//                                $comments[$key]['replys'][$k]['agree'] =  $reply_agrees[$reply['id']]['agree_type'];
//                            }
//                        }
                    }
                }
            }
        }

        return $comments;
    }

    /**
     * 根据id获取评论
     * @param $comment_id 评论id
     */
    public function getCommentById($comment_id){
        $ArticleCommentModel = new ArticleCommentModel();
        $comment = $ArticleCommentModel->getCommentById($comment_id);
        return $comment;
    }

    /**
     * 根据文章id数组获取文章的评论数量
     * @params $article_ids 文章id数组
     */
    public function getArticleCommentsNoByArticleIds($article_ids){
        $ArticleCommentModel = new ArticleCommentModel();
        $comment_nums = array();
        foreach($article_ids as $article_id){
            $num = $ArticleCommentModel->getCommentNumsByArticleId($article_id);
            $comment_nums[$article_id] = $num;
        }
        return $comment_nums;
    }

    /**
     * 判断用户是否对该评论进行过点赞或者点踩操作
     * @param $comment_id
     * @param $user_id
     */
    public function hadUserAgreeComment($comment_id, $user_id){
        $ArticleAgreeModel = new ArticleCommentAgreeModel();
        //判断用户是否对该文章进行过点赞或者点踩操作
        $had_agree = $ArticleAgreeModel->getCommentAgreeByAidAndUid($comment_id, $user_id);
        return $had_agree;
    }

    /**
     * 添加用户的文章点赞信息
     * @param $article_id 文章id
     * @param $user_id 用户id
     */
    public function addCommentAgree($comment_id, $user_id){
        $ArticleCommentModel = new ArticleCommentModel();
        $ArticleCommentAgreeModel = new ArticleCommentAgreeModel();

        //获取文章
        $comment = $ArticleCommentModel->getCommentById($comment_id);
        if(empty($comment)){
            return array();
        }
        //设置点赞数量
        $agree_num = $comment->agree_num + 1;
        $res = $ArticleCommentModel->addCommentAgree($comment_id, $agree_num);
        if(empty($res)){
            return array();
        }
        //添加用户点赞记录
        $res = $ArticleCommentAgreeModel->addUserCommentAgree($comment->article_id, $comment_id, $user_id, Constants::AGREE_TYPE_AGREE);
        if(empty($res)){
            return array();
        }
        return $res;
    }
    /**
     * 添加用户的文章点赞信息
     * @param $article_id 文章id
     * @param $user_id 用户id
     */
    public function addCommentDisagree($comment_id, $user_id){
        $ArticleCommentModel = new ArticleCommentModel();
        $ArticleCommentAgreeModel = new ArticleCommentAgreeModel();

        //获取文章
        $comment = $ArticleCommentModel->getCommentById($comment_id);
        if(empty($comment)){
            return array();
        }
        //设置点赞数量
        $disagree_num = $comment->disagree_num + 1;
        $res = $ArticleCommentModel->addCommentDisagree($comment_id, $disagree_num);
        if(empty($res)){
            return array();
        }
        //添加用户点赞记录
        $res = $ArticleCommentAgreeModel->addUserCommentAgree($comment->article_id, $comment_id, $user_id, Constants::AGREE_TYPE_DISAGREE);
        if(empty($res)){
            return array();
        }
        return $res;
    }
}
