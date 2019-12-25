<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/6
 * Time: 9:50
 */

namespace app\index\controller;

use think\Request;

class Json extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index()
    {
        return view('json/index');
    }

    /**
     * 获取随机字符串
     * @return \think\response\View
     */
    public function nonceStr()
    {
        return view('json/nonce_str');
    }

    public function getNonceStr()
    {
        $len = input('param.len');
        if ($len > 50) {
            $len = 50;
        }
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $chars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $chars .= "0123456789";
        $chars .= "!@#$%&*|?+-{}[]";
        $str = "";
        for ($i = 0; $i < $len; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return showRes(1, '操作成功', 'json', $str);
    }

}