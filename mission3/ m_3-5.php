<h1>何でも書き込んでください！</h1>
  <?php 
    $form_value1 = "名前";
        $form_value2 = "コメント";
         $form_value3 = NULL;

// 1. 削除フォームから削除番号を読み込み$delete_numberに代入
$name = @$_POST["name"];
$str = @$_POST["str"];
$date = date("Y/m/d H:i:s");
$delete_number = @$_POST["number"];
$edit_number = @$_POST["edit_number"];
$edit_number_hidden = @$_POST["edit_number_hidden"];
$password=@$_POST["password"];
$edit_password=@$_POST["edit_password"];
$delete_password=@$_POST["delete_password"];

// 2. 出力ファイル名を$filenameに代入
$filename = "mission_3-5.txt";
// 3. $delete_numberと$edit_numberがあるかないかで条件分岐
if ($delete_number == NULL && $edit_number == NULL ) {
  // 3-1. $edit_number_hiddenがない世界線
  // 3-3. 出力ファイルを読み込み、1行を1要素として配列$linesに代入
  // 3-4. end($lines)で$linesの最後の要素（最後の行）を取得し、explode関数で"<>"区切りの要素に分け、配列として$elementsに代入
  // * count($lines)で要素数（行数）を取得すると、コメントを削除した場合に番号がずれるのでダメ
  // * PHPには$lines[-1]という表現はない
  // 3-5. $elements[0]でコメント番号を取得し、その+1を$numberに代入
  // 3-6. もし出力ファイルがまだなかったら、$numberは1にする
  if ($edit_number_hidden == NULL) {
    if(file_exists($filename)){
      $lines = file($filename, FILE_IGNORE_NEW_LINES);
      $elements = explode("<>", end($lines));
      $number = $elements[0] + 1;
    } else {
      $number = 1;
    } 
    
    if ($name == "" || $name == "名前") {
      echo "名前が入力されていません<br>";
    } elseif ($str == "" || $str == "コメント") {
      echo "コメントが入力されていません<br>";
    } elseif ($password==""){
      echo "passwordが入力されていません<br>";
    } else {
      if ($str == "完成！") {
          $str = "おめでとう！";
      }

      $response = $number . "<>" . $name . "<>" . $str . "<>" . $date."<>".$password;

      $response = $response . PHP_EOL;
      $fp = fopen($filename,"a");
      fwrite($fp, $response);
      fclose($fp);
      
      if(file_exists($filename)){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
          $elements = explode("<>", $line);
          $line=$elements[0] . "<>" . $elements[1]. "<>" . $elements[2] . "<>" . $elements[3];
          echo $line ."<br>";
        }
      }
    }
  } else {
    if(file_exists($filename)){
      $lines = file($filename, FILE_IGNORE_NEW_LINES);
      foreach ($lines as $line) {
        $elements = explode("<>", $line);
        if ($elements[0] == $edit_number_hidden) {
          $line = $edit_number_hidden . "<>" . $name . "<>" . $str . "<>" . $date;
        }
        $line = $line .PHP_EOL;
        if ($elements[0] == 1){
          $fp = fopen($filename,"w");
        } else {
          $fp = fopen($filename,"a");
        }
        fwrite($fp, $line);
        fclose($fp);
      }
      if(file_exists($filename)){
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
       foreach($lines as $line){
          $elements = explode("<>", $line);
          $line=$elements[0] . "<>" . $elements[1]. "<>" . $elements[2] . "<>" . $elements[3];
          echo $line ."<br>";
        }
      }
    }
  }
} elseif ($delete_number != NULL&&$delete_password!=NULL ) {
  if(file_exists($filename)){
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
      $elements = explode("<>", $line);
      if ($elements[0] != $delete_number) {
        $line = $line . PHP_EOL;
        if ($elements[0] == 1){
          $fp = fopen($filename,"w");
        } else {
          $fp = fopen($filename,"a");
        }
        fwrite($fp, $line);
        fclose($fp);
      } else {
        echo $elements[0] . "番の投稿は削除されました<br><br>";
      }
    }
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
          $elements = explode("<>", $line);
          $line=$elements[0] . "<>" . $elements[1]. "<>" . $elements[2] . "<>" . $elements[3];
          echo $line ."<br>";
    }  
  }
} elseif($edit_number != NULL&&$edit_password != NULL) {

  if(file_exists($filename)){
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
      $elements = explode("<>", $line);
      if ($elements[0] == $edit_number) {
        $form_value1 = $elements[1];
        $form_value2 = $elements[2];
        $form_value3 = $elements[0];
        // $line = $line . PHP_EOL;
        // if ($elements[0] == 1){
        //   $fp = fopen($filename,"w");
        // } else {
        //   $fp = fopen($filename,"a");
        // }
        // fwrite($fp, $line);
        // fclose($fp);
      }
    }
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
          $elements = explode("<>", $line);
          $line=$elements[0] . "<>" . $elements[1]. "<>" . $elements[2] . "<>" . $elements[3];
          echo $line ."<br>";
    }  
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>mission_3-5</title>

</head>
<body>
  <form action="" method="post">
    <input type="text" name="name" value= <?= $form_value1 ?>>
    <input type="text" name="str" value=<?= $form_value2 ?>>
    password:<input type="password" name="password" >
    <input type="hidden" name="edit_number_hidden" value=<?= $form_value3 ?>> 
    <input type="submit" name="submit">
  </form>
  <form action="" method="post">
    <input type="number" name="number">
     password:<input type="password" name="delete_password" >
    <input type="submit" name="delete" value="削除">
    
  </form>

  <form action="" method="post">
    <input type="number" name="edit_number">
     password:<input type="password" name="edit_password" >
    <input type="submit" name="edit" value="編集">
  </form>



</body>

</html>