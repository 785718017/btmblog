<?php

namespace App\Service;

use App\Constants;
use App\Model\ArticleAgreeModel;
use App\Model\ArticleCommentModel;
use App\Model\ArticleLogoModel;
use App\Model\ArticleModel;
use App\Model\ArticleTagModel;
use App\Model\TagsModel;

class ArticleService extends CommonService
{
	/**
     * 把文章的logo路径储存到数据库中
     * @param $url logo文件的路径
     */
	public function addArticleLogo($url){
        $ArticleLogoModel = new ArticleLogoModel();
        $data['url'] = $url;
        $logo_id = $ArticleLogoModel->insertGetId($data);
        if(empty($logo_id)){
            return false;
        }
        return $logo_id;
    }

    /**
     * 新增文章信息
     * @param array $data 文章信息
     * @return int 文章id
     */
    public function addArticle($data){
        $ArticleModel = new ArticleModel();

        $article['name'] = $data['name'];
        $article['author'] = $data['author'];
        $article['content'] = $data['content'];
        $article['logo'] = $data['logo_id'];
        $article['introduce'] = $data['introduct'];

        $now_time = date('Y-m-d H:i:s');
        $article['publish_time'] = $now_time;
        $article['rewrite_time'] = $now_time;

        $article_id = $ArticleModel->insertGetId($article);
        if(empty($article_id)){
            return false;
        }
        return $article_id;
    }

    /**
     * 储存文章标签
     * @param int $aid 文章id
     * @param int $tid 标签id
     */
    public function addArticleTag($aid, $tid){
        $ArticleTagModel = new ArticleTagModel();
        $ArticleTagModel->article_id = $aid;
        $ArticleTagModel->tag_id = $tid;

        $article_tag = $ArticleTagModel->save();
        if(empty($article_tag)){
            return false;
        }
        return $article_tag;
    }

    /**
     * 修改logo的状态
     * @param int $logo_id
     * @param int $status logo的状态,0表示未使用,1表示使用中
     */
    public function changeLogoStatus($logo_id, $status){
        $ArticleLogoModel = new ArticleLogoModel();
        $logo = $ArticleLogoModel->changeLogoStatus($logo_id, $status);
        return $logo;
    }
    /**
     * 获取所有的文章
     */
    public function getAllArticles(){
        $ArticleModel = new ArticleModel();
        $articles = $ArticleModel->getAllArticles();

        if(empty($articles)){
            return array();
        }

        $articles->map(function ($item){
            //获取文章的logo和tag
            $ArticleLogoModel = new ArticleLogoModel();
            $ArticleTagModel = new ArticleTagModel();
            $TagsModel = new TagsModel();

            $logo = $ArticleLogoModel->getLogoById($item->logo);
            if(empty($logo)){
                return array();
            }
            $item->logo = $logo;

            $tag_ids = $ArticleTagModel->getTagIdsByArticleId($item->id);
            if(!empty($tag_ids)){
                //获取标签的信息
                $tags = $TagsModel->getTagByIds($tag_ids);
                if(empty($tags)){
                    return array();
                }
                $item->tags = $tags;
            }
            return $item;
        });

        return $articles;
    }

    /**
     * 文章上线和下线
     * @param $id int 文章id
     */
    public function updateArticleStatus($id){
        $ArticleModel = new ArticleModel();
        $article = $ArticleModel->getArticleById($id);
        if(empty($article)){
            return array();
        }
        //判断文章的当前状态
        if($article->status == Constants::ARTICLE_ONLINE){
            $update = $ArticleModel->updateArticleStatus($id, Constants::ARTICLE_OFFLINE);
        }else{
            $update = $ArticleModel->updateArticleStatus($id, Constants::ARTICLE_ONLINE);
        }
        return $update;
    }

    /**
     * 根据文章id获取文章内容
     * @param $id int 文章id
     */
    public function getArticleById($id){
        $ArticleModel = new ArticleModel();
        $article = $ArticleModel->getArticleById($id);
        if(empty($article)){
            return array();
        }

        //获取文章的logo图
        $ArticleLogoModel = new ArticleLogoModel();
        $logo = $ArticleLogoModel->getLogoById($article->logo);
        $logo_url = asset('storage/'.$logo->url);
        $logo->url= $logo_url;

        $article->logo = $logo;
        //获取标签数据
        $ArticleTagModel = new ArticleTagModel();
        $tag_ids = $ArticleTagModel->getTagIdsByArticleId($id);
        if(empty($tag_ids)){
            return array();
        }
        //获取用户对该文章的点赞点踩情况
        $uid = session('uid');
        $ArticleAgreeModel = new ArticleAgreeModel();
        if(empty($uid)){
            $article->agree_type = 0; //用户未登录时
        }else{
            $info = $ArticleAgreeModel->getArticleAgreeByAidAndUid($article->id, $uid);
            if(empty($info)){
                $article->agree_type = 0; //用户没有点赞或者点踩记录时
            }else{
                $article->agree_type = $info->agree_type;
            }
        }

        $TagsModel = new TagsModel();
        $tags = $TagsModel->getTagByIds($tag_ids);
        $article->tags = $tags;

        return $article;
    }
    /**
     * 更新文章内容
     *  @param array $data 文章信息
     */
    public function updateArticle($data){
        $ArticleModel = new ArticleModel();

        $article['name'] = $data['name'];
        $article['author'] = $data['author'];
        $article['content'] = $data['content'];
        $article['logo'] = $data['logo_id'];
        $article['introduce'] = $data['introduct'];

        $now_time = date('Y-m-d H:i:s');
        $article['publish_time'] = $now_time;
        $article['rewrite_time'] = $now_time;

        $article = $ArticleModel->where('id',$data['id'])->update($article);
        if($article < 0){
            return false;
        }
        return $article;
    }
    /**
     * 获取文章的标签id
     * @param $id 文章id
     */
    public function getTagIdsByArticleId($id){
        $ArticleTagModel = new ArticleTagModel();
        $tag_ids = $ArticleTagModel->getTagIdsByArticleId($id);
        if(empty($tag_ids)){
            return array();
        }
        return $tag_ids;
    }
    /**
     * 删除文章的id
     * @param int $aid 文章id
     * @param int $tid 标签id
     */
    public function deleteArticleTag($aid, $tid){
        $ArticleTagModel = new ArticleTagModel();
        $delete = $ArticleTagModel->where('article_id', $aid)
                        ->where('tag_id', $tid)
                        ->delete();
        return $delete>0 ? $delete : false;
    }

