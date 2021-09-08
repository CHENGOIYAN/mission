<?php
    $str = "Hello world";
    $filename="mission_1-24.txt";
    //mission_1-24.txtを作り、書き込むプログラミング//
    $fp = fopen($filename,"a");
    //「a」追記 「w」上書き　「r」読み込み//
    //fopen ファイルをオープン//
    fwrite($fp, $str.PHP_EOL);
    //fxwite ファイルにデータを書き込む//
    fclose($fp);
    //fclose ファイルを閉じる//
    echo "書き込み成功！";
?>