<?php
/**
 * Created by PhpStorm.
 * User: qiuye.xu
 * Date: 2016/9/10
 * Time: 12:02
 */

set_time_limit(0);

// 练习
$address = '127.0.0.1';
$port = 5002;

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo 'socket_create()连接失败,失败原因是:' . socket_strerror($sock);
    exit;
}

if(($bind = socket_bind($sock,$address,$port)) == false){
    echo ' socket_bind() 接口绑定失败:失败原因是:' . socket_strerror($bind);
    exit;
}

if(($bind = socket_listen($sock)) < 0){
    echo 'socket_listen() 端口监听失败，失败原因是：' . socket_strerror($bind);
    exit;
}

//套接字，作为不同主机间的数据通信，当然要有数据交互了

$dsn = "mysql:dbname=track;host=127.0.0.1";
$user = 'root';
$pwd = '';
$pdo = new PDO($dsn,$user,$pwd);

while(true){
    if(($send = socket_accept($sock)) < 0){
        $sql = 'insert into socket (`content`) VALUES ("'.$send.'")';
        $pdo->exec($sql);
    }
}

socket_close($sock);
