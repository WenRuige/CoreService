<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/2/28
 * Time: 下午5:29
 */
namespace core\Index;
use core\Constant;
use core\Container;
use core\Index\Logic\IndexLogic;

class IndexService
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

    //展示首页内容
    public function index()
    {
        try {
            $data = IndexLogic::getInstance()->getVideo();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }

}