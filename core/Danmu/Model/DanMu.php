<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/4
 * Time: 上午10:40
 */
namespace core\DanMu\Model;

use core\BaseModel;

class DanMu extends BaseModel
{
    private static $_instance;
    //表名
    protected $table = 'danmu';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //存储弹幕信息
    public function saveDanMu($data)
    {
        return $this->db->insertInto($this->table, $data)->execute();
    }

    //获取弹幕信息
    public function getDanMu($id)
    {
        return $this->db->from($this->table)->select(null)->select(array('content'))->where('video_id', $id)->fetchAll();
    }
}