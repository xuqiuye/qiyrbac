<?php
/**
 * Created by PhpStorm.
 * User: qiuye.xu
 * Date: 2016/9/10
 * Time: 12:27
 */

// 客户端
$address = '127.0.0.1';
$port = 5002;
$sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0){
    echo 'socket_create() 连接失败。失败原因是:' . socket_strerror($sock);
    exit;
}

if(($connect = socket_connect($sock,$address,$port)) < 0){
    echo 'socket_connect()连接不上服务器。失败原因是:' . socket_strerror($connect);
    exit;
}
$send = 'hello world length';
socket_send($sock,$send,strlen($send),MSG_OOB);