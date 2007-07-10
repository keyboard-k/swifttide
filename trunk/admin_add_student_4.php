<?
//*
// admin_add_student_4.php
// Admin Section
// Search and display contact if present already in database
//v1.5 12-08-05 true multiyear feature
//v1.51 12-08-05 add support for primary field in studentcontact
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

//Get current year
$current_year=$_SESSION['CurrentYear'];

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


//Gather search term
$clname=get_param("clname");

//Search for contact
$tot=$db->get_var("SELECT COUNT(*) FROM studentcontact WHERE 
studentcontact_year='$current_year' AND studentcontact_lname LIKE '%$clname%'");
if ($tot==0){
	$msgFormErr=_ADMIN_ADD_STUDENT_4_FORM_ERROR;
}else{
	//Include paging class
	include_once "ez_results.php";
	//Set layout for paging display
	$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=85%>COL2 COL3</td><td class=paging width=15% align=center><a href=# onclick=submitform('COL1') class=aform>&nbsp;" . _ADMIN_ADD_STUDENT_4_SELECT . "</a></td></tr>";
	$ezr->query_mysql("SELECT studentcontact_id, studentcontact_lname, 
studentcontact_fname FROM studentcontact WHERE studentcontact_lname LIKE '%$clname%' AND 
studentcontact_year='$current_year' ORDER BY studentcontact_lname");
	//Get list of relations
	$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");

};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and validate selection */
function submitform(id)
{
  var f = document.forms[0];
  if (f.relation.value==""){
	  alert("<? echo _ADMIN_ADD_STUDENT_4_ALERT?>");
  }
  else {
      var answer;	
      answer = window.confirm("<? echo _ADMIN_ADD_STUDENT_4_ALERT2?>");
      if (answer == 1) {
      f.contactid.value=id;
      f.submit();
      }
      return false;
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
    <td width="50%"><? echo _ADMIN_ADD_STUDENT_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//No results found
	if ($msgFormErr!=""){
	?>
	   <h1><? echo _ADMIN_ADD_STUDENT_4_TITLE?></h1>
	   <br>
	   <h3><? echo $msgFormErr; ?></h3>
	<?
	}else{
	?>
	   <h1><? echo _ADMIN_ADD_STUDENT_4_TITLE2?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_STUDENT_4_STUDENT?>: <? echo $sfname." ".$slname; ?></h2>
	   <br>
	   <form name="addpcont" method="POST" action="admin_add_student_5.php">
	   <p class="ltext">
	   <select name="relation">
	   <option selected=selected><? echo _ADMIN_ADD_STUDENT_4_SEL_REL?></option>
		  <?
		  //Display relations from table
		  foreach($relations as $relation){
		  ?>
		  <option value="<? echo $relation->relation_codes_id; ?>"><? echo $relation->relation_codes_desc; ?></option>
		   <?
		   };
		   ?>
		</select>
		&nbsp;&nbsp;<? echo _ADMIN_ADD_STUDENT_4_RESIDENCE?>: <input type="checkbox" name="residence" value="1"></p>
	   <?
   	   //Dislay results with paging options
	   $ezr->display();
	};
	?>

	<br>
	<p class="ltxt"><? echo _ADMIN_ADD_STUDENT_4_BACK?></p>
	   <form name="addpcont" method="POST" action="admin_add_student_5.php">
	   <input type="hidden" name="internalid" value="<? echo $internalid; ?>">	
	   <input type="hidden" name="active" value="<? echo $active; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname; ?>">
	   <input type="hidden" name="mi" value="<? echo $mi; ?>">
	   <input type="hidden" name="generation" value="<? echo $generation; ?>">
	   <input type="hidden" name="sped" value="<? echo $sped; ?>">
	   <input type="hidden" name="gender" value="<? echo $gender; ?>">
	   <input type="hidden" name="ethnicity" value="<? echo $ethnicity; ?>">
	   <input type="hidden" name="dob" value="<? echo $dob; ?>">
	   <input type="hidden" name="bcity" value="<? echo $bcity; ?>">
	   <input type="hidden" name="bstate" value="<? echo $bstate; ?>">
	   <input type="hidden" name="bcountry" value="<? echo $bcountry; ?>">
	   <input type="hidden" name="pschoolname" value="<? echo $pschoolname; ?>">
	   <input type="hidden" name="pschooladdress" value="<? echo $pschooladdress; ?>">
	   <input type="hidden" name="pschoolcity" value="<? echo $pschoolcity; ?>">
	   <input type="hidden" name="pschoolstate" value="<? echo $pschoolstate; ?>">
	   <input type="hidden" name="pschoolzip" value="<? echo $pschoolzip; ?>">
	   <input type="hidden" name="pschoolcountry" value="<? echo $pschoolcountry; ?>">
	   <input type="hidden" name="school" value="<? echo $school; ?>">
	   <input type="hidden" name="homed" value="<? echo $homed; ?>">
	   <input type="hidden" name="grade" value="<? echo $grade; ?>">
	   <input type="hidden" name="current_year_id" value="<? echo $current_year_id; ?>">
	   <input type="hidden" name="contactid" value="">
	   <input type="hidden" name="teacher" value="<? echo $teacher; ?>">
	   <input type="hidden" name="homeroom" value="<? echo $homeroom; ?>">
	   <input type="hidden" name="bus" value="<? echo $bus; ?>">
	   </form>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>

