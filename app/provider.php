<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用容器绑定定义

use app\ExceptionHandle;
use app\Request;
use app\Server\WebConv;

return [
    'think\Request' => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'webconv' => WebConv::class,
];
