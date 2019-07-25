<?php
session_start();
session_regenerate_id(true);

echo '<!DOCTYPE html>';
echo '<html lang="ja">';
echo '<head>';
echo '<meta charset="utf-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo '<title>やまもと楽器</title>';
echo '</head>';

echo '<body style="background:#bcffff;">';

if(isset($_SESSION['member_login'])==false){
  echo '<div class="text-center" >';
  echo '<br/><br/><h1 style="color:#56256e;">ようこそゲスト様</h1>';
  echo '<a href="member_login.html"><h4 style="color:#d04f97;">会員ログイン</h4></a><br/>';
  echo '<br/>';
  echo '</div>';
}else{
  echo '<div class="text-center">';
  echo '<br/><br/><h1 style="color:#56256e;">ようこそ'.$_SESSION['member_name'].'様</h1>';
  echo '<a href="member_logout.php" style="color:#d04f97";><h4>ログアウト</h4></a><br/>';
  echo '<br/>';
  echo '</div>';
}
        try{

            if(isset($_SESSION['cart'])==true){
              $cart=$_SESSION['cart'];
              $kazu=$_SESSION['kazu'];
              $max=count($cart);
            }else{
              $max=0;
            }

            if($max==0){
              echo '<div class="text-center">';
              echo '<h3 style="color:#56256e;">カートに商品が入っていません。</h3>';
              echo '<br/>';
              echo '<a href="shop_list.php"><h4>商品一覧へ戻る</h4></a>';
              echo '</div>';
              exit();
            }

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn,$user,$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            foreach($cart as $key=> $val){
              $sql='SELECT code,name,price,gazou FROM product WHERE code=?';
              $stmt=$dbh->prepare($sql);
              $data[0]=$val;
              $stmt->execute($data);

              $rec=$stmt->fetch(PDO::FETCH_ASSOC);

              $pro_name[]=$rec['name'];
              $pro_price[]=$rec['price'];
              if($rec['gazou']==''){
                $pro_gazou[]='';
              }else{
                $pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
              }
            }
            $dbh = null;

            }
            catch(Exception $e){
                echo '<div class="text-center" >';
                echo '<h1 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h1>';
                echo '</div>';
                exit();
            }
          ?>
            <div class="text-center" style="color:#56256e;">
            <h1>カートの中身</h1><br/>
            <br/>
            <form method="post" action="kazu_change.php">
              <table border="1" class="center-block" align="center">
              <tr>
                <td>商品</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
              </tr>
              <?php for($i=0;$i<$max;$i++){ ?>
              <tr>
                <td><?php echo $pro_name[$i]; ?></td>
                <td><?php echo $pro_gazou[$i]; ?></td>
                <td><?php echo $pro_price[$i]; ?>円</td>
                <td><input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>"></td>
                <td><?php echo $pro_price[$i] * $kazu[$i]; ?>円</td>
                <td><input type="checkbox" name="sakujo<?php echo $i; ?>"></td>
              </tr>
          <?php } ?>
              </table>
                <input type="hidden" name="max" value="<?php echo $max; ?>">
                <h5>(削除する際は、削除にチェックを入れて数量変更ボタンを押してください。)</h5><br/>
                <br/>
                <input type="submit" class="btn btn-warning" value="数量変更"><br/>
                </br><input type="button" class="btn btn-info" onclick="location.href='clear_cart.php'" value="カートを空にする"><br/>
                </br><input type="button" class="btn btn-success" onclick="location.href='shop_list.php'" value="戻る">
            </form>
            </br></br>
            <a href="shop_form.html">
              <h4>ご購入手続きへ進む</h4>
            </a>
            <br/>

            <?php
              if(isset($_SESSION["member_login"])==true){
                echo '<h4><a href="shop_kantan_check.php">以前登録した住所で注文する</a></h4><br/>';
              }

            ?>

            </div>

            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
            </script>

      </body>
    </html>
