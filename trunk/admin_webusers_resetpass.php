<?php
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
require_once "class.phpmailer.php";
// config
include_once "configuration.php";


$letter=get_param("letter");

function makepass($len=8)
{
 $pw = ''; //intialize to be blank
 for($i=0;$i<$len;$i++)
 {
   switch(rand(1,3))
   {
     case 1: $pw.=chr(rand(48,57));  break; //0-9
     case 2: $pw.=chr(rand(65,90));  break; //A-Z
     case 3: $pw.=chr(rand(97,122)); break; //a-z
   }
 }
 return $pw;
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_WEBUSERS_RESETPASS_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_WEBUSERS_RESETPASS_TITLE?></h1>
	<?php
		if ($teacherid) {
			$q = mysql_query("select * from web_users where web_users_relid = $teacherid and web_users_type='T'");
			if (!mysql_num_rows($q)) {
				echo _ADMIN_WEBUSERS_RESETPASS_NO_DATA;
			} else {
				$r = mysql_fetch_array($q);
				$new = makepass();
				mysql_query("update web_users set web_users_password = '$new' where web_users_relid = $teacherid and web_users_type='T'");
				$q = mysql_query("select * from teachers where teachers_id = $teacherid");
				$r = mysql_fetch_array($q);

				$m = new PHPMailer();
				$m->From = SMTP_FROM_EMAIL;
				$m->Fromname = SMTP_FROM_NAME;
				$m->AddAddress($r['teachers_email'], $r['teachers_fname']." ".$r['teachers_lname']);
				$m->AddReplyTo(SMTP_REPLY_TO, "testing");
				$m->Wordwrap = 60;
				$m->Subject = _ADMIN_WEBUSERS_RESETPASS_SUBJECT;
				$m->Body = _ADMIN_WEBUSERS_RESETPASS_BODY1 . $new . _ADMIN_WEBUSERS_RESETPASS_BODY2;
				if (!$m->Send())
					echo $m->ErrInfo;

				echo _ADMIN_WEBUSERS_RESETPASS_USER1 . $r[web_users_username] . _ADMIN_WEBUSERS_RESETPASS_USER2 . $new . _ADMIN_WEBUSERS_RESETPASS_USER3;
			}
		}
		if ($contactid) {
			$q = mysql_query("select * from web_users where web_users_flname LIKE $contactid and web_users_type='C'");
			if (@!mysql_num_rows($q)) {
				echo _ADMIN_WEBUSERS_RESETPASS_NO_DATA;
			} else {
				$r = mysql_fetch_array($q);
				$new = makepass();
				mysql_query("update web_users set web_users_password = '$new' where web_users_flname = $contactid and web_users_type='C'");
				
				$x = explode(' ',$contactid);
				$fname = $x[0];
				$lname = $x[1];
				$q = mysql_query("select * from studentcontact where studentcontact_fname like '$fname' and studentcontact_lname LIKE '$lname'");
				$r = mysql_fetch_array($q);

				$m = new PHPMailer();
				$m->From = SMTP_FROM_EMAIL;
				$m->Fromname = SMTP_FROM_NAME;
				$m->AddAddress($r['studentcontact_email'], $r['studentcontact_fname']." ".$r['studentcontact_lname']);
				$m->AddReplyTo(SMTP_REPLY_TO, "testing");
				$m->Wordwrap = 60;
				$m->Subject = _ADMIN_WEBUSERS_RESETPASS_SUBJECT;
				$m->Body = _ADMIN_WEBUSERS_RESETPASS_BODY1 . $new . _ADMIN_WEBUSERS_RESETPASS_BODY2;
				if (!$m->Send())
					echo $m->ErrInfo;

				echo _ADMIN_WEBUSERS_RESETPASS_USER1 . $r[web_users_username] . _ADMIN_WEBUSERS_RESETPASS_USER2 . $new . _ADMIN_WEBUSERS_RESETPASS_USER3;
			}
		}
	?>
</div>

<? include "admin_menu.inc.php"; ?>
</body>
</html>
