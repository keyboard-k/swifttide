<?PHP
// Current user
$current_user=NEW user();
$current_user->readUser($session,$session->user_id);

// Defaults
IF(!$orderby){
  $orderby="us.login";
}
IF(!$orderdir){
  $orderdir="ASC";
}
IF(EMPTY($page) || !IS_SCALAR($page) || $page<1){
  $page=1;
}ELSE{
  $page=ROUND($page);
}

// Admin?
IF($current_user->level&8||$current_user->level&16||$current_user->level&32){
  // Show IP addresses
  $show_ip=TRUE;
}ELSE{
  // Don't show IP addresses
  $show_ip=FALSE;
}
// Check rights
IF($edit){
  IF(!($current_user->level&8)){
    UNSET($edit);
  }
}
IF($kick){
  IF(!($current_user->level&16)){
    UNSET($kick);
  }
}
IF($ban){
  IF(!($current_user->level&32)){
    UNSET($ban);
  }
}

// Create userlist
$users_per_page=20;
user::countUsers($session, $registered_users_count=0, $dummy=0, $guests_count=0, $dummy2=0);
$total_users=$registered_users_count+$guests_count;
IF(!EMPTY($kick)){
  // No need page splitting for online userlist
  $total_pages=1;
  $userlist=user::listUsers($session,$username,$orderby, 0, 0, 1);
}ELSE{
  $total_pages=CEIL($total_users/$users_per_page);
  $userlist=user::listUsers($session,$username,$orderby,($page-1)*$users_per_page,$users_per_page);
}
$userlist_count=COUNT($userlist);

// Prepare list
$new_list=ARRAY();
FOR($i=0;$i<$userlist_count;$i++){
  IF(!$kick || $userlist[$i]['online']){
    common::doHtmlEntities($userlist[$i]['login']);
    common::doHtmlEntities($userlist[$i]['name']);
    IF(EMPTY($userlist[$i]['email'])){
      $userlist[$i][email]="&nbsp;";
    }
    IF(EMPTY($userlist[$i]['name'])){
      $userlist[$i]['name']="&nbsp;";
    }
    $new_list[]=$userlist[$i];
  }
}
$userlist=$new_list;
$userlist_count=COUNT($userlist);

REQUIRE(TEMPLATEPATH."/memberlist.tpl.php");
?>