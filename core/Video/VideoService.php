<?php


namespace core\Video;

use core\Video\Logic\VideoLogic;
use core\Constant;
use core\Container;

class VideoService
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

    //获取video的信息
    public function getVideoById($id)
    {
        try {
            $data = VideoLogic::getInstance()->getVideoById($id);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }

    //上传视频 视频文件路径,视频文件生成图片路径,视频名称
    public function uploadVideo($file, $path, $filename)
    {
        try {
            $data = VideoLogic::getInstance()->uploadVideo($file, $path, $filename);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }

    //上传视频
    public function uploadVideoInformation($data)
    {
        try {
            $data = VideoLogic::getInstance()->uploadVideoInformation($data);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }

    //获取视频的数量
    public function getVideoNum()
    {
        try {
            $data = VideoLogic::getInstance()->getVideoNum();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }

    //获取视频信息
    public function getVideoInformation()
    {
        try {
            $data = VideoLogic::getInstance()->getVideoInformation();
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
    //删除视频信息
    public function deleteVideo($video_id){
        try {
            $data = VideoLogic::getInstance()->deleteVideo($video_id);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');
        }
    }
}