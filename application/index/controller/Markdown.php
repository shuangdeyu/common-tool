<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/7 0007
 * Time: 下午 9:25
 */

namespace app\index\controller;

use think\Request;

class Markdown extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function index(){
        return view('markdown/parsing');
    }

    public function edit(){
        return view('markdown/edit');
    }
}