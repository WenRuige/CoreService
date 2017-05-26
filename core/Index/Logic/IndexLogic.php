<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/2/28
 * Time: 下午5:33
 */
namespace core\Index\Logic;

//index逻辑层
use core\Video\Model\Video;

class IndexLogic
{
    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        };
    }

    //展示首页
    public function getVideo()
    {
        return Video::getInstance()->getVideo();
    }
}