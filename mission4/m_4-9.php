<?php
 //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
         $dsn = 'mysql:dbname=tb230280db;host=localhost';
    $user = 'tb-230280';
    $password = '7RMsCRKwg8';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     
    // 【！この SQLは tbtest テーブルを削除します！】
    //DROP文：作成されたテーブル自体を削除する
        $sql = 'DROP TABLE tbtest';
        $stmt = $pdo->query($sql);
?>