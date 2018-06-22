<?php
namespace app\index\controller;

use think\Request;

class Index extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 首页
     */
    public function index(){
        return view('index/index');
    }

    /**
     * 开源插件清单
     */
    public function plugList(){
        // json-view
        // http://www.jq22.com/jquery-info13551

        // editor - md
        // http://pandao.github.io/editor.md/

    }
}