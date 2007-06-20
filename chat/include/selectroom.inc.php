<?PHP
/* This is a room selection page */

IF(!$admin_manage_rooms && $session->room_id>0 && $x=="-"){
  /* User came here from another room. Posting a system message into that room. */
  $systemmessage=NEW systemmessage();
  $systemmessage->insertMessage($session,$session->user_id."|".$session->room_id,2);
  $session->updateSession("room_id = -1");
}

SWITCH($frame){
	CASE "main"      :  /* Roomlist */
                      REQUIRE(INCLUDEPATH."/selectroom_list.inc.php");
                      BREAK;
	CASE "refresher" :  /* Refresher */
                      REQUIRE(INCLUDEPATH."/refresher.inc.php");
                      BREAK;
	DEFAULT          :  /* Frameset */
                      REQUIRE(INCLUDEPATH."/frames1.inc.php");
                      BREAK;
}
?>
