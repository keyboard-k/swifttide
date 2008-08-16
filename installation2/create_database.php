<?php
	
	$m = mysql_connect($_POST['db_server'], $_POST['db_user'], $_POST['db_password']);
	mysql_select_db($_POST['db_name']) or die('Database ' . $_POST['db_name'] . ' does not exist. Please create it first.');
	
	//Create tables.
	mysql_query('SOURCE ' . 'database_structure.sql') or 
		die(mysql_error());

	//add Administrator
	mysql_query('INSERT INTO web_users SET web_users_username = "' . 
		mysql_escape_string($_POST['admin_id']) . 
		'", web_users_password = "' . 
		mysql_escape_string($_POST['admin_password']) .
		'", web_users_type = "A" ');
	
?>
