<?php
/**
* install2.php
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
$DBsmtpfromname1        = mosGetParam( $_POST, 'DBsmtpfromname1', '' );
$DBsmtpfromname2        = mosGetParam( $_POST, 'DBsmtpfromname2', '' );
$DBsmtpfromemail        = mosGetParam( $_POST, 'DBsmtpfromemail', '' );
$DBsmtpreplyto          = mosGetParam( $_POST, 'DBsmtpreplyto', '' );

$DBPrefix       = mosGetParam( $_POST, 'DBPrefix', '' );
$DBDel          = intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup       = intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$Language       = intval( mosGetParam( $_POST, 'Language', 0 ) );
$DBSample       = intval( mosGetParam( $_POST, 'DBSample', 0 ) );
$DBcreated      = intval( mosGetParam( $_POST, 'DBcreated', 0 ) );
$BUPrefix = 'old_';
$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', '' ) );

$database = null;

$errors = array();
if (!$DBcreated){
	if (!$DBhostname || !$DBuserName || !$DBname) {
		db_err ('stepBack3','The database details provided are incorrect and/or empty.');
	}

// 	if($DBPrefix == '') {
// 		db_err ('stepBack','You have not entered a database prefix.');
// 	}
	
	$database = new database( $DBhostname, $DBuserName, $DBpassword, '', '', false );
	$test = $database->getErrorMsg();

	if (!$database->_resource) {
		db_err ('stepBack2','The password and username provided are incorrect.');
	}

	// Does this code actually do anything???
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']	 = $DBname;
	$configArray['DBsmtpserver']	 = $DBsmtpserver;
	$configArray['DBsmtpuser']	 = $DBsmtpuser;
	$configArray['DBsmtppass']	 = $DBsmtppass;
	$configArray['DBsmtpfromname1']	 = $DBsmtpfromname1;
	$configArray['DBsmtpfromname2']	 = $DBsmtpfromname2;
	$configArray['DBsmtpfromemail']	 = $DBsmtpfromemail;
	$configArray['DBsmtpreplyto']	 = $DBsmtpreplyto;
	$configArray['DBPrefix']	= $DBPrefix;

	$sql = "CREATE DATABASE `$DBname`";
	$database->setQuery( $sql );
	$database->query();
	$test = $database->getErrorNum();

	if ($test != 0 && $test != 1007) {
		db_err( 'stepBack', 'A database error occurred: ' . $database->getErrorMsg() );
	}

	// db is now new or existing, create the db object connector to do the serious work
	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );

	// delete existing mos table if requested
	if ($DBDel) {
		$query = "SHOW TABLES FROM `$DBname`";
		$database->setQuery( $query );
		$errors = array();
		if ($tables = $database->loadResultArray()) {
			foreach ($tables as $table) {
				if (strpos( $table, $DBPrefix ) === 0) {
					if ($DBBackup) {
						$butable = str_replace( $DBPrefix, $BUPrefix, $table );
						$query = "DROP TABLE IF EXISTS `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
						$query = "RENAME TABLE `$table` TO `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
					}
					$query = "DROP TABLE IF EXISTS `$table`";
					$database->setQuery( $query );
					$database->query();
					if ($database->getErrorNum()) {
						$errors[$database->getQuery()] = $database->getErrorMsg();
					}
				}
			}
		}
	}

	// populate_db( $database, 'joomla.sql' );
	// populate_db( $database, 'sms_empty.sql' );
	if ($DBSample) {
		switch ($DBSample) {
			case 1:	
			populate_db( $database, 'sms_de_empty.sql' );
			break;
			case 2:	
			populate_db( $database, 'sms_de_sample.sql' );
			break;
			case 3:	
			populate_db( $database, 'sms_en_empty.sql' );
			break;
			case 4:	
			populate_db( $database, 'sms_en_sample.sql' );
			break;
			default:
			$errors[$database->getQuery()] = $database->getErrorMsg();
			break;
		}
	}
	$DBcreated = 1;
}

function db_err($step, $alert) {
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname;
	echo "<form name=\"$step\" method=\"post\" action=\"install1.php\">
	<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\">
	<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\">
	<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\">
	<input type=\"hidden\" name=\"DBDel\" value=\"$DBDel\">
	<input type=\"hidden\" name=\"DBname\" value=\"$DBname\">
	<input type=\"hidden\" name=\"DBsmtpserver\" value=\"$DBsmtpserver\">
	<input type=\"hidden\" name=\"DBsmtpuser\" value=\"$DBsmtpuser\">
	<input type=\"hidden\" name=\"DBsmtppass\" value=\"$DBsmtppass\">
	<input type=\"hidden\" name=\"DBsmtpfromname1\" value=\"$DBsmtpfrmoname1\">
	<input type=\"hidden\" name=\"DBsmtpfromname2\" value=\"$DBsmtpfrmoname2\">
	<input type=\"hidden\" name=\"DBsmtpfromemail\" value=\"$DBsmtpfromemail\">
	<input type=\"hidden\" name=\"DBsmtpreplyto\" value=\"$DBsmtpreplyto\">
	</form>\n";
	//echo "<script>alert(\"$alert\"); window.history.go(-1);</script>";
	echo "<script>alert(\"$alert\"); document.location.href='install1.php';</script>";  
	exit();
}

/**
 * @param object
 * @param string File name
 */
