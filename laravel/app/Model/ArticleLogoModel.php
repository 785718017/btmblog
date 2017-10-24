<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleLogoModel extends Model
{
    //定义表名
    protected $table = 'article_logo';

    //去掉时间戳维护
    public $timestamps = false;

    /**
     * 根据logo_id获取文章的logo
     * @param int $id logo_id
     * @return array logo信息
     */
    public function getLogoById($id){
        $logo = $this->where('id',$id)->first();
        if(empty($logo)){
            return array();
        }
        return $logo;
    }
    /**
     * 修改logo的状态
     * @param int $logo_id
     * @param int $status logo的状态,0表示未使用,1表示使用中
     */
    public function changeLogoStatus($logo_id, $status){
        $logo = $this->where('id', $logo_id)->update(['status' => $status]);
        if(empty($logo)){
            return array();
        }
        return $logo;
    }
}
