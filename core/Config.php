<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/2/28
 * Time: 上午10:01
 */
namespace core;
class Config
{
    static $config;

    //获取配置文件
    public static function getConfig($index, $module = 'default')
    {
        //引入生产环境
        $data = require(__DIR__ . '/../config/production.php');
        self::$config[$module] = $data;
        return $data[$index];

    }
}