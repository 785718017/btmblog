<?php

namespace App\Http\Controllers\Admin;

use App\Service\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * 权限页面
     * @param int $id权限id
     */
    public function index($id = 0){
        if($id == 0){
            $auth_title = '顶级权限';
            $father_id = 0;
        }else{
            $AuthService = new AuthService();
            $auth = $AuthService->getAuthById($id);
            $auth_title = $auth['title'];
            $father_id = $auth['father_id'];
        }
        return view('admin.Auth.index',['page_title'=>'权限','auth_id'=>$id, 'auth_title'=>$auth_title, 'father_id'=>$father_id]);
    }

    /**
     * 获取该权限id下的子权限列表
     */
    public function getChildAuths(Request $request, AuthService $authService){
        $auth_id = $request->input('auth_id');
        $child_auths = $authService->getChildAuths($auth_id);
        if(empty($child_auths)){
            return $this->error('没有子权限');
        }
        return $this->success($child_auths);
    }

    /**
     * 添加权限页面
     */
    public function addChildAuth($id){
        // 获取该权限的信息
        if($id == 0){
            $auth = array();
            $auth['id'] = $id;
            $auth['title'] = '顶级权限';
        }else{
            $AuthService = new AuthService();
            $auth = $AuthService->getAuthById($id);
            if(empty($auth)){
                return '该权限不存在!';
            }
        }
        // 展示添加权限的页面
        return view('admin.Auth.addChildAuth',['page_title'=>'添加权限','auth'=>$auth]);
    }

    /**
     * 添加权限
     */
    public function addAuth(Request $request, AuthService $authService){
        $father_id = $request->input('father_id');
        $url = $request->input('url');
        $description = $request->input('description');
        $type = $request->input('type');
        $params_num = $request->input('params_num');

        if(empty($url) || empty($description) || empty($type)){
            return $this->error('缺少参数');
        }

        $this->startTrans();
        $res = $authService->addAuth($father_id, $url, $description, $type, $params_num);
        if($res){
            return $this->success('添加成功');
        }else{
            return $this->error('添加失败');
        }
    }

    /**
     * 更新用户组权限
     */
    public function updateGroupAuth(Request $request, AuthService $authService){
        $group_id = $request->input('group_id');
        $auth_ids = $request->input('auth_ids');
        // 获取用户组已有的权限
        $group_auths = $authService->getGroupAuthsById($group_id);

        $this->startTrans();
        // 没有权限变化时,默认res为true
        $res = true;

        if(empty($group_auths)){
            // 所有权限新增
            $res = $authService->addGroupAuths($group_id, $auth_ids);
        }else{
            // 对比二者,得到要新增和删除的权限(其它的不处理)
            $group_auth_ids = array_column($group_auths, 'auth_id');
            $delete_auths = array_diff($group_auth_ids, $auth_ids);
            $add_auths = array_diff($auth_ids, $group_auth_ids);
            // 删除权限
            if(!empty($delete_auths)){
                $res = $authService->deleteGroupAuths($group_id, $delete_auths);
                if(!$res){
                    return $this->error('删除权限失败');
                }
            }

            // 增加权限
            if(!empty($add_auths)){
                $res = $authService->addGroupAuths($group_id, $add_auths);
            }
        }

        if(!$res){
            return $this->error('更新权限失败');
        }
        return $this->success('更新权限成功');
    }

    /**
     * 获取用户组所有权限
     */
    public function getGroupAuths(Request $request, AuthService $authService){
        $group_id = $request->input('group_id');
        // 获取用户组已有的权限
        $group_auths = $authService->getGroupAuthsById($group_id);
        if(!empty($group_auths)){
            $group_auth_ids = array_column($group_auths, 'auth_id');
        }else{
            $group_auth_ids = array();
        }
        return $this->success($group_auth_ids);
    }
}
