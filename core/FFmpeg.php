<?php
/**
 * Created by PhpStorm.
 * User: gewenrui
 * Date: 2017/3/11
 * Time: 下午3:11
 */
namespace core;
class FFmpeg
{

    public $FFmpeg;
    public $FFProbe;

    //将一个视频通过传递帧数的不同生成不同的图片
    public function __construct()
    {
        $ffmeg = \FFMpeg\FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);
        $this->FFmpeg = $ffmeg;
        $ffprobe = \FFMpeg\FFProbe::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe'
        ]);
        $this->FFProbe = $ffprobe;

    }

    public function videoToPicture($file, $path, $videoName)
    {
        $videoTimeLength = $this->FFProbe->format($file)->get('duration');
        $video = $this->FFmpeg->open($file);
        $video->filters()
            ->resize(new \FFMpeg\Coordinate\Dimension(320, 240))
            ->synchronize();
        //策略:从视频的一半开始每一秒生成一张图片
        //最大生成5张照片,如果视频时长不到50
        for ($i = 0, $start = ($videoTimeLength / 2); $i < 5; $i++, $start++) {
            $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds($start))->save($path . '/' . $videoName . '_' . $i . '.jpg');
        }
        return $videoName;
    }

}