<?php require_once('../ignition.php');
	
	define('INST_PATH', dirname(__FILE__) . '/'); //installtion path
	
	$E = new view();
	$E->set_layout(INST_PATH . 'view/layout.ly.php');
	
	$required_php_veriosn = '5.2.0';
	
	if(version_compare($required_php_version, phpversion()) > 0)
	{
		$E->error = 'PHP version '. $required_php_version . ' or higher is needed to run Swifttide. Yours is ' . phpversion() . ' .';
		$E->set_view(INST_PATH . 'view/error.ly.php');
		$E->show();
		exit();
	}
	if(file_exists('../config.php'))
	{
		$E->error = 'File <tt>config.php</tt> already exists. Please delete this file in order to re-install Swifttide';
		$E->set_view(INST_PATH . 'view/error.ly.php');
		$E->show();
		exit();
	}
?>
