<?php

namespace App\Service;

use App\Constants;
use App\Model\AuthModel;
use App\Model\GroupAuthModel;
use App\Util\Util;

class AuthService extends CommonService
{
    /**
     * 根据id获取权限(结果为数组)
     * @param $id 权限id
     */
    public function getAuthById($id){
        $AuthModel = new AuthModel();
        $auth = $AuthModel->getAuthById($id);
        return $auth;
    }

    /**
     * 添加权限
     * @param $father_id 父级id
     * @param $url 路由地址
     * @param $description 中文描述
     * @param $type get为1,post为2
     * @param $params_num 参数数量
     */
    public function addAuth($father_id, $url, $description, $type, $params_num){
        $AuthModel = new AuthModel();
        $res = $AuthModel->addAuth($father_id, $url, $description, $type, $params_num);
        return $res;
    }

    /**
     * 获取该权限下的所有子权限
     * @param $auth_id
     */
    public function getChildAuths($auth_id){
        $AuthModel = new AuthModel();
        $child_auths = $AuthModel->getChildAuths($auth_id);
        return $child_auths;
    }

    /**
     * 获取所有的权限,并分层(递归算法)
     */
    public function getAllLevelAuths($id = 0){
        // 先获取顶级权限(father_id为0)
        $auths = $this->getChildAuths($id);
        if(empty($auths)){
            return array();
        }
        // 递归获取子权限集合
        foreach ($auths as $key=>$auth){
            $child_auths = $this->getAllLevelAuths($auth['id']);
            if(empty($child_auths)){
                continue;
            }
            $auths[$key]['child_auths'] = $child_auths;
        }
        return $auths;
    }

    /**
     * 获取用户组的权限(值为数组)
     * @param $group_id 用户组id
     */
    public function getGroupAuthsById($group_id){
        $GroupAuthModel = new GroupAuthModel();
        $auths = $GroupAuthModel->getGroupAuthsById($group_id);
        return $auths;
    }

    /**
     * 为用户组添加权限
     * @param $group_id 用户组id
     * @param $auth_ids 权限id数组
     */
    public function addGroupAuths($group_id, $auth_ids){
        $GroupAuthModel = new GroupAuthModel();
        $res = $GroupAuthModel->addGroupAuths($group_id, $auth_ids);
        return $res;
    }

    /**
     * 为用户组删除权限
     * @param $group_id 用户组id
     * @param $auth_ids 权限id数组
     */
    public function deleteGroupAuths($group_id, $auth_ids){
        $GroupAuthModel = new GroupAuthModel();
        $res = $GroupAuthModel->deleteGroupAuths($group_id, $auth_ids);
        return $res;
    }

    /**
     * 根据url获取auth的id
     * @param $url
     */
    public function getAuthIdByUrl($url){
        // 先获取所有的权限
        $AuthModel = new AuthModel();
        $auths = $AuthModel->getAllAuths();
        if(empty($auths)){
            return 0;
        }
        // 按照参数个数分组,并按照参数个数升序排序
        $auths = Util::array_group($auths, 'params_num');
        ksort($auths);

        $auth_id = 0;
        foreach($auths as $params_num=>$p_auths){
            if($params_num == 0){
                foreach($p_auths as $auth){
                    if($url == $auth['auth_name']){
                        // 返回id
                        return $auth['id'];
                    }
                }
            }else{
                // 如果参数数量大于0,则url和auth都去掉参数再进行比较
                $url_arr = explode('/', $url);
                for($i=0;$i<$params_num;$i++){
                    array_pop($url_arr);
                }
                $temp_url = implode('/', $url_arr);
                foreach($p_auths as $auth){
                    if($temp_url == $auth['auth_name']){
                        // 返回id
                        return $auth['id'];
                    }
                }
            }

        }
        return $auth_id;
    }

    /**
     * 获取用户组的所有权限
     * @param $group_ids 用户组id数组
     */
    public function getGroupsAuths($group_ids){
        $GroupAuthModel = new GroupAuthModel();
        $auths = $GroupAuthModel->getGroupsAuths($group_ids);
        if(empty($auths)){
            return array();
        }
        $auths = array_unique(array_column($auths, 'auth_id'));
        return $auths;
    }
}
