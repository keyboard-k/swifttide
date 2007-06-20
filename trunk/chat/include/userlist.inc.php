<?PHP
/* This is a userlist page. */

// Get room name
$room=NEW room();
$room->readRoom($session,$session->room_id);
$roomname=$room->name;
common::doHtmlEntities($roomname);

REQUIRE(TEMPLATEPATH."/userlist.tpl.php");
?>
