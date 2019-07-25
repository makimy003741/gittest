<?php

session_start();
session_regenerate_id(true);

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<title>やまもと楽器</title>';
echo '</head>';

echo'<body style="background:#bcffff;">';
if(isset($_SESSION['login'])==false){
  echo'<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>ログインされていません。</h1><br/>';
  echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;"><h4>ログイン画面へ</h4></a>';
  echo '</div>';
  exit();
}else{
  echo '<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>'.$_SESSION['staff_name'].'さんログイン中</h1><br/>';
  echo '</div>';
}

try{
    $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name FROM staff WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    echo '<div class="text-center">';
    echo '<h2 style="color:#56256e;">スタッフ一覧</h2><br/><br/>';
    echo '</div>';

    echo '<form method="post" action="staff_branch.php">';

    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if($rec == false){
            break;
        }
        echo '<div class="text-center">';
        echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
        echo $rec['name'];
        echo '<br/>';
        echo '</div>';
    }
    echo '<div class="text-center">';
    echo '<input type="submit" button class="btn btn-info" name="disp" value="参照">';
    echo '<input type="submit" button class="btn btn-info" name="add" value="追加">';
    echo '<input type="submit" button class="btn btn-info" name="edit" value="修正">';
    echo '<input type="submit" button class="btn btn-info" name="delete" value="削除">';
    echo '</form>';
    echo '</div>';
}

catch(Exception $e){
    echo '<div class="text-center" style="background:#bcffff;">';
    echo '<h3 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h3>';
    echo '</div>';
    exit();
}

echo '<br/>';
echo '<div class="text-center">';
echo '<a href="../staff_login/staff_top.php"><h4 style="color:#d04f97;">トップメニューへ</h4></a><br/>';
echo '</div>';
echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
echo '</body>';
echo '</html>';



?>
