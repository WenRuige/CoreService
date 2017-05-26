<?php

namespace core\DanMu\Logic;

use core\Container;
use core\DanMu\Model\DanMu;
use core\BaseLogic;

class DanMuLogic extends BaseLogic
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

    //发射弹幕
    public function shootDanMu($data)
    {
        return DanMu::getInstance()->saveDanMu($data);
    }

    //获取到弹幕
    public function getDanMu($id)
    {
        $info = DanMu::getInstance()->getDanMu($id);
        //加一层Redis
        if (!empty($info)) {
            $json = '[';
            foreach ($info as $key => $value) {
                $json .= $info[$key]['content'] . ',';
            }
            $json = substr($json, 0, -1);
            $json .= ']';
        } else {
            return false;
        }
        return $json;
    }

    //同步弹幕
    public function syncDanMu()
    {

        try {
            //获取队列的长度
            while (true) {
                $length = $this->redis->lLen('queue');
                if ($length <= 0) {
                    break;
                } else {
                    $this->consumeQueue();
                }
            }
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
        }
    }

    //同步队列
    public function consumeQueue()
    {

        $res = $this->redis->rpop('queue');
        $array = json_decode($res, true);
        $splitData = explode(',', $array);
        $danmu = '';
        for ($i = 0; $i <= 4; $i++) {
            $danmu .= $splitData[$i] . ',';
        }
        //去除最后一个逗号
        $data['content'] = rtrim($danmu, ",");
        $data['user_id'] = $splitData[5]; //用户名称
        $data['video_id'] = $splitData[6]; //视频id
        $data['create_time'] = date('Y-m-d H:i:s'); //创建时间
        //如果有一项为空的话,那么不做操作
        if (!isset($data['content']) || !isset($data['user_id']) || !isset($data['video_id'])) {
            return false;
        }
        $flag = DanMu::getInstance()->saveDanMu($data);
        if (empty($flag)) {
            Container::log('error', json_encode($data));
        }
    }
}