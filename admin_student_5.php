<?php
//Version 1.1 030507 doug, display students in schedule when done.

session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
	{
	  header ("Location: index.php?action=notauth");
		exit;
}

include_once "ez_sql.php";
include_once "common.php";
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get current Year and School ID
$cyear=$_SESSION['CurrentYear'];
$schoolid=get_param("schoolid");
$studentid=get_param("studentid");
//We'll get the schedule id below, it's called schedid2

$clear = $_POST['clear'];
reset($clear);
//echo('Schedule ID -> ' . substr($_POST['id'],0,strlen($_POST['id'])-4) . '<br><br>');

foreach($clear as $clr)
{
	if($clr==1)
	{
	$studentid2=key($clear);
	$schedid2=substr($_POST['id'],0,strlen($_POST['id'])-4);
	$check="SELECT count(*) FROM student_schedule WHERE 
student_schedule_studentid=$studentid2 AND student_schedule_year=$cyear 
AND student_schedule_schoolid=$schoolid AND 
student_schedule_schedid=$schedid2";
	//echo "sched is $schedid2 and studentid is $studentid2";
	$tot=$db->get_var($check);
		if($tot>0){
	         echo _ADMIN_STUDENT_5_DUP;
		}else{
		$query = "INSERT INTO student_schedule 
(student_schedule_id, 
student_schedule_studentid, 
student_schedule_year, 
student_schedule_schoolid, student_schedule_schedid)
				  VALUES(0," . key($clear) . 
",$cyear,$schoolid," . substr($_POST['id'],0,strlen($_POST['id'])-4) . 
");";
		// echo($query."<br><br>");
		$db->query($query);
		//echo('Student ID -> ' . key($clear) . '... to be inserted<br>');
	}
	next($clear);
}
}
//Get the readable schedule information
$sSQL="SELECT school_years_desc,
grade_terms.grade_terms_desc,
grade_subjects.grade_subject_desc, teacher_schedule_classperiod,
teacher_schedule_id, teacher_schedule_teacherid  FROM
((teacher_schedule INNER JOIN
grade_terms ON teacher_schedule_termid=grade_terms_id) INNER JOIN
grade_subjects ON teacher_schedule_subjectid=grade_subject_id) INNER
JOIN school_years ON teacher_schedule_year=school_years.school_years_id
WHERE teacher_schedule_id=$schedid2";

$sched_info=$db->get_row($sSQL);


$sSQL_k="SELECT studentbio.studentbio_id, studentbio.studentbio_fname,
studentbio.studentbio_lname FROM (studentbio INNER JOIN student_schedule
ON
studentbio.studentbio_id =
student_schedule.student_schedule_studentid) WHERE 
student_schedule.student_schedule_schedid =$schedid2";

//$crap=$db->query($sSQL_k);
//$studid=$crap->studentbio.studentbio_id;
//echo "Schedid is $schedid2";

$subject=$sched_info->grade_subject_desc;
$period=$sched_info->teacher_schedule_classperiod;
$term=$sched_info->grade_terms_desc;
$teacher=$sched_info->teacher_schedule_teacherid;
$teacherid2=$teacher;   //ugly bandaid but it works

//Gather Teacher info
$sSQL="SELECT * FROM teachers WHERE teachers_id=$teacher";
$teacher_info=$db->get_row($sSQL);

$tfname=$teacher_info->teachers_fname;

//Set paging appearence
$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=40%>COL2</td><td
class=paging width=40%>COL3</td><td class paging
width=20% align=center><a
href=admin_schedule_teach_2.php?action=remove&studentid=COL1&teacherid=$teacherid2&schedid=$schedid2
class=aform>&nbsp;" . _ADMIN_STUDENT_5_REMOVE . "</a></td></tr>";
$ezr->query_mysql($sSQL_k);
$ezr->set_qs_val("schedid", $schedid2);
//$ezr->set_qs_val("action", "srchlname");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link
rel="shortcut ico$

<script type="text/javascript" language="JavaScript"
src="sms.js"></script>

</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
      <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
          <td width="50%"><?php echo _ADMIN_STUDENT_5_UPPER?></td>
	    </tr>
	    </table>
	    </div>

<div id="Content">
        <h1><?php echo _ADMIN_STUDENT_5_TITLE?></h1>
	<br>
	<?php
	if (strlen($msgFormErr)){

		//They tried to add duplicates
	?>
		<h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
		//This line is just a holder.  We want the error, but we
		//still want the display
	};

		//Dislay results with paging options
		$ezr->display();
	?>
	<br>
	<A class="aform" href="admin_student_1.php"><?php echo _ADMIN_STUDENT_5_BACK?></a>
	<br>
	<A class="aform" href="admin_schedule_teach_2.php&teacherid=$teacherid2&schedid=$schedid2">
	<?php echo _ADMIN_STUDENT_5_CHANGE?></a> </div>
<?php include "admin_menu.inc.php"; ?>
</body>
</html>
