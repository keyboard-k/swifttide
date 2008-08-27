<?php
	
	$config_php = '<?php
	
DEFINE ("_VALID", 1);
include "lang_en.php";
DEFINE ("_LANG", "en");
DEFINE("_LOGO", "../images/sms_en.gif");
	
$db_server   = "'. str_replace('"', '\\"', $_POST['db_server'])   .'";
$db_name     = "'. str_replace('"', '\\"', $_POST['db_name'])     .'";
$db_user     = "'. str_replace('"', '\\"', $_POST['db_user'])     .'";
$db_password = "'. str_replace('"', '\\"', $_POST['db_password']) .'";
?>
';

$f = fopen(ROOT_PATH . 'config.php', 'w');
fputs($f, $config_php, strlen($config_php));

?>
