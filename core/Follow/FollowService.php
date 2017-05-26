<?php
namespace core\Follow;
use core\Constant;
use core\Container;
use core\Follow\Logic\FollowLogic;
class FollowService
{
    private static $_instance;

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
    public function checkFollow($uid){
        try {
            $data = FollowLogic::getInstance()->checkFollow($uid);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
    //follow一个人
    public function follow($uid){
        try {
            $data = FollowLogic::getInstance()->follow($uid);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
    //检查我拥有的粉丝数
    public function getFollowNum(){
        try {
            $data = FollowLogic::getInstance()->getFollowNum();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
}