<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 储存请求对象
     */
    protected $Request = null;
    /**
     * 事务的开启状态
     */
    protected $trans_status = false;
    /**
     * 初始化时调用的服务
     */
    public function  __construct(Request $Request){
        $this->$Request = $Request;
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
}
