<?php
include 'dbConnect.php';

$op ='none';
if(isset($_GET['op'])) $op = $_GET['op'];

if($op=='createOrder')
{
    createOrder();
}
if($op=='checkLogin')
{
    checkLogin($_POST['email'],$_POST['password']);
}
if($op=='logout')
{
    logout();
}
if($op=='check_staffLogin')
{
    check_staffLogin($_POST['email'],$_POST['password']);
}
function isUser()
{
    return isset($_SESSION ['customer'] );
   
    
}
function logout()
{
    session_start();
    session_destroy();
    header("Location: /tb-230280/mission6/");
}
function checkLogin($email, $password)
{
    global $dbConnection;
    $userQ = mysqli_query($dbConnection, "SELECT * FROM `user` WHERE `mail`='".$email."'");

    $user = mysqli_fetch_assoc($userQ);
    
    if($email == $user['mail'] &&
    password_verify($_POST['password'], $user['password'] ))
    {
        //認證是一個職員 SESSION
        session_start();
        $_SESSION ['customer'] = array (
            // idというキーで$row['id']を入れる

            'name' => $user ['name'],
            'mail' => $user ['mail'],
            'password' => $user ['password']);
    

        header("Location: /tb-230280/mission6/");
    }
    else
    {
        
        header("Location: /tb-230280/mission6/login.php");
    }
}

function createOrder(){

    global $dbConnection;
    /* echo $_POST['gem_id']."<br>";
    echo $_POST['name']."<br>";
    echo $_POST['email']."<br>";
    echo $_POST['quantity']."<br>";
    echo date('Y-m-d H:i:s')."<br>"; */

    //儲存訂單
    $sql = "INSERT INTO `order` (
        `client_name`, 
        `client_email`,
         `quantity`, 
         `order_time`, 
         `gem_id`
         ) VALUES (
         '{$_POST['name']}', 
         '{$_POST['email']}',
         {$_POST['quantity']}, 
         '".date('Y-m-d H:i:s')."',
         {$_POST['gem_id']})";

    //寫入MySQL資料庫
    if(mysqli_query($dbConnection, $sql))
    {
        //你可以在這裡減去gem table的remaining存貨

        //轉變頁面
        header("Location: /tb-230280/mission6/order-completed.php");
    }
    else{
        echo "接続できません";
    }
}
function check_staffLogin($email, $password)
{
    global $dbConnection;
    $staffQ = mysqli_query($dbConnection, "SELECT * FROM `staff` WHERE `email`='".$email."'");

    $staff = mysqli_fetch_assoc($staffQ);


    if($email == $staff['email'] && $staff['password'] == $password)
    {
        
        header("Location: /tb-230280/mission6/allOrders.php");
    }
    else
    {
        header("Location: /tb-230280/mission6/staffLogin.php");
        
    }
}