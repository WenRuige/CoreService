<?php

/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/4
 * Time: 下午12:10
 */
namespace core\Comment\Model;

use core\BaseModel;

class Comment extends BaseModel
{

    private static $_instance;
    protected $table = 'comment';

    //单例模式
    public static function getInstance()
    {
        if (self::$_instance instanceof self) {
            return self::$_instance;
        } else {
            return new self();
        }
    }

    //获取评论
    public function getCommentByVideoId($id)
    {
        return $this->db->from($this->table)->select(null)->select('*')->where('video_id', $id)->fetchAll();
    }
    //插入一条评论
    public function insertComment($data)
    {
        return $this->db->insertInto($this->table, $data)->execute();
    }
}