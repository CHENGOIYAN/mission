<?php include('header.php'); 
include('functions.php'); 


?>
<h1>予約リスト</h1>
<?php
//拿訪客的訂單資料
$orderQ = mysqli_query($dbConnection, "SELECT * FROM `order`");

while ($order = mysqli_fetch_assoc($orderQ)) {

    $gemQ = mysqli_query($dbConnection, 'SELECT * FROM `gem` WHERE gem_id='.$order['gem_id']);
    $gem = mysqli_fetch_assoc($gemQ);

    echo '<div class="order"><p>';
    echo 'お名前 : '.$order['client_name'].'<br/>';
    echo 'メールアドレス : '.$order['client_email'].'<br/>';
    echo '予約内容 : '.$gem['name'].' X '.$order['quantity'].'件 <br/>';
    echo '時間 : '.$order['order_time'].'<br/>';
    echo '</p></div>';

}
/* $orderData = file_get_contents('data.csv');
$orders = str_getcsv($orderData, "\r\n"); 
//顯示所有訂單
foreach($orders as $order)
{
    //拆解每一單的幾個資料
    $singleOrder = explode(",", $order);
    echo '<div class="order"><p>';
    echo '客戶稱呼 : '.$singleOrder[1].'<br/>';
    echo '客戶電郵 : '.$singleOrder[2].'<br/>';
    echo '想預訂 : '.$gems[$singleOrder[0]-1]['name'].' X '.$singleOrder[3].'件 <br/>';
    echo '下單時間 : '.$singleOrder[4].'<br/>';
    echo '</p></div>';
}*/
?>
<?php include('footer.php'); ?>