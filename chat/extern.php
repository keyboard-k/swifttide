<?PHP
/* This is a PCPIN Chat redirection to external server script */

/* Offset */
DEFINE("OFFSET","./");

/* Load configuration */
REQUIRE("./config/config.inc.php");

/* Execute global actions and load classes */
REQUIRE("./config/prepend.inc.php");

/* Load database connection settings */
INCLUDE("./config/db.inc.php");

/* Creating session handle */
IF(EMPTY($session_id)){
  $session_id='';
}
$session=NEW session($session_id);

IF(!ISSET($ext)){
  $ext='';
}
?>
<html><head><script>window.location.href="<?=HTMLENTITIES($ext)?>";</script></head></html>