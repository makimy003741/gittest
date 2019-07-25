<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
  echo'<!DOCTYPE html>';
  echo'<html lang="ja">';
  echo'<head>';
  echo'<meta charset="utf-8">';
  echo'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
  echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
  echo'<title>やまもと楽器</title>';
  echo'</head>';
  echo'<body class="text-center" style="background:#bcffff;">';
  echo '<h1 style="color:#56256e;">ログインされていません。</h1><br/>';
  echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;"><h4>ログイン画面へ</h4></a>';
  echo '</div>';
  echo'</body>';
  echo'</html>';
  exit();
}

if(isset($_POST['disp'])==true){

    if(isset($_POST['procode'])==false){
        header('Location:pro_ng.php');
      　exit();
    }

    $pro_code=$_POST['procode'];
    header('Location:pro_disp.php?procode='.$pro_code);
    exit();
}

if(isset($_POST['add'])==true){
   header('Location:pro_add.php');
   exit();
}

if(isset($_POST['edit'])==true){

    if(isset($_POST['procode'])==false){
        header('Location:pro_ng.php');
        exit();
    }
    $pro_code=$_POST['procode'];
        header('Location:pro_edit.php?procode='.$pro_code);
        exit();
}

if(isset($_POST['delete'])==true){

    if(isset($_POST['procode'])==false){
        header('Location:pro_ng.php');
        exit();
    }

    $pro_code=$_POST['procode'];
    header('Location:pro_delete.php?procode='.$pro_code);
    exit();
}

?>
