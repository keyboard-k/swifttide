<?php
//v1.5 12-30-05 doug.  write to active field not web_users_active
//v1.52 01-08-06 doug. write active/deactive in Red, depending on what 
//they are NOT in web_users
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
$letter=get_param("letter");
// config
include_once "configuration.php";

$action = get_param("action");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to check if field is empty */
function submitform(fldName, frmNumb)
{
  var f = document.forms[frmNumb];
  var t = f.elements[fldName]; 
  if (t.value!="") 
	return true;
  else
	alert("<?php echo _ENTER_VALUE?>");
	return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_WEBUSERS_TEACHERS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_WEBUSERS_TEACHERS_TITLE?></h1>
	<br />
<?php
	switch ($action) {
		case "letter":
			if (!isset($letter))
				die();
			$q = mysql_query("select * FROM teachers where teachers_lname LIKE '".$letter."%' ");
//			$q = mysql_query("select * from web_users where web_users_type='T' and web_users_flname LIKE '% ".$letter."%'");
			if (@mysql_num_rows($q) == 0) {
				echo _ADMIN_WEBUSERS_TEACHERS_NODATA;
			} else {
			echo "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			while ($r = mysql_fetch_array($q)) {
				$z = mysql_query("SELECT web_users_relid FROM web_users WHERE web_users_relid=teachers_id");
				echo "<tr>
				<td>$r[teachers_lname]</td>
				<td>$r[teachers_fname]</td>
				<td>
				<a href=admin_webusers_active.php?act=1&teacherid=$r[teachers_id] class=aform>" .
				_ADMIN_WEBUSERS_TEACHERS_ACTIVATE . "</a>
				</td>
				<td>
				<a href=admin_webusers_active.php?act=0&teacherid=$r[teachers_id] class=aform>" .
				_ADMIN_WEBUSERS_TEACHERS_DEACTIVATE . "</a>
				</td>
				<td>
				<a href=admin_webusers_resetpass.php?teacherid=$r[teachers_id] class=aform>" .
				_ADMIN_WEBUSERS_TEACHERS_PASS . "</a>
				</td>
				</tr>";
			}
			echo "</table>";				
			}
	}
?>
<br>
<a class="aform" href="admin_users_1.php"><?php echo _ADMIN_WEBUSERS_TEACHERS_NEW?></a>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>
</html>
