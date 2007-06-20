<?PHP
/* This is a message input page */

// Update session
$session->updateSession("last_post_time = UNIX_TIMESTAMP()");

IF(isset($m)){
  $usermessage=NEW usermessage();
  // Preparing message
  $m=TRIM($m);
  common::dTrim($m);
  common::doHtmlEntities($m);
  $m=ADDSLASHES($m);
  /* Message type */
  SWITCH($t){
    CASE  1   :     /* Normal message (in main frame)*/
                    IF($u>0){
                      // Message was whispered to user
                      $usermessage->insertMessage($session,$u,$m,3,$x);
                    }ELSE IF($u<0){
                      // Message was 'said' to user
                      $u*=-1;
                      $usermessage->insertMessage($session,$u,$m,4,$x);
                    }ELSE{
                      // Message for all room users
                      $usermessage->insertMessage($session,0,$m,1,$x);
                    }
                    BREAK;
    CASE  2   :     /* Private message (in popUp) */
                    $usermessage->insertMessage($session,$u,$m,2,$x);
                    BREAK;
  }
  INCLUDE(INCLUDEPATH."/dummyform.inc.php");
}ELSE{
  /* First run, load template */
  /* Template type */
  SWITCH($t){
  	CASE  1 :       /* Main chat input frame */
                    REQUIRE(TEMPLATEPATH."/input_main.tpl.php");
                    BREAK;
  	CASE  2 :       /* Private messages input frame */
                    REQUIRE(TEMPLATEPATH."/input_pm.tpl.php");
                    BREAK;
  }
}
?>
