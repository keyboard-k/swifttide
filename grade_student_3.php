<?php
//*
// teacher_manage_grades_3.php
// Teachers Section
// Edit grades for student
//*

//Check if teacher is logged in
session_start();
  if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
  }

//Include global functions
include_once "common.php";
//Include db functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];
$term= $_SESSION[term];
$subject= $_SESSION[subject];

$sSQL="SELECT grade_terms.grade_terms_desc FROM grade_terms WHERE grade_terms.grade_terms_id=$term";
$term_disp=$db->get_var($sSQL);
$sSQL= "SELECT grade_subject_desc FROM grade_subjects WHERE grade_subject_id=$subject";
$subject_disp = $db->get_var($sSQL);

//Get student id
$studentid=get_param("studentid");

// *** to carryover to next form,  kind of a kludge
$_SESSION[kidid]=$studentid;
$_SESSION[currentyear]=$current_year;

	//Get student names
	$sSQL="SELECT studentbio_fname, studentbio_lname, studentbio_school FROM studentbio WHERE studentbio_id=$studentid";
	$student=$db->get_row($sSQL);
	$slname=$student->studentbio_lname;
	$sfname=$student->studentbio_fname;
	$sschoolid=$student->studentbio_school;;
	//Get Year
	$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year";
	$cyear=$db->get_var($sSQL);
	//Get School
	$sSQL="SELECT school_names_desc FROM school_names WHERE school_names_id=$sschoolid";
	$sschool=$db->get_var($sSQL);

//Get list of grade codes
$gradecodes=$db->get_results("SELECT * FROM grade_names ORDER BY grade_names_desc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _GRADE_STUDENT_3_TITLE?></h1>
	<br>
	<h2><?php echo $sfname. " " .$slname ; ?></h2>
	<br>
	<h2><?php echo _GRADE_STUDENT_3_TITLE2?>Grade for Term <? echo $term_disp; ?></h2>
	<table border="1" cellpadding="0" cellspacing="0" width="70%">
	<form name="attendance" method="POST" action="grade_student_4.php">
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_SCHOOL?></td>
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_YEAR?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $sschool ; ?></td>
	    <td width="50%">&nbsp;<?php echo $cyear ; ?></td>
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_SUBJECT?></td>
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_OVERALL?></td>
	  </tr>
	  <tr class="tblcont">
	    <td width="50%">&nbsp;<?php echo $subject_disp ; ?></td>
	    <td width="50%" class="tdinput">
            <input type="text" name="overall" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_effort);};?>">
	     </td>
          </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_EFFORT?></td>
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_CONDUCT?></td>
	  </tr>
	  <tr class="tblcont">
		<td width="50%" class="tdinput">
			<input type="text" name="effort" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_effort);};?>">
		</td>
		<td width="50%" class="tdinput">
			<input type="text" name="conduct" onchange="this.value=this.value.toUpperCase();" maxlength="5" size="10" value="<? if($action=="edit"){echo strip($grade->grade_history_conduct);};?>">
		</td>	    
	  </tr>
	  <tr class="trform">
	    <td width="50%">&nbsp;<?php echo _GRADE_STUDENT_3_COMMENTS?></td>
	    <td width="50%">&nbsp;</td>
	  </tr>
	  <tr class="tblcont">
		<td width="100%" class="tdinput" colspan="2">
			  <select name="comment1">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <? if ($gradecode->grade_names_id==$grade->grade_history_comment1){echo "selected=selected";};?>><? echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
		</tr>
		<tr class="tblcont">
		<td width="100%" class="tdinput" colspan="2">
			  <select name="comment2">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <? if ($gradecode->grade_names_id==$grade->grade_history_comment2){echo "selected=selected";};?>><? echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
	  </tr>
	  <tr class="tblcont">
	    <td width="100%" class="tdinput" colspan="2">
			  <select name="comment3">
			   <?php
			   //Display grades codes from table
			   foreach($gradecodes as $gradecode){
			   ?>
		       <option value="<?php echo $gradecode->grade_names_id; ?>" <? if ($gradecode->grade_names_id==$grade->grade_history_comment3){echo "selected=selected";};?>><? echo $gradecode->grade_names_desc; ?></option>
			   <?php
			   };
			   ?>
			   </select>
		</td>
	  </tr>
	  <tr class="trform">
	    <td width="100%" colspan="2">&nbsp;<?php echo _GRADE_STUDENT_3_NOTES?></td>
	  </tr>
	  <tr class="tdinput">
	    <td width="100%" colspan="2">&nbsp;<textarea name="gradenotes" cols="40" rows="5"><? if($action=="edit"){echo strip($grade->grade_history_notes);};?></textarea></td>
	  </tr>
	  <?php
	  if($action=="new"){
	  ?>
	  <tr>
	    <td width="100%" colspan="2" class="tdinput">&nbsp;<?php echo _GRADE_STUDENT_3_NOTIFY?>:<input type="checkbox" name="notify" value="1" checked=checked></td>
		<input type="hidden" name="sschool" value="<?php echo $sschoolid; ?>">
	  </tr>
	  <?php
	  };
	  ?>
	<table>
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	    <td width="50%"><a href="teacher_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><? echo _GRADE_STUDENT_3_BACK?></a></td>
	    <td width="50%" align="right"><input type="submit" name="submit" value="<? if($action=="edit"){echo _GRADE_STUDENT_3_UPDATE;}else{echo _GRADE_STUDENT_3_ADD;};?>" class="frmbut"></td>
	  </tr>
	  <input type="hidden" name="gradeid" value="<?php echo $gradeid; ?>">
	  <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	  <input type="hidden" name="action" value="<? if($action=="edit"){echo "update";}else{echo "new";};?>">
	</table>
</div>
</body>

</html>
