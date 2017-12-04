<?php
    namespace App\Http\Controllers\Admin;
    use App\Constants;
    use App\Http\Controllers\Controller;
    use App\Service\ArticleService;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    class ArticleController extends Controller{
        /**
         * 显示文章列表
         * @author 半透明
         */
        public function index(){
            return view('admin.Article.article',['page_title'=>'文章管理']);
        }

        /**
         * 显示后台写文章的页面
         * @author 半透明
         */
        public function write(){
            return view('admin.Article.write',['page_title'=>'写文章']);
        }

        /**
         * 上传logo
         */
        public function uploadLogo(Request $request, ArticleService $articleService){
            $logo = $request->file('file')->store('article_logo');
            //将文件信息存入数据库
            $this->startTrans();
            $logo_id = $articleService->addArticleLogo($logo);
            //返回文件路径
            if(!$logo_id){
                return $this->error('存入logo数据失败');
            }
            $data = array();
            $data['logo_id'] = $logo_id;
            $data['url'] = asset('storage/'.$logo);
            return $this->success($data);
        }

        /**
         * 写文章
         */
        public function addArticle(Request $request, ArticleService $articleService){

            $data = $request->all();

            if(empty($data['name']) || empty($data['author']) || empty($data['content']) || empty($data['logo_id']) || empty($data['introduct']) || empty($data['tags'])){
                return $this->error('缺少参数');
            }
            //开启事务
            $this->startTrans();
            //将文章的数据入库
            $aid = $articleService->addArticle($data);
            if($aid == false){
                return $this->error('存储文章失败');
            }

            //储存文章标签数据
            $tags = array_unique($data['tags']);
            foreach($tags as $tag){
                $article_tag = $articleService->addArticleTag($aid, $tag);
                if(empty($article_tag)){
                    return $this->error('添加文章标签失败');
                }
            }
            //将对应的logo数据的status改为使用中
            $logo = $articleService->changeLogoStatus($data['logo_id'], Constants::TAG_STATUS_USE);
            if(empty($logo)){
                return $this->error('添加文章logo失败');
            }
            return $this->success('成功');
            //生成静态化的文件

        }
        /**
         * 获取所有的文章列表
         */
        public function getAllArticles(ArticleService $articleService){
            $articles = $articleService->getAllArticles();
            if(empty($articles)){
                return $this->error('获取数据失败');
            }
            $data = array();
            $data['data'] = $articles;

            //获取分页
            $pages = $articles->links();
            $data['pages'] = strval($pages);


            return $this->success($data);
        }

        /**
         * 修改文章页面
         */
        public function update(Request $request){
            $id = $request->input('id');
            //赋值给模板
            return view('admin.Article.update',['page_title'=>'修改文章','id'=>$id]);
        }

        /**
         * 文章上线和下线
         */
        public function onlineOrOffline(Request $request, ArticleService $articleService){
            $id = $request->input('id');
            //修改文章的状态
            $status = $articleService->updateArticleStatus($id);
            if(empty($status)){
                return $this->error('操作失败');
            }
            return $this->success('操作成功');
        }

        /**
         * 获取文章信息
         */
        public function getArticleInfo(Request $request, ArticleService $articleService){
            $id = $request->input('id');
            //获取文章的数据
            $article = $articleService->getArticleById($id);
            if(empty($article)){
                return $this->error('获取文章失败');
            }
            return $this->success($article);
        }

        /**
         * 保存文章的修改
         */
        public function updateArticle(Request $request, ArticleService $articleService){
            $data = $request->all();

            if(empty($data['id']) || empty($data['name']) || empty($data['author']) || empty($data['content']) || empty($data['logo_id']) || empty($data['introduct']) || empty($data['tags'])){
                return $this->error('缺少参数');
            }
            //开启事务
            $this->startTrans();
            //将文章的数据入库
            $update = $articleService->updateArticle($data);
            if($update == false){
                return $this->error('更新文章失败');
            }

            //储存文章标签数据
            $tags = array_unique($data['tags']);
            //获取文章的标签
            $article_tags = $articleService->getTagIdsByArticleId($data['id']);
            if(empty($article_tags)){
                //如果没有标签,则所有的标签全部插入
                foreach($tags as $tag){
                    $article_tag = $articleService->addArticleTag($data['id'], $tag);
                    if(empty($article_tag)){
                        return $this->error('添加文章标签失败');
                    }
                }
            }else{
                //对比标签的不同
                foreach($tags as $tag){
                    if(!in_array($tag, $article_tags)){
                        // 原来没有的加入
                        $article_tag = $articleService->addArticleTag($data['id'], $tag);
                        if(empty($article_tag)){
                            return $this->error('添加文章标签失败');
                        }
                    }
                }
                foreach($article_tags as $article_tag_old){
                    if(!in_array($article_tag_old, $tags)){
                        // 原来有的,现在没有的,删除
                        $article_tag = $articleService->deleteArticleTag($data['id'], $article_tag_old);
                        if($article_tag === false){
                            return $this->error('删除文章标签失败');
                        }
                    }
                }
            }

            //将对应的logo数据的status改为使用中
            $logo = $articleService->changeLogoStatus($data['logo_id'], Constants::TAG_STATUS_USE);
            if($logo === false){
                return $this->error('更新文章logo失败');
            }
            return $this->success('成功');
            //生成静态化的文件
        }
    }