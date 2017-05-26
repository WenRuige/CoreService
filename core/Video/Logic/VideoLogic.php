<?php
namespace core\Video\Logic;

use core\FFmpeg;
use core\Imagick;
use core\Video\Model\Video;

class VideoLogic
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

    //通过视频id来获取视频
    public function getVideoById($id)
    {
        return Video::getInstance()->getVideoById($id);

    }

    //上传视频相关信息
    public function uploadVideoInformation($data)
    {
        return Video::getInstance()->uploadVideo($data);
    }

    //上传视频
    public function uploadVideo($file, $path, $filename)
    {

        $ffmpeg = new FFmpeg();
        $videoName = $ffmpeg->videoToPicture($file, $path, $filename);
        $imagick = new Imagick();
        $imagick->pictureToGif($path, $videoName, 'gif');
        return $videoName;
    }

    //获取视频的数目
    public function getVideoNum()
    {
        $uid = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
        if (empty($uid)) {
            return 0;
        }
        return Video::getInstance()->getVideoNum($uid);
    }

    //根据user_id获取所有的视频内容
    public function getVideoInformation()
    {
        $uid = isset($_SESSION['userId']) ? $_SESSION['userId'] : '';
        if (empty($uid)) {
            return 0;
        }
        return Video::getInstance()->getVideoInformation($uid);
    }

    //删除视频信息
    public function deleteVideo($video_id)
    {
        //通过视频id 来获取一些信息
        if (empty($video_id)) {
            return false;
        }
        $videoInfo = Video::getInstance()->getVideoById($video_id);
        //首先删除视频所在位置
        if (file_exists('video/upload/' . $videoInfo['video'])) {
            unlink('video/upload/' . $videoInfo['video']);
        }
        //检查封面是否存在,若存在删除
        if (file_exists('video/cover/' . $videoInfo['picture'])) {
            unlink('video/cover/' . $videoInfo['picture']);
        }
        //检查生成的gif图是否存在,若存在删除!
        if (file_exists('video/gif/' . $videoInfo['gif'])) {
            unlink('video/gif/' . $videoInfo['gif']);
        }
        return Video::getInstance()->deleteVideoById($video_id);

    }
}