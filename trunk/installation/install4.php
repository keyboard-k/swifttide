<?php
/**
* install4.php
*/

// Set flag that this is a parent file
define( "_VALID", 1 );

// Include common.php
require_once( 'common.php' );
require_once( 'database.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname  	= mosGetParam( $_POST, 'DBname', '' );

$DBsmtpserver           = mosGetParam( $_POST, 'DBsmtpserver', '' );
$DBsmtpuser             = mosGetParam( $_POST, 'DBsmtpuser', '' );
$DBsmtppass             = mosGetParam( $_POST, 'DBsmtppass', '' );
$DBsmtpfromname1         = mosGetParam( $_POST, 'DBsmtpfromname1', '' );
$DBsmtpfromname2         = mosGetParam( $_POST, 'DBsmtpfromname2', '' );
$DBsmtpfromemail        = mosGetParam( $_POST, 'DBsmtpfromemail', '' );
$DBsmtpreplyto          = mosGetParam( $_POST, 'DBsmtpreplyto', '' );

$Language       = intval( mosGetParam( $_POST, 'Language', 0 ) );
$DBSample       = mosGetParam( $_POST, 'DBSample', 1 );

$DBPrefix  	= mosGetParam( $_POST, 'DBPrefix', '' );
$sitename  	= mosGetParam( $_POST, 'sitename', '' );
$adminEmail	= mosGetParam( $_POST, 'adminEmail', '');
$siteUrl  	= mosGetParam( $_POST, 'siteUrl', '' );
$absolutePath	= mosGetParam( $_POST, 'absolutePath', '' );
$adminPassword	= mosGetParam( $_POST, 'adminPassword', '');
$logo		= mosGetParam( $_POST, 'logo', '');

if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname']	= $DBhostname;
	$configArray['DBuserName']	= $DBuserName;
	$configArray['DBpassword']	= $DBpassword;
	$configArray['DBname']	 	= $DBname;
	$configArray['DBsmtpserver']	 	= $DBsmtpserver;
	$configArray['DBsmtpuser']	 	= $DBsmtpuser;
	$configArray['DBsmtppass']	 	= $DBsmtppass;
	$configArray['DBsmtpfromname1']	 	= $DBsmtpfromname1;
	$configArray['DBsmtpfromname2']	 	= $DBsmtpfromname2;
	$configArray['DBsmtpfromemail']	 	= $DBsmtpfromemail;
	$configArray['DBsmtpreplyto']	 	= $DBsmtpreplyto;
	$configArray['Language']	= $Language;
	$configArray['DBPrefix']	= $DBPrefix;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBsmtpserver\" value=\"$DBsmtpserver\">
		<input type=\"hidden\" name=\"DBsmtpuser\" value=\"$DBsmtpuser\">
		<input type=\"hidden\" name=\"DBsmtppass\" value=\"$DBsmtppass\">
		<input type=\"hidden\" name=\"DBsmtpfromname1\" value=\"$DBsmtpfromname1\">
		<input type=\"hidden\" name=\"DBsmtpfromname2\" value=\"$DBsmtpfromname2\">
		<input type=\"hidden\" name=\"DBsmtpfromemail\" value=\"$DBsmtpfromemail\">
		<input type=\"hidden\" name=\"DBsmtpreplyto\" value=\"$DBsmtpreplyto\">
		<input type=\"hidden\" name=\"Language\" value=\"$Language\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('The database details provided are incorrect and/or empty'); document.stepBack.submit(); </script>";
	return;
}

if (file_exists( '../configuration.php' )) {
	$canWrite = is_writable( '../configuration.php' );
} else {
	$canWrite = is_writable( '..' );
}

