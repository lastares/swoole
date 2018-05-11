<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-9
 * Time: 下午8:23
 */

swoole_async_readfile(__DIR__ . '/test.txt', function($filename, $content) {
    echo 'filename: ' . $filename . PHP_EOL;
    echo 'content: ' . $content . PHP_EOL;
});