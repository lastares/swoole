<?php

$http_server = new swoole_http_server('0.0.0.0', '8811');
$http_server->set([
    'enable_static_handler' => true,
    'document_root' => '/usr/local/'
]);
$http_server->on('request', function(swoole_http_request $request, swoole_http_response $response){
    $response->cookie('name', 'hwy', time() + 86400);
    $response->end('hello, ' . json_encode($request->get['m'], JSON_UNESCAPED_UNICODE));
});

$http_server->start();