<?php

namespace App\Http\Controllers;

use Log;
use App\Services\Filters\Xxtea;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function test()
    {
        /**
         * @var \Hprose\Http\Client $hprose_client
         */
        $hprose_client = app('RpcClient')->use('http://lhseed.dev/api', false);
        $hprose_client->addFilter(new Xxtea());
        $result = $hprose_client->users_list();
        return $result;
    }
}
