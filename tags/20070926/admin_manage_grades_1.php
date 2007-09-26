<?php
//*
// admin_manage_grades_1.php
// Admin Section
// Display grades for student
//*

//Check if admin is logged in
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
$msgFormErr="";

//Set proper menu
$menustudent=1;

//Get student id
$studentid=get_param("studentid");
if(!strlen($studentid)){
	$msgFormErr=_ADMIN_MANAGE_GRADES_1_FORM_ERROR . "<br>";
}else{
	//Get Student Name
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	//Get grade history
	$sSQL="SELECT grade_terms.grade_terms_desc, 
grade_subjects.grade_subject_desc, 
grade_history.grade_history_grade, 
grade_history.grade_history_effort, grade_history.grade_history_conduct, 
grade_history.grade_history_id 
FROM ((grade_history 
INNER JOIN grade_terms ON grade_history.grade_history_quarter=grade_terms.grade_terms_id) 
INNER JOIN grade_subjects ON grade_history.grade_history_subject = grade_subjects.grade_subject_id) 
WHERE grade_history.grade_history_student = '$studentid' 
ORDER BY grade_history.grade_history_quarter DESC";
	//Set paging appearence
	$ezr->results_open = "<table width=80% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_heading = "<tr class=tblhead>
	<td width=20%>" . _ADMIN_MANAGE_GRADES_1_QUARTER . "</td>
	<td width=20%>" . _ADMIN_MANAGE_GRADES_1_SUBJECT . "</td>
	<td width=15%>" . _ADMIN_MANAGE_GRADES_1_GRADE . "</td>
	<td width=15%>" . _ADMIN_MANAGE_GRADES_1_EFFORT . "</td>
	<td width=15%>" . _ADMIN_MANAGE_GRADES_1_CONDUCT . "</td>
	<td width=15%>" . _ADMIN_MANAGE_GRADES_1_DETAILS . "</td>
	</tr>"; 
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr>
	<td class=paging width=20% align=center>COL1</td>
	<td class=paging width=20% align=center>COL2</td>
	<td class=paging width=15% align=center>COL3</td>
	<td class=paging width=15% align=center>COL4</td>
	<td class=paging width=15% align=center>COL5</td>
	<td class=paging width=15% align=center>
	  <a href=admin_manage_grades_2.php?studentid=$studentid&gradeid=COL6 class=aform>
	  &nbsp;" . _ADMIN_MANAGE_GRADES_1_DETAILS . "</a></td>
	</tr>";
	$ezr->query_mysql($sSQL);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_MANAGE_GRADES_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _ADMIN_MANAGE_GRADES_1_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname; ?></h2>
	<br>
	<?php
	$ezr->display();
	?>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="80%">
	  <tr>
	    <td width="50%"><a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_MANAGE_GRADES_1_BACK?></a></td>
	    <td width="50%" align="right"><a href="admin_manage_grades_3.php?studentid=<?php echo $studentid; ?>&action=new" class="aform"><?php echo _ADMIN_MANAGE_GRADES_1_ADD?></a></td>
	  </tr>
	</table>
	<?php
	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<?php
	};
	?>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
