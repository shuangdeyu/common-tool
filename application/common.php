<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 百度翻译密钥
 */
define("CURL_TIMEOUT",   10);
define("URL",            "http://api.fanyi.baidu.com/api/trans/vip/translate");
define("APP_ID",         "20180119000117089"); //替换为您的APPID
define("SEC_KEY",        "yuEipNlVM8qM62631m66");//替换为您的密钥

/**
 * 设置ajax跨域头文件，允许跨域
 */
function setAjaxHead()
{
    header("Access-Control-Allow-Origin:*"); //*号表示所有域名都可以访问
    header("Access-Control-Allow-Method:POST,GET");
}

/**
 * 按综合方式输出通信数据
 * @param integer $code 状态码
 * @param string $message 提示信息
 * @param string $type 数据类型
 * return string
 */
function showRes($code, $message = '', $type = 'default', $data = [])
{
    $type = strtolower($type);

    switch($type){
        case 'default':
            echo $message;
            break;
        case 'json':
            showJson($code, $message, $data);
            break;
    }
}

/**
 * 按json方式输出通信数据
 * @param integer $code 状态码
 * @param string $message 提示信息
 * return string
 */
function showJson($code, $message = '', $data = array())
{
    $result = array(
        'code'    => $code,
        'msg' => $message,
        'data'    => $data
    );

    echo json_encode($result);
}
