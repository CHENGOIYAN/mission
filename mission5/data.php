<!--misson_5-1の掲示板で入力したデータレコードを抽出し、表示する-->
<?php
 $dsn = 'mysql:dbname=tb230280db;host=localhost';
    $user = 'tb-230280';
    $password = '7RMsCRKwg8';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //SELECT文：入力したデータレコードを抽出し、表示する
$sql = 'SELECT * FROM tb_5';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
       echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['date'].',';
        echo $row['compas'].'<br>';
    echo "<hr>";
    }
    ?>