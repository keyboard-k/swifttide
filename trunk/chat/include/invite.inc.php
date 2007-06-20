<?PHP

IF($session->room_id<0||!$user_id){
?>
<HTML><HEAD><SCRIPT>window.close();</SCRIPT></HEAD></HTML>
<?
  DIE("Hack?");
}

// Load userdata
$user=NEW user();
$user->readUser($session,$user_id);
$login=$user->login;
common::doHtmlEntities($login);
$color=$user->color;

IF(ISSET($answer)){
  IF($answer){
    $message=$lng["invitationaccepted"];
  }ELSE{
    $message=$lng["invitationrejected"];
    // Delete 'one-time' pass for user to enter password-protected room, if any
    $roompass=NEW roompass();
    $roompass->deletePass($session,$session->room_id,$user_id);
  }
}ELSEIF($invited){
  IF(ISSET($response)){
    // Send response
    systemmessage::insertMessage($session,$session->user_id."|".$user_id."|".$response,8);
    IF($response){
      // Invitation accepted. Change room.
      systemmessage::insertMessage($session,$session->user_id."|".$room_id,9);
    }
?>
<HTML><BODY onload="window.close();"></BODY></HTML>
<?
    DIE();
  }ELSE{
    // Show invitation
    // Get room name
    $room=NEW room();
    $room->readRoom($session,$room_id);
    $roomname=$room->name;
    common::doHtmlEntities($roomname);
  }
}ELSEIF($do_invite){
  // Create 'one-time' pass for user to enter password-protected room
  $room=NEW room();
  $room->readRoom($session,$session->room_id);
  IF($room->type==2||$room->type==3){
    $roompass=NEW roompass();
    $roompass->createPass($session,$session->room_id,$user_id);
  }
  // Invite user
  systemmessage::insertMessage($session,$session->user_id."|".$user_id."|".$session->room_id,7);
}

// Load template
REQUIRE(TEMPLATEPATH."/invite.tpl.php");
?>
