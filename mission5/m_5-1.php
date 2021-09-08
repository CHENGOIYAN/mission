<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>5_1</title>
</head>
<body>
<?php
// データベース接続
$dsn = 'mysql:dbname=tb230280db;host=localhost';
$user = 'tb-230280';
$password = '7RMsCRKwg8';
try {
  $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION] );
  //データベースに接続できなかった時
  } catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
  }
    //テーブル作成
    $stmt = $pdo->query("CREATE TABLE IF NOT EXISTS posts1 (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name TEXT,
      comment TEXT,
      postDate TEXT,
      new_pass TEXT
      )"
    );
    // 新規投稿
    // if($_SERVER["REQUEST_METHOD"] === 'POST') {
      if(isset($_POST["send"]) && isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["new_pass"]) && empty($_POST["hidden_editNo"])) {
        if(!empty($_POST["comment"]) && !empty($_POST["new_pass"]) && isset($_POST["send"])) {
          $name = trim($_POST["name"]);
          $comment = trim($_POST["comment"]);
          $send = $_POST["send"];
          $new_pass = trim($_POST["new_pass"]);
          $postDate = date('Y-m-d H:i:s');
          if(empty($name)) { 
            $name = "名無し";
          }
          $stmt = $pdo->prepare("INSERT INTO posts1 (name,comment,postDate,new_pass) VALUES (:name,:comment,:postDate,:new_pass)");
          $params = array(':name'=>$name,':comment'=>$comment,':postDate'=> $postDate,':new_pass'=> $new_pass);
          $stmt->execute($params);
        } elseif(empty($_POST["comment"]) && !empty($_POST["new_pass"]) && isset($_POST["send"])) {
          echo "<script>alert('コメントが入力されていません。');</script>";
        } elseif(empty($_POST["new_pass"]) && !empty($_POST["comment"]) && isset($_POST["send"])) {
          echo "<script>alert('パスワードが入力されていません。');</script>";
        }elseif(isset($_POST["send"]) && empty($_POST["comment"]) && empty($_POST["new_pass"])) {
          echo "<script>alert('パスワードとコメントが入力されていません。');</script>";
        }
      }
    // }
// 編集
// if($_SERVER["REQUEST_METHOD"] === 'POST') {
  if(isset($_POST["edit"]) && isset($_POST["editNo"]) && isset($_POST["edit_pass"])) {
    if(!empty($_POST["editNo"]) && !empty($_POST["edit_pass"])) {
      $edit = $_POST["edit"];
      $editNo = $_POST["editNo"];
      $edit_pass = $_POST["edit_pass"];
      $res = $pdo->query('SELECT * FROM posts1');
      foreach( $res as $value ){
        if($editNo == $value['id'] && $edit_pass == $value['new_pass']) {
          $hidden_editNo = $value['id'];
          $edit_name = $value['name'];
          $edit_comment = $value['comment'];
          $edit_ID = $value['new_pass'];
        } elseif ($editNo == $value['id'] && $edit_pass != $value['new_pass']) {
          echo "<script>alert('パスワードが間違っています。');</script>";
        }
      break;
    }
   } elseif (empty($_POST["editNo"]) && isset($_POST["edit"]) && !empty($_POST["edit_pass"])) {
        echo "<script>alert('番号を入力してください。');</script>";
   } elseif (empty($_POST["edit_pass"]) && isset($_POST["edit"]) && !empty($_POST["editNo"])) {
        echo "<script>alert('パスワードを入力してください。');</script>";
   }
  } 
