<!DOCTYPE html>
<html lang=ja>
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    
    <h1>掲示板</h1>
    <?php
        //////////////////////////////////////////        
        //データベースへの接続
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        try {
            $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION] );
            //データベースに接続できなかった時
        } catch (PDOException $e) {
            echo "接続失敗: " . $e->getMessage() . "\n";
            exit();
        }
        //テーブルの作成
        $sql = "CREATE TABLE IF NOT EXISTS tb_5"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "comment TEXT,"
        . "compas TEXT,"
        . "date TEXT"
        . ");";
        $stmt = $pdo->query($sql);
        /////////////////////////////////////////
        //受信した値をそれぞれ変数にする
        $date = date("Y/m/d H:i:s");    //時間の取得&変数化
        
        if(!empty($_POST["submit"])){       //送信ボタンが押されたとき
            $name = $_POST["name"];         //コメ主名
            $comment = $_POST["comment"];   //コメント
            $compas = $_POST["compas"];     //パスワード
            $editnumhol = $_POST["editnumhol"]; //編集モードの時編集番号が入る
        }
        if(!empty($_POST["delsub"])){       //削除ボタンが押された時
            $delnum = $_POST["delnum"];     //削除番号
            $delpas = $_POST["delpas"];     //パスワード(コメントのパスワードと後で比較)
        }
        if(!empty($_POST["editsub"])){      //編集ボタンが押された時
            $editnum = $_POST["editnum"];   //編集番号
            $editpas = $_POST["editpas"];   //パスワード(コメントのパスワードと後で比較)
        }
        //////////////////////////////////////////
        // 削除
        if(!empty($delnum)){  
            $sql = 'SELECT * FROM tb_5 WHERE id=:id';
            $stmt = $pdo->prepare($sql);                  
            $stmt->bindParam(':id', $delnum, PDO::PARAM_INT); 
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                if ($delpas == $row['compas']){
                    //4-8 DELETE文：入力したデータレコードを削除
                    $sql = 'DELETE FROM tb_5 WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $delnum, PDO::PARAM_INT);
                    $stmt->execute();
                    //番号を自動的に振り返す
                    $sql = "ALTER TABLE tb_5 DROP column id";
                    $stmt = $pdo->query($sql);
                    $sql = "ALTER TABLE tb_5 add id int(11) primary key not null auto_increment first";
                    $stmt = $pdo->query($sql);
                    $sql = "ALTER TABLE tb_5 AUTO_INCREMENT = 1"; 
                    $stmt = $pdo->query($sql);
                }else{
                    echo "パスワードが違います<br>";
                }
            }  
        }
        ///////////////////////////////////////////
        //編集番号が送信されたら、番号の名前とコメを探して変数に代入する(あとでフォームの初期値へ)
        if(!empty($editnum)){ //編集番号が送信されている時
            $sql = 'SELECT * FROM tb_5 WHERE id=:id ';
            $stmt = $pdo->prepare($sql);                  
            $stmt->bindParam(':id', $editnum, PDO::PARAM_INT); 
            $stmt->execute();
            
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                if ($editpas == $row['compas']){
                    $editnum_form = $row['id'];
                    $editname_form = $row['name'];
                    $editcom_form = $row['comment'];
                    $editpas_form = $row['compas'];
                }else{
                    echo "パスワードが違います<br>";
                }
            }
        }
   
        
        
        //////////////////////////////////////////
        
        //コメントが送信された時編集番号があればその行を書き直し、なければ追加
        if(isset($name) && isset($comment)){    //名前とコメントが送信された時
            //編集番号が送信されたなら編集モード
            if(is_numeric($editnumhol)){
                $sql = 'UPDATE tb_5 SET name=:name,comment=:comment,compas=:compas,date=:date WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':compas', $compas, PDO::PARAM_STR);
                $stmt->bindParam(':date', $date, PDO::PARAM_STR);
                $stmt->bindParam(':id', $editnumhol, PDO::PARAM_INT);
                $stmt->execute();
          
            //編集番号が送信されてないなら追記モード
            }else{    
                $sql = $pdo -> prepare("INSERT INTO tb_5 (name, comment, compas, date) VALUES (:name, :comment, :compas, :date)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
                $sql -> bindParam(':compas', $compas, PDO::PARAM_STR);
                $sql -> bindParam(':date', $date, PDO::PARAM_STR);
                $sql -> execute();
            }
        }
    ?>
        
    <p>-------------------------------------------------------------------------------</p>
    <!--投稿用-->
    <form action=""method="post">
        <p>名前:
        <input type="text"name="name"value="<?php if(!empty($editname_form)){echo $editname_form;}?>">
        </p>
        <p>コメント:
        <input type="text"name="comment"value="<?php if(!empty($editcom_form)){echo $editcom_form;} ?>">
        </p>
  　　　　<p>パスワードを入力してください:
        <input type="password"name="compas"value="<?php if(!empty($editpas_form)){echo $editpas_form;} ?>">
        </p>
        <input type="hidden"name="editnumhol"placeholder=""value="<?php if(!empty($editnum_form)){echo $editnum_form;} ?>">
        <input type="submit"name="submit">
    </form>
    
    
    <p>-------------------------------------------------------------------------------</p>
    <!--削除用-->
    <form action=""method="post">
        
        <p>削除したい番号を入力してください:
        <input type="number"min="1"name="delnum">
        </p>
        
        <p>パスワードを入力してください:
        <input type="password"name="delpas">
        </p>
        
        </script>
        <input type="submit"name="delsub"value="削除">
         
    </form>
    
    <p>-------------------------------------------------------------------------------</p>
    
    <!--編集用-->
    <form action=""method="post">
        <p>編集したい番号を入力してください:
        <input type="number"min="1"name="editnum">
        </p>
        <p>パスワードを入力してください:
        <input type="password"name="editpas">
        </p>
        <input type="submit"name="editsub"value="編集">
    </form>
    
     <p>-------------------------------------------------------------------------------</p>
    <!-- 投稿一覧表示 -->
    <h2>投稿一覧(
    <?php
      $sql = 'SELECT * FROM tb_5';
      $stmt = $pdo->query($sql);
      $stmt-> execute();
      $cnt = $stmt->rowCount();
      echo $cnt;
    ?>
    件)</h2>
    <?php
        $sql = 'SELECT * FROM tb_5';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            echo $row['id'].' ';
            echo $row['name'].' ';
            echo $row['comment'].' ';
            echo $row['date'];
            echo "<br>";
            echo "<p>---------------------------------------------------------------</p>";
       }
    ?>
     
</body>
</html>
