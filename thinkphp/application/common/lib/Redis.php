<?php

namespace app\common\lib;

class Redis
{
    private static $sms_prefix = 'sms_';

    public static function smsKey(string $mobile)
    {
        return self::$sms_prefix . $mobile;
    }
}