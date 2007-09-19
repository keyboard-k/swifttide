<?php
//*
// admin_add_edit_contact_4.php
// Admin Section
// Process additional contact from database and save all info in database
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

//Get current year
$current_year=$_SESSION['CurrentYear'];

//Gather info from form post

$studentid=get_param("studentid");
$contactid=get_param("contactid");
$slname=get_param("slname");
$sfname=get_param("sfname");
$relation=get_param("relation");
$residence=get_param("residence");
if(!strlen($residence)){
	$residence=0;
};

//Validate Relation
$sSQL="SELECT relations_codes.relation_codes_unique, relations_codes.relation_codes_desc FROM contact_to_students INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id WHERE relations_codes.relation_codes_id=$relation AND contact_to_students_student=$studentid";
if($relunique=$db->get_row($sSQL)){
	if($relunique->relation_codes_unique==1){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_4_REL_DEF1 . $relunique->relation_codes_desc . _ADMIN_ADD_EDIT_CONTACT_4_REL_DEF2 . "<br>";
	};
};

//Validate Residence
if($residence==1){
	$sSQL="SELECT contact_to_students_residence FROM contact_to_students WHERE contact_to_students_student=$studentid AND contact_to_students_residence=1 AND contact_to_students_contact<>$contactid";
	if($db->get_results($sSQL)){
		$msgFormErr.=_ADMIN_ADD_EDIT_CONTACT_4_RES_DEF . "<br>";
	};
};

//Set appropriate menu
$rback=get_param("rback");
if(strlen($rback)){
	$menustudent=1;
};


//Get contact info from database
$sSQL="SELECT studentcontact_lname, studentcontact_fname FROM studentcontact WHERE 
studentcontact_id=$contactid AND studentcontact_year='$current_year'";
$contact=$db->get_row($sSQL);
$cfname=$contact->studentcontact_fname;
$clname=$contact->studentcontact_lname;


//Insert ids in relation table
if(!strlen($msgFormErr)){
	$sSQL="INSERT INTO contact_to_students (contact_to_students_contact, 
contact_to_students_student, contact_to_students_relation, contact_to_students_residence, 
contact_to_students_year) VALUES ($contactid, $studentid, $relation, $residence, 
$current_year)";
	$db->query($sSQL);
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
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
	  alert('<?php echo _ADMIN_ADD_EDIT_CONTACT_4_ENTER_ALL?>');
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

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>
	   <h1><?php echo _ADMIN_ADD_EDIT_CONTACT_4_TITLE?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_EDIT_CONTACT_4_STUDENT?>: <?php echo $sfname." ".$slname; ?></h2>
	   <br>
	   <h2><?php echo _ADMIN_ADD_EDIT_CONTACT_4_ADDITIONAL?>: <?php echo $cfname." ".$clname; ?></h2>
	   <br>
	   <p class="ltext"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<?php echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_4_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10">&nbsp;
	   <?php echo _ADMIN_ADD_EDIT_CONTACT_4_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10"></p>
	   <input type="submit" name="submit" value="<?php echo _ADMIN_ADD_EDIT_CONTACT_4_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<?php echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<?php echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<?php echo $sfname ; ?>">
	   <?php
	   if($menustudent==1){
	   ?>
			<input type="hidden" name="rback" value="rback">	   
			</form>
			<a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_BACK?></a>
	   <?php
	   }else{
	   ?>
	   </form>
	   <a href="admin_add_edit_contact_1.php?id=<?php echo $studentid; ?>&action=add" class="aform"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_ADD_NEW?></a>
	<?php
	   };
	}else{
	?>
	<h1><?php echo _ADMIN_ADD_EDIT_CONTACT_4_TITLE_ERROR?></h1>
	<br>
	<h2><?php echo _ADMIN_ADD_EDIT_CONTACT_4_STUDENT?>: <?php echo $sfname." ".$slname; ?></h2>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<p class="ltext"><?php echo _ADMIN_ADD_EDIT_CONTACT_4_BACK2?></p>
	<?php
	};
	?>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>

