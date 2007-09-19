<?
//*
// admin_add_edit_contact_3.php
// Admin Section
// Search and display contact if present already in database
//v1.5 12-08-05 true multiyear features
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

//get current year
$current_year=$_SESSION['CurrentYear'];

//Gather info from form post

//Student
$studentid=get_param("studentid");
$slname=get_param("slname");
$sfname=get_param("sfname");

//Gather search term
$clname=get_param("clname");

//Set appropriate menu
$rback=get_param("rback");
if(strlen($rback)){
	$menustudent=1;
};

//Search for contact
//This is when we check only the contacts that are not already assigned to the student
$sSQL="SELECT contact_to_students_contact FROM contact_to_students WHERE 
contact_to_students_student=$studentid AND contact_to_students_year='$current_year'";
$non=$db->get_results($sSQL);
$i=-1;
foreach($non as $nlist){
	$i=$i+1;
	$list[$i]=$nlist->contact_to_students_contact;
}
$nlist=implode(",", $list);
$sSQL="SELECT count(*) FROM studentcontact WHERE studentcontact_id NOT IN ($nlist) AND studentcontact_lname LIKE '%$clname%'";
$tot=$db->get_var($sSQL);
if ($tot==0){
	$msgFormErr=_ADMIN_ADD_EDIT_CONTACT_3_FORM_ERROR;
}else{
	$sSQL="SELECT studentcontact_id, studentcontact_lname, studentcontact_fname FROM 
studentcontact WHERE studentcontact_id NOT IN ($nlist) AND studentcontact_lname LIKE 
'%$clname%' AND studentcontact_year='$current_year'";
	//Include paging class
	include_once "ez_results.php";
	//Set layout for paging display
	$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
	$ezr->results_close = "</table>";
	$ezr->results_row = "<tr><td class=paging width=85%>COL2 COL3</td><td class=paging width=15% align=center><a href=# onclick=submitform('COL1') class=aform>&nbsp;Select</a></td></tr>";
	$ezr->query_mysql($sSQL);
	
	//Get list of relations
	$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and validate selection */
/* Javascript function to submit form and validate selection */
function submitform(id)
{
  var f = document.forms[0];
  if (f.relation.selectedIndex==0){
	  alert("<?php echo _ADMIN_ADD_EDIT_CONTACT_3_ENTER_RELATION?>");
  }
  else {
      var answer;	
      answer = window.confirm("<?php echo _ADMIN_ADD_EDIT_CONTACT_3_CONFIRM?>");
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

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_ADD_EDIT_CONTACT_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	//No results found
	if ($msgFormErr!=""){
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_CONTACT_3_TITLE?></h1>
	   <br>
	   <h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_CONTACT_3_CHOOSE?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_EDIT_CONTACT_3_STUDENT?>: <?php echo $sfname." ".$slname; ?></h2>
	   <br>
	   <form name="addpcont" method="POST" action="admin_add_edit_contact_4.php">
	   <p class="ltext">
	   <select name="relation">
	   <option selected=selected><?php echo _ADMIN_ADD_EDIT_CONTACT_3_SEL_REL?></option>
		  <?php
		  //Display relations from table
		  foreach($relations as $relation){
		  ?>
		  <option value="<?php echo $relation->relation_codes_id; ?>"><?php echo $relation->relation_codes_desc; ?></option>
		   <?php
		   };
		   ?>
		</select>
		&nbsp;&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_3_RESIDENCE?>: <input type="checkbox" name="residence" value="1"></p>
	   <?
   	   //Dislay results with paging options
	   $ezr->display();
	};
	?>
	<br>
	<a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_ADD_EDIT_CONTACT_3_BACK?></a>
	   <input type="hidden" name="internalid" value="<?php echo $internalid; ?>">	
	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	   <input type="hidden" name="slname" value="<?php echo $slname; ?>">
	   <input type="hidden" name="sfname" value="<?php echo $sfname; ?>">
	   <input type="hidden" name="contactid" value="">
	   <?php
	   if($menustudent==1){
	   ?>
			<input type="hidden" name="rback" value="rback">	   
	   <?php
	   };
	   ?>
	   </form>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>

