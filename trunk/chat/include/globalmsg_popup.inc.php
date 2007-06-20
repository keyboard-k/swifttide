<?PHP

// Read message
$message=globalMessage::readMessage($session,$msg_id);

$sender=NEW user();
$sender->readUser($session,$message[user_id]);

// Load template
REQUIRE(TEMPLATEPATH."/globalmsg_popup.tpl.php");
?>