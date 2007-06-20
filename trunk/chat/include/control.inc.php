<?PHP
/* This is a general chat control engine.
   It reads new messages from database and shows them in main window.
   It updates userlist and roomlist frames.
   It executes all server commands. */


/* Declaring comand line that will be sent to the client */
$command_line="";

/* SYSTEM MESSAGES */
$systemmessage=NEW systemmessage();
/* Deleting old system messages */
$systemmessage->deleteOldMessages($session);
/* Reading new system messages */
$systemmessages=$systemmessage->readNewMessages($session);
/* Counting system messages */
$systemmessages_count=COUNT($systemmessages);
/* Processing each system message */
FOR($i=0;$i<$systemmessages_count;$i++){
  /* Which type the new message of? */
  SWITCH($systemmessages[$i][type]){
    CASE  1   :       /* User entered room */
                      $fields=EXPLODE("|",$systemmessages[$i]['body']);
                      /* User ID */
                      $user_id=$fields[0];
                      /* Room ID */
                      $room_id=$fields[1];
                      IF($room_id==$session->room_id){
                        /* User entered THIS room */
                        /* Reading user data */
                        $new_user=NEW user();
                        $new_user->readUSer($session,$user_id);
                        $user_name=$new_user->login;
                        /* Converting HTML special characters in user nickname */
                        common::doHtmlEntities($user_name);
                        $user_level=$new_user->level;
                        $user_sex=$new_user->sex;
                        $user_color=$new_user->color;
                        /* Adding new command */
                        common::addCommand("E>$user_id<$user_name<$user_level<$user_sex<$user_color<{$systemmessages[$i][post_time]}",$command_line,"'");
                      }ELSE{
                        /* User entered other room */
                        /* Updating roomlist */
                        common::addCommand("u>$room_id<<<+",$command_line,"'");
                      }
                      BREAK;
    CASE  2   :       /* User left room */
                      $fields=EXPLODE("|",$systemmessages[$i]['body']);
                      /* User ID */
                      $user_id=$fields[0];
                      /* Room ID */
                      $room_id=$fields[1];
                      IF($room_id==$session->room_id){
                        /* User left THIS room */
                        /* Adding new command */
                        common::addCommand("L>$user_id<{$systemmessages[$i][post_time]}",$command_line,"'");
                      }ELSE{
                        /* User left OTHER room */
                        /* Updating roomlist */
                        common::addCommand("u>$room_id<<<-",$command_line,"'");
                      }
                      BREAK;
    CASE  3   :       /* Userinfo changed */
                      /* Updating user info in userlist */
                      $user=NEW user();
                      $user->readUser($session,$systemmessages[$i]['body']);
                      common::addCommand("U>{$user->id}<{$user->login}<{$user->level}<{$user->sex}<{$user->color}",$command_line,"'");
                      BREAK;
    CASE  4   :       /* Room was deleted */
                      /* Updating roomlist */
                      common::addCommand("d>{$systemmessages[$i]['body']}",$command_line,"'");
                      BREAK;
    CASE  5   :       /* Room was created */
                      /* Updating roomlist */
                      $room=NEW room();
                      $room->listRooms($session,$systemmessages[$i]['body']);
                      $new_room=$room->roomlist[0];
                      common::doHtmlEntities($new_room[name]);
                      common::addCommand("n>{$new_room[id]}<{$new_room[name]}<{$new_room[type]}<0",$command_line,"'");
                      BREAK;
    CASE  6   :       // User was kicked
                      common::addCommand("K>{$systemmessages[$i]['body']}<{$systemmessages[$i][post_time]}",$command_line,"'");
                      BREAK;
    CASE  7   :       // Show invitation
                      $tmp=EXPLODE("|",$systemmessages[$i]['body']);
                      IF($tmp[1]==$session->user_id){
                        // This user was invited
                        common::addCommand("I>".$tmp[0]."<".$tmp[2],$command_line,"'");
                      }
                      BREAK;
    CASE  8   :       // Show invitation response
                      $tmp=EXPLODE("|",$systemmessages[$i]['body']);
                      IF($tmp[1]==$session->user_id){
                        // Response to this user
                        common::addCommand("i>".$tmp[0]."<".$tmp[2],$command_line,"'");
                      }
                      BREAK;
    CASE  9   :       // Change room
                      $tmp=EXPLODE("|",$systemmessages[$i]['body']);
                      IF($tmp[0]==$session->user_id){
                        // This user
                        common::addCommand("C>".$tmp[1],$command_line,"'");
                      }
                      BREAK;
    CASE  10  :       // Restart room
                      IF(!$systemmessages[$i]['body']||$systemmessages[$i]['body']==$session->room_id){
                        // Global restart or this room only
                        common::addCommand("R",$command_line,"'");
                      }
                      BREAK;
    CASE  11  :       // Show advertisement
                      $fields=EXPLODE("|",$systemmessages[$i]['body']);
                      /* Room ID */
                      $room_id=ARRAY_SHIFT($fields);
                      $systemmessages[$i]['body']=ADDSLASHES(IMPLODE('|', $fields));
                      IF($room_id==$session->room_id){
                        common::addCommand("A>".$systemmessages[$i]['body'],$command_line,"'");
                      }
                      BREAK;
    CASE  12  :       // Clear room
                      IF(EMPTY($systemmessages[$i]['body']) || $systemmessages[$i]['body']==$session->room_id){
                        common::addCommand("c",$command_line,"'");
                      }
                      BREAK;
  }
}

