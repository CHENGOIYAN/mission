<?php
$dsn = 'mysql:dbname=tb230280db;host=localhost';
    $user = 'tb-230280';
    $password = '7RMsCRKwg8';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     
    //INSERT文：データを入力（データレコードの挿入）
$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $name = 'テイ';
    $comment = 'よろしくお願いします'; //好きな名前、好きな言葉は自分で決めること
    $sql -> execute();
    //bindParamの引数名（:name など）はテーブルのカラム名に併せるとミスが少なくなります。最適なものを適宜決めよう。
    ?>