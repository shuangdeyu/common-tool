<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/4
 * Time: 11:14
 */

namespace app\index\controller;

use data\extend\CryptAES;
use think\Request;

class Encryption extends Base
{
    //public $secret_key = 'JYJTOOLOWNUSEJYJ2017'; // 密钥
    //public $iv = 'JYJTOOLOWNUSEJYJ'; // 位移

    function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 显示界面 - aes
     */
    public function aesEncrypt(){
        return view('encrypt/aes_encrypt');
    }

    /**
     * 显示界面 - md5
     */
    public function md5Encrypt(){
        return view('encrypt/md5_encrypt');
    }
    public function doEncryptMd5(){
        $str = input('param.str');
        return showRes(1,'操作成功','json',md5($str));
    }

    /**
     * AES加密/解密
     */
    public function doEncrypt(){
        $type = input('param.type')?input('param.type'):1; // 1加密，2解密
        $str = input('param.str');
        $secret_key = input('param.secret_key');
        $iv = input('param.iv');

        if($type == 1){
            $code = self::__aesEncrypt($str, $secret_key, $iv);
            return showRes(1,'操作成功','json',$code);
        }elseif($type == 2){
            $code = self::__aesDecrypt($str, $secret_key, $iv);
            return showRes(1,'操作成功','json',$code);
        }else{
            return showRes(0,'参数错误','json');
        }
    }

    /**
     * AES - 加密
     * @param $str
     * @return bool|string
     */
    private function __aesEncrypt($str, $secret_key, $iv){
        $aes = new CryptAES();
        $aes->set_key( $secret_key ); // 设置密钥
        $aes->set_iv( $iv ); // 设置位移
        $aes->require_pkcs5(); // 设置加密方式为pkcs5
        $code = $aes->encrypt($str); // 加密
        // 进一步编码加密
        $code = base64_decode($code);
        $code = bin2hex($code);
        return $code;
    }

    /**
     * AES - 解密
     * @param $code
     * @return bool|mixed|string
     */
    private function __aesDecrypt($code, $secret_key, $iv){
        $aes = new CryptAES();
        $str = hex2bin($code);
        $str = base64_encode($str);
        $aes->set_key( $secret_key ); // 设置密钥
        $aes->set_iv( $iv ); // 设置位移
        $aes->require_pkcs5(); // 设置加密方式为pkcs5
        $str = $aes->decrypt($str); // 解密
        return $str;
    }
}