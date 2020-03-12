<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23 0023
 * Time: 18:23
 */

namespace app\index\controller;

use think\Request;

class Design extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    // 中国传统配色
    public function cn_color()
    {
        $list = config('web.cn_color');
        $this->assign('list', $list);
        return view('design/cn_color');
    }

    // 日本传统配色
    public function jp_color()
    {
        $list = config('web.jp_color');
        $this->assign('list', $list);
        return view('design/jp_color');
    }

    // 香港地铁配色
    public function hk_color()
    {
        $list = config('web.hk_color');
        $this->assign('list', $list);
        return view('design/hk_color');
    }

    // switch配色大全
    public function ns_color()
    {
        $list = config('web.ns_color');
        $this->assign('list', $list);
        return view('design/ns_color');
    }
}