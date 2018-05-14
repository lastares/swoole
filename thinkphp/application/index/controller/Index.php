<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        $a = false;
        echo $a && '6666';

//        echo '<h1>Hello, TihinkPhp</h1>';
    }

    public function add()
    {
        echo random_int(1, 10) . 'test' . PHP_EOL;
        echo 'I am Add' . PHP_EOL;
    }
    
    public function test()
    {
        echo random_int(1, 10) . 'test' . PHP_EOL;
        echo 'I am test' . PHP_EOL;
    }

}

