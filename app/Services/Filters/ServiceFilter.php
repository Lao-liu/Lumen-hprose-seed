<?php
/**
 * Project ~ Lumen-hprose-seed
 * FileName: ServiceFilter.php
 *
 * @author  :  Liujian <laoliu@lanmv.com>
 * @package App\Services
 *
 * Date: 2016/12/27 下午2:25
 */

namespace App\Services;

use Hprose\Filter;
use stdClass;

class ServiceFilter implements Filter
{
    public function inputFilter($data, stdClass $context)
    {
        // TODO: Implement inputFilter() method.
        return $data;
    }

    public function outputFilter($data, stdClass $context)
    {
        // TODO: Implement outputFilter() method.
        return $data;
    }
}