<?php
    $str = "Hello world";
    //書き込む文字列を変更して数回試してみましょう//
    $filename="mission_1-25.txt";
    $fp = fopen($filename,"w");
    //上書きのモード//
    fwrite($fp, $str.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！";
?>
        