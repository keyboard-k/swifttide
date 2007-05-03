<?
//*
// admin_add_student_5.php
// Admin Section
// Process the primary contact  from database and save all info in database
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
// config
include_once "configuration.php";

//Gather info from form post
//Student
$internalid=get_param("internalid");
$active=get_param("active");
$slname=get_param("slname");
$sfname=get_param("sfname");
$mi=get_param("mi");
$generation=get_param("generation");
$sped=get_param("sped");
$gender=get_param("gender");
$ethnicity=get_param("ethnicity");
$dob=get_param("dob");
$dob=date( "Y-m-d", strtotime($dob));
$bcity=get_param("bcity");
$bstate=get_param("bstate");
$bcountry=get_param("bcountry");
$pschoolname=get_param("pschoolname");
$pschooladdress=get_param("pschooladdress");
$pschoolcity=get_param("pschoolcity");
$pschoolstate=get_param("pschoolstate");
$pschoolzip=get_param("pschoolzip");
$pschoolcountry=get_param("pschoolcountry");
$school=get_param("school");
$homed=get_param("homed");
$grade=get_param("grade");
$current_year_id=get_param("current_year_id");
$teacher=get_param("teacher");
$homeroom=get_param("homeroom");
$bus=get_param("bus");


//Get contact info from database
$contactid=get_param("contactid");
$sSQL="SELECT studentcontact_lname, studentcontact_fname FROM studentcontact WHERE studentcontact_id=$contactid";
$contact=$db->get_row($sSQL);
$cfname=$contact->studentcontact_fname;
$clname=$contact->studentcontact_lname;
$relation=get_param("relation");
$residence=get_param("residence");
if(!strlen($residence)){
	$residence=0;
};


//Insert Student Bio
$sSQL = "insert into studentbio (" . 
  "studentbio_internalid," . 
  "studentbio_active," . 
  "studentbio_lname," . 
  "studentbio_fname," . 
  "studentbio_mi," . 
  "studentbio_generation," . 
  "studentbio_sped," . 
  "studentbio_gender," . 
  "studentbio_ethnicity," . 
  "studentbio_dob," . 
  "studentbio_birthcity," . 
  "studentbio_birthstate," . 
  "studentbio_birthcountry," . 
  "studentbio_prevschoolname," . 
  "studentbio_prevschooladdress," . 
  "studentbio_prevschoolcity," . 
  "studentbio_prevschoolstate," . 
  "studentbio_prevschoolzip," .
  "studentbio_prevschoolcountry," . 		
  "studentbio_homed," . 		
  "studentbio_primarycontact," . 		
  "studentbio_teacher," . 		
  "studentbio_homeroom," . 		
  "studentbio_bus," . 		
  "studentbio_school)" . 
  " values (" . 
  tosql($internalid, "Text") . "," . 
  tosql($active, "Number") . "," . 
  tosql($slname, "Text") . "," . 
  tosql($sfname, "Text") . "," . 
  tosql($mi, "Text") . "," . 
  tosql($generation, "Number") . "," . 
  tosql($sped, "Number") . "," . 
  tosql($gender, "Text") . "," . 
  tosql($ethnicity, "Number") . "," . 
  tosql($dob, "Text") . "," . 
  tosql($bcity, "Text") . "," . 
  tosql($bstate, "Text") . "," . 
  tosql($bcountry, "Text") . "," . 
  tosql($pschoolname, "Text") . "," . 
  tosql($pschooladdress, "Text") . "," . 
  tosql($pschoolcity, "Text") . "," . 
  tosql($pschoolstate, "Text") . "," . 
  tosql($pschoolzip, "Text") . "," . 
  tosql($pschoolcountry, "Text") . "," . 
  tosql($homed, "Number") . "," . 
  tosql($contactid, "Number") . "," . 
  tosql($teacher, "Number") . "," . 
  tosql($homeroom, "Text") . "," . 
  tosql($bus, "Text") . "," . 
  tosql($school, "Number") .  
  ")";
  $db->query($sSQL);
  $studentid=mysql_insert_id();
  
  //Set grade for current year
  $sSQL="INSERT INTO student_grade_year (student_grade_year_student, student_grade_year_grade, student_grade_year_year) VALUES ($studentid, $grade, $current_year_id)";
  $db->query($sSQL);

  //Insert ids in relation table
  // pq - 2007-02-22 - set as primary like done in admin_add_student_3.php
  $sSQL="INSERT INTO contact_to_students (contact_to_students_contact, contact_to_students_student, contact_to_students_relation, contact_to_students_residence, contact_to_students_primary) VALUES ($contactid, $studentid, $relation, $residence, 1)";
  $db->query($sSQL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if fields are empty */
function submitform()
{
  var f = document.forms[0];
  var x = "";
  var t = f.elements['email']; 
  if (t.value=="") 
     x = x+"x";
  var t = f.elements['username']; 
  if (t.value=="") 
     x = x+"x";
  var t = f.elements['password']; 
  if (t.value=="") 
     x = x+"x";

  if (x != ""){
	  alert('<? echo _ADMIN_ADD_STUDENT_5_ENTER_ALL?>');
	  return false;
  }
  else{
	  return true;
  }
}
</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_ADD_STUDENT_5_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	   <h1><? echo _ADMIN_ADD_STUDENT_5_TITLE_SUCCESS?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_STUDENT_5_STUDENT?>: <? echo $sfname." ".$slname; ?></h2>
	   <br>
	   <h2><? echo _ADMIN_ADD_STUDENT_5_CONTACT?>: <? echo $cfname." ".$clname; ?></h2>
	   <br>
	   <p class="ltext"><? echo _ADMIN_ADD_STUDENT_5_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><? echo _ADMIN_ADD_STUDENT_5_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<? echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo _ADMIN_ADD_STUDENT_5_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10">&nbsp;
	   <? echo _ADMIN_ADD_STUDENT_5_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10"></p>
	   <input type="submit" name="submit" value="<? echo _ADMIN_ADD_STUDENT_5_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<? echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname ; ?>">
	   </form>
	   <a href="admin_add_edit_contact_1.php?id=<? echo $studentid; ?>&action=add" class="aform"><? echo _ADMIN_ADD_STUDENT_5_ADD_NEW?></a>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>

