<?php

$http_server = new swoole_http_server('0.0.0.0', '8811');
$http_server->set([
    'enable_static_handler' => true,
    'document_root' => '/usr/local/nginx/html/swoole/data'
]);
$http_server->on('request', function(swoole_http_request $request, swoole_http_response $response){

    $logInfo = [
        'Time: ' => date('Ymd H:i:s', time()),
        'Get: ' => $request->get,
        'Post: ' => $request->post,
        'Header' => $request->header
    ];
    swoole_async_writefile(__DIR__ . '/access.log', json_encode($logInfo) . PHP_EOL, function($filename) {
        echo '文件写入完成'. PHP_EOL;
    }, FILE_APPEND);
    $response->cookie('name', 'hwy', time() + 86400);
    $response->end('hello, ' . json_encode($request->get, JSON_UNESCAPED_UNICODE));
});

$http_server->start();