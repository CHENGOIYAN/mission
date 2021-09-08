<?php
//基本どのページでもsession_start()を使うので、header.phpに書くことで簡略化する
session_start();
include 'stock.php';
include 'dbConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jewelry onlinestore</title>
    <link rel="stylesheet" href="/tb-230280/mission6/css/css.css">
</head>
<body>
<nav>
<ul class="clientMenu">
        <li><a href="/tb-230280/mission6/">HOME</a></li>
        <li><a href="/tb-230280/mission6/about.php">ABOUT</a></li>
</ul>

    
</ul>
<ul class="staffMenu">
    <?php 
    if (isset($_SESSION['customer']))
    {
        echo '<li><a href="/tb-230280/mission6/functions.php?op=logout">ログアウト</a></li>';
    }
    else{
        echo '<li><a href="/tb-230280/mission6/login.php">ログイン</a></li>';
        echo '<li><a href="/tb-230280/mission6/staffLogin.php">社員専用</a></li>';
    }
    ?>
    
</ul>
</nav>