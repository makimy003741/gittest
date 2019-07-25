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
  echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;"><h4>ログイン画面へ</h4></a>';
  echo '</div>';
  exit();
}else{
  echo '<div class="text-center" style="color:#56256e;">';
  echo '<br/><br/><h1>'.$_SESSION['staff_name'].'さんログイン中</h1><br/>';
  echo '</div>';
}
          require_once('../common/common.php');

          $post=sanitize($_POST);

          $pro_code=$post['code'];
          $pro_name=$post['name'];
          $pro_price=$post['price'];
          $pro_gazou_name_old=$_POST['gazou_name_old'];
          $pro_gazou=$_FILES['gazou'];

          if($pro_name == ''){
              echo '<div class="text-center" >';
              echo '<h3 style="color:#56256e;">商品名が入力されていません。</h3><br/>';
              echo'</div>';
          }else{
              echo '<div class="text-center" >';
              echo '<h3 style="color:#56256e;">商品名：'.$pro_name.'</h3>';
              echo'</div>';
              echo '<br/>';
              }

          if(preg_match("/^[0-9]+$/",$pro_price) == 0){
            echo '<div class="text-center" >';
            echo '<h3 style="color:#56256e;">半角数字で入力してください。</h3><br/>';
            echo'</div>';
          }else{
            echo '<div class="text-center" >';
            echo '<h3 style="color:#56256e;">価格：'.$pro_price.'円</h3><br/>';
            echo'</div>';
            }

          if($pro_gazou['size']>0){
            if($pro_gazou['size'] > 1000000){
                echo '<div class="text-center">';
                echo '<h3 style="color:#56256e;">画像が大き過ぎます。</h3>';
                echo'</div>';
            }else{
                move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
                echo '<div class="text-center">';
                echo '<img src="./gazou/'.$pro_gazou['name'].'">';
                echo '<br/>';
                  echo'</div>';
            }
          }

          if($pro_name == '' || preg_match("/^[0-9]+$/",$pro_price) == 0 || $pro_gazou['size']>1000000){
              echo '<div class="text-center" >';
              echo '<form>';
              echo '<input type="button" button class="btn btn-success" onclick="history.back()" value="戻る">';
              echo '</form>';
              echo'</div>';
          }else{
              echo '<div class="text-center" >';
              echo '<h3>上記の様に変更します。</h3><br/>';
              echo '<form method="post" action="pro_edit_done.php">';
              echo '<input type="hidden" name="code" value="'.$pro_code.'">';
              echo '<input type="hidden" name="name" value="'.$pro_name.'">';
              echo '<input type="hidden" name="price" value="'.$pro_price.'">';
              echo '<input type="hidden" name="gazou_name_old" value="'.$pro_gazou_name_old.'">';
              echo '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'">';
              echo '<br/>';
              echo '<input type="button" button class="btn btn-success" onclick="history.back()" value="戻る">';
              echo '<input type="submit" button class="btn btn-info" value="OK">';
              echo '</form>';
              echo'</div>';
          }
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
