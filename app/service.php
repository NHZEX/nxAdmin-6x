<?php

use app\Service\Auth\AuthService;
use app\Service\DebugHelper\DebugHelperService;
use app\Service\DeployTool\DeployServer;
use app\Service\Redis\RedisService;
use app\Service\Swoole\SwooleService;
use app\Service\Validate\ValidateService;
use HZEX\Think\Cors\Service as CorsService;

return [
    SwooleService::class,
    CorsService::class,
    AuthService::class,
    DeployServer::class,
    DebugHelperService::class,
    RedisService::class,
    ValidateService::class,
];
