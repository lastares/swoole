<?php

class Ws
{
    public $ws;
    CONST HOST = '0.0.0.0';
    CONST PORT = 8812;
    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST, self::PORT);
        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);
        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('task', [$this, 'onTask']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->on('close', [$this, 'onClose']);

        $this->ws->start();
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        if($request->fd == 1) {
            // 毫秒定时器
            swoole_timer_tick(2000, function ($timer_id) {
                echo "2s: timerId----{$timer_id}\n";
            });
        }
    }


    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        echo "Server-push-message: {$frame->data}\n";
        // TODO 10S
//        $data = [
//            'task' => 1,
//            'fd' => $frame->fd
//        ];
//        $ws->task($data);
        swoole_timer_after(5000, function() use ($ws, $frame) {
            echo "5s-after\n";
            $ws->push($frame->fd, "5s-time-after:\n");
        });
        $ws->push($frame->fd, 'server-push: ' . date('Y-m-d H:i:s'));
    }

    /**
     * @param $serv
     * @param int $task_id
     * @param int $src_worker_id
     * @param $data
     * @return string
     */
    public function onTask($serv, int  $task_id, int $src_worker_id, $data)
    {
        print_r($data);
        sleep(10);
        return "onTask Finish\n";
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $data task返回的内容，不是数组
     */
    public function onFinish($serv, $taskId, $data)
    {
        echo "taskId: {$taskId}\n";
        echo "return-task-success: {$data}";
    }
    
    
    /**
     * @param $ws websocket服务器
     * @param $fd 客户端标示id
     */
    public function onClose($ws, $fd)
    {
        echo "clientId: {$fd}\n";
    }
}

$obj = new Ws();