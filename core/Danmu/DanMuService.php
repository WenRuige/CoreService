<?php

namespace core\DanMu;

use core\Constant;
use core\DanMu\Logic\DanMuLogic;
use core\Container;

class DanMuService
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

    //发射弹幕
    public function shootDanMu($data)
    {
        try {
            $data = DanMuLogic::getInstance()->shootDanMu($data);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }

    }

    //获取弹幕
    public function getDanMu($id)
    {
        try {
            $data = DanMuLogic::getInstance()->getDanMu($id);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }

    //同步弹幕信息
    public function syncDanMu()
    {
        try {
            $data = DanMuLogic::getInstance()->syncDanMu();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
}