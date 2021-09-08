<?php
    $items = array("Ken","Alice","Judy","BOSS","Bob");
     foreach($items as $item){
        if($item=="BOSS"){
            echo "Good morning $item!<br>";
        }else{
            echo "Hi! $item<br>";
        }
    }
?>

<!--foreach( 配列 as 変数 ){
    配列にある全ての要素について、変数への代入を繰り返す。
}*/-->