function populate_db( &$database, $sqlfile='mambo.sql') {
	global $errors;

	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$query = fread( fopen( 'sql/' . $sqlfile, 'r' ), filesize( 'sql/' . $sqlfile ) );
	@set_magic_quotes_runtime($mqr);
	$pieces  = split_sql($query);

	for ($i=0; $i<count($pieces); $i++) {
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") {
			$database->setQuery( $pieces[$i] );
			if (!$database->query()) {
				$errors[] = array ( $database->getErrorMsg(), $pieces[$i] );
			}
		}
	}
}

/**
 * @param string
 */
function split_sql($sql) {
	$sql = trim($sql);
	$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) {
		if($sql[$i] == ";" && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
			$in_string = false;
		}
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
			$in_string = $sql[$i];
		}
		if(isset($buffer[1])) {
			$buffer[0] = $buffer[1];
		}
		$buffer[1] = $sql[$i];
	}

	if(!empty($sql)) {
		$ret[] = $sql;
	}
	return($ret);
}

$isErr = intval( count( $errors ) );

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMS - Web Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid = true;
	var f = document.form;
	// if ( f.sitename.value == '' ) {
	// 	alert('Please enter a Site Name');
	// 	f.sitename.focus();
	// 	formValid = false
	// }
	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.DBsmtpserver.focus();">
<div id="wrapper">
	<div id="header">
	  <!-- <div id="joomla"><img src="header_install.png" alt="SMS Installation" /></div> -->
	</div>
</div>

<div id="ctr" align="center">
	<form action="install3.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
	<input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
	<input type="hidden" name="DBsmtpserver" value="<?php echo "$DBsmtpserver"; ?>" />
	<input type="hidden" name="DBsmtpuser" value="<?php echo "$DBsmtpuser"; ?>" />
	<input type="hidden" name="DBsmtppass" value="<?php echo "$DBsmtppass"; ?>" />
	<input type="hidden" name="DBsmtpfromname1" value="<?php echo "$DBsmtpfromname1"; ?>" />
	<input type="hidden" name="DBsmtpfromname2" value="<?php echo "$DBsmtpfromname2"; ?>" />
	<input type="hidden" name="DBsmtpfromemail" value="<?php echo "$DBsmtpfromemail"; ?>" />
	<input type="hidden" name="DBsmtpreplyto" value="<?php echo "$DBsmtpreplyto"; ?>" />
	<input type="hidden" name="Language" value="<?php echo "$Language"; ?>" />
	<input type="hidden" name="DBSample" value="<?php echo "$DBSample"; ?>" />
	<input type="hidden" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
	<input type="hidden" name="DBcreated" value="<?php echo "$DBcreated"; ?>" />
	<div class="install">
		<div id="stepbar">
		  	<div class="step-off">pre-installation check</div>
	  		<div class="step-off">license</div>
		  	<div class="step-off">step 1</div>
		  	<div class="step-on">step 2</div>
	  		<div class="step-off">step 3</div>
		  	<div class="step-off">step 4</div>
		</div>
		<div id="right">
  			<div class="far-right">
