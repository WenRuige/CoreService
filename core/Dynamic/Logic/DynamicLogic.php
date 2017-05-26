<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/10
 * Time: 下午4:27
 */
namespace core\Dynamic\Logic;

use core\Dynamic\Model\Dynamic;

class DynamicLogic
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
        //获取uid
        $uid = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
        if (!empty($uid)) {
            $data['user_id'] = $uid;
        }
        $data['info'] = $info;
        $data['create_time'] = date('Y-m-d H:i:s');
        return Dynamic::getInstance()->saveDynamic($data);
    }

    //获取动态
    public function getDynamic()
    {
        return Dynamic::getInstance()->getDynamic();

    }
}