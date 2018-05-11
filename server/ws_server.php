<?php

$server = new swoole_websocket_server("0.0.0.0", 8812);

$server->set([
    'enable_static_handler' => true,
    'document_root' => '/usr/local/nginx/html/swoole/data'
]);

$server->on('open', 'onOpen');
function onOpen($server, $request) {
    $request->fd;
}

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();