    /**
     * 获取推荐的文章列表(即最新的5篇文章)
     */
    public function getRecommend(){
        $ArticleModel = new ArticleModel();
        $articles = $ArticleModel->getRecommend();
        if(empty($articles)){
            return array();
        }

        //获取logo和标签
        $articles->map(function( $item){
            $ArticleLogoModel = new ArticleLogoModel();
            $logo = $ArticleLogoModel->getLogoById($item->logo);
            if(!empty($logo)){
                $item->logo = $logo;
            }

            $ArticleTagModel = new ArticleTagModel();
            $TagsModel = new TagsModel();
            $tag_ids = $ArticleTagModel->getTagIdsByArticleId($item->id);
            if(!empty($tag_ids)){
                //获取标签的信息
                $tags = $TagsModel->getTagByIds($tag_ids);
                if(empty($tags)){
                    return array();
                }
                $item->tags = $tags;
            }

            //获取评论的数量
            $ArticleCommentModel = new ArticleCommentModel();
            $num = $ArticleCommentModel->getCommentNumsByArticleId($item->id);
            $item->comment_num = $num;


            //判断用户是否对这些文章进行了点赞或者点踩操作
            $uid = session('uid');
            $ArticleAgreeModel = new ArticleAgreeModel();
            if(empty($uid)){
                $item->agree_type = 0; //用户未登录时
            }else{
                $info = $ArticleAgreeModel->getArticleAgreeByAidAndUid($item->id, $uid);
                if(empty($info)){
                    $item->agree_type = 0; //用户没有点赞或者点踩记录时
                }else{
                    $item->agree_type = $info->agree_type;
                }
            }

            return $item;
        });


        return $articles;
    }
    /**
     * 获取阅读量最高的9篇文章
     */
    public function getHotNineArticles(){
        $ArticleModel = new ArticleModel();
        $articles = $ArticleModel->getHotNineArticles();
        return $articles;
    }

    /**
     * 增加阅读量
     * @param $id 文章id
     */
    public function increaseVisionTimes($id){
        $ArticleModel = new ArticleModel();
        $article = $ArticleModel->getArticleById($id);
        if(empty($article)){
            return array();
        }
        $vision_times = $article->browse_times + 1;
        $res = $ArticleModel->increaseVisionTimes($id, $vision_times);
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
    public function addArticleAgree($article_id, $user_id){
        $ArticleModel = new ArticleModel();
        $ArticleAgreeModel = new ArticleAgreeModel();

        //获取文章
        $article = $ArticleModel->getArticleById($article_id);
        if(empty($article)){
            return array();
        }
        //设置点赞数量
        $agree_num = $article->agree_num + 1;
        $res = $ArticleModel->addArticleAgree($article_id, $agree_num);
        if(empty($res)){
            return array();
        }
        //添加用户点赞记录
        $res = $ArticleAgreeModel->addUserArticleAgree($article_id, $user_id, Constants::AGREE_TYPE_AGREE);
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
    public function addArticleDisagree($article_id, $user_id){
        $ArticleModel = new ArticleModel();
        $ArticleAgreeModel = new ArticleAgreeModel();

        //获取文章
        $article = $ArticleModel->getArticleById($article_id);
        if(empty($article)){
            return array();
        }
        //设置点赞数量
        $disagree_num = $article->disagree_num + 1;
        $res = $ArticleModel->addArticleDisagree($article_id, $disagree_num);
        if(empty($res)){
            return array();
        }
        //添加用户点赞记录
        $res = $ArticleAgreeModel->addUserArticleAgree($article_id, $user_id, Constants::AGREE_TYPE_DISAGREE);
        if(empty($res)){
            return array();
        }
        return $res;
    }

    /**
     * 判断用户是否对该文章进行过点赞或者点踩操作
     * @param $article_id
     * @param $user_id
     * @return boolean 用户点过赞或者点过踩,返回true,否则返回false
     */
    public function hadUserAgreeArticle($article_id, $user_id){
        $ArticleAgreeModel = new ArticleAgreeModel();
        //判断用户是否对该文章进行过点赞或者点踩操作
        $had_agree = $ArticleAgreeModel->getArticleAgreeByAidAndUid($article_id, $user_id);
        return $had_agree;
    }
}
