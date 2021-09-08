<?php
//データベースへの接続
//mysqli_connect(host,username,password,dbname,port,socket);
$dbConnection = mysqli_connect("localhost","tb-230280","7RMsCRKwg8","tb230280db");

//接続していることを検証
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

//echo "成功連線";