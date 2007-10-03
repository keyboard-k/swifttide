<?php
//Check if admin is logged in
session_start();
if(!session_is_registered('UserId'))
  {
    header ("Location: index.php?action=notauth");
	exit;
}

// Include configuration
include_once "configuration.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left" class="forum"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%" class="forum"><?php echo _SHOWMESSAGE_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
<?php
include("myphpforum.php");
$myforum=new myphpforum();
$myforum->display_thread();
?>
</div>
<? 
$usertype=$_SESSION['UserType'];
switch ($usertype){
	case "A":
		include "admin_menu_forum.inc.php";
		break;
	case "T":
		include "teacher_menu_forum.inc.php";
		break;
	case "N":
		include "health_menu_forum.inc.php";
		break;
	case "C":
		include "contact_menu_forum.inc.php";
		break;
}
		?>
</body>

</html>
