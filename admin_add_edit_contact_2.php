<?
//*
// admin_add_edit_contact_2.php
// Admin Section
// Process update/add contact
//v1.5 true multiyear features
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

//Gather info from form
$title=get_param("title");
$fname=get_param("cfname");
$lname=get_param("clname");
$relation=get_param("relation");
$address1=get_param("address1");
$address2=get_param("address2");
$city=get_param("city");
$state=get_param("state");
$zip=get_param("zip");
$phone1=get_param("phone1");
$phone2=get_param("phone2");
$phone3=get_param("phone3");
$email=get_param("email");
$other=get_param("other");
$mailings=get_param("mailings");
$studentid=get_param("studentid");
$action=get_param("action");
$residence=get_param("residence");
if(!strlen($residence)){
	$residence=0;
};

//doug fix for titles to be stored and display correctly
$sSQL="SELECT title_id FROM tbl_titles WHERE title_desc='".$title."'";
$title=$db->get_var($sSQL);
// echo "SQL is $sSQL and title is $title";
//end of fix

//Validate mandatory fields
$msgFormErr="";
if(!strlen($cfname))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_FIRST . "<br>";
if(!strlen($clname))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_LAST . "<br>";
if(!strlen($address1))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_ADDRESS . "<br>";
if(!strlen($city))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_CITY . "<br>";
if(!strlen($relation))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_RELATION . "<br>";
if(!strlen($state))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_STATE . "<br>";
if(!strlen($zip))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_ZIP . "<br>";
if(!strlen($phone1))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_PHONE . "<br>";
if(strlen($email)){
	$oEmail = new email;
	if (!$oEmail->valida($email)){ 
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_2_ENTER_EMAIL . "<br>";
	};
};
$sSQL="SELECT relations_codes.relation_codes_unique, relations_codes.relation_codes_desc 
FROM contact_to_students 
INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id 
WHERE relations_codes.relation_codes_id='".$relation."' 
AND contact_to_students_student='".$studentid."' 
AND contact_to_students_year='".$current_year."'"; 
if($relunique=$db->get_row($sSQL)){
	if($relunique->relation_codes_unique==1){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_2_REL_DEF1 . $relunique->relation_codes_desc . _ADMIN_ADD_EDIT_CONTACT_2_REL_DEF2 . "<br>";
	};
};
if($residence==1){
	$sSQL="SELECT contact_to_students_residence FROM contact_to_students WHERE contact_to_students_student='".$studentid."' AND contact_to_students_residence=1";
	if($db->get_results($sSQL)){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_2_RES_DEF . "<br>";
	};
};
//No errors on validation, insert/update record
if ($msgFormErr==""){
	if ($action=="new"){
	$msg_header=_ADMIN_ADD_EDIT_CONTACT_2_ADDED;
    $sSQL = "insert into studentcontact (" . 
          "studentcontact_studentid," . 
          "studentcontact_title," . 
          "studentcontact_fname," . 
          "studentcontact_lname," . 
          "studentcontact_address1," . 
          "studentcontact_address2," . 
          "studentcontact_city," . 
          "studentcontact_state," . 
          "studentcontact_zip," . 
          "studentcontact_phone1," . 
          "studentcontact_phone2," . 
          "studentcontact_phone3," . 
          "studentcontact_email," . 
          "studentcontact_other," . 
	  "studentcontact_year," .
          "studentcontact_mailings)" . 
          " values (" . 
		  tosql($studentid, "Number") . "," . 
  		  tosql($title, "Text") . "," . 
		  tosql($fname, "Text") . "," . 
		  tosql($lname, "Text") . "," . 
		  tosql($address1, "Text") . "," . 
		  tosql($address2, "Text") . "," . 
		  tosql($city, "Text") . "," . 
		  tosql($state, "Text") . "," . 
		  tosql($zip, "Text") . "," . 
		  tosql($phone1, "Text") . "," . 
		  tosql($phone2, "Text") . "," . 
		  tosql($phone3, "Text") . "," . 
		  tosql($email, "Text") . "," . 
		  tosql($other, "Text") . "," .
		  tosql($current_year, "Number") . "," . 
		  tosql($mailings, "Number") .  
		  ")";
		  $db->query($sSQL);
		  $contactid=mysql_insert_id();
		  //Get student first and last name
		  $student=$db->get_row("SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id=$studentid");
		  $sfname=$student->studentbio_fname;
		  $slname=$student->studentbio_lname;
		  //Insert ids in relation table
		  $sSQL="INSERT INTO contact_to_students (contact_to_students_contact, 
contact_to_students_student, contact_to_students_relation, contact_to_students_residence, 
contact_to_students_year) VALUES ($contactid, $studentid, $relation, $residence, 
$current_year)";
		  $db->query($sSQL);
	}else{
		$msg_header=_ADMIN_ADD_EDIT_CONTACT_2_UPDATED;
		$sSQL="UPDATE studentcontact set ".
          "studentcontact_title=" .tosql($title, "Text") . "," .  
          "studentcontact_fname=" .tosql($fname, "Text") . "," .  
          "studentcontact_lname=" .tosql($lname, "Text") . "," .  
          "studentcontact_address1=" .tosql($address1, "Text") . "," .  
          "studentcontact_address2=" .tosql($address2, "Text") . "," .  
          "studentcontact_city=" .tosql($city, "Text") . "," .  
          "studentcontact_state=" .tosql($state, "Text") . "," .  
          "studentcontact_zip=" .tosql($zip, "Text") . "," .  
          "studentcontact_phone1=" .tosql($phone1, "Text") . "," .  
          "studentcontact_phone2=" .tosql($phone2, "Text") . "," .  
          "studentcontact_phone3=" .tosql($phone3, "Text") . "," .  
          "studentcontact_email=" .tosql($email, "Text") . "," .  
          "studentcontact_other=" .tosql($other, "Text") . "," .
          "studentcontact_year=" .tosql($current_year, "Number") . "," . 
          "studentcontact_mailings=" .tosql($mailings, "Number") .
		  " WHERE studentcontact_id=$contactid AND 
studentcontact_year='$current_year'";
		  $db->query($sSQL);
		  $SQL="UPDATE contact_to_students SET contact_to_students_relation=$relation, 
contact_to_students_residence=$residence WHERE contact_to_students_contact=$contactid AND 
contact_to_students_student=$studentid AND contact_to_students_year='$current_year'";
		  $db->query($sSQL);
	};
}else{
	if ($action=="new"){
		$msg_header=_ADMIN_ADD_EDIT_CONTACT_2_ADDING;
	}else{
		$msg_header=_ADMIN_ADD_EDIT_CONTACT_2_UPDATING;
	};
};
//Set appropriate menu
$rback=get_param("rback");
if(strlen($rback)){
	$menustudent=1;
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
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
	  alert('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ALL');
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
    <td width="50%"><? echo _ADMIN_ADD_EDIT_CONTACT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><? echo _ADMIN_ADD_EDIT_CONTACT_2_TITLE?> <? echo $msg_header; ?> <? echo _ADMIN_ADD_EDIT_CONTACT_2_CONTACT?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_EDIT_CONTACT_2_PLEASE?> <form action='admin_add_edit_contact_1.php?studentid=<?php echo $_POST['studentid'];?>&action=new&rback=rback' method='POST'>
			<input type="hidden" name="cfname_1" value="<?php echo $_POST['cfname'];?>">
			<input type="hidden" name="clname_1" value="<?php echo $_POST['clname'];?>">
			<input type="hidden" name="address1_1" value="<?php echo $_POST['address1'];?>">
			<input type="hidden" name="address2_1" value="<?php echo $_POST['address2'];?>">
			<input type="hidden" name="residence_1" value="<?php echo $_POST['residence'];?>">
			<input type="hidden" name="city_1" value="<?php echo $_POST['city'];?>">
			<input type="hidden" name="email_1" value="<?php echo $_POST['email'];?>">
			<input type="hidden" name="phone1_1" value="<?php echo $_POST['phone1'];?>">
			<input type="hidden" name="phone2_1" value="<?php echo $_POST['phone2'];?>">
			<input type="hidden" name="phone3_1" value="<?php echo $_POST['phone3'];?>">
			<input type="hidden" name="other_1" value="<?php echo $_POST['other'];?>">
			<input type="hidden" name="mailings_1" value="<?php echo $_POST['mailings'];?>">
			<input type="hidden" name="title_1" value="<?php echo $_POST['title'];?>">
			<input type="hidden" name="relation_1" value="<?php echo $_POST['relation'];?>">
			<input type="hidden" name="state_1" value="<?php echo $_POST['state'];?>">
			<input type="submit" name="click" value="<? echo _ADMIN_ADD_EDIT_CONTACT_2_CLICK_HERE?>" class="frmbut">
	   </form> <? echo _ADMIN_ADD_EDIT_CONTACT_2_CORRECT?></h2>
	   <br>
	   <h3><? echo $msgFormErr; ?></h3>
	<?
	}else{
	?>
	   <h1><? echo _ADMIN_ADD_EDIT_CONTACT_2_TITLE_SUCCESS?> <? echo $msg_header; ?> <? echo _ADMIN_ADD_EDIT_CONTACT_2_CONTACT?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_EDIT_CONTACT_2_CONTACT?>: <? echo $cfname." ".$clname; ?></h2>
	   <br>
	   <p class="ltext"><? echo _ADMIN_ADD_EDIT_CONTACT_2_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><? echo _ADMIN_ADD_EDIT_CONTACT_2_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<? echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_2_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10">&nbsp;
	   <? echo _ADMIN_ADD_EDIT_CONTACT_2_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10"></p>
	   <input type="submit" name="submit" value="<? echo _ADMIN_ADD_EDIT_CONTACT_2_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<? echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname ; ?>">
	   <?
	   if($menustudent==1){
	   ?>
			<input type="hidden" name="rback" value="rback">	   
			</form>
			<a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_ADD_EDIT_CONTACT_2_BACK?></a>
	   <?
	   }else{
	   ?>
	   </form>
	   <a href="admin_add_edit_contact_1.php?studentid=<? echo $studentid; ?>&action=add" class="aform"><? echo _ADMIN_ADD_EDIT_CONTACT_2_ADD_NEW?></a>
	<?
	   };
	};
	?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
