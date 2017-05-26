<?php
namespace core\Comment\Logic;

use core\Comment\Model\Comment;

class CommentLogic
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

    //获取评论列表
    public function getCommentList($id)
    {
        return Comment::getInstance()->getCommentByVideoId($id);
    }

    //插入一条评论
    public function insertComment($comment, $video_id)
    {
        $userId = $_SESSION['userId'];
        if (empty($userId)) {
            return false;
        }
        $data['user_id'] = $userId;
        $data['content'] = $comment;
        $data['create_time'] = date("Y-m-d H:i:s");
        $data['video_id'] = $video_id;
        return Comment::getInstance()->insertComment($data);
    }
}