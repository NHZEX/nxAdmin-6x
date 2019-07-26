<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace app;

use app\Exception\ExceptionRecordDown;
use app\Model\ExceptionLogs;
use app\Traits\PrintAbnormal;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    use PrintAbnormal;

    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 不对[http-404]进行高级记录
        // 不对降级异常进行高级记录
        if (false === $exception instanceof ExceptionRecordDown
            && !($exception instanceof HttpException && $exception->getStatusCode() === 404)
        ) {
            try {
                ExceptionLogs::push($exception);
            } catch (Throwable $throwable) {
                $newException = new ExceptionRecordDown('异常日志降级', 0, $throwable);
                // 打印记录异常
                self::printAbnormalToLog($newException);
            }
        }
        // 打印异常日志
        self::printAbnormalToLog($exception);
        // 交由系统处理
        parent::report($exception);
    }
}
