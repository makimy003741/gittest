  <?php
  echo'<!DOCTYPE html>';
  echo'<html lang="ja">';
  echo'<head>';
  echo'<meta charset="utf-8">';
  echo'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
  echo'<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
  echo'<title>やまもと楽器</title>';
  echo'</head>';

  echo'<body style="background:#bcffff;">';
    require_once('../common/common.php');

    $post = sanitize($_POST);

    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];
    $chumon = $post['chumon'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];
    $danjo = $post['danjo'];

    $okflg = true;

    if($onamae==''){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<br/><br/><h3>お名前が入力されていません。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }else{
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>氏名：'.$onamae.'</h3><br/>';
      echo '</div>';
    }

    if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>メールアドレスを正しく入力してください。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }else{
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>メールアドレス：'.$email.'</h3><br/>';
      echo '</div>';
    }

    if(preg_match('/\A[0-9]+\z/',$postal1)==0){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>郵便番号は半角数字で入力してください。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }elseif(preg_match('/\A[0-9]+\z/',$postal2)==0){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>郵便番号は半角数字で入力してください。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }else{
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>郵便番号：〒'.$postal1.'-'.$postal2.'</h3><br/>';
      echo '</div>';
    }

    // if(preg_match('/\A[0-9]+\z/',$postal2)==0){
    //   echo '郵便番号は半角数字で入力してください。<br/><br/>';
    // }

    if($address==''){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>住所が入力されていません。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }else{
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>住所：'.$address.'</h3><br/>';
      echo '</div>';
    }

    if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$tel)==0){
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>電話番号は半角数字とハイフンで入力してください。</h3><br/><br/>';
      echo '</div>';
      $okflg = false;
    }else{
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>電話番号：'.$tel.'</h3><br/>';
      echo '</div>';
    }

    if($chumon=='chumontouroku'){
      if($pass==''){
        echo '<div class="text-center" style="color:#56256e;">';
        echo '<h3>パスワードが入力されていません。</h3><br/><br/>';
        echo '</div>';
        $okflg=false;
      }

      if($pass!=$pass2){
        echo '<div class="text-center" style="color:#56256e;">';
        echo '<h3>パスワードが一致しません。</h3><br/><br/>';
        echo '</div>';
        $okflg=false;
      }
      echo '<div class="text-center" style="color:#56256e;">';
      echo '<h3>性別</h3>';
      echo '</div>';

      if($danjo=='dan'){
        echo '<div class="text-center" style="color:#56256e;">';
        echo '<h3>男性</h3>';
        echo '</div>';
      }else{
        echo '<div class="text-center" style="color:#56256e;">';
        echo '<h3>女性</h3>';
        echo '</div>';
      }

      echo '<br/><br/>';

    }


    if($okflg == true){
      echo '<div class="text-center">';
      echo '<form method="post" action="shop_form_done.php">';
      echo '<input type="hidden" name="onamae" value="'.$onamae.'">';
      echo '<input type="hidden" name="email" value="'.$email.'">';
      echo '<input type="hidden" name="postal1" value="'.$postal1.'">';
      echo '<input type="hidden" name="postal2" value="'.$postal2.'">';
      echo '<input type="hidden" name="address" value="'.$address.'">';
      echo '<input type="hidden" name="tel" value="'.$tel.'">';
      echo '<input type="hidden" name="chumon" value="'.$chumon.'">';
      echo '<input type="hidden" name="pass" value="'.$pass.'">';
      echo '<input type="hidden" name="danjo" value="'.$danjo.'">';
      echo '<br/>';
      echo '<h3 style="color:#56256e;">上記でお間違いないですか？</h3><br/>';
      echo '<input type="button"  button class="btn btn-success" onclick="history.back()" value="戻る">';
      echo '<input type="submit" button class="btn btn-info" value="OK"><br/>';
      echo '</form>';
      echo '</div>';
    }else{
      echo '<div class="text-center">';
      echo '<form>';
      echo '<input type="button"  button class="btn btn-success" onclick="history.back()" value="戻る">';
      echo '</form>';
      echo '</div>';
    }
    echo'<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
  echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>';
  echo'<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';
  echo'</body>';
echo'</html>';
  ?>
