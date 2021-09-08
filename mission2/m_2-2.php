<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-2</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" value="コメント" >
        <input type="submit" name="submit">
    </form>


<?php
$str = @$_POST["str"];
 //strlen()関数は、文字列の長さを調べる関数です。
 //長さがゼロであればデータが入力されてないと判断します。
    if (!strlen($str)) {}
    elseif($str=="完成！"){echo "おめでとう！";}
    else {echo $str."を受け付けました！";
    }


    
    $filename="mission_2-2.txt";
    $fp = fopen($filename,"a");
    fwrite($fp,$str.PHP_EOL);
    fclose($fp);
     
     if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line . "<br>";}}
 
    ?>
