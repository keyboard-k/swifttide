<?php
/*
 * ----------------------------------------------
 * This script installs PCPIN Chat on your server
 * ----------------------------------------------
 * Author: Kanstantin Reznichak <k.reznichak@pcpin.com>
 * Homepage: http://www.pcpin.com/
 * Support forum: http://community.pcpin.com/
 * ----------------------------------------------
 */

// Offset
define('OFFSET','./');

// Load configuration
require_once('./config/config.inc.php');

// Perform global actions and load classes
require_once('./config/prepend.inc.php');

// Installation base directory
define('PCPIN_INSTALL_BASEDIR', './install');

// Load main install script part
require_once(PCPIN_INSTALL_BASEDIR.'/install_main.php');

?>