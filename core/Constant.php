<?php


namespace core;
class Constant
{

    const SUCCESS = 0; //成功
    const UNKNOWN_ERROR = 1; //位置错误
    const PARAM_REPEAT = 2;//变量重复
    const USER_ERROR = 3;//用户名或密码错误
    const SESSION_OVERTIME = 4;//已经过期

    public static $ret = array(
        self::SUCCESS => '成功',
        self::PARAM_REPEAT => '重复',
        self::USER_ERROR => '用户名或密码错误',
        self::SESSION_OVERTIME => '信息过期',
        self::UNKNOWN_ERROR => '未知错误'
    );

    public static function getMsg($exceptionCode)
    {

        if (isset(self::$ret[$exceptionCode])) {
            return self::$ret[$exceptionCode];
        } elseif (isset(static::$ret[$exceptionCode])) {
            return static::$ret[$exceptionCode];
        } else {
            return self::$ret[self::UNKNOWN_ERROR];
        }
    }
    //response 类
    public static function response($code, $data, $message = null)
    {
        $result = array(
            'code' => $code,
            'message' => !isset($message) ? Constant::getMsg($code) : $message,
            'data' => $data
        );
        return $result;
    }

}