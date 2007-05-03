<?php
/**
* index.php
*/

// Set flag that this is a parent file
define( '_VALID_MOS', 1 );

///////////////////////////////////////////////////
// uncomment these 4 lines before final release !!!
///////////////////////////////////////////////////
// if (file_exists( '../configuration.php' ) && filesize( '../configuration.php' ) > 10) {
// 	header( "Location: ../index.php" );
// 	exit();
// }

require( 'globals.php' );
require_once( 'version.php' );

/** Include common.php */
include_once( 'common.php' );
view();

/*
 * Added 1.0.11
 */
function view() {	
	$sp 		= ini_get( 'session.save_path' );
	
	$_VERSION 		= new joomlaVersion();				 	
	$versioninfo 	= $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS;
	$version 		= $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '. $_VERSION->DEV_STATUS.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
	
	echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>SMS - Web Installer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="shortcut icon" href="../images/favicon.ico" />
	<link rel="stylesheet" href="install.css" type="text/css" />
	</head>
	<body>
	
	<div id="wrapper">
		<div id="header">
			<div id="joomla">
				<!-- <img src="header_install.png" alt="SMS Installation" /> -->
				<!-- <img src="header_bg.png" alt="SMS Installation" /> -->
				<img src="../images/sms_en_small.gif" alt="SMS Installation" />
				<!-- <img src="../images/sms_de_small.gif" alt="SMS Installation" /> -->
			</div>
		</div>
	</div>
	
	<div id="ctr" align="center">
		<div class="install">
			<div id="stepbar">
				<div class="step-on">pre-installation check</div>
				<div class="step-off">license</div>
				<div class="step-off">step 1</div>
				<div class="step-off">step 2</div>
				<div class="step-off">step 3</div>
				<div class="step-off">step 4</div>
			</div>
	
			<div id="right">
				<div id="step">pre-installation check</div>
	
				<div class="far-right">
					<input name="Button2" type="submit" class="button" value="Next >>" onclick="window.location='install.php';" />
					<br/>
					<br/>
					<input type="button" class="button" value="Check Again" onclick="window.location=window.location" />
				</div>
				<div class="clr"></div>				
					
				<h1 style="text-align: center; border-bottom: 0px;">
					<?php echo $version; ?>
				</h1>
	
				<h1>
					Required Settings Check:
				</h1>
				
				<div class="install-text">
					<p>
						If any of these items are highlighted in red then please take actions to correct them. 
					</p>
					<p>
						Failure to do so could lead to your SMS installation not functioning correctly.
					</p>
					<div class="ctr"></div>
				</div>
	
				<div class="install-form">
					<div class="form-block">
						<table class="content">
						<tr>
							<td class="item">
								PHP version >= 4.1.0
							</td>
							<td align="left">
								<?php echo phpversion() < '4.1' ? '<b><font color="red">No</font></b>' : '<b><font color="green">Yes</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - zlib compression support
							</td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - XML support
							</td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td>
								&nbsp; - MySQL support
							</td>
							<td align="left">
								<?php echo function_exists( 'mysql_connect' ) ? '<b><font color="green">Available</font></b>' : '<b><font color="red">Unavailable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td valign="top" class="item">
								configuration.php
							</td>
							<td align="left">
								<?php
								if (@file_exists('../configuration.php') &&  @is_writable( '../configuration.php' )){
									echo '<b><font color="green">Writeable</font></b>';
								} else if (is_writable( '..' )) {
									echo '<b><font color="green">Writeable</font></b>';
								} else {
									echo '<b><font color="red">Unwriteable</font></b><br /><span class="small">You can still continue the install as the configuration will be displayed at the end, just copy & paste this and upload.</span>';
								} 
								?>
							</td>
						</tr>
						<tr>
							<td class="item">
								Session save path
							</td>
							<td align="left" valign="top">
								<?php echo is_writable( $sp ) ? '<b><font color="green">Writeable</font></b>' : '<b><font color="red">Unwriteable</font></b>';?>
							</td>
						</tr>
						<tr>
							<td class="item" colspan="2">
								<b>
									<?php echo $sp ? $sp : 'Not set'; ?>
								</b>
							</td>
						</tr>
						</table>
					</div>
				</div>
				<div class="clr"></div>
				
			</div>
			<div class="clr"></div>
		</div>
	</div>
	
	</body>
	</html>
	<?php
}

function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? 'ON' : 'OFF';
}

function writableCell( $folder, $relative=1, $text='' ) {
	$writeable 		= '<b><font color="green">Writeable</font></b>';
	$unwriteable 	= '<b><font color="red">Unwriteable</font></b>';
	
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="right">';
	if ( $relative ) {
		echo is_writable( "../$folder" ) 	? $writeable : $unwriteable;
	} else {
		echo is_writable( "$folder" ) 		? $writeable : $unwriteable;
	}
	echo '</tr>';
}
?>
