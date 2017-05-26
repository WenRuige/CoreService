<?php
namespace core\Follow\Model;

use core\BaseModel;

class Follow extends BaseModel
{
    private static $_instance;
    protected $table = 'follow';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //检查是否follow
    public function checkFollow($param)
    {
        return $this->db->from($this->table)->select(null)->select(array('id'))->where($param)->fetch();
    }

    //插入一个粉丝
    public function insertFollowInformation($param)
    {
        return $this->db->insertInto($this->table, $param)->execute();
    }

    //更新一个信息
    public function updateFollowInformation($param, $where)
    {
        return $this->db->update($this->table)->set($param)->where($where)->execute();
    }

    //获取follow我的粉丝数
    public function getFollowNum($uid)
    {
        return $this->db->from($this->table)->where('be_followed_id', $uid)->count();
    }
}