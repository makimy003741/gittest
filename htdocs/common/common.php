<?php

date_default_timezone_set('Asia/Tokyo');

function sanitize($before){
  foreach($before as $key=>$value){
    $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $after;
}

function pulldown_year(){
  for($i=date("Y"); $i>=date("Y")-50; $i--){
    echo '<option value="'.$i.'">'.$i.'</option>';
  }
}

function pulldown_month(){
  for($i=1; $i<=12; $i++){
    $j='0'.$i;
    echo '<option value="'.substr($j,-2,2).'">'.substr($j,-2,2).'</option>';
  }
}

function pulldown_day(){
  for($i=1; $i<=31; $i++){
    $j='0'.$i;
    echo '<option value="'.substr($j,-2,2).'">'.substr($j,-2,2).'</option>';
  }
}

?>
