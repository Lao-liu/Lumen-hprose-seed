<?php
/**
 * Project ~ Lumen-hprose-seed
 * FileName: Xxtea.php
 *
 * @author  :  Liujian <laoliu@lanmv.com>
 * @package App\Services
 *
 * Date: 2016/12/27 下午2:27
 */

namespace App\Services\Filters;

//use Log;
use stdClass;
use Hprose\Filter;

class Xxtea implements Filter
{
    const ENCRYPTION_KEY = '5AB485E2E3D790ED';

    public function inputFilter($data, stdClass $context)
    {
        try {
//            Log::info("Input: ", [$data]);
            $data = xxtea_decrypt(base64_decode($data), self::ENCRYPTION_KEY);
//            Log::info("Input Decrypt: ", [$data]);
            return $data;
        } catch (\Exception $e) {
            trigger_error("Request parameter decryption failed");
        }
    }

    public function outputFilter($data, stdClass $context)
    {
        try {
//            Log::info("Output: ", [$data]);
            $data = base64_encode(xxtea_encrypt($data, self::ENCRYPTION_KEY));
//            Log::info("Output Encrypt: ", [$data]);
            return $data;
        } catch (\Exception $e) {
            trigger_error("Request parameter decryption failed");
        }
    }
}