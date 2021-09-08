
<?php
    $num = 15;
    if($num%3==0 && $num%5==0){echo "FizzBuzz<br>";}
    elseif ($num%3==0){echo "Fizz<br>";}
    elseif($num%5==0){echo "Buzz<br>";}
    else{echo $num . "<br>";}
    /*
1.if (条件) {条件がtrueであれば実行} 
    else {条件がfalseであれば実行}<br>
例えば、$num = "5";if ($num == 5) 
    {echo "犬";} else {echo $num;}<br>
2.if (条件A) {条件Aがtrueであれば実行} 
elseif (条件B) {条件Aがfalseで条件Bがtrueであれば実行}
else {条件Aと条件Bがともにfalseであれば実行}<br>*/
?>
