<?php include('header.php'); ?>
<h1>予約ありがとうございます！</h1>
<div class="container">

<p class="thankyouText">ご予約の申し込みを受け付けました。予約が確定しましたら、改めて担当よりメールを差し上げます。</p>
</div>
<?php
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'ordersetting.php';

// PHPMailerのインスタンス生成
    $email = new PHPMailer\PHPMailer\PHPMailer();

    $email->isSMTP(); // SMTPを使うようにメーラーを設定する
    $email->SMTPAuth = true;
    $email->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
    $email->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
    $email->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
    $email->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
    $email->Port = SMTP_PORT; // 接続するTCPポート

    // メール内容設定
    $email->CharSet = "UTF-8";
    $email->Encoding = "base64";
    $email->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $email->addAddress($_SESSION['customer']['mail'], $_SESSION ['customer']['name']); //受信者（送信先）を追加する
//    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
//    $mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
//    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
    $email->Subject = MAIL_SUBJECT; // メールタイトル
    $email->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
    $body = $_SESSION ['customer']['name'].'様<br>この度はjewelry onlinestoreをご利用いただき誠にありがとうございます。<br>
       予約が確定しましたら、改めて担当よりメールを差し上げます。<br>ご質問・パスワード等に関するお問い合せ
: jewelry.onlinestore21@gmail.com   ';
      

    $email->Body  = $body; // メール本文
    // メール送信の実行
    if(!$email->send()) {
    	echo 'メッセージは送られませんでした！';
    	echo 'Mailer Error: ' . $email->ErrorInfo;
    } else {
    	
    }

 ?>
  

<?php include('footer.php'); ?>