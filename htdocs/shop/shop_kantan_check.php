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
if(isset($_SESSION['member_login'])==false){
  echo'<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>ログインされていません。</h1><br/>';
  echo '<a href="shop_list.php"style="color:#d04f97;"><h4>商品一覧へ</h4></a>';
  echo '</div>';
  exit();
}

      $code=$_SESSION['member_code'];

      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql = 'SELECT name,email,postal1,postal2,address,tel
              FROM dat_member WHERE code=?';
      $stmt = $dbh->prepare($sql);
      $data[] = $code;
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $dbh = null;

      $onamae=$rec['name'];
      $email=$rec['email'];
      $postal1=$rec['postal1'];
      $postal2=$rec['postal2'];
      $address=$rec['address'];
      $tel=$rec['tel'];

      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>氏名</h3><br/>';
      echo '<h3>'.$onamae.'</h3>';
      echo '<br/><br/>';

      echo '<h3>メールアドレス</h3><br/>';
      echo '<h3>'.$email.'</h3>';
      echo '<br/><br/>';

      echo '<h3>郵便番号</h3><br/>';
      echo '<h3>'.$postal1.'</h3>';
      echo '<h3>-</h3>';
      echo '<h3>'.$postal2.'</h3>';
      echo '<br/><br/>';

      echo '<h3>住所</h3><br/>';
      echo '<h3>'.$address.'</h3>';
      echo '<br/><br/>';

      echo '<h3>電話番号</h3><br/>';
      echo '<h3>'.$tel.'</h3>';
      echo '<br/><br/>';

      echo '<form method="post" action="shop_kantan_done.php">';
      echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
      echo '<input type="hidden" name="email" value="'.$email.'">';
      echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
      echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
      echo '<input type="hidden" name="address" value="'.$address.'">';
      echo '<input type="hidden" name="tel" value="'.$tel.'">';
      echo '<br/>';
      echo '<input type="button" button class="btn btn-info" onclick="history.back()" value="戻る">';
      echo '<input type="submit"  button class="btn btn-success"value="OK"><br/>';
      echo '</form>';
      echo '</div>';
      echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
    echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
    echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';

  echo'</body>';
echo'</html>';
?>
