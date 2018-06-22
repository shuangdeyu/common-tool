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

    public function index(){
        return view('json/index');
    }
}