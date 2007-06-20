<?PHP
/* This is a Admin navigation frame. */
$user=NEW user();
$user->readUser($session,$session->user_id);
IF(!$user->level){
  DIE("Hack?");
}

$cssurl=NEW cssURL($session->db);

REQUIRE(TEMPLATEPATH."/admin_left.tpl.php");
?>
