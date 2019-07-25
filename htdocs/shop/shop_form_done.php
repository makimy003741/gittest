<?php
  session_start();
  session_regenerate_id(true);
  echo'<!DOCTYPE html>';
  echo'<html lang="ja">';
  echo'<head>';
  echo'<meta charset="utf-8">';
  echo'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
  echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
  echo'<title>やまもと楽器</title>';
  echo'</head>';

  echo'<body style="background:#bcffff;">';

    try{
      require_once('../common/common.php');

      $post = sanitize($_POST);

      $onamae = $post['onamae'];
      $email = $post['email'];
      $postal1 = $post['postal1'];
      $postal2 = $post['postal2'];
      $address = $post['address'];
      $tel = $post['tel'];
      $chumon = $post['chumon'];
      $pass = $post['pass'];
      $danjo = $post['danjo'];

      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>'.$onamae.'様</h3><br/>';
      echo '<h3>ご注文ありがとうございました。</h3><br/>';
      echo '<h3>'.$email.'にメールをお送りいたしましたのでご確認ください。</h3><br/>';
      echo '<h3>商品は下記の住所に発送させていただきます。</h3><br/>';
      echo '<h3>'.$postal1.'-'.$postal2.'</h3><br/>';
      echo '<h3>'.$address.'</h3><br/>';
      echo '<h3>'.$tel.'</h3><br/>';
      echo '<br/>';
      echo '</div>';

      $honbun='';
      $honbun.=$onamae."<h3>様\n\nこの度はご注文ありがとうございました。</h3>\n";
      $honbun.="\n";
      $honbun.="<h3>ご注文商品一覧\n";
      $honbun.="<h3>-----------------------------------\n";

      $cart=$_SESSION['cart'];
      $kazu=$_SESSION['kazu'];
      $max=count($cart);

      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      for($i=0;$i<$max;$i++){
        $sql='SELECT name,price FROM product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0]=$cart[$i];
        $stmt->execute($data);

        $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        $name=$rec['name'];
        $price=$rec['price'];
        $kakaku[]=$price;
        $suryo=$kazu[$i];
        $shokei=$price * $suryo;

        $honbun.='<h3>'.$name;
        $honbun.='<h3>'.$price.'円x';
        $honbun.='<h3>'.$suryo.'個=';
        $honbun.='<h3>'.$shokei.'円\n';
      }

      $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();

      $lastmembercode=0;
      if($chumon=='chumontouroku'){
        $sql='INSERT INTO dat_member(password,name,email,postal1,postal2,address,tel,danjo)
        VALUES(?,?,?,?,?,?,?,?)';
        $stmt=$dbh->prepare($sql);
        $data=array();
        $data[]=md5($pass);
        $data[]=$onamae;
        $data[]=$email;
        $data[]=$postal1;
        $data[]=$postal2;
        $data[]=$address;
        $data[]=$tel;
        if($danjo=='dan'){
          $data[]=1;
        }else{
          $data[]=2;
        }
        $stmt->execute($data);

        $sql='SELECT LAST_INSERT_ID()';
        $stmt=$dbh->prepare($sql);
        $stmt->execute();
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $lastmembercode=$rec['LAST_INSERT_ID()'];
      }

      $sql='INSERT INTO dat_sales(code_member,name,email,postal1,postal2,address,tel) VALUES(?,?,?,?,?,?,?)';
      $stmt=$dbh->prepare($sql);
      $data=array();
      $data[]=$lastmembercode;
      $data[]=$onamae;
      $data[]=$email;
      $data[]=$postal1;
      $data[]=$postal2;
      $data[]=$address;
      $data[]=$tel;
      $stmt->execute($data);

      $sql='SELECT LAST_INSERT_ID()';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      $lastcode=$rec['LAST_INSERT_ID()'];

      for($i=0;$i<$max;$i++){
        $sql='INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES(?,?,?,?)';
        $stmt=$dbh->prepare($sql);
        $data=array();
        $data[]=$lastcode;
        $data[]=$cart[$i];
        $data[]=$kakaku[$i];
        $data[]=$kazu[$i];
        $stmt->execute($data);
      }

      $sql='UNLOCK TABLES';
      $stmt=$dbh->prepare($sql);
      $stmt->execute();

      $dbh=null;

      if($chumon=='chumontouroku'){
        echo '<h3>会員登録が完了いたしました。</h3><br/>';
        echo '<h3>次回からメールアドレスとパスワードでログインしてください。</h3><br/>';
        echo '<h3>スムーズにご注文することができます。</h3><br/>';
        echo '<br/>';
      }

      $honbun.="<h3>送料は無料です。</h3>\n";
      $honbun.="<h3>-----------------------------------</h3>\n";
      $honbun.="\n";
      $honbun.="<h3>代金は下記の口座にお振り込みください。</h3>\n";
      $honbun.="<h3>oo銀行 xx支店 普通口座 1234567</h3>\n";
      $honbun.="<h3>入金の確認が取れ次第、発送させて頂きます。</h3>\n";
      $honbun.="\n";

      if($chumon=='chumontouroku'){
        $honbun.="<h3>会員登録が完了いたしました。</h3>\n";
        $honbun.="<h3>次回からメールアドレスとパスワードでログインしてください。</h3>\n";
        $honbun.="<h3>スムーズにご注文することができます。</h3>\n";
        $honbun.="\n";
      }

      $honbun.="<h3>-----------------------------------</h3>\n";
      $honbun.="<h3> 〜やまもと楽器〜</h3>\n";
      $honbun.="<h3> oo県xx市△△町12-34</h3>\n";
      $honbun.="<h3> TEL:090-xxxx-xxxx</h3>\n";
      $honbun.="<h3> MAIL:info@yamamotogakki.co.jp</h3>\n";
      $honbun.="<h3>-----------------------------------</h3>\n";

      // 本文確認用
      // echo nl2br($honbun);

      // お客様へメール送信
      $title='<h3>ご注文完了致しました</h3>';
      $header='<h3>From:info@info@yamamotogakki.co.jp</h3>';
      $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail($email,$title,$honbun,$header);

      // 注文確認用メール
      $title='<h3>注文がありました</h3>';
      $header='<h3>From:'.$email.'</h3>';
      $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail('info@info@yamamotogakki.co.jp',$title,$honbun,$header);

    }catch(Exception $e){
      echo'<div class="text-center">';
      echo'<h3 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h3>';
      echo '</div>';
      //exit();
    }

    ?>
    <form method="post" action="clear_cart.php">
      <input type="submit" button="btn btn-warning" name="clear" value="商品画面へ">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </form>
  </body>
</html>
