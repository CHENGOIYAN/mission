<?php include 'header.php'; 
include('functions.php'); 
//不是user的不可以觀看訂單
if(!isUser()) header("Location: /tb-230280/mission6/login.php");?>



<form action="/tb-230280/mission6/functions.php?op=createOrder" method="post">

  <label for="gem_name">予約商品： </label>
  <input type="hidden" id="gem_id" name="gem_id" value="<?php echo $_GET['gem_id'];?>">
  
  <h2><?php echo $gems[$_GET['gem_id']-1]['name'];?></h2>

  <label for="name">お名前:</label>
  <input type="text" id="name" name="name"value ="<?php if (isset($_SESSION ['customer']['name'] ) ){ echo $_SESSION['customer']['name']; } ?>"
  <label for="email">メールアドレス:</label>
  <input type="email" id="email" name="email" 
  value ="<?php if (isset($_SESSION['customer']['mail']) ){ echo $_SESSION['customer']['mail']; } ?>"require><br/>
  <label for="quantity">予約数:</label>
  <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">
  
  <br>
  <input class="buyBtn" type="submit" value="予約">
</form> 

<?php include 'footer.php';?>