// if ($siteUrl) {
	$configArray['siteUrl']=$siteUrl;
	// Fix for Windows
	$absolutePath= str_replace("\\\\","/", $absolutePath);
	$configArray['absolutePath']=$absolutePath;

	$config = "<?php\n";

	$config .= "DEFINE ('_VALID', 1);\n";
	if ($Language) {
		if ($Language == 1) {
			$config .= "include \"lang_de.php\";\n";
		}
		elseif ($Language == 2) {
			$config .= "include \"lang_en.php\";\n";
		}
		else { echo "Wrong language!"; }
	}
	else { echo "Error selecting language!\n"; }

	if ($logo != "") {
	  $config .= "DEFINE('_LOGO', '" . $logo . "');\n\n";
	}
	else {
	  if (($DBSample == 1) || ($DBSample == 2)) {
	    $config .= "DEFINE('_LOGO', 'sms_de.gif');\n\n";
	  }
	  else {
	    $config .= "DEFINE('_LOGO', 'sms_en.gif');\n\n";
	  }
	}

	$config .= "\$db_server = '{$configArray['DBhostname']}';\n";
	$config .= "\$db_name = '{$configArray['DBname']}';\n";
	$config .= "\$db_user = '{$configArray['DBuserName']}';\n";
	$config .= "\$db_password = '{$configArray['DBpassword']}';\n\n";

	$config .= "\$SMTP_SERVER = '{$configArray['DBsmtpserver']}';\n";
	$config .= "\$SMTP_USER = '{$configArray['DBsmtpuser']}';\n";
	$config .= "\$SMTP_PASS = '{$configArray['DBsmtppass']}';\n";
	$config .= "\$SMTP_FROM_NAME = '{$configArray['DBsmtpfromname1']}" . " " . "{$configArray['DBsmtpfromname2']}';\n";
	$config .= "\$SMTP_FROM_EMAIL = '{$configArray['DBsmtpfromemail']}';\n";
	$config .= "\$SMTP_FROM_REPLYTO = '{$configArray['DBsmtpreplyto']}';\n";

	$config .= "?>\n";

	if ($canWrite && ($fp = fopen("../configuration.php", "w"))) {
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	} else {
		$canWrite = false;
	} // if

	$cryptpass=md5( $adminPassword );

	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );
	$nullDate = $database->getNullDate();

	/////////////////////////////////////////////////
	// Step 1: Table tbl_admin: enter admin user data
	/////////////////////////////////////////////////
	// if (($DBSample == 1) || ($DBSample == 3)) {
	// echo "INSERT";
	// $query = "INSERT INTO `tbl_admin` (tbl_admin_id, tbl_admin_fname, tbl_admin_lname, tbl_admin_email) VALUES (1, '$DBsmtpfromname1', '$DBsmtpfromname2', '$DBsmtpfromemail')";
	// }
	// else {
	// echo "UPDATE";
	$query = "UPDATE `tbl_admin` SET tbl_admin_fname = '$DBsmtpfromname1', tbl_admin_lname = '$DBsmtpfromname2', tbl_admin_email = '$DBsmtpfromemail' WHERE tbl_admin_id = '1' LIMIT 1";
	// }
	$database->setQuery( $query );
	$database->query();

	/////////////////////////////////////////////////
	// Step 2: table web_users: enter admin user data
	/////////////////////////////////////////////////
	// store the password UNENCRYPTED !!!
	// concatenate admin's first and last name
	$flname = $DBsmtpfromname1 . " " . $DBsmtpfromname2;
	// if (($DBSample == 1) || ($DBSample == 3)) {
	// echo "INSERT";
	// $query = "INSERT INTO `web_users` (web_users_type, web_users_relid, web_users_username, web_users_password, web_users_flname, web_users_active, active) VALUES ('A', 1, 'admin', '$adminPassword', '$flname', 0, 1)";
	// }
	// else {
	// echo "UPDATE";
	$query = "UPDATE `web_users` SET web_users_password = '$adminPassword', web_users_flname = '$flname' WHERE web_users_id = '1' LIMIT 1";
	// }
	$database->setQuery( $query );
	$database->query();

	////////////////////////////////////////////////////
	// Step 3: table school_years: enter one school year
	////////////////////////////////////////////////////
	// calculate entry for current school year and enter
	$year = date("Y");
	$next = $year + 1;
	$together = $year . "-" . $next;
	if (($DBSample == 1) || ($DBSample == 3)) {
	// echo "INSERT";
	$query = "INSERT INTO `school_years` (school_years_id, school_years_desc) VALUES (1, '$together')";
	}
	// else {
	// echo "UPDATE";
	// // $query = "UPDATE `school_years` SET school_years_desc = '$together' WHERE school_years_id = '1' LIMIT 1";
	// $query = "INSERT INTO `school_years` (school_years_id, school_years_desc) VALUES (1, '$together')";
	// }
	$database->setQuery( $query );
	$database->query();

	// Step 4: table tbl_config: set current_year to 1
	///////////////////////////////////////////////
	// not needed, it gets INSERTed in the sample files!
	////////////////////////////////////////////////////
	// if (($DBSample == 1) || ($DBSample == 3)) {
	// echo "INSERT";
	// $query = "INSERT INTO `tbl_config` (id, current_year) VALUES (1, 1)"; }
	// else {
	// echo "UPDATE";
	// $query = "UPDATE `tbl_config` SET current_year = '1' WHERE id = '1' LIMIT 1";
	// }
	// $database->setQuery( $query );
	// $database->query();

	// Step 5: table generations: enter "---" for no generation
	///////////////////////////////////////////////////////////
	// not needed, it gets INSERTed in the sample files!
	////////////////////////////////////////////////////
	// if (($DBSample == 1) || ($DBSample == 3)) {
	// echo "INSERT";
	// $query = "INSERT INTO `generations` (generations_id, generations_desc) (VALUES (1, '---')"; }
	// else {
	// echo "UPDATE";
	// $query = "UPDATE `generations` SET generations_desc = '---' WHERE generations_id = '1' LIMIT 1";
	// }
	// $database->setQuery( $query );
	// $database->query();

