<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-4</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str" value="名前" >
        <input type="submit" name="submit">
    </form>


<?php
$str = @$_POST["str"];
 

    $filename="mission_2-4.txt";
    $fp = fopen($filename,"a");
    fwrite($fp,$str.PHP_EOL);
    fclose($fp);
//file_exists :ファイルまたはディレクトリが存在するかどうか//
// FILE_IGNORE_NEW_LINES:配列の各要素の最後に改行文字を追加しません。//
//foreach( 配列 as 変数 ){
//配列にある全ての要素について、変数への代入を繰り返す。}//
 if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
//strlen()関数は、文字列の長さを調べる関数です。
 //長さがゼロであればデータが入力されてないと判断します。
    if (!strlen($line)) {}
    else {echo "おめでとう！by ".$line."<br>";
    };}}
    
    
    ?>