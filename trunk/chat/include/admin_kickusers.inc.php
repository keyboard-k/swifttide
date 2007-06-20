<?PHP
/* Kick user */

// Check rights
IF(!(($current_user->level)&16)){
  DIE('Access denied');
}

// Superuser protection
$target_user=new user();
$target_user->readUser($session, $profile_user_id);
if($target_user->level>=131071){
  die('Access denied');
}

// Get user's session ID
$session2=NEW session($session->getUsersSession($profile_user_id));
IF($session2->id){
  // Update user's session
  $session2->updateSession("kicked = 1");
  // Post a system message
  systemMessage::insertMessage($session,$profile_user_id,6);
}

IF(!EMPTY($dummy)){
  // Load dummy form
  HEADER("Location: main.php?include=30&session_id=$session_id");
}ELSE{
  // Return to userlist
  HEADER("Location: main.php?include=11&kick=1&session_id=$session_id");
}
?>
