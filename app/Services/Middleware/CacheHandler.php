<?php
/**
 * Project ~ Lumen-hprose-seed
 * FileName: CacheHandler.php
 *
 * @author  :  Liujian <laoliu@lanmv.com>
 * @package App\Services\Middleware
 *
 * Date: 2016/12/27 下午9:07
 */

namespace App\Services\Middleware;

use Cache;
use Closure;
use stdClass;

class CacheHandler
{
    public function handle($name, array &$args, stdClass $context, Closure $next)
    {
        if (isset($context->userdata->cache)) {
            $key = 'api-'.$name.'-'.md5(hprose_serialize($args));
            if (Cache::has($key)) {
                return Cache::get($key);
            }
            else {
                $result = $next($name, $args, $context);
                Cache::put($key, $result, 3600);
            }

            return $result;
        }
        return $next($name, $args, $context);
    }
}