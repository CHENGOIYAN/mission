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
            echo $str;
    ?>
</body>

</html>
   <!--変数$str へ フォームの入力欄（name="str"）からデータを受け取る場合はPHPタグ内に下記のように記述します。
$str = $_POST["str"]-->         