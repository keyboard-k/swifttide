<?PHP
/* This is a chat main frameset */

IF(!$room_id){
  $room_id=$m;
}
$room=NEW room();
$room->readRoom($session,$room_id);

// Check whether the room still exists
IF(!$room->id){
  // Room does not exists (anymore)
?>
<HTML><BODY onload="document.i.submit();">
<FORM name="i" action="main.php" method="post">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="3">
</FORM>
</BODY></HTML>
<?
  DIE();
}ELSE{
  // Update room ping
  $room->updateRoom($session,$room->id,"last_ping = UNIX_TIMESTAMP()");
}

// Check password for password-protected rooms
IF($room->type==2||$room->type==3){
  // Room is password-protected
  IF(MD5($room_password)<>$room->password){
    // Wrong password.
    // Look for pass
    $roompass=NEW roompass();
    IF(!$roompass->checkPass($session,$room_id,$session->user_id,1)){
      // Pass does not exists. Ask for password.
?>
<HTML><BODY onload="document.i.submit();">
<FORM name="i" action="main.php" method="post">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="10">
  <INPUT type="hidden" name="u" value="<?=$u?>">
  <INPUT type="hidden" name="m" value="<?=$room_id?>">
  <INPUT type="hidden" name="x" value="3">
</FORM>
</BODY></HTML>
<?
      DIE();
    }
  }
}

// Load background image, if exists
IF($room->bgimg){
  $background="style=\\\"background-image: url('".IMAGEPATH."/rooms/".$room->bgimg."'); background-repeat: no-repeat; background-position: center; background-attachment: fixed;\\\"";
}ELSE{
  $background="";
}

// Update session
$session->updateSession("last_post_time = UNIX_TIMESTAMP()");

// User entered room.
IF($session->room_id<>$room_id){
  IF($session->room_id>0){
    /* User was in other room. Posting a system message into that room. */
    systemmessage::insertMessage($session,$session->user_id."|".$session->room_id,2);
  }
  /* Posting a system message into new room */
  systemmessage::insertMessage($session,$session->user_id."|".$room_id,1);
  /* Updating session */
  $session->updateSession("room_id = $room_id");
  systemmessage::readNewMessages($session);
  usermessage::readNewMessages($session);
}

/* Declaring comand line that will be sent to the client */
$command_line="";

/* Loading userlist */
$sessionlist=$session->listRoomUsers($session->room_id);
$sessionlist_count=COUNT($sessionlist);
$user=NEW user();
FOR($i=0;$i<$sessionlist_count;$i++){
  /* Loading data for each user in room */
  $user->readUser($session,$sessionlist[$i][user_id]);
  $user_id=$user->id;
  $user_name=$user->login;
  common::doHtmlEntities($user_name);
  $user_level=$user->level;
  $user_sex=$user->sex;
  $user_color=$user->color;
  common::addCommand("newUser($user_id,\"$user_name\",$user_level,\"$user_sex\",\"$user_color\");",$command_line,"\n");
}

/* Loading roomlist */
$room=NEW room();
$room->listRooms($session);
$roomlist=$room->roomlist;
$roomlist_count=COUNT($roomlist);
FOR($i=0;$i<$roomlist_count;$i++){
  $room_id=$roomlist[$i][id];
  $room_name=$roomlist[$i][name];
  common::doHtmlEntities($room_name);
  $room_type=$roomlist[$i][type];
  $room_userscount=COUNT($session->listRoomUsers($roomlist[$i][id]));
  common::addCommand("newRoom($room_id,\"$room_name\",$room_type,$room_userscount);",$command_line,"\n");
}

/* Read roomlist frame template into variable */
OB_START();
REQUIRE(INCLUDEPATH."/roomlist.inc.php");
$roomlist_html=common::convertTextToJavaScriptVar(OB_GET_CONTENTS());
OB_END_CLEAN();

/* Read userlist frame template into variable */
OB_START();
REQUIRE(INCLUDEPATH."/userlist.inc.php");
$userlist_html=common::convertTextToJavaScriptVar(OB_GET_CONTENTS());
OB_END_CLEAN();

/* List smilies */
$smilie=NEW smilie();
$smilies=$smilie->listSmilies($session);

/* WELCOME MESSAGE */
IF($session->welcome){
  $melcome_msg=STR_REPLACE("<","|_/&lt;_|",STR_REPLACE(">","|_/&gt;_|",STR_REPLACE("\r",'|_/&cr;_|',STR_REPLACE("\n",'|_/&lf;_|',ADDSLASHES($session->config->welcome_message)))));
  common::addCommand("globalMessage(\"2<".$melcome_msg."\");",$command_line,"\n");
  $session->updateSession("welcome = 0");
}

// Show top banner?
IF($session->config->top_banner){
  $top_banner_height=$session->config->top_banner_height.",";
  $top_banner_code="<FRAME name=\"top_banner\" src=\"".$session->config->top_banner_url."\" scrolling=\"auto\" noresize marginwidth=\"0\" marginheight=\"0\">";
}ELSE{
  $top_banner_height="";
  $top_banner_code="";
}

// Show bottom banner?
IF($session->config->bottom_banner){
  $bottom_banner_height=",".$session->config->bottom_banner_height;
  $bottom_banner_code="<FRAME name=\"bottom_banner\" src=\"".$session->config->bottom_banner_url."\" scrolling=\"auto\" noresize marginwidth=\"0\" marginheight=\"0\">";
}ELSE{
  $bottom_banner_height="";
  $bottom_banner_code="";
}

// Userlist frame position
IF($session->config->userlist_position){
  $cols="*,".$session->config->userlist_width;
}ELSE{
  $cols=$session->config->userlist_width.",*";
}


/* Load frameset page template */
REQUIRE(TEMPLATEPATH."/frames_main.tpl.php");
?>