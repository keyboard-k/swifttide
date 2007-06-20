<?PHP
/* Clear chat screen */

// Check rights
IF(($current_user->level)&64){ // Required: "Post global messages"
  // Post a system message
  systemMessage::insertMessage($session, $clear_room_id*1, 12);
}

// Load dummy form
header('Location: main.php?include=30&session_id='.$session_id);
die();
?>
