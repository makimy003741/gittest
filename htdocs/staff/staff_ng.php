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
   echo '<div class="text-center" style="color:#56256e;">';
   echo '<br/><br/><h1>ログインされていません。</h1><br/>';
   echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;"><h4>ログイン画面へ</h4></a>';
   echo '</div>';
   exit();
 }else{
   echo '<div class="text-center" style="color:#56256e;">';
   echo '<br/><br/><h1>'.$_SESSION['staff_name'].'さんログイン中</h1><br/>';
   echo '</div>';
 }

  echo'<div class="text-center">';
  echo'<br/><br/><h1 style="color:#56256e;">スタッフが選択されていません。</h1><br/>';
  echo'<a href = "staff_list.php"><h4>戻る</h4></a>';
  echo'</div>';
 echo'</body>';
 echo'</html>';
?>
