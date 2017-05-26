<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/10
 * Time: 下午4:26
 */
namespace core\Dynamic;

use core\Dynamic\Logic\DynamicLogic;
use core\Constant;
use core\Container;

class DynamicService
{
    private static $_instance;

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }
    //发送动态
    public function sendDynamic($info)
    {
        try {
            $data = DynamicLogic::getInstance()->sendDynamic($info);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
    //获取动态
    public function getDynamic(){
        try {
            $data = DynamicLogic::getInstance()->getDynamic();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
}