<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/6
 * Time: 上午8:35
 */
namespace cron\DanMu;

use core\Danmu\DanMuService;

//加载DanMu
class Danmu
{
    //同步弹幕
    public function __construct()
    {
        $this->syncDanMu();
    }


    //同步danmu到mysql
    public function syncDanMu()
    {
        DanMuService::getInstance()->syncDanMu();
        echo '同步成功!';
    }
}

