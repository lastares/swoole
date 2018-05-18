<?php

namespace app\common\lib;

class Util
{
    const FIELD_CODE = 'code';
    const FIELD_MESSAGE = 'msg';
    const FIELD_DATA = 'data';

    private static $data = [
        self::FIELD_CODE => 0,
        self::FIELD_MESSAGE => '',
        self::FIELD_DATA => []
    ];

    protected  function error($msg = '操作失败')
    {
        $this->data[self::FIELD_CODE] = 1;
        $this->data[self::FIELD_MESSAGE] = $msg;
        return $this->data;
    }

    protected function success($msg='操作成功', $data = [])
    {
        $this->data[self::FIELD_CODE] = 0;
        $this->data[self::FIELD_MESSAGE] = $msg;
        $this->data[self::FIELD_DATA] = $data;
        return $this->data;
    }

}