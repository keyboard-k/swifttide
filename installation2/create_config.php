<?php
	
	$config_php = '<?php

$db_server   = "'. str_replace('"', '\\"', $_POST['db_server'])   .'";
$db_name     = "'. str_replace('"', '\\"', $_POST['db_name'])     .'";
$db_user     = "'. str_replace('"', '\\"', $_POST['db_user'])     .'";
$db_password = "'. str_replace('"', '\\"', $_POST['db_password']) .'";
?>
';

$f = fopen(ROOT_PATH . 'config.php', 'w');
fputs($f, $config_php, strlen($config_php));

?>
