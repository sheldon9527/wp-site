<?php
//引入MeepoPS
require_once (dirname(__FILE__).'/MeepoPS/MeepoPS/index.php');
require_once (dirname(__FILE__).'/PhpCurl.php');

$cu = new PhpCurl();
//使用WebSocket协议传输的Api类
$webSocket = new \MeepoPS\Api\Websocket('0.0.0.0', '19910');
$webSocket->callbackNewData = function ($connect, $data) use ($cu){
    if(!trim($data)){
      $msg ='欢迎来闲聊！！！';
    }else {
        $content = $cu->get('http://cx.beikexi.com/api/chats', ['title'=>trim($data)]);
        $content = json_decode($content,true);
        if(empty($content)){
          $msg ='你太调皮了！！！超出我的范围啦';
        }else {
          if(array_key_exists('title', $content)){
            $msg = $content['title'];
          }else {
            $msg ='没有查询任何信息，可能出现错误,';
          }
        }
    }
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
