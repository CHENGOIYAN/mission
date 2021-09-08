<?php include('header.php'); ?>

<form action="/tb-230280/mission6/functions.php?op=checkLogin" method="post">

  <label for="email">メールアドレス:</label>
  <input type="email" id="email" name="email"  require><br>
  
  <label for="email">パスワード:</label>
  <input type="password" id="password" name="password">
  
  <br>
  <input type="submit" value="登入">
</form> 


<p>まだ会員に登録されていない方は<a href="/tb-230280/mission6/signup_mail.php">こちら</a></p>
<?php include('footer.php'); ?>