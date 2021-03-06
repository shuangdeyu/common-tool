<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/19 0019
 * Time: 下午 10:33
 */

namespace app\index\controller;

use think\Request;

class Translate extends Base
{
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        header("Content-type: text/html; charset=utf-8");
    }

    /**
     * 界面展示
     */
    public function index()
    {
        return view('translate/index');
    }

    /**
     * 执行翻译操作
     */
    public function doTranslate()
    {
        $input = input('param.input');
        $from = input('param.from');
        $to = input('param.to');

        $ret = $this->translate($input, $from, $to);
        return showRes(1, 'success', 'json', $ret);
    }

    //翻译入口
    public function translate($query, $from, $to)
    {
        $args = array(
            'q' => $query,
            'appid' => APP_ID,
            'salt' => rand(10000, 99999),
            'from' => $from,
            'to' => $to,

        );
        $args['sign'] = $this->buildSign($query, APP_ID, $args['salt'], SEC_KEY);
        $ret = $this->call(URL, $args);
        $ret = json_decode($ret, true);
        return $ret;
    }

    //加密
    public function buildSign($query, $appID, $salt, $secKey)
    {/*{{{*/
        $str = $appID . $query . $salt . $secKey;
        $ret = md5($str);
        return $ret;
    }/*}}}*/

    //发起网络请求
    public function call($url, $args = null, $method = "post", $testflag = 0, $timeout = CURL_TIMEOUT, $headers = array())
    {/*{{{*/
        $ret = false;
        $i = 0;
        while ($ret === false) {
            if ($i > 1)
                break;
            if ($i > 0) {
                sleep(1);
            }
            $ret = $this->callOnce($url, $args, $method, false, $timeout, $headers);
            $i++;
        }
        return $ret;
    }/*}}}*/

    public function callOnce($url, $args = null, $method = "post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers = array())
    {/*{{{*/
        $ch = curl_init();
        if ($method == "post") {
            $data = $this->convert($args);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST, 1);
        } else {
            $data = $this->convert($args);
            if ($data) {
                if (stripos($url, "?") > 0) {
                    $url .= "&$data";
                } else {
                    $url .= "?$data";
                }
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($withCookie) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
        }
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }/*}}}*/

    public function convert(&$args)
    {/*{{{*/
        $data = '';
        if (is_array($args)) {
            foreach ($args as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $k => $v) {
                        $data .= $key . '[' . $k . ']=' . rawurlencode($v) . '&';
                    }
                } else {
                    $data .= "$key=" . rawurlencode($val) . "&";
                }
            }
            return trim($data, "&");
        }
        return $args;
    }/*}}}*/
}