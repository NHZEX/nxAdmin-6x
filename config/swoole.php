<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use app\Service\Swoole\DestroyRedisConnection;
use app\Service\Swoole\ServiceHealthCheck;
use think\facade\App;

return [
    'hot_reload' => [
        'enable'  => env_get('SERVER_HOT_RELOAD', false),
        'name'    => ['*.php'],
        'notName' => [],
        'include' => [
            app_path(),
            root_path('extend'),
            root_path('vendor/topthink'),
            root_path('vendor/nhzex')
        ],
        'exclude' => [],
    ],
    'enable_coroutine' => true,
    'plugins' => [
    ],
    'tasks' => [],
    'resetters' => [],
    'penetrates' => [],
    'process' => [
    ],
    'events' => [],
    'pools' => [],
    'container' => [
        'destroy' => [
            DestroyRedisConnection::class,
        ],
    ],
    'health' => ServiceHealthCheck::class,
    'memory_limit' => '512M',
    'resolveLogger' => function () {
        return \app()->log;
    },
    'server' => [
        'listen' => env_get('SERVER_HTTP_LISTEN', '0.0.0.0:9501'), // 监听
        'mode' => SWOOLE_PROCESS, // 运行模式 默认为SWOOLE_PROCESS
        'sock_type' => SWOOLE_TCP, // sock type 默认为SWOOLE_SOCK_TCP
        'options' => [
            'daemonize' => false,
            'dispatch_mode' => 2,
            'worker_num' => env_get('SERVER_WORKER_NUM', 4),
            'enable_coroutine' => true,

            'task_worker_num' => env_get('SERVER_TASK_WORKER_NUM', 2),
            'task_enable_coroutine' => true,

            'pid_file' => App::getRuntimePath() . 'swoole.pid',
            'log_file' => App::getRuntimePath() . 'swoole.log',

            // 启用Http响应压缩
            'http_compression' => true,
            // 启用静态文件处理
            'enable_static_handler' => true,
            // 设置静态文件根目录
            'document_root' => App::getRootPath() . 'public',
            // 设置静态处理器的路径
            'static_handler_locations' => ['/static', '/upload', '/favicon.ico', '/robots.txt'],

            //心跳检测：每60秒遍历所有连接，强制关闭20分钟内没有向服务器发送任何数据的连接
            'heartbeat_check_interval' => 60,
            'heartbeat_idle_time' => 1200,

            'package_max_length' => 20 * 1024 * 1024, // 设置最大数据包尺寸
            'buffer_output_size' => 10 * 1024 * 1024, // 发送输出缓存区内存尺寸
            'socket_buffer_size' => 128 * 1024 * 1024, // 客户端连接的缓存区长度

            // 'max_request' => 100000,
            // 'task_max_request' => 100000,
            'send_yield' => true, // 发送数据协程调度
            'reload_async' => true, // 异步安全重启
        ],
    ],
    'websocket' => [
        'enabled' => false,
        // 'host' => '0.0.0.0', // 监听地址
        // 'port' => 9502, // 监听端口
        // 'sock_type' => SWOOLE_TCP, // sock type 默认为SWOOLE_SOCK_TCP
        // 'handler' => WebSocket::class,
        // 'parser' => Parser::class,
        // 'route_file' => base_path() . 'websocket.php',
        'ping_interval' => 25000,
        'ping_timeout' => 60000,
    ],
];