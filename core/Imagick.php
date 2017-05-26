<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2016/10/26
 * Time: 下午5:59
 */

namespace core;
//将多张图片生成为一张gif
class Imagick
{

    public $imagick;

    public function __construct()
    {
        if (extension_loaded('imagick')) {
            $this->imagick = new \Imagick();
        }
    }

    //将图片转换为GIF
    public function pictureToGif($savePath, $fileName, $type = 'gif')
    {
        $fileList = array();
        for ($i = 0; $i < 5; $i++) {
            $fileList[] = $savePath . '/' . $fileName . '_' . $i . '.jpg';
        }
        $animation = $this->imagick;
        $animation->setFormat($type);
        foreach ($fileList as $file) {
            $image = $this->imagick;
            $image->readImage($file);  //合并图片
            $animation->addImage($image); //加入到对象
            $animation->setImageDelay(10); //设定图片帧数
            unset($image);    //清除内存里的图像，释放内存
        }
        $animation->writeImages($savePath . '/' . $fileName . '.gif', true);
        //如果该gif存在的话
        if (file_exists($savePath . '/' . $fileName . '.gif')) {
            for ($i = 0; $i < 5; $i++) {
                unlink($savePath . '/' . $fileName . '_' . $i . '.jpg');
            }
            $finalPath = $savePath . '/' . $fileName . '.gif';
            //将原始路径返回
            return $finalPath;
        }
    }
}