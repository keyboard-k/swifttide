<?PHP
/* This is a room select page */


/* Read room list from database */
$room=NEW room();
$main_rooms=ARRAY();
$user_rooms=ARRAY();
// Main chat rooms without password
$room->listRooms($session,0,"",0);
$main_roomlist=ARRAY();
$roomlist_count=COUNT($room->roomlist);
FOR($i=0;$i<$roomlist_count;$i++){
  $users_count=COUNT($session->listRoomUsers($room->roomlist[$i][id]));
  common::doHtmlEntities($room->roomlist[$i][name]);
  $main_roomlist[$users_count][]=ARRAY("id"=>$room->roomlist[$i][id],
                                    "name"=>$room->roomlist[$i][name],
                                    "type"=>$room->roomlist[$i][type],
                                    "userscount"=>$users_count
                                    );
}
// Sort rooms by users count
KRSORT($main_roomlist);
RESET($main_roomlist);
WHILE(LIST($key,$val)=EACH($main_roomlist)){
  WHILE(LIST($key2,$val2)=EACH($val)){
    $main_rooms[]=$val2;
  }
}
// Main chat rooms with password
$room->listRooms($session,0,"",2);
$main_roomlist=ARRAY();
$roomlist_count=COUNT($room->roomlist);
FOR($i=0;$i<$roomlist_count;$i++){
  $users_count=COUNT($session->listRoomUsers($room->roomlist[$i][id]));
  common::doHtmlEntities($room->roomlist[$i]['name']);
  $main_roomlist[$users_count][]=ARRAY("id"=>$room->roomlist[$i][id],
                                    "name"=>$room->roomlist[$i][name],
                                    "type"=>$room->roomlist[$i][type],
                                    "userscount"=>$users_count
                                    );
}
// Sort rooms by users count
KRSORT($main_roomlist);
RESET($main_roomlist);
WHILE(LIST($key,$val)=EACH($main_roomlist)){
  WHILE(LIST($key2,$val2)=EACH($val)){
    $main_rooms[]=$val2;
  }
}
IF(!$admin_manage_rooms&&!EMPTY($session->config->default_room)){
  // There is default room. Redirect user into it.
?>
<HTML><BODY onLoad="document.redirectform.submit();">
<FORM name="redirectform" method="post" target="_parent" action="main.php">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="room_id" value="<?=$session->config->default_room?>">
</FORM></BODY>
<?
  DIE();
}
$main_rooms_count=COUNT($main_rooms);
IF(!$admin_manage_rooms&&$main_rooms_count==1&&!$session->config->allow_userrooms){
  // Tehere are only one main room and userrooms are disabled. Redirect to main room
?>
<HTML><BODY onLoad="document.redirectform.submit();">
<FORM name="redirectform" method="post" target="_parent" action="main.php">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="room_id" value="<?=$main_rooms[0][id]?>">
</FORM></BODY>
<?
  DIE();
}

IF($admin_manage_rooms || $session->config->allow_userrooms){
  // User rooms
  $room_creator=NEW user();
  // User rooms without password
  $room->listRooms($session,0,"",1);
  $user_roomlist=ARRAY();
  $roomlist_count=COUNT($room->roomlist);
  FOR($i=0;$i<$roomlist_count;$i++){
    $users_count=COUNT($session->listRoomUsers($room->roomlist[$i][id]));
    common::doHtmlEntities($room->roomlist[$i][name]);
    $room_creator->readUser($session, $room->roomlist[$i]['creator_id']);
    common::doHtmlEntities($room_creator->login);
    $user_roomlist[$users_count][]=ARRAY("id"=>$room->roomlist[$i][id],
                                      "name"=>$room->roomlist[$i][name],
                                      "type"=>$room->roomlist[$i][type],
                                      "userscount"=>$users_count,
                                      "creator"=>$room_creator->login
                                      );
  }
  // Sort rooms by users count
  KRSORT($user_roomlist);
  RESET($user_roomlist);
  WHILE(LIST($key,$val)=EACH($user_roomlist)){
    WHILE(LIST($key2,$val2)=EACH($val)){
      $user_rooms[]=$val2;
    }
  }
  // User rooms with password
  $room->listRooms($session,0,"",3);
  $user_roomlist=ARRAY();
  $roomlist_count=COUNT($room->roomlist);
  FOR($i=0;$i<$roomlist_count;$i++){
    $users_count=COUNT($session->listRoomUsers($room->roomlist[$i][id]));
    common::doHtmlEntities($room->roomlist[$i][name]);
    $room_creator->readUser($session, $room->roomlist[$i]['creator_id']);
    common::doHtmlEntities($room_creator->login);
    $user_roomlist[$users_count][]=ARRAY("id"=>$room->roomlist[$i][id],
                                      "name"=>$room->roomlist[$i][name],
                                      "type"=>$room->roomlist[$i][type],
                                      "userscount"=>$users_count,
                                      "creator"=>$room_creator->login
                                      );
  }
  // Sort rooms by users count
  KRSORT($user_roomlist);
  RESET($user_roomlist);
  WHILE(LIST($key,$val)=EACH($user_roomlist)){
    WHILE(LIST($key2,$val2)=EACH($val)){
      $user_rooms[]=$val2;
    }
  }
  $user_rooms_count=COUNT($user_rooms);
}

/* Loading room select page template */
REQUIRE(TEMPLATEPATH."/selectroom_list.tpl.php");
?>
