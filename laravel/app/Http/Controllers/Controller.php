<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 事务的开启状态
     */
    protected $trans_status = false;

    /**
     * 用户id
     */
    protected $uid = null;
    /**
     * 昵称
     */
    protected $nick_name = null;
    /**
     * 登录方式
     */
    protected $login_type = null;
    /**
     * 用户头像
     */
    protected $head = null;
    /**
     * 初始化时调用的服务
     */
    public function  __construct(Request $Request){
        //laravel 5.3 之后就无法再构造函数中获取session了,因为中间件还未加载,参考官方文档http://laravelacademy.org/post/5691.html
        //如果用户已登录,则设置uid等属性
//        $this->uid = $Request->session()->get('uid');
//        $this->nick_name = $Request->session()->get('nick_name');
//        $this->login_type = $Request->session()->get('login_type');
//        $this->head = $Request->session()->get('head');

    }

    /**
     * 开启事务
     */
    public function startTrans(){
        if(!($this->trans_status)){
            DB::beginTransaction();
            $this->trans_status = true;
        }
    }
    /**
     * 操作成功方法（返回数据并提交事务）
     * @param $info 返回的信息
     */
    public function success($info){
        $data['info'] = $info;
        $data['status'] = (int)1;
        if($this->trans_status){
            DB::commit();
            $this->trans_status = false;
        }
        return $data;
    }

    /**
     * 操作失败方法（返回提示并回滚事务）
     * @param $info 返回的信息
     * @param $jump_url 跳转的地址
     */
    public function error($info){
        $data['info'] = $info;
        $data['status'] = (int)0;
        if($this->trans_status){
            DB::rollback();
            $this->trans_status = false;
        }
        return $data;
    }

    /**
     * 根据文件的url,创建文件夹以及文件
     * @param $url 文件的url
     * @param $data 要写入文件的内容
     */
    public function createOrUpdateDirAndFile($url, $data){
        // 将url分称文件夹和文件
        $url_params = explode('/', $url);
        array_pop($url_params);
        $dir_path = implode('/', $url_params);

        // 判断文件夹是否存在,如果不在则递归创建文件夹
        if(!is_dir($dir_path)){
            if(!mkdir($dir_path, 0777, true)){
                return false;
            }
        }
        // 创建文件
        $res = fopen($url, 'w');
        if($res === false){
            return false;
        }
        $write = fwrite($res, $data);
        if($write === false){
            return false;
        }
        fclose($res);
        return true;
    }
}
