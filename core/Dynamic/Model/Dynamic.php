<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/10
 * Time: 下午4:27
 */

namespace core\Dynamic\Model;

use core\BaseModel;

class Dynamic extends BaseModel
{
    private static $_instance;

    private $table = 'dynamic';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //保存动态
    public function saveDynamic($info)
    {

        return $this->db->insertInto($this->table, $info)->execute();
    }

    //获取动态
    public function getDynamic()
    {
        return $this->db->from($this->table)->select(null)->select(array('info', 'user_id', 'create_time'))->orderBy('id desc')->fetchAll();
    }
}