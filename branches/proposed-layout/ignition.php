<?php
	//This file should always be the first one to be called by all files
	
	$E['path'] = dirname(__FILE__) . '/'; //absolute path to Swift Tide directory, note the trainling slash
	$E['ly'] = $E['path'] . '+front_layer/'; //absolute path for layout files
	
	//always load loaded.php helper file from +helper
	require_once($E['path'] . '+helper/loaded.hp.php');
	//if we want other helper files to be loaded, we can do it by gloabl $E['hp'] array
	if(isset($E['hp']) && is_array($E['hp']))
	{
		foreach($E['hp'] as $helper_file)
		{
			require_once($E['path'] . '+helper/' . $helper_file .'.hp.php');
		}
	}
	
	//load configuration files
	require_once($E['path'] . '+configuration/loaded.cf.php');
	require_once($E['path'] . '+configuration/database-connection.cf.php');
	//if we want other configuration files to be loaded, we can do it by gloabl $E['cf'] array
	if(isset($E['cf']) && is_array($E['cf']))
	{
		foreach($E['cf'] as $helper_file)
		{
			require_once($E['path'] . '+configuration/' . $helper_file .'.cf.php');
		}
	}
	
	//Load required database files
	if(isset($E['dl']) && is_array($E['dl']))
	{
		foreach($E['dl'] as $database_file)
		{
			require_once($E['path'] . '+database_layer/'. $database_file . '.dl.php');
		}
	}
?>