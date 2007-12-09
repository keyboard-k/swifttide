<?php
/**
* version.php
*/

// no direct access
defined( '_VALID' ) or die( 'Restricted access' );

/**
 * Version information
 * @package SMS
 */
class joomlaVersion {
	/** @var string Product */
	var $PRODUCT 	= 'School Management System';
	/** @var int Main Release Level */
	var $RELEASE 	= '1.08';
	/** @var string Development Status */
	var $DEV_STATUS = 'Stable';
	/** @var int Sub Release Level */
	var $DEV_LEVEL 	= '01';
	/** @var int build Number */
	var $BUILD	 	= '';
	/** @var string Codename */
	var $CODENAME 	= 'Sunset';
	/** @var string Date */
	var $RELDATE 	= '2007-12-09';
	/** @var string Time */
	var $RELTIME 	= '12:00';
	/** @var string Timezone */
	var $RELTZ 		= 'UTC';
	/** @var string Copyright Text */
	var $COPYRIGHT 	= "Copyright (C) 2005 - 2006 Open Source Matters. All rights reserved.";
	/** @var string URL */
	var $URL 		= 'SMS - Student Management System';
	/** @var string Whether site is a production = 1 or demo site = 0: 1 is default */
	var $SITE 		= 1;
	/** @var string Whether site has restricted functionality mostly used for demo sites: 0 is default */
	var $RESTRICT	= 0;
	/** @var string Whether site is still in development phase (disables checks for /installation folder) - should be set to 0 for package release: 0 is default */
	var $SVN		= 0;

	
	/**
	 * @return string Long format version
	 */
	function getLongVersion() {
		return $this->PRODUCT .' '. $this->RELEASE .'.'. $this->DEV_LEVEL .' '
			. $this->DEV_STATUS
			.' [ '.$this->CODENAME .' ] '. $this->RELDATE .' '
			. $this->RELTIME .' '. $this->RELTZ;
	}

	/**
	 * @return string Short version format
	 */
	function getShortVersion() {
		return $this->RELEASE .'.'. $this->DEV_LEVEL;
	}

	/**
	 * @return string Version suffix for help files
	 */
	function getHelpVersion() {
		if ($this->RELEASE > '1.0') {
			return '.' . str_replace( '.', '', $this->RELEASE );
		} else {
			return '';
		}
	}
}
$_VERSION = new joomlaVersion();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;

// $release = $_VERSION->RELEASE . '.' . $_VERSION->DEV_LEVEL;
$release = $_VERSION->RELEASE;
$reldate = $_VERSION->RELDATE;

?>
