<?php

namespace app\index\controller;

use app\extend\rlyun\SendTemplateSMS;

require_once APP_PATH . '../extend/rlyun/SendTemplateSMS.php';

class Index
{
    public function index()
    {
        echo 'I am Index action';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function sms()
    {
        $mobile = '17682349912';
        $code = $this->randString();
        $data = [$code, '5'];
        $messge = new SendTemplateSMS();
        return $messge->sendTemplateSMS($mobile, $data);
    }

    public function randString($len = 6)
    {
        $chars = str_repeat('0123456789', 3);
        // 位数过长重复字符串一定次数
        $chars = str_repeat($chars, $len);
        $chars = str_shuffle($chars);
        $str = substr($chars, 0, $len);
        return $str;
    }

}
