<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);
if(!$client->connect('127.0.0.1', '9501')) {
    echo 'swoole connect is failed';
    exit;
}

//php cli const
fwrite(STDOUT, 'please input your message: ');



$msg = trim(fgets(STDIN));


// send message to tcp server
$client->send($msg);

// receiver from server data
$result = $client->recv();

echo $result;
