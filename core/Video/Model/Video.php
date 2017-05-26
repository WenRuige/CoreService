<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/1
 * Time: 下午2:57
 */
namespace core\Video\Model;

use core\BaseModel;

class Video extends BaseModel
{

    private static $_instance;
    protected $table = 'video';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //获取全部视频
    public function getVideo()
    {
        return $this->db->from($this->table)->select(null)->select('*')->orderBy('id desc')->fetchAll();
    }

    //获取视频ById
    public function getVideoById($id)
    {
        return $this->db->from($this->table)->select(null)->select('*')->where('id', $id)->fetch();
    }

    //上传视频
    public function uploadVideo($data)
    {
        return $this->db->insertInto($this->table, $data)->execute();
    }

    //获取视频数量
    public function getVideoNum($uid)
    {
        return $this->db->from($this->table)->select(null)->select('*')->where('user_id', $uid)->count();
    }

    //获取所有视频信息
    public function getVideoInformation($uid)
    {
        return $this->db->from($this->table)->select(null)->select('*')->where('user_id', $uid)->fetchAll();
    }

    //通过视频id删除
    public function deleteVideoById($video_id)
    {
        return $this->db->deleteFrom($this->table)->where('id', $video_id)->execute();
    }

}