<?php if (!$isErr) { ?>
  		  		<input class="button" type="submit" name="next" value="Next >>"/>
<?php } ?>
  			</div>
	  		<div id="step">step 2</div>
  			<div class="clr"></div>

  			<h1>Enter the details of your SMTP server:</h1>
			<div class="install-text">
<?php if ($isErr) { ?>
			Looks like there have been some errors with inserting data into your database!<br />
  			You cannot continue.
<?php } else { ?>
			<b>SUCCESS!</b>
			<br/>
			<br/>
  			Type in the IP address of your SMTP server.
			Also the username/password IF YOU NEED THEM to log in to the SMTP server.
<?php } ?>
  		</div>
  		<div class="install-form">
  			<div class="form-block">
  				<table class="content2">
<?php
			if ($isErr) {
				echo '<tr><td colspan="2">';
				echo '<b></b>';
				echo "<br/><br />Error log:<br />\n";
				// abrupt failure
				echo '<textarea rows="10" cols="50">';
				foreach($errors as $error) {
					echo "SQL=$error[0]:\n- - - - - - - - - -\n$error[1]\n= = = = = = = = = =\n\n";
				}
				echo '</textarea>';
				echo "</td></tr>\n";
  			} else {
?>
  		  			<tr>
  						<td colspan="2">
  							SMTP Server
  							<br/>
  							<input class="inputbox" type="text" name="DBsmtpserver" value="<?php echo "$DBsmtpserver"; ?>" />
  						</td>
			  			<td>
			  				<em>SMTP Server</em>
			  			</td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							SMTP Username
  							<br/>
  							<input class="inputbox" type="text" name="DBsmtpuser" value="<?php echo "$DBsmtpuser"; ?>" />
  						</td>
			  			<td>
			  				<em>SMTP Username</em>
			  			</td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							SMTP Password
  							<br/>
  							<input class="inputbox" type="text" name="DBsmtppass" value="<?php echo "$DBsmtppass"; ?>" />
  						</td>
			  			<td>
			  				<em>SMTP Password</em>
			  			</td>
  					</tr>
  		  			<!-- REMOVE Prefix -> we don't need it -->
  		  			<!-- <tr>
  						<td colspan="2">
  							MySQL Table Prefix
  							<br/>
  							<input class="inputbox" type="text" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
  						</td>
			  			<td>
			  			<em>Don't use 'old_' since this is used for backup tables</em>
			  			</td>
  					</tr>
					-->
  		  			<!-- REMOVE DROP -> only install empty DB -->
					<!-- <tr>
			  			<td>
			  				<input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if ($DBDel) echo 'checked="checked"'; ?> />
			  			</td>
						<td>
							<label for="DBDel">Drop Existing Tables</label>
						</td>
  						<td>
  						</td>
			  		</tr>
					-->
  		  			<!-- REMOVE Backup -> only install empty DB -->
  		  			<!-- <tr>
			  			<td>
			  				<input type="checkbox" name="DBBackup" id="DBBackup" value="1" <?php if ($DBBackup) echo 'checked="checked"'; ?> />
			  			</td>
						<td>
							<label for="DBBackup">Backup Old Tables</label>
						</td>
  						<td>
  							<em>Any existing backup tables from former SMS installations will be replaced</em>
  						</td>
			  		</tr>
					-->
  					<!--
					<tr>
  						<td width="100">Site name</td>
  						<td align="center"><input class="inputbox" type="text" name="sitename" size="30" value="<?php echo "{$configArray['sitename']}"; ?>" /></td>
  					</tr>
  					<tr>
  						<td width="100">&nbsp;</td>
  						<td align="center" class="small">e.g. Student management System</td>
  					</tr>
				-->
  				</table>
<?php
  			} // if
?>
  			</div>
  		</div>
  		<div class="clr"></div>
  		<div id="break"></div>
	</div>
	<div class="clr"></div>
	</form>
</div>
<div class="clr"></div>
</div>
<div class="ctr">
	<!-- <a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License. -->
</div>
</body>
</html>

