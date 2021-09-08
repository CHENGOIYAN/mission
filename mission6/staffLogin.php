<?php include('header.php'); ?>

<form action="/tb-230280/mission6/functions.php?op=check_staffLogin" method="post">
   <h1>社員専用ページ</h1>
  <label for="email">メールアドレス:</label>
  <input type="email" id="email" name="email" require><br>
  
  <label for="email">パスワード:</label>
  <input type="password" id="password" name="password">
  
  <br>
  <input type="submit" value="登入">
</form> 

<?php include('footer.php'); ?>