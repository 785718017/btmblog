<?php
namespace App\Util;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class Util
{
    /**
     * 公共函数,将数组按照其中的某个键值分类
     * @param $array 二位数组
     * @param $key 键名
     * @return array 三维数组
     */
    public static function array_group($array, $key)
    {
        $arr = array();
        if (empty($array)){
            return false;
        }
        foreach($array as $value){
            //没有这个键值
            if(!isset($value[$key])){
                return false;
            }else{
                $arr[$value[$key]][] = $value;
            }
        }

        return $arr;
    }

    /**
     * 公共函数,将数组中某个不重复的字段作为键名
     */
    public static function array_convert($array, $key){
        $arr  = array();
        if (empty($array)){
            return false;
        }
        foreach($array as $value){
            //没有这个键值
            if(!isset($value[$key])){
                return false;
            }else{
                $arr[$value[$key]] = $value;
            }
        }

        return $arr;
    }

    /**
     * 将查询出来的集合转化为二位数组
     */
//    public function collection_to_array($collection){
//        $array = array();
//        $collection->map(function($item, $key){
//            $array[$key] = $item;
//        });
//    }
}
