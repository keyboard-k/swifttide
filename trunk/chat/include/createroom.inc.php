<?PHP
/* Create new room page */

// Check rights
IF($admin_manage_rooms){
  IF(!($current_user->level&2048)){
    UNSET($admin_manage_rooms);
  }
}

IF(   !($session->config->allow_userrooms==2 || $session->config->allow_userrooms==1 && !($current_user->guest))
   && !$admin_manage_rooms){
  DIE();
}


IF(!$admin_manage_rooms&&$session->room_id>0){
  // User came here from another room. Posting a system message into that room.
  systemmessage::insertMessage($session,$session->user_id."|".$session->room_id,2);
  // Create pass to make return into password-protected room possible
  $room=NEW room();
  $room->readRoom($session,$session->room_id);
  IF($room->type==2||$room->type==3){
    $roompass=NEW roompass();
    $roompass->createPass($session,$session->room_id,$session->user_id);
  }
  // Updating session
  $session->updateSession("room_id = -2");
}

SWITCH($frame){
	CASE "main"      :  /* Roomlist */
                      REQUIRE(INCLUDEPATH."/createroom_main.inc.php");
                      BREAK;
	CASE "refresher" :  /* Refresher */
                      REQUIRE(INCLUDEPATH."/refresher.inc.php");
                      BREAK;
	DEFAULT          :  /* Frameset */
                      REQUIRE(INCLUDEPATH."/frames1.inc.php");
                      BREAK;
}

?>
