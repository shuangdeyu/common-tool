<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/22
 * Time: 9:58
 */

namespace data\extend;


class MapApi
{
    /**
     * 发送HTTP请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    public function http($url, $params, $method = 'GET', $header = array(), $multi = false){
        $opts = array(
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER      => $header
        );
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new \think\Exception('不支持的请求方式！');
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        //if($error) throw new Exception('请求发生错误：' . $error);
        return  $data;
    }

    /**
     * 通过单个地址获取经纬度
     * @param string $address 地址
     * @return array|mixed
     */
    public function getLonLat($address){
        $url = "http://api.map.baidu.com/geocoder/v2/";
        $header = array("Content-type: text/html; charset=utf-8");
        $params['output'] = 'json';//返回数据格式类型
        $params['ret_coordtype'] = 'gcj02ll';//国测局经纬度坐标
        $params['address'] = $address;//地址
        $params['ak'] = 'FsFDqoBoDgOZcGXFTygDyghkQzmiVGXp';//用户申请注册的key
        $httpReturn = $this->http($url,$params,'GET',$header);
        $httpReturn = json_decode($httpReturn, true);
        return $httpReturn;
    }


}