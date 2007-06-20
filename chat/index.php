<?php
$get_string=array();
if(!empty($_GET) && is_array($_GET)){
  foreach($_GET as $key=>$val){
    if(is_scalar($val)){
      $get_string[]=$key.'='.$val;
    }
  }
}
$param=!empty($get_string)? '?'.implode('&', $get_string) : '';
header('Location: main.php?'.$param);
die();
?>