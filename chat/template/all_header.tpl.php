<?PHP
IF(EMPTY($all_header)){
  $all_header=TRUE;
  HEADER("Content-type: text/html; charset=".$lng["charset"]);
  HEADER("Content-Language: ".$ISO_639_LNG);
}
?>