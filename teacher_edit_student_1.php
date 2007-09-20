<?php
//*
// teacher_edit_student_1.php
// Teacher Section
// Display Student Details
//*

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];



//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

//Gather student id
$studentid=get_param("studentid");

//Get all info to display
//Student
$sSQL="SELECT studentbio.*, DATE_FORMAT(studentbio.studentbio_dob, '" . _EXAMS_DATE . "') as sdob, 
              ethnicity.ethnicity_desc, school_names.school_names_desc, generations.generations_desc, 
	      grades.grades_desc FROM 
	      ((((studentbio 
	      INNER JOIN generations ON studentbio.studentbio_generation = generations.generations_id) 
	      INNER JOIN ethnicity ON studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
	      INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
	      INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
	      INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id 
	      WHERE studentbio.studentbio_id='". $studentid ."'";
$studentinfo=$db->get_row($sSQL);
$primarycontact=$studentinfo->studentbio_primarycontact;
//Primary Contact
$sSQL="SELECT studentcontact.*, contact_to_students.contact_to_students_internet, 
contact_to_students.contact_to_students_id, contact_to_students.contact_to_students_relation, 
relations_codes.relation_codes_desc, contact_to_students.contact_to_students_residence 
FROM (studentcontact 
INNER JOIN contact_to_students ON studentcontact.studentcontact_id =  contact_to_students.contact_to_students_contact) 
INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id 
WHERE studentcontact.studentcontact_id='". $primarycontact ."' 
AND contact_to_students.contact_to_students_student='". $studentid ."'";
$primcontinfo=$db->get_row($sSQL);

//doug fix so titles are stored and displayed properly
$sSQL="SELECT title_desc FROM tbl_titles WHERE title_id='". $primcontinfo->studentcontact_title ."'";
$studentcontact_title=$db->get_var($sSQL);
//end of fix

//get the custom fields for this student by Joshua
$scfSQL = "SELECT * FROM custom_studentbio, custom_fields 
 	WHERE (custom_fields.custom_field_id = custom_studentbio.custom_field_id) 
  	AND (studentbio_id = '". $studentid ."')";
$student_custom_fields = $db->get_results($scfSQL);

//get the entry action history for this student by Joshua
$entries_sql = "SELECT * from entry_actions, school_names, school_years, tbl_config
	WHERE (entry_actions.school_id = school_names.school_names_id)
	AND (entry_actions.school_year_id = school_years.school_years_id)
	AND (entry_actions.student_id = '". $studentid ."') ";
$entries = $db->get_results($entries_sql);

//Additional Contacts
$sSQL="SELECT contact_to_students_contact 
FROM contact_to_students 
WHERE contact_to_students_contact<>'". $primarycontact ."' 
AND contact_to_students_student='". $studentid ."'";
if($addcont=$db->get_results($sSQL)){
	$ac=1;
	$i=-1;
	foreach($addcont as $mlist){
		$i=$i+1;
		$list[$i]=$mlist->contact_to_students_contact;
	}
	$ylist=implode(",", $list);
	$sSQL="SELECT studentcontact.studentcontact_id, studentcontact.studentcontact_fname, studentcontact.studentcontact_lname, contact_to_students.contact_to_students_relation, contact_to_students.contact_to_students_residence, relations_codes.relation_codes_desc FROM (studentcontact INNER JOIN contact_to_students ON studentcontact.studentcontact_id = contact_to_students.contact_to_students_contact) INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id WHERE studentcontact.studentcontact_id IN (". $ylist .") AND contact_to_students_student='". $studentid ."'";
	$addcontlist=$db->get_results($sSQL);	
}else{
	$ac=0;
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-teacher.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <?php echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _TEACHER_EDIT_STUDENT_1_TITLE?></h1>
	<br>
	<h2><?php echo $studentinfo->studentbio_fname . " " . $studentinfo->studentbio_mi . " " . $studentinfo->studentbio_lname . " " .  $studentinfo->generations_desc . " (" . $studentinfo->studentbio_gender . ")"; ?></h2>	
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_INTERNAL_ID?></td>
		    <td width="66%" colspan="2">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ETHNICITY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $studentinfo->studentbio_internalid; ?></td>
		    <td width="66%" colspan="2">&nbsp;<?php echo $studentinfo->ethnicity_desc; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_BIRTHDATE?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_SCHOOL?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_GRADE?></td>
		  </tr>
		  <tr class="tblcont">
			<td width="34%">&nbsp;<?php echo $studentinfo->sdob; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->school_names_desc; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->grades_desc; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ACTIVE?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_HOMED?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_SPED?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php if($studentinfo->studentbio_active==1){echo _YES;}else{echo _NO;};?></td>
		    <td width="33%">&nbsp;<?php if($studentinfo->studentbio_homed==1){echo _YES;}else{echo _NO;};?></td>
		    <td width="33%">&nbsp;<?php if($studentinfo->studentbio_sped==1){echo _YES;}else{echo _NO;};?></td>
		  </tr>

			<?		  
  		    //check for entry actions and display by Joshua
		    if(count($entries) && $entries != NULL) {
				?> <tr><td colspan=3><table cellpadding="0" cellspacing="1" width="100%">
	    		<tr class="tblhead"><td><?php echo _TEACHER_EDIT_STUDENT_1_ENTRY_RECORD?></td>
	    		<td><?php echo _TEACHER_EDIT_STUDENT_1_NOTES?></td></tr><?php
		    		foreach($entries as $entry) {
		    			?><tr class="tblcont"><td><?php
		    			echo(ucwords($entry->action_code));
		    			if($entry->action_code == 'entry') {echo" into ";}
		    			if($entry->action_code == 'exit') {echo" from ";}
		    			echo($entry->school_names_desc);
		    			?> on <?php echo($entry->action_date);
		    			?> for year <?php echo($entry->school_years_desc);
		    			?></td><td><?php echo($entry->action_notes);
		    			?></td></tr><?php
		    		} 
		    		?></table></td></tr><?php
		    } //end entry actions
			?>

		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_BIRTHCITY?></td>
			<td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_BIRTHSTATE?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_BIRTHCOUNTRY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $studentinfo->studentbio_birthcity; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_birthstate; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_birthcountry; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLNAME?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLADDRESS?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLCITY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $studentinfo->studentbio_prevschoolname; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_prevschooladdress; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_prevschoolcity; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLSTATE?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLZIP?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLCOUNTRY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $studentinfo->studentbio_prevschoolstate; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_prevschoolzip; ?></td>
		    <td width="33%">&nbsp;<?php echo $studentinfo->studentbio_prevschoolcountry; ?></td>
		  </tr>
		  <?php
		  //display custom field list by Joshua
            if(count($student_custom_fields)) {
			?><tr><td colspan=3><h2><?php echo _TEACHER_EDIT_STUDENT_1_CUSTOM_FIELDS?></h2></td></tr>
			<tr><td colspan=3><table width="100%"><?php
     	     foreach($student_custom_fields as $student_custom_field) {
  				?><tr><td class="tblhead"><?php
  				echo($student_custom_field->name);
  				?>:</td><td class="tblcont"><?php
				echo($student_custom_field->data);
     	     	?></td></tr><?php
     	     }
			?></table></td></tr><?php
		 } 
		 //end of custom fields
		 ?>

		</table>
		<h2><?php echo _TEACHER_EDIT_STUDENT_1_PRIMARY_CONTACT?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<?php echo $studentcontact_title . " " . $primcontinfo->studentcontact_fname . " " .$primcontinfo->studentcontact_lname . " (" . $primcontinfo->relation_codes_desc . ")" ;?>
			<?php if ($primcontinfo->contact_to_students_residence==1){echo " <font color=#FF0000><b>" . _TEACHER_EDIT_STUDENT_1_RESIDENCE . "</b></font>";}; ?>
			</td>
		  </tr>
		  <tr class="tblhead">
		    <td width="100%" colspan="3">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ADDRESS?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<?php echo $primcontinfo->studentcontact_address1 . " " . $primcontinfo->studentcontact_address2 ;?> </td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_CITY?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_STATE?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ZIP?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $primcontinfo->studentcontact_city ; ?></td>
		    <td width="33%">&nbsp;<?php echo $primcontinfo->studentcontact_state ; ?></td>
		    <td width="33%">&nbsp;<?php echo $primcontinfo->studentcontact_zip ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PHONE1?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PHONE2?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_PHONE3?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<?php echo $primcontinfo->studentcontact_phone1 ; ?></td>
		    <td width="33%">&nbsp;<?php echo $primcontinfo->studentcontact_phone2 ; ?></td>
		    <td width="33%">&nbsp;<?php echo $primcontinfo->studentcontact_phone3 ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="67%" colspan="2">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_EMAIL?></td>
		    <td width="33%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_WEB_USER?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="67%" colspan="2">&nbsp;<?php echo $primcontinfo->studentcontact_email ; ?></td>
		    <td width="33%">&nbsp;<?php if($primcontinfo->contact_to_students_internet==1){echo _YES;}else{echo _NO;};?></td>
		  </tr>
	</table>
	<?php
	if ($ac==1){
	?>
		<h2><?php echo _TEACHER_EDIT_STUDENT_1_ADD_CONTACTS?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblhead">
		    <td width="30%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ADD_FIRST_NAME?></td>
			<td width="30%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ADD_LAST_NAME?></td>
			<td width="15%">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ADD_RELATION?></td>
			<td width="25%" colspan="2">&nbsp;<?php echo _TEACHER_EDIT_STUDENT_1_ADD_WEB_USER?></td>
		  </tr>
		  <?foreach($addcontlist as $adc){?>
			  <tr class="tblcont">
			    <td width="30%">&nbsp;<?php echo $adc->studentcontact_fname; ?></td>
				<td width="30%">&nbsp;<?php echo $adc->studentcontact_lname; if($adc->contact_to_students_residence==1){echo " <font color=#FF0000><b>R</b></font>";}?></td>
				<td width="15%">&nbsp;<?php echo $adc->relation_codes_desc; ?></td>
				<td width="15%">&nbsp;<?php if($adc->contact_to_students_internet==1){echo _YES;}else{echo _NO;};?></td>
				<td width="10%">&nbsp;<a href="teacher_edit_student_2.php?studentid=<?echo $studentid;?>&contactid=<?echo $adc->studentcontact_id; ?>" class="aform"><?php echo _TEACHER_EDIT_STUDENT_1_DETAILS?></a></td>
			  </tr>
		  <?php };?>
		</table>
	<?php
	};
	?>
</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>
