<?php
    //4-1で書いた「// DB接続設定」のコードの下に続けて記載する。
    $dsn = 'mysql:dbname=tb230280db;host=localhost';
    $user = 'tb-230280';
    $password = '7RMsCRKwg8';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    //id の値が 2 の データレコードを削除
    $id = 2;
    $sql = 'delete from tbtest where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();


    //続けて、4-6の SELECTで表示させる機能 も記述し、表示もさせる。
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
       echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
    //※ データベース接続は上記で行っている状態なので、その部分は不要
    ?>