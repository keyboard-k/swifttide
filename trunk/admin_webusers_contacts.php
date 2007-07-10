<?php
//v1.5 01-15-06 carry the id of the contact from studentcontact for later use
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
// config
include_once "configuration.php";

$action=get_param("action");
$letter=get_param("letter");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
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
	alert("<? echo _ENTER_VALUE?>");
	return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_WEBUSERS_CONTACTS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_WEBUSERS_CONTACTS_TITLE?></h1>
	<br />
<?php
	switch ($action) {
		case "letter":
			if (!isset($letter))
				die();
			$q = mysql_query("select * from studentcontact where studentcontact_lname LIKE '".$letter."%'");
//			$q = mysql_query("select * from web_users where web_users_type='C' and web_users_flname LIKE '% ".$letter."%'");
			if (@mysql_num_rows($q) == 0) {
				echo _ADMIN_WEBUSERS_CONTACTS_NO_DATA;
			} else {
			echo "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			while ($r = mysql_fetch_array($q)) {
				$name = $r['studentcontact_fname']. "&nbsp;" .$r['studentcontact_lname'];
				$cid=$r['studentcontact_id'];
				echo "<tr>
					<td>
						$r[studentcontact_lname]
					</td>
					<td>
						$r[studentcontact_fname]
					</td>
					<td>
					<a href=admin_webusers_active.php?act=1&contactid=$cid class=aform>" .
					_ADMIN_WEBUSERS_CONTACTS_ACTIVATE . "</a>
					</td>
					<td>
					<a href=admin_webusers_active.php?act=0&contactid=$cid class=aform>" .
					_ADMIN_WEBUSERS_CONTACTS_DEACTIVATE . "</a>
					</td>
					<td>
					<a href=admin_webusers_resetpass.php?contactid=$cid class=aform>" .
					_ADMIN_WEBUSERS_CONTACTS_PASS . "</a>
					</td>
				</tr>";
			}
			echo "</table>";				
			}
	}
?>
<br>
<br>
<a class="aform" href="admin_users_1.php"><? echo _ADMIN_WEBUSERS_CONTACTS_NEW?></a>
</div>
<? include "admin_menu.inc.php"; ?>
</body>
</html>
