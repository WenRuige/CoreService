<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/5
 * Time: 上午11:47
 */
namespace core\Follow\Logic;

use core\Follow\Model\Follow;

class FollowLogic
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

    //检查是否follow me
    public function checkFollow($uid)
    {

        $param['follow_id'] = $_SESSION['userId'];
        $param['be_followed_id'] = $uid;
        $param['flag'] = 1;
        $info = Follow::getInstance()->checkFollow($param);
        if (!empty($info)) {
            $flag = 1;
        }
        return isset($flag) ? 1 : 0;
    }

    //follow
    public function follow($uid)
    {
        $flag = $this->checkFollow($uid);
        $param['follow_id'] = $_SESSION['userId'];
        $param['be_followed_id'] = $uid;
        if (intval($flag) == 0) {
            $info = Follow::getInstance()->checkFollow($param);
            if (empty($info)) {
                $param['flag'] = 1;
                $param['create_time'] = date('Y-m-d H:i:s');
                $followInfo = Follow::getInstance()->insertFollowInformation($param);
            } else {
                $followInfo = Follow::getInstance()->updateFollowInformation($param, ['flag' => 1, 'update_time' => date("Y-m-d H:i:s")]);
            }
        } else {
            //如果关注过我,直接取关
            $followInfo = Follow::getInstance()->updateFollowInformation($param, ['flag' => 0, 'update_time' => date("Y-m-d H:i:s")]);
        }
        return empty($followInfo) ? false : true;
    }

    //获取follow的粉丝数
    public function getFollowNum()
    {
        $uid = isset($_SESSION['userId'])?$_SESSION['userId']:'';
        if (!isset($uid)) {
            return 0;
        }
        return Follow::getInstance()->getFollowNum($uid);
    }
}