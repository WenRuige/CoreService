<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/1
 * Time: 下午10:15
 */

namespace core\User\Logic;

use core\User\Model\User;
use function FastRoute\TestFixtures\empty_options_cached;

class UserLogic
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

    //获取用户的相关信息
    public function getUserInformation($uid, $fields)
    {
        if (empty($uid) || empty($fields)) {
            return false;
        }
        return User::getInstance()->getUserInformation($uid, $fields);
    }

    //登录操作
    public function login($email, $password)
    {   //验证邮箱是否存在
        $info = User::getInstance()->checkEmail($email, ['id', 'password']);
        if (empty($info)) {
            return false;
        }
        //验证密码是否正确
        $flag = password_verify($password, $info['password']);
        if (!$flag) {
            return false;
        }
        //存入session
        $_SESSION['userId'] = $info['id'];
        return true;
    }

    //注册操作
    public function register($email, $password)
    {
        $info = User::getInstance()->checkEmail($email, ['id']);
        if (!empty($info)) {
            return false;
        }
        $data['email'] = $email;
        $data['password'] = $password;
        $flag = User::getInstance()->register($data);
        if (!$flag) {
            return false;
        }
        return true;
    }

    //存储用户个人信息
    public function storeUserInformation($data)
    {
        $uid = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
        $flag = User::getInstance()->updateUserInformation($data, $uid);
        return empty($flag) ? false : true;
    }

    //上传头像
    public function uploadPhoto($filename)
    {
        $uid = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
        //通过uid来获取用户上传头像信息
        $userInfo = User::getInstance()->getUserInformation($uid, ['photo']);
        //是否存在头像url
        if (!empty($userInfo['photo'])) {
            $res = unlink('picture/upload/' . $userInfo['photo']);
            if (!$res) {
                return false;
            }
        }
        $data['photo'] = $filename;
        $flag = User::getInstance()->updateUserInformation($data, $uid);
        return empty($flag) ? false : true;
    }

    //通过open_id获取用户信息
    public function getUserInformationByOpenId($openId)
    {
        if (empty($openId)) {
            return false;
        }
        $userInfo = User::getInstance()->getUserInformationByOpenId($openId);
        return $userInfo;
    }
}