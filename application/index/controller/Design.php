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

    // 日本传统配色
    public function jp_color()
    {
        $list = config('web.jp_color');
        $this->assign('list', $list);
        return view('design/jp_color');
    }
}