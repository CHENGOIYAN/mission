<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_2-3</title>
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
    elseif($str=="完成！"){echo "おめでとう！"."<br>";}
    else {echo $str."を受け付けました！"."<br>";
    }


    
    $filename="mission_2-3.txt";
    $fp = fopen($filename,"a");
    fwrite($fp,$str.PHP_EOL);
    fclose($fp);
 
    ?>
