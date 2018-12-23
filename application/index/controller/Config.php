<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/23 0023
 * Time: 18:49
 */

namespace app\index\controller;

use think\Controller;

class Config extends Controller
{
    public function index()
    {
        return view();
    }

    public function add()
    {
        $path = 'application/extra/web.php';
        $file = (include $path);
        $config = array(
            'WEB_DESCRIPTION' => input('WEB_DESCRIPTION')
        );
        $res = array_merge($file, $config);
        $str = '<?php return [';
        foreach ($res as $key => $value) {
            $str .= '\'' . $key . '\'' . '=>' . '\'' . $value . '\'' . ',';
        }
        $str .= ']; ';
        if (file_put_contents($path, $str)) {
            $this->success('添加成功');
        } else {
            $this->error('添加失败');
        }
    }
}