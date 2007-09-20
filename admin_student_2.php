<?php
//*
// admin_student_2.php
// Admin Section
// Search and display list of results or redirect to page to display single result
//*
//version 1.01 04-02-05
//v1.5 12-07-05 fix for true multiple years feature

// ***Doug Note***
// At one time, a user could put in a PORTION of the last name and get any 
//matching results.  It might be nice to revisit that functionality down the road.

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

//Get search field info
$action=get_param("action");

//current year for true year feature
$current_year=$_SESSION['CurrentYear'];

//Determine what field(s) to search
switch ($action){

	case "srchid":
		$internalid=get_param("internalid");
		if($id = $db->get_var("SELECT studentbio_id FROM studentbio WHERE studentbio_internalid='$internalid'")){
			$url="admin_edit_student_1.php?studentid=".$id;
			header("Location: $url");
			exit();
		}else{
			$msgFormErr=_ADMIN_STUDENT_2_FORM_ERROR . $internalid;
		};
		break;
	case "srchlname":
		$slname=get_param("slname");
		$tot = $db->get_var("SELECT count(*) FROM studentbio WHERE studentbio_lname = '$slname'");
			if ($tot > 0){
				//Set paging appearence
				$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
				$ezr->results_close = "</table>";
				$ezr->results_row = "<tr><td class=paging width=23%>COL2</td><td class=paging width=23%>COL3</td><td class=paging width=24%>COL4</td><td class=paging width=20%>COL5</td><td class=paging width=10% align=center><a 	href=admin_edit_student_1.php?action=edit&studentid=COL1 class=aform>&nbsp;" . _ADMIN_STUDENT_2_SELECT . "</a></td></tr>";

				$sSQL="SELECT studentbio.studentbio_id, 
studentbio.studentbio_lname, studentbio.studentbio_fname, 
school_names.school_names_desc, grades.grades_desc FROM ((studentbio INNER 
JOIN student_grade_year ON studentbio.studentbio_id = 
student_grade_year.student_grade_year_student) INNER JOIN school_names ON 
studentbio.studentbio_school = school_names.school_names_id) INNER JOIN 
grades ON student_grade_year.student_grade_year_grade = grades.grades_id 
WHERE studentbio.studentbio_lname = '$slname' AND 
student_grade_year_year = '$current_year' ORDER BY 
studentbio.studentbio_lname";
				$ezr->query_mysql($sSQL);
				$ezr->set_qs_val("slname", $slname);
				$ezr->set_qs_val("action", "srchlname"); 
			}else{
				$msgFormErr=_ADMIN_STUDENT_2_FORM_ERROR2 . $slname;
			};
		break;
    case "letter":
		$letter=get_param("letter");
		//Set paging appearence
		$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
		$ezr->results_close = "</table>";
		$ezr->results_row = "<tr>
		<td class=paging width=23%>COL2</td>
		<td class=paging width=23%>COL3</td>
		<td class=paging width=24%>COL4</td>
		<td class=paging width=20%>COL5</td>
		<td class=paging width=10% align=center>
		  <a href=admin_edit_student_1.php?action=edit&studentid=COL1 class=aform>&nbsp;" . _ADMIN_STUDENT_2_SELECT . "</a></td>
		</tr>";
		$sSQL="SELECT studentbio.studentbio_id, 
studentbio.studentbio_lname, studentbio.studentbio_fname, 
school_names.school_names_desc, grades.grades_desc 
FROM ((studentbio 
INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id 
WHERE studentbio.studentbio_lname LIKE '$letter%' 
AND student_grade_year_year = '$current_year' 
ORDER BY studentbio.studentbio_lname";
		$ezr->query_mysql($sSQL);
		$ezr->set_qs_val("letter", $letter);
		$ezr->set_qs_val("action", "letter"); 	
		break;
	case "srchall":
		$clause="";
		$school=get_param("school");
		$grade=get_param("grade");
		$gender=get_param("gender");
		$ethnicity=get_param("ethnicity");
		$active=get_param("active");
		$homed=get_param("homed");
		$sped=get_param("sped");
		//Construct the search clause
		if(strlen($school)){
			$clause.=" AND studentbio.studentbio_school=$school";
		};
		if(strlen($grade)){
			$clause.=" AND student_grade_year.student_grade_year_grade=$grade";
		};
		if(strlen($gender)){
			$clause.=" AND studentbio.studentbio_gender='$gender'";
		};
		if(strlen($ethnicity)){
			$clause.=" AND studentbio.studentbio_ethnicity=$ethnicity";
		};
		if(strlen($active)){
			$clause.=" AND studentbio.studentbio_active=1";
		}else{
			$clause.=" AND studentbio.studentbio_active<>1";
		};
		if(strlen($homed)){
			$clause.=" AND studentbio.studentbio_homed=1";
		}else{
			$clause.=" AND (studentbio.studentbio_homed=0 OR studentbio.studentbio_homed IS NULL)";
		};
		if(strlen($sped)){
			$clause.=" AND studentbio.studentbio_sped=1";
		}else{
			$clause.=" AND (studentbio.studentbio_sped=0 OR studentbio.studentbio_sped IS NULL)";
		};
	    //Main SQL
		$sSQL="SELECT studentbio.studentbio_id, studentbio.studentbio_lname, 
studentbio.studentbio_fname, school_names.school_names_desc, grades.grades_desc FROM 
((studentbio INNER JOIN student_grade_year ON studentbio.studentbio_id = 
student_grade_year.student_grade_year_student) INNER JOIN school_names ON 
studentbio.studentbio_school = school_names.school_names_id) INNER JOIN grades ON 
student_grade_year.student_grade_year_grade = grades.grades_id WHERE 
student_grade_year_year='$current_year' AND studentbio.studentbio_id >0";
		$sSQL.=$clause." ORDER BY studentbio.studentbio_lname";
		if ($srch = $db->get_results($sSQL)){	
			//Set paging appearence
			$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
			$ezr->results_close = "</table>";
			$ezr->results_row = "<tr><td class=paging width=23%>COL2</td><td class=paging width=23%>COL3</td><td class=paging width=24%>COL4</td><td class=paging width=20%>COL5</td><td class=paging width=10% align=center><a 	href=admin_edit_student_1.php?action=edit&studentid=COL1 class=aform>&nbsp;" . _ADMIN_STUDENT_2_SELECT . "</a></td></tr>";
			$ezr->query_mysql($sSQL);							
			$ezr->set_qs_val("action", "srchall"); 
			$ezr->set_qs_val("school", $school);
			$ezr->set_qs_val("gender", $gender);
			$ezr->set_qs_val("ethnicity", $ethnicity);
			$ezr->set_qs_val("active", $active);
			$ezr->set_qs_val("homed", $homed);
			$ezr->set_qs_val("sped", $sped);

		}else{
			$msgFormErr=_ADMIN_STUDENT_2_FORM_ERROR3;
		};
		break;
}
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
    <td width="50%"><?php echo _ADMIN_STUDENT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_STUDENT_2_TITLE?></h1>
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
	<A class="aform" href="admin_student_1.php"><?php echo _ADMIN_STUDENT_2_NEW?></a>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
