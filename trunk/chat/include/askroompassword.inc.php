<?PHP
/* Password promt for password-protected rooms */

// Check whether the room still exists
$room=NEW room();
$room->listRooms($session,$m);
IF(!$room->roomlist[0][id]){
  // Room does not exists anymore
?>
<HTML><BODY onload="document.i.submit();">
<FORM name="i" action="main.php" method="post" target="_parent">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="3">
</FORM>
</BODY></HTML>
<?
  DIE();
}


IF($session->room_id>0){
  /* User came here from another room. Posting a system message into that room. */
  systemmessage::insertMessage($session,$session->user_id."|".$session->room_id,2);
  $session->updateSession("room_id = -3");
}

// Look for pass
$roompass=NEW roompass();
IF($roompass->checkPass($session,$m,$session->user_id)){
  // A pass exists. Redirecting user into room.
?>
<HTML><BODY onload="document.loginform.submit();">
<FORM name="loginform" action="main.php" method="post" target="_parent">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="room_id" value="<?=$m?>">
  <INPUT type="hidden" name="u" value="<?=$u?>">
  <INPUT type="hidden" name="x" value="<?=$x?>">
  <INPUT type="hidden" name="submitted" value="1">
</FORM>
</BODY></HTML>
<?
  DIE();
}

SWITCH($frame){
	CASE "main"      :  /* Roomlist */
                      REQUIRE(INCLUDEPATH."/askroompassword_main.inc.php");
                      BREAK;
	CASE "refresher" :  /* Refresher */
                      REQUIRE(INCLUDEPATH."/refresher.inc.php");
                      BREAK;
	DEFAULT          :  /* Frameset */
                      REQUIRE(INCLUDEPATH."/frames1.inc.php");
                      BREAK;
}

?>
