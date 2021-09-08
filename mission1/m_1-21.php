<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_1-20</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="str">
        <input type="submit" name="submit">
    </form>
    <?php
            $str = $_POST["str"];
    if($str%3==0 && $str%5==0){echo "FizzBuzz<br>";}
    elseif ($str%3==0){echo "Fizz<br>";}
    elseif($str%5==0){echo "Buzz<br>";}
    else{echo $str . "<br>";}
    ?>
</body>

</html>