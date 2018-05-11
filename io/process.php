<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-10
 * Time: 下午4:49
 */


/**
 * 创建进程
 */
$process = new swoole_process(function (swoole_process $procs){

    // 创建子进程
    $procs->exec('/usr/local/php/bin/php', [__DIR__ . '/../server/http_server.php']);
}, true);


$pid = $process->start();
echo $pid . PHP_EOL;

swoole_process::wait();
