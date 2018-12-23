<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/index/hello', ['method' => 'post']],
    ],

    // 主页
    'index' => 'index/index/index',
    // 加密类
    'encrypt/aes' => 'index/Encryption/aesEncrypt',
    'encrypt/do' => 'index/Encryption/doEncrypt',
    'encrypt/md5' => 'index/Encryption/md5Encrypt',
    'encrypt/do_md5' => 'index/Encryption/doEncryptMd5',
    'encrypt/uuid' => 'index/Encryption/showUuid',
    'encrypt/get_uuid' => 'index/Encryption/getUuid',
    // json
    'json' => 'index/Json/index',
    // 时间戳
    'timestamp' => 'index/Timestamp/index',
    'stamp_to_time' => 'index/Timestamp/stampToTime',
    'time_to_stamp' => 'index/Timestamp/timeToStamp',
    // markdown
    'markdown/par' => 'index/Markdown/index',
    'markdown/edit' => 'index/Markdown/edit',
    // translate
    'translate' => 'index/Translate/index',
    'translate/do' => 'index/Translate/doTranslate',
    // 设计
    'design/jp_color' => 'index/Design/jp_color',

];
