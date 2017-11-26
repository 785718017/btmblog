<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Notify extends Controller
{
    //公共通知控制器

    /**
     * 成功通知
     */
    public function successNotify($info, $time){
        //地址默认为前台首页
        $href = 'http://www.btmblog.com' ;
        if(empty($info)){   //提示信息为空,则提示成功
            $info = '成功';
        }
        if(empty($time)){   //时间为空或者0,则直接跳转
            header('Location: '.$href);
        }

        $arr = [
                'page_title'=>'正在跳转',
                'href' => $href ,
                'info' => $info ,
                'time' => $time
        ];
        //展示跳转页面
        return view('home/Common/successNotify', $arr);
    }
    /**
     * 失败通知
     */
    public function failNotify($info, $time){
        //地址默认为前台首页
        $href = 'http://www.btmblog.com' ;
        if(empty($info)){   //提示信息为空,则提示成功
            $info = '失败';
        }
        if(empty($time)){   //时间为空或者0,则直接跳转
            header('Location: '.$href);
        }

        $arr = [
            'page_title'=>'正在跳转',
            'href' => $href ,
            'info' => $info ,
            'time' => $time
        ];
        //展示跳转页面
        return view('home/Common/failNotify', $arr);
    }
}
