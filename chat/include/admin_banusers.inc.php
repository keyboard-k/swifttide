<?PHP
/* Ban user */

// Check rights
IF(!($current_user->level&32)){
  DIE("HACK?");
}

$user=NEW user();

// Superuser protection
if(!empty($profile_user_id)){
  $target_user=new user();
  $target_user->readUser($session, $profile_user_id);
  if($target_user->level>=131071){
    die('Access denied');
  }
}

IF($list){
  IF($removefromlist){
    // Remove users / IP addresses from banlist
    IF(IS_ARRAY($ban_id)){
      WHILE(LIST($id,$dummy)=EACH($ban_id)){
        ban::unBan($session,$id);
      }
    }
  }
  // Show banlist
  IF(!ISSET($usr_sortby)) $usr_sortby=0;
  IF(!ISSET($usr_sortdir)) $usr_sortdir=0;
  IF(!ISSET($ip_sortby)) $ip_sortby=0;
  IF(!ISSET($ip_sortdir)) $ip_sortdir=0;
  $banlist=ban::banList($session, $usr_sortby, $usr_sortdir, $ip_sortby, $ip_sortdir);
  $banlist_count=COUNT($banlist);
  $banlist_users=ARRAY();
  $banlist_ips=ARRAY();
  FOR($i=0;$i<$banlist_count;$i++){
    IF($banlist[$i][user_id]){
      // Banned user
      common::doHtmlEntities($banlist[$i]['login']);
      $banlist_users[]=ARRAY("name"=>$banlist[$i][login],
                             "bandate"=>common::convertDateFromTimestamp(&$session,$banlist[$i][bandate]),
                             "id"=>$banlist[$i][id]
                             );
    }ELSE{
      // Banned IP address
      $banlist_ips[]=ARRAY("ip"=>$banlist[$i][ip],
                           "bandate"=>common::convertDateFromTimestamp(&$session,$banlist[$i][bandate]),
                           "id"=>$banlist[$i][id]
                           );
    }
  }
  $banlist_users_count=COUNT($banlist_users);
  $banlist_ips_count=COUNT($banlist_ips);
  // Load template
  REQUIRE(TEMPLATEPATH."/admin_banlist.tpl.php");
}ELSEIF($profile_user_id&&$profile_user_id<>$session->user_id){
  IF($do_ban&&($user_id||$ip)){
    // First, kick user if he is online
    IF($session->isOnline($user_id)){
      // Post a control message
      $session2=NEW session($session->getUsersSession($user_id));
      IF($session2->id){
        // Update user's session
        $session2->updateSession('kicked = 1');
        // Post a system message
        systemMessage::insertMessage($session, $user_id, 6);
      }
    }
    ban::ban($session,$user_id,$ip);
    // Show banlist
    HEADER("Location: main.php?session_id=$session_id&include=$include&list=1");
  }ELSE{
    $user=NEW user();
    $user->readUser($session,$profile_user_id);
    common::doHtmlEntities($user->login);
    // Load template
    REQUIRE(TEMPLATEPATH."/admin_banuser.tpl.php");
  }
}ELSE{
  HEADER("Location: main.php?session_id=$session_id&include=$include&list=1");
}

?>
