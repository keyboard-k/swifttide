<?
//*
// admin_add_edit_contact_6.php
// Admin Section
// Process update contact
//v1.5 12-07-05 true multiyear feature
//v1.51 12-27-05 carry contact full name fwd to next form
//v1.52 01-16-06 users with ' in last name display oddly.  fixed.
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

//Set variable for menu
$menustudent=1;

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
$contactid=get_param("contactid");
$contacttostudentsid=get_param("contacttostudentsid");
$residence=get_param("residence");
if(!strlen($residence)){
	$residence=0;
};

//Validate mandatory fields
$msgFormErr="";
if(!strlen($fname))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_FIRST . "<br>";
if(!strlen($lname))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_LAST . "<br>";
if(!strlen($address1))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_ADDRESS . "<br>";
if(!strlen($city))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_CITY . "<br>";
if(!strlen($relation))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_RELATION . "<br>";
if(!strlen($state))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_STATE . "<br>";
if(!strlen($zip))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_ZIP . "<br>";
if(!strlen($phone1))
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_PHONE . "<br>";
if(strlen($email)){
	$oEmail = new email;
	if (!$oEmail->valida($email)){ 
      $msgFormErr .= _ADMIN_ADD_EDIT_CONTACT_6_ENTER_EMAIL . "<br>";
	};
};
if($residence==1){
	$sSQL="SELECT contact_to_students_residence 
	FROM contact_to_students 
	WHERE contact_to_students_student='".$studentid."'" 
	AND contact_to_students_residence=1 
	AND contact_to_students_contact<>'".$contactid."'" 
	AND contact_to_students_year = '".$current_year."'";
	if($db->get_results($sSQL)){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_6_RES_DEF . "<br>";
	};
};
$sSQL="SELECT relations_codes.relation_codes_unique, 
relations_codes.relation_codes_desc 
FROM contact_to_students 
INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id 
WHERE relations_codes.relation_codes_id='".$relation."'" 
AND contact_to_students_student='".$studentid."'" 
AND contact_to_students.contact_to_students_id<>'".$contacttostudentsid."'"; 
if($relunique=$db->get_row($sSQL)){
	if($relunique->relation_codes_unique==1){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_6_REL_DEF1 . $relunique->relation_codes_desc . _ADMIN_ADD_EDIT_CONTACT_6_REL_DEF2 . "<br>";
	};
};

//No errors on validation, insert/update record
if ($msgFormErr==""){
		  //Get student first and last name
		  $student=$db->get_row("SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id='".$studentid."'");
		  $sfname=$student->studentbio_fname;
		  $slname=$student->studentbio_lname;
		  $msg_header=_ADMIN_ADD_EDIT_CONTACT_6_UPDATED;
		  $sSQL="UPDATE studentcontact set ".
          "studentcontact_title=" .tosql($title, "Number") . "," .  
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
          "studentcontact_mailings=" .tosql($mailings, "Number") .
		  " WHERE studentcontact_studentid='".$contactid."'" 
		  AND studentcontact_year='".$current_year."'"";
		  $db->query($sSQL);
		  $sSQL="UPDATE contact_to_students 
		  SET contact_to_students_relation='".$relation."'", 
		  contact_to_students_residence='".$residence."'" 
		  WHERE contact_to_students_id='".$contacttostudentsid."'" 
		  AND contact_to_students_year='".$current_year."'";
		  $db->query($sSQL);
		  $sSQL="SELECT contact_to_students_internet 
		  FROM contact_to_students 
		  WHERE contact_to_students_id='".$contacttostudentsid."'" 
		  AND contact_to_students_year='".$current_year."'";
		  $web=$db->get_var($sSQL);
		  if($web==1){
			  $sSQL="SELECT web_users_username, web_users_password FROM web_users WHERE web_users_type='C' AND web_users_relid='".$contactid."'";
			  $webuser=$db->get_row($sSQL);
			  $username=$webuser->web_users_username;
			  $password=$webuser->web_users_password;
		  };
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
	  alert('<? echo _ADMIN_ADD_EDIT_CONTACT_6_ENTER_ALL?>');
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
    <td width="50%"><? echo _ADMIN_ADD_EDIT_CONTACT_6_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><? echo _ADMIN_ADD_EDIT_CONTACT_6_TITLE?> <? echo $msg_header; ?> <? echo _ADMIN_ADD_EDIT_CONTACT_6_CONTACT?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_EDIT_CONTACT_6_ERROR_BACK?></h2>
	   <br>
	   <h3><? echo $msgFormErr; ?></h3>
	<?
	}else{
	?>
	   <h1><? echo _ADMIN_ADD_EDIT_CONTACT_6_TITLE_SUCCESS?> <? echo $msg_header; ?> <? echo _ADMIN_ADD_EDIT_CONTACT_6_CONTACT?></h1>
	   <br>
	   <h2>Contact : <? echo stripslashes($cfname)." 
".stripslashes($clname); ?></h2>
	   <br>
	   <p class="ltext"><? echo _ADMIN_ADD_EDIT_CONTACT_6_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><? echo _ADMIN_ADD_EDIT_CONTACT_6_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<? echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo _ADMIN_ADD_EDIT_CONTACT_6_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10" value="<? echo $username; ?>">&nbsp;
	   <? echo _ADMIN_ADD_EDIT_CONTACT_6_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10" value="<? echo $password; ?>"></p>
	   <input type="submit" name="submit" value="<? echo _ADMIN_ADD_EDIT_CONTACT_6_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<? echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname ; ?>">
	   <input type="hidden" name="clname" value="<? echo $clname ; ?>">
	   <input type="hidden" name="cfname" value="<? echo $cfname ; ?>">
	   <input type="hidden" name="rback" value="back">
	   </form>
	   <a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_ADD_EDIT_CONTACT_6_BACK?></a>
	<?
	};
	?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
