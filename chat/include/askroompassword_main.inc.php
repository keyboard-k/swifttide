<?PHP
/* Password promt for password-protected rooms */

$room=NEW room();
$room->listRooms($session,$m);
$roomname=$room->roomlist[0][name];
common::doHtmlEntities($roomname);

IF($submitted){
  // Check password
  IF(MD5($t)==$room->roomlist[0][password]){
    // Password is correct
?>
<HTML><BODY onload="document.enterroom.submit();">
<FORM name="enterroom" action="main.php" method="post" target="_parent">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="room_id" value="<?=$m?>">
  <INPUT type="hidden" name="room_password" value="<?=$t?>">
</FORM>
</BODY></HTML>
<?
    DIE();
  }ELSE{
    $errortext=$lng["wrongpassword"];
  }
}

/* Load login page template */
REQUIRE(TEMPLATEPATH."/askroompassword.tpl.php");
?>
