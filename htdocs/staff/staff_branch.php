<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false){
  echo'<div class="text-center">';
  echo '<br/><br/><h1 style="color:#56256e;">ログインされていません。</h1><br/>';
  echo '<a href="../staff_login/staff_login.html" style="color:#d04f97;"><h4>ログイン画面へ</h4></a>';
  echo '</div>';
  exit();
}

if(isset($_POST['disp'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
      　exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_disp.php?staffcode='.$staff_code);
    exit();
}

if(isset($_POST['add'])==true){
   header('Location:staff_add.php');
   exit();
}

if(isset($_POST['edit'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
        exit();
    }
    $staff_code=$_POST['staffcode'];
        header('Location:staff_edit.php?staffcode='.$staff_code);
        exit();
}

if(isset($_POST['delete'])==true){

    if(isset($_POST['staffcode'])==false){
        header('Location:staff_ng.php');
        exit();
    }

    $staff_code=$_POST['staffcode'];
    header('Location:staff_delete.php?staffcode='.$staff_code);
    exit();
}

?>
