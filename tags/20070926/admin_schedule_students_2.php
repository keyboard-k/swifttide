<?php
//*
// admin_schedule_students_2.php
// Admin Section
// Build the list of students for scheduling
// V1.0 April 19, 2006
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

//This grade is the TEXT grade, not the # that should be stored!  FIX!
$grade=get_param("grade");
$schedid=get_param("schedid");
$year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];

//Validate some important fields
$msgFormErr="";
//if(!strlen($grade)){
//	$msgFormErr.=_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR . "<br>";
if($grade<0){
        $msgFormErr.=_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR . "<br>";
};

//Get the #s from the schedule entry
$sSQL="SELECT teacher_schedule_id, teacher_schedule_year, 
teacher_schedule_subjectid, teacher_schedule_termid, 
teacher_schedule_classperiod, teacher_schedule_teacherid, teacher_schedule_year FROM teacher_schedule WHERE teacher_schedule_id='$schedid'"; 

$schednum=$db->get_row($sSQL);
$subject=$schednum->teacher_schedule_subjectid;

//Gather info on the relevant schedule
$sSQL="SELECT school_years_desc,
grade_terms.grade_terms_desc,
grade_subjects.grade_subject_desc, teacher_schedule_classperiod,
teacher_schedule_id, teacher_schedule_teacherid  FROM
(((teacher_schedule INNER JOIN
grade_terms ON teacher_schedule_termid=grade_terms_id) INNER JOIN
grade_subjects ON teacher_schedule_subjectid=grade_subject_id) INNER
JOIN school_years ON teacher_schedule_year=school_years.school_years_id) 
WHERE teacher_schedule_id='$schedid'";

$sched_info=$db->get_row($sSQL);

//$subject=$crap->grade_subject_desc;
$subj_desc=$sched_info->grade_subject_desc;
$period=$sched_info->teacher_schedule_classperiod;
$term=$sched_info->grade_terms_desc;
$teacher=$sched_info->teacher_schedule_teacherid;
//Gather Teacher info
$sSQL="SELECT * FROM teachers WHERE teachers_id=$teacher";
//echo "the sql is $sSQL";
$teacher_info=$db->get_row($sSQL);

$tfname=$teacher_info->teachers_fname;
$tlname=$teacher_info->teachers_lname;
$tschool=$teacher_info->teachers_school;

//Get search field info
$action=get_param("action");

//Determine what field(s) to search

		$clause="";
		//$grade=get_param("grade");
		//Construct the search clause
			$clause.=" AND student_grade_year.student_grade_year_grade=$grade";
	    //Main SQL
		$sSQL="SELECT studentbio.studentbio_id, studentbio.studentbio_lname, studentbio.studentbio_fname, school_names.school_names_desc, grades.grades_desc FROM ((studentbio INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id WHERE studentbio.studentbio_id >0";
		$sSQL.=$clause." ORDER BY studentbio.studentbio_lname";
		if ($srch = $db->get_results($sSQL)){	
			//Set paging appearence
			$ezr->num_results_per_page=100;
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_row = "<tr><td class=paging width=23%>COL2</td><td class=paging width=23%>COL3</td><td class=paging width=24%>COL4</td><td class=paging width=20%>COL5</td><td class=paging width=10% align=center><input type=\"checkbox\" name=\"clear[COL1]\" value=\"1\" /></td></tr>";
			$ezr->query_mysql($sSQL);
			$ezr->set_qs_val("action", "srchall"); 
			$ezr->set_qs_val("school", $school);

		}else{
			$msgFormErr=_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR2;
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
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<b><?php echo 
date(_DATE_FORMAT); ?></b></font></td>
    <td width="50%"><b><?php echo _ADMIN_SCHEDULE_STUDENT_2_UPPER?></b></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_SCHEDULE_STUDENT_2_TITLE?></h1>
	<br>
	<h2><?php echo _ADMIN_SCHEDULE_STUDENT_2_CLASS?> <?php echo $tfname. " " .$tlname. " " .$subj_desc. " " 
.$term . _ADMIN_SCHEDULE_STUDENT_2_PERIOD . $period ?></h2>

<?php
//This line is a bit of a mess, shows extraneous chars on the address line
//but it does work.  Nice to clean it up at some point
?>
	<form id="add" name="add" method="post" action="admin_student_5.php">
	<?php
	if (strlen($msgFormErr)){
		//No results
	?>
		<h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
		//Dislay results with paging options
		$ezr->display();
	};
	?>
	<br>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td><A class="aform" href="admin_student_1.php"><?php echo _ADMIN_SCHEDULE_STUDENT_2_NEW?></a></td>
		<td align="right"><input type="submit" name="submit" value="<?php echo _ADMIN_SCHEDULE_STUDENT_2_ADD?>"></td>
	  </tr>
	</table>
	
<?php
	echo('<input type="hidden" name="id" value="'.$schedid.'">');
	echo('<input type="hidden" name="schoolid" 
value="'.$tschool.'">');
?>
    </form>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
