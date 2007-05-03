<?
//*
// grade_student_1.php
// Teacher Section
// Form to build bulk grade entering list
//03-26-2005, v .04
//version 1.01 April 30, 2005
//1.01, removed Teacher box, changed button to "build list"
//1.02, 11-24-2005.  Drop-down boxes for term and subjects.  Move "build"
//button to far right.
//*

//Check if Teacher is logged in
//*** Add code to test for teacher instead, or both teacher and admin ***

session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

// *** FINISH THIS UP ***
//Because we are coming here kind of quirky, we need to get the current year differently.
//$sSQL="SELECT current_year FROM tbl_config"; 
//$current_year_id = $db->get_results($sSQL);
//echo "Current Year ID is $current_year_id";
//$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id = 
//$current_year_id";
//$current_year = $db->get_results($sSQL);
//echo "The current year is $current_year";

//Gather all information for drop-downs from basic tables
$sSQL="SELECT * FROM school_names ORDER BY school_names_desc";
$schools = $db->get_results($sSQL);

$sSQL="SELECT * FROM grades ORDER BY grades_desc";
$grades = $db->get_results($sSQL);

$sSQL="SELECT * FROM grade_terms ORDER BY grade_terms_desc";
$terms = $db->get_results($sSQL);

$sSQL="SELECT * FROM grade_subjects ORDER BY grade_subject_desc";
$subjects = $db->get_results($sSQL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
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

<body> <img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _GRADE_STUDENT_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _GRADE_STUDENT_1_TITLE?></h1>
	<br>
	<h2><? echo _GRADE_STUDENT_1_TITLE2?></h2>
	<br>
	  <tr>
	    <td width="80%" height="21">
	      <table border="1" cellpadding="0" cellspacing="0" width="100%">
		    <tr class="trform">
	          <td width="100%" colspan="4">&nbsp;<? echo _GRADE_STUDENT_1_CHOOSE?></td>
	        </tr>
		    <tr>
			  <form name="srchall" method="POST" action="grade_student_2.php">
	          <td width="100%" class="tdinput" colspan="4">
			    <select size="1" name="school">
				   <option value="" selected=selected><? echo _GRADE_STUDENT_1_CHOOSE_SCHOOL?></option>
				   <?
				   //Display Schools from table
				   foreach($schools as $school){
				   ?>
                    <option value="<? echo $school->school_names_id; ?>"><? echo $school->school_names_desc; ?></option>
				   <?
				   };
				   ?>
                </select>
			    <select name="grade">
				   <option value="" selected=selected><? echo _GRADE_STUDENT_1_CHOOSE_GRADE?></option>
				   <?
				   //Display grades from table
				   foreach($grades as $grade){
				   ?>
			       <option value="<? echo $grade->grades_id; ?>"><? echo $grade->grades_desc; ?></option>
				   <?
				   };
				   ?>
			    </select>
			    <select name="term">
				   <option value="" selected=selected><? echo _GRADE_STUDENT_1_CHOOSE_TERM?></option>
				   <?
				   //Display Terms from table
				   foreach($terms as $term){
				   ?>
			       <option value="<? echo $term->grade_terms_id; ?>"><? echo $term->grade_terms_desc; ?></option>
				   <?
				   };
				   ?>
			    </select>
			    <select name="subject">
				   <option value="" selected=selected><? echo _GRADE_STUDENT_1_CHOOSE_SUBJECT?></option>
				   <?
				   //Display subjects from table
				   foreach($subjects as $subject){
				   ?>
			       <option value="<? echo $subject->grade_subject_id; ?>"><? echo $subject->grade_subject_desc; ?></option>
				   <?
				   };
				   ?>
			    </select>
		    <tr class="trform">
			  <td width="25%" class="tdinput" align="center">			  
	          <input type="submit" value="<? echo _GRADE_STUDENT_1_BUILD?>" name="submit" 
class="frmbut">
			  <input type="hidden" name="action" value="srchall"></td>
			  </form>
	        </tr>
			  </table>
	    </td>
	  </tr>
	  <tr>
	    <td width="80%">
		<table border="1" cellpadding="0" cellspacing="0" 
width="80%">
		<tr class="trform">

		</form>
	</tr>
	</table></td> </tr>		
</div>
<? if($_SESSION['UserType'] == "A") {
        include "admin_menu.inc.php";
	        } else {
        include "teacher_menu.inc.php";
}; ?>
</body>

</html>
