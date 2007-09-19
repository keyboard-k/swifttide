<?php
//*
// admin_add_student_3.php
// Admin Section
// Process the primary contact and save all info in database
//v1.5 12-4-05 add link to quickly add another student
//v1.5.1 12-08-05 add support for primary field in studentcontact
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

//Get current year, set primary to 1
$current_year=$_SESSION['CurrentYear'];
$primary=1;

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


//Primary Contact
$title=get_param("title");
$cfname=get_param("cfname");
$clname=get_param("clname");
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
$residence=get_param("residence");
if(!strlen($residence)){
	$residence=0;
};

//Doug fix so titles are stored and displayed properly
$sSQL="SELECT title_id FROM tbl_titles WHERE title_desc='".$title."'";
$title=$db->get_var($sSQL);
//end doug fix

//Validate mandatory fields
$msgFormErr="";
if(!strlen($cfname))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_FIRST . "<br>";
if(!strlen($clname))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_LAST . "<br>";
if(!strlen($relation))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_RELATION . "<br>";
if(!strlen($address1))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_ADDRESS . "<br>";
if(!strlen($city))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_CITY . "<br>";
if(!strlen($state))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_STATE . "<br>";
if(!strlen($zip))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_ZIP . "<br>";
if(!strlen($phone1))
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_PHONE . "<br>";
if(strlen($email)){
	$oEmail = new email;
	if (!$oEmail->valida($email)){ 
      $msgFormErr .= _ADMIN_ADD_STUDENT_3_ENTER_EMAIL . "<br>";
	};
};

//No errors on validation, insert new record
if ($msgFormErr==""){
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
		  "studentbio_teacher," . 		
		  "studentbio_homeroom," . 		
		  "studentbio_bus," . 		
		  "studentbio_homed," . 		
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
		  tosql($teacher, "Number") . "," . 
		  tosql($homeroom, "Text") . "," . 
		  tosql($bus, "Text") . "," . 
		  tosql($homed, "Number") . "," . 
		  tosql($school, "Number") .  
		  ")";
		  $db->query($sSQL);
		  $studentid=mysql_insert_id();
		  
    //Insert Primary contact
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
  		  tosql($title, "Number") . "," . 
		  tosql($cfname, "Text") . "," . 
		  tosql($clname, "Text") . "," . 
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

		  //Set primary contact in Student Bio table
		  $sSQL="UPDATE studentbio SET studentbio_primarycontact='".$contactid."' WHERE studentbio_id='".$studentid."'";
		  $db->query($sSQL);

		  //Set grade for current year
		  $sSQL="INSERT INTO student_grade_year (student_grade_year_student, student_grade_year_grade, student_grade_year_year) VALUES ($studentid, $grade, $current_year)";
		  $db->query($sSQL);

		  //Insert ids in relation table
		  $sSQL="INSERT INTO contact_to_students (contact_to_students_contact, 
contact_to_students_student, contact_to_students_relation, contact_to_students_residence, 
contact_to_students_year, contact_to_students_primary) VALUES 
($contactid, $studentid, $relation, $residence, 
$current_year, 1)";
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
	  alert('<?php echo _ADMIN_ADD_STUDENT_3_ENTER_ALL?>');
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
    <td width="50%"><?php echo _ADMIN_ADD_STUDENT_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><?php echo _ADMIN_ADD_STUDENT_3_TITLE?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_STUDENT_3_ERROR_BACK?></h2>
	   <br>
	   <h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
	?>
	   <h1><?php echo _ADMIN_ADD_STUDENT_3_TITLE_SUCCESS?></h1>
	   <br>
	   <h2><?php echo _ADMIN_ADD_STUDENT_3_STUDENT?>: <?php echo $sfname." ".$slname; ?></h2>
	   <br>
	   <h2><?php echo _ADMIN_ADD_STUDENT_3_CONTACT?>: <?php echo $cfname." ".$clname; ?></h2>
	   <br>
	   <p class="ltext"><?php echo _ADMIN_ADD_STUDENT_3_MESSAGE?></p>
	   <form name="addwebuser" method="POST" action="admin_add_contact_user.php" onsubmit="return submitform();">
	   <p class="ltext"><?php echo _ADMIN_ADD_STUDENT_3_EMAIL?>:&nbsp;
	   <input type="text" onchange="this.value=this.value.toLowerCase();" name="email" value="<?php echo $email; ?>" size="35"><br><br>
	   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo _ADMIN_ADD_STUDENT_3_USERNAME?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="username" size="10">&nbsp;
	   <?php echo _ADMIN_ADD_STUDENT_3_PASSWORD?>:&nbsp;<input type="text" onchange="this.value=this.value.toLowerCase();" name="password" size="10"></p>
	   <input type="submit" name="submit" value="<?php echo _ADMIN_ADD_STUDENT_3_SET?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	   <input type="hidden" name="contactid" value="<?php echo $contactid ; ?>">
	   <input type="hidden" name="slname" value="<?php echo $slname ; ?>">
	   <input type="hidden" name="sfname" value="<?php echo $sfname ; ?>">
	   </form>
	   <a href="admin_add_edit_contact_1.php?studentid=<?php echo $studentid; ?>&action=add" class="aform"><?php echo _ADMIN_ADD_STUDENT_3_ADD_NEW?></a>
	<br>
	   <a href="admin_add_student_1.php"><?php echo _ADMIN_ADD_STUDENT_3_ADD?></a>
	<?php
	};
	?>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>

