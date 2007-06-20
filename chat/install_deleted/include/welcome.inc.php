<?php
$next_include=1000;

$_body_onload.="document.getElementById('startBtn').style.visibility='visible'; ";

// Load template
require_once(PCPIN_INSTALL_TEMPLATES.'/welcome.tpl.php');
?>