// }
//編集する値がフォームに表示された後の投稿
if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["hidden_editNo"])) {
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $hidden_editNo = $_POST["hidden_editNo"];
  $postDate = date('Y-m-d H:i:s');
  $new_pass = $_POST["new_pass"];
  $res = $pdo->query('SELECT * FROM posts1');
  $stmt = $pdo->prepare("UPDATE posts1 SET name = :name,comment = :comment,postDate =:postDate, new_pass = :new_pass WHERE id = $hidden_editNo");
  $params = array(':name' => $name,':comment'=>$comment,':postDate'=>$postDate,':new_pass'=>$new_pass);
  $stmt->execute($params);
}
// 削除
// if($_SERVER["REQUEST_METHOD"] === 'POST') {
  if(isset($_POST["delete"]) && isset($_POST["deleteNo"]) && isset($_POST["delete_pass"])) {
    if(!empty($_POST["deleteNo"]) && !empty($_POST["delete_pass"])) {
      $delete = $_POST["delete"];
      $deleteNo = $_POST["deleteNo"];
      $delete_pass = $_POST["delete_pass"];
      $res = $pdo->query("SELECT * FROM posts1");
      foreach( $res as $value ){
        if($deleteNo == $value['id'] && $delete_pass == $value['new_pass']) {
           $params = array(':id'=> $deleteNo);
          $stmt = $pdo->prepare("DELETE FROM posts1 WHERE id =:id");
          $stmt->execute($params);
          
          
          $sql = "ALTER TABLE posts1 DROP column id";
          $stmt = $pdo->query($sql);
          $sql = "ALTER TABLE posts1 add id int(11) primary key not null auto_increment first";
          $stmt = $pdo->query($sql);
          $sql = "ALTER TABLE posts1 AUTO_INCREMENT = 1"; 
          $stmt = $pdo->query($sql);
        } else if($deleteNo == $value['id'] && $delete_pass != $value['new_pass']) {
            echo "<script>alert('パスワードが間違っています。');</script>";
        }
       break;
      }
    } elseif(empty($_POST["deleteNo"]) && isset($_POST["delete"]) && !empty($_POST["delete_pass"])) {
        echo "<script>alert('番号を入力してください。');</script>";
    } elseif(empty($_POST["delete_pass"]) && isset($_POST["delete"]) && !empty($_POST["deleteNo"])) {
        echo "<script>alert('パスワードを入力してください。');</script>";
    }
  }
// }
?>
<!-- html記述 -->
  <h1>簡易掲示板</h1>
  <p>-------------------------------------------------------------------------------</p>
  <!-- 投稿フォーム -->
  <form action = "" method = "post">
  <!-- 編集モード用 のinput-->
  <input type = "hidden" name = "hidden_editNo" value = "<?php if(isset($hidden_editNo)) {echo $hidden_editNo;}?>">
  <p>名前:
    <input type = "text" name = "name" value = "<?php if(isset($edit_name)) {echo $edit_name;}?>">
  </p>
  <p>コメント:
    <textarea name = "comment"><?php if(isset($edit_comment)) {echo $edit_comment;}?></textarea>
  </p>
  <p>パスワードを入力してください:
    <input type = "password" name = "new_pass" value="<?php if(isset($edit_ID)) {echo $edit_ID;}?>">
  </p>
  <input type = "submit" name = "send" value = "投稿">
  </form>
  <p>-------------------------------------------------------------------------------</p>
  <!-- 編集フォーム -->
  <form action = "" method = "post">
  <p>編集したい番号を入力してください:
    <input type = "text" name = "editNo">
  </p>
  <p>パスワードを入力してください:
    <input type = "password" name = "edit_pass">
  </p>
  <input type = "submit" name = "edit" value = "編集">
  </form>
  <p>-------------------------------------------------------------------------------</p>
  <!-- 削除フォーム -->
  <form action = "" method = "post" onSubmit="return check()">
  <p>削除したい番号を入力してください:
    <input type = "text" name = "deleteNo">
  </p>
  <p>パスワードを入力してください:
    <input type = "password" name = "delete_pass">
  </p>
  <!-- 削除確認ダイアログ -->
  <script type="text/javascript">
    function check(){
      if(window.confirm('本当に削除しますか？')){
       return true;
     }else{
       window.alert('キャンセルされました');
       return false;
     }
   }
  </script>
  <input type = "submit" name = "delete" value = "削除" >
  </form>
  <p>-------------------------------------------------------------------------------</p>
  <!-- 投稿一覧表示 -->
  <h2>投稿一覧(
    <?php
      $sql = 'SELECT * FROM posts1';
      $stmt = $pdo->query($sql);
      $stmt-> execute();
      $cnt = $stmt->rowCount();
      echo $cnt;
    ?>
    件)</h2>
  <?php
   $sql = 'SELECT * FROM posts1';
   $stmt = $pdo->query($sql);
   $stmt-> execute();
     $res = $pdo-> query('SELECT * FROM posts1');
       foreach($res as $value) {
         echo $value['id']."\t";
         echo $value['name']."\t";
         echo $value['comment']."\t";
         echo $value['postDate'];
         echo "<br>";
         echo "<p>---------------------------------------------------------------</p>";
       }
  
  ?>
  <p>-------------------------------------------------------------------------------</p>
</body>
</html>