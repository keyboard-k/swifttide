<?php
//*
// grade_student_2.php
// Teacher Section
// Build the list of students for bulk grade entering
//Modified 11-24-2005 to incorporate fixes from step 1.
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
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// Include configuration
include_once "configuration.php";

$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];
$grade = get_param("grade");
$school = get_param("school");
$subject=get_param("subject");
$term=get_param("term");
$_SESSION[school]=$school;
$_SESSION[subject]=tosql($subject, "Text");
$_SESSION[term]=$term;

//Validate some important fields
$msgFormErr="";
if(!strlen($term)){
	$msgFormErr.= _GRADE_STUDENT_2_ENTER_TERM . "<br>";
};
if(!strlen($subject)){
	$msgFormErr.= _GRADE_STUDENT_2_ENTER_SUBJECT . "<br>";
};

//create the OpenPop function
//close php for a second while we create this javascript function
?>

<script>
function openPop(){
  PrivoxyWindowOpen(",'popup','top=100,left=100,width=300,heigth=300');
  return true;
}
</script>

<?php
//Now re-open php

//Get search field info
$action=get_param("action");

//Determine what field(s) to search
switch ($action){
	case "srchall":
		$clause="";
		$school=get_param("school");
		$grade=get_param("grade");
		$gender=get_param("gender");
		$ethnicity=get_param("ethnicity");
		//Construct the search clause
		if(strlen($school)){
			$clause.=" AND studentbio.studentbio_school=$school";
		};
		if(strlen($grade)){
			$clause.=" AND student_grade_year.student_grade_year_grade=$grade";
		};
	    //Main SQL
		$sSQL="SELECT studentbio.studentbio_id, studentbio.studentbio_lname, studentbio.studentbio_fname, school_names.school_names_desc, grades.grades_desc FROM ((studentbio INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id WHERE studentbio.studentbio_id >0";
		$sSQL.=$clause." ORDER BY studentbio.studentbio_lname";
		if ($srch = $db->get_results($sSQL)){	
			//Set paging appearence
			$ezr->num_results_per_page=100;
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_row = "<tr><td class=paging width=23%>COL2</td><td class=paging width=23%>COL3</td><td class=paging width=24%>COL4</td><td class=paging width=20%>COL5</td><td class=paging width=10% align=center><a 	href='grade_student_3.php?action=edit&studentid=COL1' target='popup' OnClick='openPop()' class=aform>&nbsp;" . _GRADE_STUDENT_2_SELECT . "</a></td></tr>";
			$ezr->query_mysql($sSQL);
			$ezr->set_qs_val("action", "srchall"); 
			$ezr->set_qs_val("school", $school);

		}else{
			$msgFormErr=_GRADE_STUDENT_2_FORM_ERROR;
		};
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<b><?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%" align="right"><?php echo _GRADE_STUDENT_2_TEACHER_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _GRADE_STUDENT_2_TITLE?></h1>
	<br>
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
	<A class="aform" href="grade_student_1.php"><?php echo _GRADE_STUDENT_2_NEW?></a>
</div>
<? if($_SESSION['UserType'] == "A") {
        include "admin_menu.inc.php";
        } else {
        include "teacher_menu.inc.php";
}; ?>
</body>

</html>
