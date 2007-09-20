<?php
//*
// contacts_menu.php
// Contacts Section
// Main Menu
//*

//Check if contact is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "C")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Inizialize databse functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";
//Include Crypt class
include_once "classCrypt.php";
// config
include_once "configuration.php";

$cfname=$_SESSION['cfname'];
$clname=$_SESSION['clname'];
$cid=$_SESSION['UserId'];

//Get message to display
$msgparents=$db->get_var("SELECT messageto_parents FROM tbl_config WHERE id=1");
//Get allowed students for contact
$sSQL="SELECT studentbio.studentbio_fname, studentbio.studentbio_lname, contact_to_students.contact_to_students_student FROM studentbio INNER JOIN contact_to_students ON studentbio.studentbio_id = contact_to_students.contact_to_students_student where contact_to_students.contact_to_students_contact=$cid AND contact_to_students.contact_to_students_internet=1";
$students=$db->get_results($sSQL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-contact.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0">
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $cfname. " " .$clname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _CONTACTS_MENU_TITLE?></h1>
	<p><?php echo _CONTACTS_MENU_SUBTITLE?></p>
	<br>
	<?php
	if ($students) {
	foreach($students as $student){
	  $keys="SMS-".$student->contact_to_students_student;
	  $crpt = &New EncDec;
	  $crpt->hash="nscegfbzucbrfzugrfzugcr";
	  $studentid=$crpt->phpEncrypt($keys);

	?>
	<a href="contacts_set_student.php?studentid=<?php echo $studentid; ?>" class="aform"><?echo $student->studentbio_fname. " " .$student->studentbio_lname; ?></a><br>
	<?php
	};
	}
	?>
	<hr>
	<p class="msgdisplay"><?php echo $msgparents; ?></p>
</div>
<?php include "contact_menu.inc.php"; ?>
</body>

</html>
