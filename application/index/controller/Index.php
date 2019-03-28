<?php

namespace app\index\controller;

use think\Controller;
use Workerman\Lib\Timer;
use Workerman\Worker;

class Index extends Controller
{
    public function index()
    {
        // 创建一个Worker监听2345端口，使用http协议通讯
        $http_worker = new Worker("http://0.0.0.0:2345");
        // 启动4个进程对外提供服务
        $http_worker->count = 4;

        // 接收到浏览器发送的数据时回复hello world给浏览器
        $http_worker->onMessage = function ($connection, $data) {
            // 向浏览器发送hello world
            $connection->send('hello world');
        };
        // 运行worker
        Worker::runAll();
    }
    public function test()
    {
        return $this->fetch('test');
    }

    public function webSocket()
    {
        // 注意：这里与上个例子不同，使用的是websocket协议
        $ws_worker = new Worker("websocket://127.0.0.1:2000");
        // 启动4个进程对外提供服务
        $ws_worker->count = 4;
        // 进程启动时设置一个定时器，定时向所有客户端连接发送数据
        $ws_worker->onWorkerStart = function ($worker) {
            // 定时，每10秒一次
            Timer::add(10, function () use ($worker) {
                // 遍历当前进程所有的客户端连接，发送当前服务器的时间
                foreach ($worker->connections as $connection) {
                    $connection->send(time());
                }
            });
        };
        // 当收到客户端发来的数据后返回hello $data给客户端
        $ws_worker->onMessage = function ($connection, $data) {
            // 向客户端发送hello $data
            $connection->send('hello ' . $data);
        };
        // 运行worker
        Worker::runAll();
    }
}
