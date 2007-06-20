<?PHP
/* Post global message */

// Check rights
IF(!($current_user->level&64)){
  DIE("HACK?");
}

IF($message){
  $message=TRIM($message);
  common::dTrim($message);
  common::doHtmlEntities($message);
  /* Posting message */
  globalmessage::insertMessage($session,$session->user_id,$message,$type);
}


// Load template
REQUIRE(TEMPLATEPATH."/admin_globalmsg.tpl.php");
?>
