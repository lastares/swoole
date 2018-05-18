<?php

namespace app\index\controller;

use app\common\lib\Redis;
use app\common\lib\Util;
use app\extend\rlyun\SendTemplateSMS;
use think\Request;

require_once APP_PATH . '../extend/rlyun/SendTemplateSMS.php';

class Index extends Base
{
    protected $request;
    private $redis;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        echo 'I am Index action';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function sendMessage()
    {
        echo 5555;
        $mobile = $this->request->param('mobile');
        if (empty($mobile)) {
            return $this->error('手机号不能为空');
        }
        $code = $this->randString();
        $message = new SendTemplateSMS();
        $sendMsgResult = $message->sendTemplateSMS($mobile, [$code, '2']);
        if ($sendMsgResult == true) {
            echo 666;
            $redis = new \Swoole\Coroutine\Redis();
            $redis->connect(config('redis.host'), config('redis.port'));
            $setKeyResult = $redis->set(Redis::smsKey($mobile), $code, config('redis.expired'));
            var_dump($setKeyResult);
            return json_encode(['code' => 0, 'msg' => '短信发送成功'], JSON_UNESCAPED_UNICODE);
//            if ($setKeyResult == 'ok') {
//                return $this->success('短信发送成功');
//            }
        }
        return $this->error('短信发送失败');
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
