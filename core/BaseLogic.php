<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/6
 * Time: 上午8:50
 */
namespace core;
//逻辑鸡肋
class BaseLogic
{
    protected $redis;

    public function __construct()
    {
        $this->redis = Container::getRedis();
    }

}