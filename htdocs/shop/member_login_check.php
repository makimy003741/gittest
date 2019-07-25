<?php
try{

    require_once('../common/common.php');

    $post=sanitize($_POST);

    $member_email = $post['email'];
    $member_pass = $post['pass'];

    $member_pass = md5($member_pass);

    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name FROM dat_member WHERE email=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $member_email;
    $data[] = $member_pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec == false){
      echo'<html lang="ja">';
      echo'<head>';
      echo'<meta charset="utf-8">';
      echo'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
      echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
      echo'<title>やまもと楽器</title>';
      echo'</head>';

      echo'<body style="background:#bcffff;">';
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>メールアドレスかパスワードが間違っています。</h3><br/>';
      echo '<a href="member_login.html" button class="btn btn-success">戻る</a>';
      echo '</div>';
      echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
      echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
      echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
      echo'</body>';
      echo'</html>';
    }else{
      session_start();
      $_SESSION['member_login']=1;
      $_SESSION['member_code']=$rec['code'];
      $_SESSION['member_name']=$rec['name'];
      header('Location: shop_list.php');
      exit();
    }

}catch(Exception $e){
  echo'<html lang="ja">';
    echo'<head>';
    echo'<meta charset="utf-8">';
    echo'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    echo'<title>やまもと楽器</title>';
    echo'</head>';

    echo'<body style="background:#bcffff;">';
    echo '<div class="text-center" style="color:#56256e;">';
    echo '<h3>ただいま障害により大変ご迷惑をお掛けしております。</h3><br/>';
    echo '</div>';
    echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
    echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
    echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
    echo'</body>';
    echo'</html>';
    exit();
}
?>
