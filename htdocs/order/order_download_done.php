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

      try{

          $year=$_POST['year'];
          $month=$_POST['month'];
          $day=$_POST['day'];

          $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
          $user = 'root';
          $password = '';
          $dbh = new PDO($dsn,$user,$password);
          $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

          $sql = 'SELECT
                    dat_sales.code,
                    dat_sales.date,
                    dat_sales.code_member,
                    dat_sales.name AS dat_sales_name,
                    dat_sales.email,
                    dat_sales.postal1,
                    dat_sales.postal2,
                    dat_sales.address,
                    dat_sales.tel,
                    dat_sales_product.code_product,
                    product.name AS product_name,
                    dat_sales_product.price,
                    dat_sales_product.quantity
                  FROM
                    dat_sales,dat_sales_product,product
                  WHERE
                    dat_sales.code=dat_sales_product.code_sales
                    AND dat_sales_product.code_product=product.code
                    AND substr(dat_sales.date,1,4)=?
                    AND substr(dat_sales.date,6,2)=?
                    AND substr(dat_sales.date,9,2)=?
                  ';
          $stmt = $dbh->prepare($sql);
          $data[]=$year;
          $data[]=$month;
          $data[]=$day;
          $stmt->execute($data);

          $dbh = null;

          $csv='注文コード,注文日時,会員番号,氏名,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
          $csv.="\n";
          while(true){
            $rec=$stmt->fetch(PDO::FETCH_ASSOC);
            if($rec==false){
              break;
            }
            $csv.=$rec['code'];
            $csv.=',';
            $csv.=$rec['date'];
            $csv.=',';
            $csv.=$rec['code_member'];
            $csv.=',';
            $csv.=$rec['dat_sales_name'];
            $csv.=',';
            $csv.=$rec['email'];
            $csv.=',';
            $csv.=$rec['postal1'].'-'.$rec['postal2'];
            $csv.=',';
            $csv.=$rec['address'];
            $csv.=',';
            $csv.=$rec['tel'];
            $csv.=',';
            $csv.=$rec['code_product'];
            $csv.=',';
            $csv.=$rec['product_name'];
            $csv.=',';
            $csv.=$rec['price'];
            $csv.=',';
            $csv.=$rec['quantity'];
            $csv.="\n";
          }
          // echo nl2br($csv);
          $file=fopen("./chumon.$year-$month-$day.csv",'w');
          $csv=mb_convert_encoding($csv,'sjis-win','utf-8');
          fputs($file,$csv);
          fclose($file);
      }

      catch(Exception $e){
          echo '<div class="text-center" >';
          echo '<h3 style="color:#56256e;">ただいま障害により大変ご迷惑をお掛けしております。</h3>';
          echo '</div>';
          exit();
      }

      ?>
      <div class="text-center" >
      <h4 style="color:#56256e;">ダウンロードしました。</h4>
      <br/>
      <a href="../staff_login/staff_top.php" style="color:#d04f97;"><h4>トップメニューへ</h4></a><br/>
      </div>
    </body>
</html>
