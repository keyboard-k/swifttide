<?PHP
/* This is a roomlist page. */

// Load user data
$user=NEW user();
$user->readUser($session);

REQUIRE(TEMPLATEPATH."/roomlist.tpl.php");
?>