// }

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
		<!-- <div id="joomla"><img src="header_install.png" alt="SMS Installation" /></div> -->
	</div>
</div>
<div id="ctr" align="center">
	<form action="dummy" name="form" id="form">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">pre-installation check</div>
			<div class="step-off">license</div>
			<div class="step-off">step 1</div>
			<div class="step-off">step 2</div>
			<div class="step-off">step 3</div>
			<div class="step-on">step 4</div>
		</div>
		<div id="right">
			<div id="step">step 4</div>
			<div class="far-right">
				<input class="button" type="button" name="runSite" value="View Site"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/index.php' \"";
				}
?>/>
<!--
				<input class="button" type="button" name="Admin" value="Administration"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/administrator/index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/administrator/index.php' \"";
				}
?>/>
-->
			</div>
			<div class="clr"></div>
			<h1>Congratulations! SMS is installed</h1>
			<div class="install-text">
				<p>Click the "View Site" button to start SMS site</p>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table width="100%">
						<tr><td class="error" align="center">PLEASE REMEMBER TO COMPLETELY<br/>REMOVE THE INSTALLATION DIRECTORY</td></tr>
						<tr><td align="center"><h5>Administration Login Details</h5></td></tr>
						<tr><td align="center" class="notice"><b>Username : admin</b></td></tr>
						<tr><td align="center" class="notice"><b>Password : <?php echo $adminPassword; ?></b></td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td align="right">&nbsp;</td></tr>
<?php						if (!$canWrite) { ?>
						<tr>
							<td class="small">
								Your configuration file or directory is not writeable,
								or there was a problem creating the configuration file. You'll have to
								upload the following code by hand. Click in the textarea to highlight
								all of the code.
							</td>
						</tr>
						<tr>
							<td align="center">
								<textarea rows="5" cols="60" name="configcode" onclick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo htmlspecialchars( $config );?></textarea>
							</td>
						</tr>
<?php						} ?>
						<tr><td class="small"><?php /*echo $chmod_report*/; ?></td></tr>
					</table>
				</div>
			</div>
			<div id="break"></div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
</html>
