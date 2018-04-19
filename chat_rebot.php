<?php
//引入MeepoPS
require_once (dirname(__FILE__).'/MeepoPS/MeepoPS/index.php');

//使用WebSocket协议传输的Api类
$webSocket = new \MeepoPS\Api\Websocket('0.0.0.0', '19910');
$webSocket->callbackNewData = function ($connect, $data){
    $msg = '收到消息:' . trim($data);
    $message = array(
        'errno' => 0, 'errmsg' => 'OK', 'data' => array(
            'content' => $msg, 'create_time' => date('Y-m-d H:i:s'),
        ),
    );
    $connect->send(json_encode($message));
};

//使用HTTP协议传输的Api类
$http = new \MeepoPS\Api\Http('0.0.0.0', '19911');
$http->setDocument('localhost:19911', dirname(__FILE__).'/MeepoPS/Chat/Web');

//启动MeepoPS
\MeepoPS\runMeepoPS();
