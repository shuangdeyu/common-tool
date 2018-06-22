<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/4
 * Time: 11:21
 */

namespace app\index\controller;

\think\Loader::addNamespace('data', 'data/');
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        setAjaxHead();
    }
}