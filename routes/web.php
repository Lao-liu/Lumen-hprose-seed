<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Services\Middleware\CacheHandler;
use App\Services\Middleware\LoggerHandler;

$app->get('/', function () use ($app) {
    return $app->version();
});

/**
 * Config hprose server
 */
$hproseService = function() use ($app){
    /**
     * @var Hprose\Http\Server $server
     */
    $server = app('RpcServer');
    // Encryption use xxtea
    $server->addFilter(new App\Services\Filters\Xxtea());
    // Enable Cache
    $server->addInvokeHandler([new CacheHandler(), 'handle']);
    // Enable Logger
    $server->addInvokeHandler([new LoggerHandler(), 'handle']);
    // Support JsonRpc
    $server->addFilter(new Hprose\Filter\JSONRPC\ServiceFilter());
    // Support XmlRpc
    $server->addFilter(new Hprose\Filter\XMLRPC\ServiceFilter());
    // Add services
    $server->addInstanceMethods(new App\Services\UsersService(), '', 'users');
    // Publish
    $server->start();
};
/**
 * Config Api Routes
 */
$app->get('/api', $hproseService);
$app->post('/api', $hproseService);

/**
 * Other routes
 */
$app->get('/test', ['as' => 'test', 'uses' => 'ExampleController@test']);