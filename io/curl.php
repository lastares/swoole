<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-11
 * Time: 上午9:30
 */

echo 'process_start_time: ' . date('Y-m-d H:i:s', time()) . PHP_EOL;
$urls = [
    'http://www.baidu.com',
    'http://music.baidu.com',
    'http://map.baidu.com',
    'http://image.baidu.com',
    'http://www.sina.com.cn',
    'http://qq.com'
];


for($i=0; $i < 6; $i++) {
    // 子进程
    $process = new swoole_process(function(swoole_process $worker) use($i, $urls) {
        $content = curlData($urls[$i]);
        echo $content . PHP_EOL;
    }, true);
    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach($workers as $worker) {
    echo $worker->read();
}
function curlData($url) {
    // curl
    sleep(1);
    return $url . 'success' . PHP_EOL;
}

echo 'process_end_time: ' . date('Y-m-d H:i:s', time()) . PHP_EOL;