<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/6
 * Time: 9:50
 */

namespace app\index\controller;

use think\Request;

class Map extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    // 高德-经纬度查询
    public function gao_coords()
    {
        return view('map/gao_coords');
    }

}