<?php
    $str = "Hello world";
    $filename="mission_1-24.txt";
    $fp = fopen($filename,"a");
    fwrite($fp, $str.PHP_EOL);
    fclose($fp);
    echo "書き込み成功！<br>";
    //読み込むファイルは前々回の「mission_1-24.txt」を使用//
    //書き出したファイルを読み込んで、表示してみましょう。//
    if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line . "<br>";}}
    //file_exists :ファイルまたはディレクトリが存在するかどうか//
    // FILE_IGNORE_NEW_LINES:配列の各要素の最後に改行文字を追加しません。//
    //foreach( 配列 as 変数 ){
    //配列にある全ての要素について、変数への代入を繰り返す。}//
    ?>