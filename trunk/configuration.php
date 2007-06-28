<?php
DEFINE ('_VALID', 1);
DEFINE ('_LANG', 'de');
$language_file = "lang_" . _LANG . ".php";
// include "lang_en.php";
include $language_file;
DEFINE('_LOGO', '../images/sms_de.gif');

$db_server = 'localhost';
$db_name = 's2';
$db_user = 'test';
$db_password = 'test';

$SMTP_SERVER = '213.153.32.129';
$SMTP_USER = '';
$SMTP_PASSWORD = '';
$SMTP_FROM_NAME = 'Helmut Leinfellner';
$SMTP_FROM_EMAIL = 'h.leinfellner@sbg.at';
$SMTP_REPLY_TO = 'h.leinfellner@sbg.at';
?>
