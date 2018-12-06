<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6 0006
 * Time: 17:42
 */

namespace app\index\controller;

use think\Request;

class Timestamp extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index(){
        return view('timestamp/index');
    }

    // 时间戳转换成时间
    public function stampToTime(){
        $stamp = input('param.stamp');
        $time = date('Y-m-d H:i:s', $stamp);

        return showRes(1, '操作成功', 'json', $time);
    }

    // 时间转换成时间戳
    public function timeToStamp(){
        $time = input('param.stamp');
        $stamp = strtotime($time);

        return showRes(1, '操作成功', 'json', $stamp);
    }
}