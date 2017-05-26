<?php

class Socket
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function execute()
    {

        $ws = new swoole_websocket_server("0.0.0.0", 9502);

        //监听WebSocket连接打开事件
        $ws->on('open', function ($ws, $request) {
            $fd[] = $request->fd;
            $GLOBALS['fd'][] = $fd;
            //$ws->push($request->fd, "hello, welcome\n");
        });
        //监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
            $this->redis->lPush('queue', json_encode($frame->data));
        });

        //监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $ws->start();
    }
}

$socket = new Socket();
$socket->execute();