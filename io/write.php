<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-9
 * Time: 下午8:32
 */

$file_content = PHP_EOL . '张华';
swoole_async_writefile(__DIR__ . '/test.txt', $file_content, function($filename) {
    echo "{$filename} wirte ok.\n";
}, FILE_APPEND);