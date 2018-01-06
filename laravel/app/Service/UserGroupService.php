<?php

namespace App\Service;

use App\Constants;
use App\Model\GroupModel;

class UserGroupService extends CommonService
{
    /**
     * 获取所有的用户组
     */
    public function getAllGroup(){
        $GroupModel = new GroupModel();
        $groups = $GroupModel->getAllGroup();
        return $groups;
    }


}
