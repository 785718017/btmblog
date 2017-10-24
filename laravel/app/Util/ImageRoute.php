<?php
namespace App\Util;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class ImageRoute
{
    static public function imageStorageRoute($name)
    {
        //获取当前的url
        $path = storage_path().'app/Files'.$name;
//        if(!file_exists($path)){
////            //报404错误
////            header("HTTP/1.1 404 Not Found");
////            header("Status: 404 Not Found");
////            exit;
//            return false;
//        }
        //输出图片
        return Storage::get($path);
    }
}
