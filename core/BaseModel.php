<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/1
 * Time: 下午2:57
 */
namespace core;


//鸡肋
class BaseModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Container::getMysql();
    }

}