/* GLOBAL MESSAGES */
$globalmessage=NEW globalMessage();
/* Deleting old global messages */
$globalmessage->deleteOldMessages($session);
/* Reading new global messages */
$globalmessages=$globalmessage->readNewMessages($session);
/* Counting global messages */
$globalmessages_count=COUNT($globalmessages);
/* Processing each global message */
FOR($i=0;$i<$globalmessages_count;$i++){
  /* Reading user data */
  $new_user=NEW user();
  $new_user->readUSer($session,$globalmessages[$i]['user_id']);
  $user_name=$new_user->login;
  /* Converting HTML special characters in user nickname */
  common::doHtmlEntities($user_name);
  $user_color=$new_user->color;
  /* Adding new command */
  IF($globalmessages[$i][type]){
    $globalmessages[$i]['body']=$globalmessages[$i][id];
    $user_name="";
    $user_color="";
  }
  common::addCommand("G>{$globalmessages[$i][type]}<$user_name<$user_color<{$globalmessages[$i]['body']}",$command_line,"'");
}

/* USER MESSAGES */
$usermessage=NEW usermessage();
/* Deleting old user messages */
$usermessage->deleteOldMessages($session);
/* Reading new user messages */
$usermessages=$usermessage->readNewMessages($session);
/* Counting user messages */
$usermessages_count=COUNT($usermessages);
/* Processing each user message */
FOR($i=0;$i<$usermessages_count;$i++){
  /* Which type the new message of? */
  SWITCH($usermessages[$i][type]){
    CASE  1   :       /* Normal message */
                      IF($usermessages[$i]['user_id']<>$session->user_id||$session->config->synchronize_time){
                        // Sender not me, or synchronization enabled
                        // Adding new command
                        common::addCommand("M>{$usermessages[$i]['user_id']}<{$usermessages[$i]['body']}<{$usermessages[$i][flags]}<{$usermessages[$i][post_time]}",$command_line,"'");
                      }
                      BREAK;
    CASE  2   :       /* Private message */
                      // Check user
                      IF($usermessages[$i][target_user_id]==$session->user_id){
                        /* Adding new command */
                        common::addCommand("P>{$usermessages[$i]['user_id']}<{$usermessages[$i]['body']}<{$usermessages[$i][id]}<{$usermessages[$i][flags]}<{$usermessages[$i][post_time]}",$command_line,"'");
                      }
                      BREAK;
    CASE  3   :       /* Whispered message */
                      // Check user
                      IF($usermessages[$i][target_user_id]==$session->user_id){
                        // Receiver is me
                        common::addCommand("W>{$usermessages[$i]['user_id']}<{$usermessages[$i]['body']}<{$usermessages[$i][flags]}<{$usermessages[$i][post_time]}",$command_line,"'");
                      }ELSEIF($usermessages[$i]['user_id']==$session->user_id&&$session->config->synchronize_time){
                        // Synchronization enabled
                        common::addCommand("w>{$usermessages[$i][target_user_id]}<{$usermessages[$i]['body']}<{$usermessages[$i][flags]}<{$usermessages[$i][post_time]}",$command_line,"'");
                      }
                      BREAK;
    CASE  4   :       /* 'Said' message */
                      // Check user
                      IF($usermessages[$i]['user_id']<>$session->user_id||$session->config->synchronize_time){
                        // Sender is not me or synchronization enabled
                        common::addCommand("S>{$usermessages[$i]['user_id']}<{$usermessages[$i]['body']}<{$usermessages[$i][flags]}<{$usermessages[$i][post_time]}<{$usermessages[$i][target_user_id]}",$command_line,"'");
                      }
                      BREAK;
  }
}

/* ADVERTISEMENT */
$advertisement=NEW advertisement();
$advertisements=$advertisement->listAdvertisements($session,1);
$advertisements_count=COUNT($advertisements);
FOR($i=0;$i<$advertisements_count;$i++){
  // Check period
  IF(!fk_advertisement::check(&$session,$session->room_id,$advertisements[$i][id])||TIME()-$advertisements[$i][period]*60>=fk_advertisement::check(&$session,$session->room_id,$advertisements[$i][id])){
    // Which room type?
    $room=NEW room();
    $room->readRoom($session,$session->room_id);
    IF(!($room->type) || $room->type&&$advertisements[$i]['show_private']){
      // Are there enough users in room?
      IF($advertisements[$i]['min_roomusers'] <= $session->countRoomUsers($session->room_id)){
        // Show message
        // Convert HTML characters
        $text=STR_REPLACE("<","*_/&lt;_*", STR_REPLACE(">","*_/&gt;_*", STR_REPLACE("'","*_/&quot;_*", STR_REPLACE("\r","*_/CR_*", STR_REPLACE("\n","*_/LF_*", ADDSLASHES($advertisements[$i][text]))))));
        systemMessage::insertMessage($session, $session->room_id.'|'.$text, 11);
        // Update advertisement time
        fk_advertisement::update(&$session,$session->room_id,$advertisements[$i][id]);
        // Update advertisement shows count
        $advertisement->updateAdvertisement($session,$advertisements[$i]['id'],"shows_count = shows_count + 1");
      }
    }
  }
}


/* Update room ping */
$room=NEW room();
$room->updateRoom($session,$session->room_id,"last_ping = UNIX_TIMESTAMP()");

/* Load user control frame page template */
REQUIRE(TEMPLATEPATH."/control.tpl.php");
?>
