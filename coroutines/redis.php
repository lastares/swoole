<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-11
 * Time: 上午10:37
 */


$http_server = new swoole_http_server('0.0.0.0', 8001);

$http_server->on('request', function ($request, $response) {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1', 6379);
    $value = $redis->get($request->get['a']);

    $response->header('charset', 'utf-8');
    $response->header('Content-Type', 'text/plain');
    $response->end($value);

});

$http_server->start();