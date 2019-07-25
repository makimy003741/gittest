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



require_once('../common/common.php');
?>
    <div class="text-center" style="color:#56256e;">
    <h3>ダウンロードしたい注文日を選択して下さい。</h3><br/>
    <form method="post" action="order_download_done.php">
    <select name="year">
    <?php pulldown_year();?>
    </select>
    <h3>年</h3>
    <select name="month">
    <?php pulldown_month();?>
    </select>
    <h3> 月</h3>
    <select name="day">
    <?php pulldown_day(); ?>
    </select>
    <h3>日</h3><br/>
    <br/>
    <input type="submit" value="ダウンロード">
      <input type="button" onclick="history.back()" button class="btn btn-info" value="戻る">
    </form>

  </body>
</html>
