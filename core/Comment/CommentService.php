<?php
namespace core\Comment;

use core\Constant;
use core\Container;
use core\Comment\Logic\CommentLogic;

class CommentService
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
        try {
            $data = CommentLogic::getInstance()->getCommentList($id);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }

    //插入一条评论
    public function insertComment($comment, $video_id)
    {
        try {
            $data = CommentLogic::getInstance()->insertComment($comment, $video_id);
            return Constant::response(Constant::SUCCESS, $data);
        } catch (\Exception $e) {
            Container::log('error', $e->getMessage());
            return Constant::response(Constant::UNKNOWN_ERROR, '');

        }
    }
}