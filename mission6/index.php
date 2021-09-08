<?php include('header.php'); ?>

    <h1>商品リスト</h1>
    <h2></h2>
      
      <div class="flex-grid">
      <?php
     //顯示貨品
    $gemQ = mysqli_query($dbConnection, "SELECT * FROM `gem`");

    while ($gem = mysqli_fetch_assoc($gemQ)) {
        echo '<div class="col">
        <img src="/tb-230280/mission6/images/'.$gem['image'].'" />
        <p>
        '.$gem['name'].'<br>
        値段：'.$gem['price'].'円<br>
        <a href="/tb-230280/mission6/order.php?gem_id='.$gem['gem_id'].'" class="buyBtn">予約</a><br>
        </div>';
    }

    /* foreach($gems as $key => $gem)
    {
        echo '<div class="col">
        <img src="/images/'.$gem['image'].'" />
        <p>
        名稱：'.$gem['name'].'<br>
        價格：$'.$gem['price'].'<br>
        <a href="/order.php?gem_id='.$gem['gem_id'].'" class="buyBtn">預訂'.$gem['name'].'</a><br>
        </div>';
    } */
    ?>
    </div>
    <p></p>
<?php include('footer.php'); ?>
© 2021 GitHub, Inc.