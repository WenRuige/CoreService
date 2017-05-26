<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/1
 * Time: 下午2:57
 */

namespace core\User\Model;

use core\BaseModel;

class User extends BaseModel
{
    private static $_instance;
    protected $table = 'users';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //获取用户的相关信息
    public function getUserInformation($uid, $fields)
    {
        return $this->db->from($this->table)->select(null)->select($fields)->where('id', $uid)->fetch();
    }

    //检测用户邮箱是否注册
    public function checkEmail($email, $fields)
    {
        return $this->db->from($this->table)->select(null)->select($fields)->where('email', $email)->fetch();
    }

    //注册邮箱
    public function register($data)
    {
        return $this->db->insertInto($this->table, $data)->execute();
    }

    //更新用户的个人信息
    public function updateUserInformation($data, $uid)
    {
        return $this->db->update($this->table)->set($data)->where('id', $uid)->execute();
    }

    //通过open_id获取用户信息
    public function getUserInformationByOpenId($openId)
    {
        return $this->db->from($this->table)->select(null)->select(array('id'))->where('open_id', $openId)->fetch();
    }

}