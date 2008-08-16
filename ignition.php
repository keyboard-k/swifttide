<?php
	/**
	* This is the base and the very first file to be included in all other swfttide php files.
	*/

	//Define the global constant BASE_PATH, which contains the absolute path to Swift Tide directory
	if(!defined('ROOT_PATH'))
		define('ROOT_PATH', dirname(__FILE__).'/'); //note the trailing slash

	require_once(ROOT_PATH . 'helper/global_function.php');
	require_once(ROOT_PATH . 'helper/base.php');
	require_once(ROOT_PATH . 'helper/view.php');
?>