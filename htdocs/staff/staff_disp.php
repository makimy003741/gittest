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
if(isset($_SESSION['login'])==false){
  echo'<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>ログインされていません。</h1><br/>';
  echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;">ログイン画面へ</a>';
  echo '</div>';
  exit();
}else{
  echo '<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>'.$_SESSION['staff_name'].'さんログイン中</h1><br/>';
  echo '</div>';
}

        try{
            $staff_code = $_GET['staffcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name FROM staff WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $staff_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];

            $dbh = null;
            }
            catch(Exception $e){
                echo '<div class="text-center">';
                echo'<h4 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h4>';
                echo '</div>';
                exit();
            }

        echo '<div class="text-center" style="color:#56256e;">';
        echo'<h2>スタッフ参照情報</h2><br/>';
        echo'<br/>';
        echo'<h3>スタッフコード</h3>';
        echo '<h4>'.$staff_code.'</h4><br/>';
        echo'<br/>';
        echo'<h3>スタッフ名</h3>';
        echo '<h4>'.$staff_name.'</h4><br/>';
        echo'<br/>';
        echo'<input type="button" onclick="history.back()"button class="btn btn-success" value="戻る">';
        echo'</div>';
        echo'</form>';
        echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
        echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
  echo'</body>';
echo'</html>';
?>
