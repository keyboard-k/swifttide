<?PHP
/* This is a private message window frameset */

// Update session
$session->updateSession("last_post_time = UNIX_TIMESTAMP()");

// Read userdata
$target_user=NEW user();
$target_user->readUser($session,$target_user_id);
$target_user_name=$target_user->login;
common::doHtmlEntities($target_user_name);
$current_user_name=$current_user->login;
common::doHtmlEntities($current_user_name);

IF($message_id){
  // Read message from database
  $usermessage=NEW userMessage();
  $usermessage->readMessage($session,$message_id);
  // Check user
  IF($usermessage->target_user_id<>$session->user_id){
    DIE("HACK?");
  }
}

/* Load frameset page template */
REQUIRE(TEMPLATEPATH."/frames_pm.tpl.php");
?>
