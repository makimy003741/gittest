<?php

session_start();
session_regenerate_id(true);
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


        try{
            $pro_code = $_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT name,price,gazou FROM product WHERE code=?';
            $stmt = $dbh->prepare($sql);
            $data[] = $pro_code;
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $pro_name = $rec['name'];
            $pro_price = $rec['price'];
            $pro_gazou_name_old = $rec['gazou'];

            $dbh = null;

              if($pro_gazou_name_old==''){
                $disp_gazou='';
              }else{
                $disp_gazou='<img src="./gazou/'.$pro_gazou_name_old.'">';
              }

            }
            catch(Exception $e){
              echo '<div class="text-center">';
              echo'<h4 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h4>';
              echo '</div>';
              exit();
            }
?>
        <div class="text-center" style="color:#56256e;">
        <h2>商品修正</h2><br/>
        <br/>
        <h3>商品コード</h3>
        <h4><?php echo $pro_code; ?></h4>
        <br/>
        <br/>
        <form method ="post" action="pro_edit_check.php" enctype="multipart/form-data">
        <input type="hidden" name="code" value="<?php echo $pro_code;?>">
        <input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old;?>">
        <h3>商品名</h3>
        <input type="text" name="name" style="width:200px" value="<?php echo $pro_name; ?>">
        <br/>
        <br/><h3>価格</h3>
        <input type="text" name="price" style="width:50px" value="<?php echo $pro_price;?>"><h3>円</h3><br/>
        <br/>
        <?php echo $disp_gazou; ?>
        <br/>
        <h3>画像を選んでください。</h3><br/>
        <input type="file" name="gazou" style="width:400px"><br/>
        <br/>
        <input type="button" button class="btn btn-success" onclick="history.back()" value="戻る">
        <input type="submit" button class="btn btn-info" value="OK">
        </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
