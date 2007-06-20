<?PHP
/* This is a smilies page. */

// List smilies
$smilies=smilie::listSmilies($session);
$smilies_count=COUNT($smilies);

IF($smilies_count){
  // Calculating rows count
  $rows_count=$smilies_count/$session->config->smiliesInRow;
  IF($rows_count<>ROUND($rows_count)){
    $rows_count=ROUND($rows_count)+1;
  }
}

// Loading smilies into array
UNSET($smilies_array);
FOR($i=0;$i<$rows_count;$i++){
  FOR($ii=0;$ii<$session->config->smiliesInRow;$ii++){
    $smilie_nr=$i*$session->config->smiliesInRow+$ii;
    IF($smilie_nr<$smilies_count){
      $smilies_array[$i][$ii]=ARRAY("image"=>IMAGEPATH."/smilies/".$smilies[$smilie_nr][image],"id"=>$smilies[$smilie_nr][id],"nr"=>$smilie_nr);
    }ELSE{
      $smilies_array[$i][$ii]=ARRAY("image"=>IMAGEPATH."/clearpixel.gif","id"=>0,"nr"=>$smilie_nr);
    }
  }
}

// Table cellspacing
$cellspacing=3;

// Table cellpadding
$cellpadding=3;


// Loading template
REQUIRE(TEMPLATEPATH."/smilies.tpl.php");
?>
