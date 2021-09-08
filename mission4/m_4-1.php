 <?php //記入例；
    //4-2以降でも毎回接続は必要。
    //$dsnの式の中にスペースを入れないこと！

    // 【サンプル】
    // ・データベース名：tb230280db
    // ・ユーザー名：tb-230280
    // ・パスワード：7RMsCRKwg8
    // の学生の場合：

    // DB接続設定
   
    $dsn = 'mysql:dbname=tb230280db;host=localhost';
    $user = 'tb-230280';
    $password = '7RMsCRKwg8';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     
      ?> 