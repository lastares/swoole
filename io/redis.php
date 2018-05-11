<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-5-10
 * Time: 下午4:20
 */


$redisClient = new swoole_redis;
$redisClient->connect('127.0.0.1', 6379, function(swoole_redis $redisClient, $result) {
    if($result === true) {
        echo 'redis is connected' . PHP_EOL;
        var_dump($result);
//        $redisClient->set('name1', time(), function(swoole_redis $redisClient, $result) {
//            return $result;
//        });
//        $redisClient->get('name1', function(swoole_redis $redisClient, $result) {
//            var_dump($result);
//            $redisClient->close();
//        });

        $redisClient->keys('*', function(swoole_redis $redisClient, $result) {
            var_dump($result);
            $redisClient->close();
        });
    }
});