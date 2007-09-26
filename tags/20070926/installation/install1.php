<?php
/**
* install1.php
*/

// Set flag that this is a parent file
define( "_VALID", 1 );

/** Include common.php */
require_once( 'common.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname     = mosGetParam( $_POST, 'DBname', '' );

$DBPrefix  	= mosGetParam( $_POST, 'DBPrefix', 'jos_' );
$DBDel  	= intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup  	= intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$Language  	= mosGetParam( $_POST, 'Language', 1 );
$DBSample  	= mosGetParam( $_POST, 'DBSample', 1 );

echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMS - Web Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script  type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('Please enter a Host name');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('Please enter a Database User Name');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('Please enter a Name for your new Database');
		f.DBname.focus();
		formValid=false;
	} else if ( f.DBPrefix.value == 'old_' ) {
		alert('You cannot use "old_" as the MySQL Table Prefix because SMS uses this prefix for backup tables.');
		f.DBPrefix.focus();
		formValid=false;
	} else if ( confirm('Are you sure these settings are correct? \nSMS will now attempt to populate a Database with the settings you have supplied')) {
		formValid=true;
	}

	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.DBhostname.focus();">
<div id="wrapper">
	<div id="header">
		<!-- <div id="joomla"><img src="header_install.png" alt="SMS Installation" /></div> -->
	</div>
</div>
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">
				pre-installation check
			</div>
			<div class="step-off">
				license
			</div>
			<div class="step-on">
				step 1
			</div>
			<div class="step-off">
				step 2
			</div>
			<div class="step-off">
				step 3
			</div>
			<div class="step-off">
				step 4
			</div>
		</div>
		<div id="right">
			<div class="far-right">
				<input class="button" type="submit" name="next" value="Next >>"/>
  			</div>
	  		<div id="step">
	  			step 1
	  		</div>
  			<div class="clr"></div>
  			<h1>MySQL database configuration:</h1>
	  		<div class="install-text">
  				<p>Setting up SMS to run on your server involves 4 simple steps...</p>
  				<p>Please enter the hostname of the server SMS is to be installed on.</p>
				<p>Enter the MySQL username, password and database name you wish to use with SMS.</p>
				<p>Choose the language and database you wish you use.</p>
  			</div>
			<div class="install-form">
  				<div class="form-block">
  		 			<table class="content2">
  		  			<tr>
  						<td></td>
  						<td></td>
  						<td></td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							Host Name
  							<br/>
  							<input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
  						</td>
			  			<td>
			  				<em>This is usually 'localhost'</em>
			  			</td>
  					</tr>
					<tr>
			  			<td colspan="2">
			  				MySQL User Name
			  				<br/>
			  				<input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
			  			</td>
			  			<td>
			  				<em>Either something as 'root' or a username given by the hoster</em>
			  			</td>
  					</tr>
			  		<tr>
			  			<td colspan="2">
			  				MySQL Password
			  				<br/>
			  				<input class="inputbox" type="text" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
			  			</td>
			  			<td>
			  				<em>For site security using a password for the mysql account is mandatory</em>
			  			</td>
					</tr>
  		  			<tr>
  						<td colspan="2">
  							MySQL Database Name
  							<br/>
  							<input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" />
  						</td>
			  			<td>
			  				<em>Enter the name of your DB here.</em>
			  			</td>
  					</tr>
					<tr>
  						<td colspan="2">
							<label for="Language">Language</label>
  							
  							<br/>
  		  			<!--
							<input type="radio" name="Language" id="Language" value="1" />Deutsch<br>
					-->
			  				<input type="radio" name="Language" id="Language" value="2" />English<br>
  						</td>
			  			<td>
			  				<em>Choose your language here.</em>
			  			</td>
  					</tr>
					<tr>
			  			<td colspan=2>
							<label for="DBSample">Database</label>
			  				<br/>
  		  			<!--
							<input type="radio" name="DBSample" id="DBSample" value="1" />Deutsch, ohne Daten<br>
			  				<input type="radio" name="DBSample" id="DBSample" value="2" />Deutsch, mit Daten<br>
					-->
							<input type="radio" name="DBSample" id="DBSample" value="3" />English, without data<br>
			  				<input type="radio" name="DBSample" id="DBSample" value="4" />English, sample data<br>
			  			</td>
			  			<td>
			  				<em>Please choose your language and if sample data should be installed or not</em>
			  			</td>
			  		</tr>
		  		 	</table>
  				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<!-- <a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License. -->
</div>
</body>
</html>
