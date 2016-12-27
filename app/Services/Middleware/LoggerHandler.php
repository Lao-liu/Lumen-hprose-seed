<?php

/**
 * Project ~ Lumen-hprose-seed
 * FileName: LoggerHandler.php
 *
 * @author:  Liujian <laoliu@lanmv.com>
 *
 * Date: 2016/12/27 下午7:32
 */
namespace App\Services\Middleware;

use Log;
use Closure;
use stdClass;

class LoggerHandler
{
    public function handle($name, array &$args, stdClass $context, Closure $next)
    {
        Log::info($name, [$args]);
        return $next($name, $args, $context);
    }
}