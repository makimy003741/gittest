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
  require_once('../common/common.php');

  $post=sanitize($_POST);

  $max=$post['max'];
  for($i=0;$i<$max;$i++){
    if(preg_match("/^[0-9]+$/",$post['kazu'.$i]) == 0){
      echo '<div class="text-center">';
      echo '<h1>数量に誤りがあります。</h1>';
      echo '<a href="shop_cartlook.php"><h4 style="color:#d04f97;">カートに戻る</h4></a>';
      echo '</div>';
      exit();
    }
    if($post['kazu'.$i]<1 || 100<$post['kazu'.$i]){
      echo '<div class="text-center">';
      echo '<h3 style="color:#56256e;">数量は必ず1個以上、100個以下にしてください。</h3>';
      echo '<a href="shop_cartlook.php"><h4 style="color:#d04f97;">カートに戻る</h4></a>';
      echo '</div>';
      exit();
    }
    $kazu[]=$post['kazu'.$i];
  }

  $cart=$_SESSION['cart'];

  for($i=$max;0<=$i;$i--){
    if(isset($_POST['sakujo'.$i])==true){
      array_splice($cart,$i,1);
      array_splice($kazu,$i,1);
    }
  }

  $_SESSION['cart']=$cart;
  $_SESSION['kazu']=$kazu;

  header('Location: shop_cartlook.php');
  exit();
  echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
  echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
  echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
  echo'</body>';
  echo'</html>';

?>
