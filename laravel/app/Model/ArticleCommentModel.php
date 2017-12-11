<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Constants;

class ArticleCommentModel extends Model
{
    //文章评论模型

    //定义表名
    protected $table = 'article_comment';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 添加文章评论
     * @param $uid 用户id
     * @param $article_id 文章id
     * @param $comment 评论内容
     * @param $email 邮箱地址
     */
    public function addComment($uid, $article_id, $comment, $email, $time){
        $this->user_id = $uid;
        $this->article_id = $article_id;
        $this->content = $comment;
        $this->email = $email;
        $this->publish_time = $time;
        $res = $this->save();
        if(empty($res)){
            return false;
        }
        return true;
    }

    /**
     * @param $article_id 文章id
     */
    public function getShowCommentsByArticleId($article_id){
        $where = array(
            ['article_id', '=', $article_id],
            ['status', '=', Constants::ARTICLE_COMMENT_STATUS_SHOW]
        );
        $comments = $this->where($where)->orderBy('publish_time','desc')->paginate(8);
        if($comments->isEmpty()){
            return array();
        }
        $pages = $comments->links();
        $arr = array();
        foreach($comments as $key=>$comment){
            $arr[$key]['id'] = $comment->id;
            $arr[$key]['user_id'] = $comment->user_id;
            $arr[$key]['content'] = $comment->content;
            $arr[$key]['article_id'] = $comment->article_id;
            $arr[$key]['email'] = $comment->email;
            $arr[$key]['agree_num'] = $comment->agree_num;
            $arr[$key]['disagree_num'] = $comment->disagree_num;
            $arr[$key]['publish_time'] = $comment->publish_time;
            $arr[$key]['status'] = $comment->status;
        }

        return array('comments' => $arr, 'pages' => strval($pages));
    }

    /**
     * 根据id获取评论
     * @param $comment_id 评论id
     */
    public function getCommentById($comment_id){
        $comment = $this->where('id', $comment_id)->first();
        if(empty($comment)){
            return array();
        }
        return $comment;
    }

    /**
     * 根据文章id获取文章的评论数量
     * @param $article_id 文章id
     */
    public function getCommentNumsByArticleId($article_id){
        $num = $this->where('article_id', $article_id)->count();
        if(empty($num)){
            return 0;
        }
        return $num;
    }

    /**
     * 修改点赞数量
     * @param $comment_id 评论id
     * @param $num 新的点赞数量
     */
    public function addCommentAgree($comment_id, $num){
        $res = $this->where('id', $comment_id)->update(['agree_num' => $num]);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 修改点踩数量
     * @param $comment_id 评论id
     * @param $num 新的点赞数量
     */
    public function addCommentDisagree($comment_id, $num){
        $res = $this->where('id', $comment_id)->update(['disagree_num' => $num]);
        if(empty($res)){
            return array();
        }
        return $res;
    }
}
