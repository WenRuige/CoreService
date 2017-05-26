<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/1
 * Time: 下午10:14
 */

namespace core\User;

use core\User\Logic\UserLogic;
use core\Constant;
use core\Container;

class UserService
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

    //获取用户相关信息
    public function getUserInformation($uid, $fields)
    {
        try {
            $data = UserLogic::getInstance()->getUserInformation($uid, $fields);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }

    //登录操作
    public function login($email,$password)
    {
        try {
            $data = UserLogic::getInstance()->login($email, $password);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
    //注册操作
    public function register($email,$password){
        try {
            $data = UserLogic::getInstance()->register($email, $password);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
    //存储用户的个人信息
    public function storeUserInformation($data){
        try {
            $data = UserLogic::getInstance()->storeUserInformation($data);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
    //用户上传头像
    public function uploadPhoto($filename){
        try {
            $data = UserLogic::getInstance()->uploadPhoto($filename);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
    //通过open_id获取用户个人信息
    public function getUserInformationByOpenId($openId){
        try {
            $data = UserLogic::getInstance()->getUserInformationByOpenId($openId);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
}