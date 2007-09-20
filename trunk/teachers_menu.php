<?php
//*
// teachers_menu.php
// Teachers Section
// Main Menu
// added list of students with birthday today (Helmut)
//*

// added XHTML syntax to non-closing tags. Tony Sodano (tonysodano@gmail.com) 05.02.05
// added closing link tags.


//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Initialize database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
//Include global functions
include_once "common.php";
// Include configuration
include_once "configuration.php";

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$msgteachers=$db->get_var("SELECT messageto_teachers FROM tbl_config WHERE id=1");

//Get list of rooms
$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_id";
$schoolrooms=$db->get_results($sSQL);

// get students' name whose birthday is today
$sSQL="SELECT studentbio_lname, studentbio_fname, studentbio_gender, school_rooms_desc, studentbio_dob, CURDATE(), (YEAR(CURDATE())-YEAR(studentbio_dob)) - (RIGHT(CURDATE(),5)<RIGHT(studentbio_dob,5)) 
FROM studentbio 
INNER JOIN school_rooms ON studentbio_homeroom = school_rooms_id 
WHERE (MONTH(studentbio_dob) = MONTH(CURDATE())) 
AND (DAY(studentbio_dob) = DAY(CURDATE())) 
ORDER BY studentbio_dob DESC";

if ($srch = $db->get_results($sSQL)){
//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_heading = "<tr class=tblhead>
<td width=16% align=center>" . _TEACHERS_MENU_LASTNAME . "</td>
<td width=17% align=center>" . _TEACHERS_MENU_FIRSTNAME . "</td>
<td width=16% align=center>" . _TEACHERS_MENU_GENDER . "</td>
<td width=17% align=center>" . _TEACHERS_MENU_HOMEROOM . "</td>
<td width=16% align=center>" . _TEACHERS_MENU_DOB . "</td>
<td width=18% align=center>" . _TEACHERS_MENU_AGE . "</td></tr>";

$ezr->results_row = "<tr>
<td class=paging width=16% align=center>COL1</td>
<td class=paging width=17% align=center>COL2</td>
<td class=paging width=16% align=center>COL3</td>
<td class=paging width=17% align=center>COL4</td>
<td class=paging width=16% align=center>COL5</td>
<td class=paging width=18% align=center>COL7</td>
</tr>";
$ezr->results_close = "</table>";
$ezr->query_mysql($sSQL);
$ezr->query_mysql($sSQL);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" />

<html xmlns="http://www.w3.org/1999/xhtml" />

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title />
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"></link><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"></link><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body>
<img src="images/<?php echo _LOGO?>" border="0" />
<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _TEACHERS_MENU_TITLE?></h1>
	<p><?php echo _TEACHERS_MENU_CHOOSE?></p>
	<br /></br>
	<p class="msgdisplay"><?php echo $msgteachers; ?></p>

	<p>&nbsp;</p>
	
	<h2><?php echo _TEACHERS_MENU_BIRTHDAY?></h2>
	<br>
	<p><?php $ezr->display();?></p>

</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>
