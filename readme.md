# Right way to use hprose for lumen

`Hprose` is a High Performance Remote Object Service Engine.

It is a modern, lightweight, cross-language, cross-platform, object-oriented, high performance, remote dynamic communication middleware. It is not only easy to use, but powerful. 

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Introduction

This project show the right way to use hprose for lumen and build the powerful WebService.

## Installation

```
git clone https://github.com/Lao-liu/Lumen-hprose-seed.git Api
cd Api && composer install
```
## Configuration

```php
# copy a config file
cp vendor/lao-liu/laravel-hprose/config/hprose.php app/Config/hprose.php

# copy .env file
cp .env.example .env

# edit Api/config/hprose.php
# edit .env
```

## Usage

### hprose server
```php
# Api/routes/web.php

$hproseService = function() use ($app){
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
$app->get('/api', $hproseService);
$app->post('/api', $hproseService);
```

### hprose client

```php
$hprose_client = app('RpcClient')->use('http://hprose-service-url', false);
$hprose_client->addFilter(new Xxtea());
$result = $hprose_client->users_list();
```

## License

The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
