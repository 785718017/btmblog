<?php

namespace App\Service;

//公共服务层，定义service中一些公共的方法
class CommonService
{
    /**
     * @var string 分页信息
     */
	public $page = '';

    /**
     * 返回分页信息
     */
    public function getPage(){
        return $this->page;
    }

}
