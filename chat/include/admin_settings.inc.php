<?PHP
/* Chat settings */

// Check rights
IF(!($current_user->level&4)){
  DIE("Hack?");
}

IF($settings_submitted){
  // Save changes
  RESET($configuration);
  WHILE(LIST($key,$val)=EACH($configuration)){
    $session->config->changeParameter($session,$key,$val);
  }
  $session->config=NEW configuration($session->db);
  // Creating roompasses for all users from password-protected rooms
  $roompass=NEW roompass();
  $room=NEW room();
  // Main rooms
  $room->listRooms(&$session,0,"",2);
  FOR($i=0;$i<COUNT($room->roomlist);$i++){
    $room_users=$session->listRoomUsers($room->roomlist[$i][id]);
    FOR($ii=0;$ii<COUNT($room_users);$ii++){
      $roompass->createPass($session,$room->roomlist[$i][id],$room_users[$ii][user_id]);
    }
  }
  // User rooms
  $room->listRooms(&$session,0,"",3);
  FOR($i=0;$i<COUNT($room->roomlist);$i++){
    $room_users=$session->listRoomUsers($room->roomlist[$i][id]);
    FOR($ii=0;$ii<COUNT($room_users);$ii++){
      $roompass->createPass($session,$room->roomlist[$i][id],$room_users[$ii][user_id]);
    }
  }
  // Restarting all users
  systemMessage::insertMessage($session,"",10);
}

// Read configuration from database
$config=$session->config->loadFullConfiguration($session);
$config_count=COUNT($config);
// Replacing HTML
FOR($i=0;$i<$config_count;$i++){
  common::doHtmlEntities($config[$i][value]);
}

// Languages list
// Open languages directory
$handle=OPENDIR(LANGUAGEPATH);
UNSET($lng_array);
// Read each entry
WHILE($file=READDIR($handle)){
  IF(IS_FILE(LANGUAGEPATH."/".$file)&&SUBSTR($file,-8,8)==".lng.php"){
    // Adding each passed language file to array
    $lng_array[]=STR_REPLACE(".lng.php","",$file);
  }
}
CLOSEDIR($handle);


REQUIRE(TEMPLATEPATH."/admin_settings.tpl.php");
?>
