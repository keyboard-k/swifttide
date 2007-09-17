<?
//*
// admin_edit_student_1.php
// Admin Section
// Display and Manage Student Details
//v1.5 12-07-05 fix for true multi year feature
//v1.5.1 12-08-05 add support for primary field in studentcontact
//v1.5.2 12-10-05 when promoting to a new year, contacts are being displayed duplicate
//v1.53 12-30-06 Fix so titles are stored and displayed properly
//update 032507 by doug add "View Schedule" button and code
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

//Gather student id
$studentid=get_param("studentid");

//Set variable for menu
$menustudent=1;

//Get current year
$current_year=$_SESSION['CurrentYear'];

//Get all info to display
//Student
$sSQL="SELECT studentbio.*, DATE_FORMAT(studentbio.studentbio_dob,'" . _EXAMS_DATE . "') as sdob, 
ethnicity.ethnicity_desc, 
school_names.school_names_desc, generations.generations_desc, 
grades.grades_desc, teachers.teachers_fname, teachers.teachers_lname, school_rooms_desc 
FROM ((((((studentbio INNER JOIN generations ON studentbio.studentbio_generation 
= generations.generations_id) INNER JOIN ethnicity ON 
studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id) 
INNER JOIN teachers ON studentbio.studentbio_teacher = teachers.teachers_id) 
INNER JOIN school_rooms ON school_rooms_id=studentbio_homeroom 
WHERE studentbio.studentbio_id=$studentid AND 
student_grade_year.student_grade_year_year = '$current_year'"; 
$studentinfo=$db->get_row($sSQL);

$sSQL="SELECT studentcontact_primary FROM studentcontact WHERE studentcontact_studentid='$studentid' AND studentcontact_year='$current_year'";
$primarycontact=$db->get_var($sSQL);

//Primary Contact
//pq - 2007-02-22 - Grab the primary contact id from the studentbio record and use to query
$sSQL="SELECT studentcontact.*, 
contact_to_students.contact_to_students_internet, 
contact_to_students.contact_to_students_id, 
contact_to_students.contact_to_students_relation, 
relations_codes.relation_codes_desc, 
contact_to_students.contact_to_students_residence, 
tbl_states.state_name 
FROM (((studentcontact 
INNER JOIN contact_to_students ON studentcontact.studentcontact_studentid = contact_to_students.contact_to_students_student) 
INNER JOIN relations_codes ON contact_to_students.contact_to_students_relation = relations_codes.relation_codes_id) 
INNER JOIN tbl_states ON tbl_states.state_code = studentcontact.studentcontact_state) 
WHERE studentcontact.studentcontact_id='$studentinfo->studentbio_primarycontact' AND 
studentcontact.studentcontact_year = '$current_year'";
$primcontinfo=$db->get_row($sSQL);

//Title fix, doug, 12-30-06
$title_id=$primcontinfo->studentcontact_title;
$sSQL="SELECT title_desc FROM tbl_titles WHERE title_id='$title_id'";
$title_desc=$db->get_var($sSQL);
//End of doug fix
$primarycontact=$primcontinfo->studentcontact_id;

// commented out by Helmut: we just got primarycontact, why a second query?
// furthermore, it does not always yield a result?!
// $sSQL="SELECT studentcontact_id FROM studentcontact WHERE 
// studentcontact_studentid='$studentid' AND studentcontact_year='$current_year' AND 
// studentcontact_primary=1"; 
// $primarycontact=$db->get_var($sSQL);

//get the custom fields for this student by Joshua
$scfSQL = "SELECT * FROM custom_studentbio, custom_fields 
 	WHERE (custom_fields.custom_field_id = custom_studentbio.custom_field_id) 
  	AND (studentbio_id = '$studentid')";
$student_custom_fields = $db->get_results($scfSQL);

//get the entry action history for this student by Joshua
$entries_sql = "SELECT * from entry_actions, school_names, school_years, tbl_config 
	WHERE (entry_actions.school_id = school_names.school_names_id) 
	AND (entry_actions.school_year_id = school_years.school_years_id) 
	AND (entry_actions.student_id = '$studentid')";
$entries = $db->get_results($entries_sql);

//Additional Contacts
$sSQL="SELECT contact_to_students_contact FROM contact_to_students WHERE 
contact_to_students_contact<>'$studentinfo->studentbio_primarycontact' AND contact_to_students_student='$studentid' AND contact_to_students_year=$current_year";

if($addcont=$db->get_results($sSQL)){
	$ac=1;
	$i=-1;
	foreach($addcont as $mlist){
		$i=$i+1;
		$list[$i]=$mlist->contact_to_students_contact;
	}
	$ylist=implode(",", $list);

	$sSQL="SELECT studentcontact.studentcontact_id, 
studentcontact.studentcontact_fname, studentcontact.studentcontact_lname, 
contact_to_students.contact_to_students_relation, 
contact_to_students.contact_to_students_internet, 
contact_to_students.contact_to_students_residence, 
relations_codes.relation_codes_desc FROM (studentcontact INNER JOIN 
contact_to_students ON studentcontact.studentcontact_id = 
contact_to_students.contact_to_students_contact) INNER JOIN 
relations_codes ON contact_to_students.contact_to_students_relation = 
relations_codes.relation_codes_id WHERE 
contact_to_students_year=$current_year AND studentcontact.studentcontact_id 
IN ($ylist) AND contact_to_students_student='$studentid'";
	$addcontlist=$db->get_results($sSQL);	
}else{
	$ac=0;
};

$qquery = "Select * from studentbio_pictures where studentid = $studentid order by grade";
$pic = $db->get_row($qquery);
if ($pic->picturepath != NULL) {
	//Define stuff
	define('IMAGE_BASE', 'pictures');
	define('MAX_WIDTH', 150);
	define('MAX_HEIGHT', 150);

	// Get image location
	$image_file = $pic->picturepath;
	$image_path = "$image_file";

	//Get image extension etc, we need it to read the image
	$img = null;
	$ext = strtolower(end(explode('.', $image_path)));
	$g = 0;
	if ($ext == 'jpg' || $ext == 'jpeg') {
		$img = @imagecreatefromjpeg($image_path);
	} else if ($ext == 'png') {
		$img = @imagecreatefrompng($image_path);
	} else if ($ext == 'gif') {
		$img = @imagecreatefromgif($image_path);
		$g = 1;
	}

	if ($img) {
		//What is the width and height of image right now?
	    $width = imagesx($img);
		$height = imagesy($img);
	    $scale = min(MAX_WIDTH/$width, MAX_HEIGHT/$height);
	
		// If the image is larger than the max shrink it
	    if ($scale < 1) {
		    $new_width = floor($scale*$width);
			$new_height = floor($scale*$height);
			if ($g) {
				$tmp_img = imagecreate($new_width, $new_height) or die(_ADMIN_EDIT_STUDENT_1_ERROR1);
			} else {
			    $tmp_img = imagecreatetruecolor($new_width, $new_height);
			}

	        if (!imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
//				echo "Duh";
	        imagedestroy($img);
		    $img = $tmp_img;
	    }
	}

	# Create error image if necessary
	if (!$img) {
		echo _ADMIN_EDIT_STUDENT_1_ERROR2;
		$img = imagecreate(MAX_WIDTH, MAX_HEIGHT);
	    imagecolorallocate($img,0,0,0);
		$c = imagecolorallocate($img,70,70,70);
	    imageline($img,0,0,MAX_WIDTH,MAX_HEIGHT,$c2);
		imageline($img,MAX_WIDTH,0,0,MAX_HEIGHT,$c2);
	}
	
	//Create a temp file for this load only
	//	header("Content-type: image/jpeg");
	//  imagejpeg($img);
	$x = time();
	$tfile = $_SERVER['DOCUMENT_ROOT']."/pictures/temp/".$x.".jpeg";
	$tfile = "pictures/temp/".$x.".jpeg";
	imagejpeg($img, $tfile);
	$fpath = "http://".$_SERVER['HTTP_HOST']."/pictures/temp/".$x.".jpeg";
	$fpath = "pictures/temp/".$x.".jpeg";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_EDIT_STUDENT_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php if ($pic->picturepath != NULL) {?>
		<div style="float: right; width: 150px; height: 150px; vertical-align:top; text-align: right;">
			<img src="<?php echo $fpath;?>">
		</div>
	<?php } ?>
	<h1><? echo _ADMIN_EDIT_STUDENT_1_TITLE?></h1>
	<br>
	<h2><? echo $studentinfo->studentbio_fname . " " .
$studentinfo->studentbio_mi . " " . $studentinfo->studentbio_lname . " "
.  $studentinfo->generations_desc . " (" .
$studentinfo->studentbio_gender . ")"; ?><input type="button"
name="addc" value="<? echo _ADMIN_EDIT_STUDENT_1_ADD_CONTACT?>" class="frmbut" onclick="javascript:
window.location='admin_add_edit_contact_1.php?studentid=<? echo
$studentid; ?>&action=new&rback=rback';">
<!--
// commented out by Helmut
// the student's schedule is constructed by the homeroom he is in
<input type="button"
name="viewsched" value="<? echo _ADMIN_EDIT_STUDENT_1_VIEW_SCHEDULE?>" class="frmbut"
onclick="javascript:window.location='admin_stu_schedule.php?studentid=<?
echo $studentid; ?>';">
//
-->
<input
type="button"
name="addp" value="<? echo _ADMIN_EDIT_STUDENT_1_ADD_PIC?>" class="frmbut" onclick="javascript:window.location='admin_add_edit_picture.php?studentid=<? echo $studentid; ?>&action=new&rback=rback';"></h2>
	<br>
	<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_INTERNAL_ID?></td>
		    <td width="66%" colspan="2">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ETHNICITY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->studentbio_internalid; ?></td>
		    <td width="66%" colspan="2">&nbsp;<? echo $studentinfo->ethnicity_desc; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_BIRTHDATE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_SCHOOL?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_GRADE?></td>
		  </tr>
		  <tr class="tblcont">
			<td width="34%">&nbsp;<? echo $studentinfo->sdob; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->school_names_desc; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->grades_desc; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ACTIVE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_HOMED?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_SPED?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? if($studentinfo->studentbio_active==1){echo _YES;}else{echo _NO;};
		    ?></td>
		    <td width="33%">&nbsp;<? if($studentinfo->studentbio_homed==1){echo _YES;}else{echo _NO;};?></td>
		    <td width="33%">&nbsp;<? if($studentinfo->studentbio_sped==1){echo _YES;}else{echo _NO;};?></td>
		  </tr>
			<?		  
  		    //check for entry actions and display by Joshua
		    if(count($entries) && $entries != NULL) {
				?> <tr><td colspan=3><table cellpadding="0" cellspacing="1" width="100%">
	    		<tr class="tblhead"><td><? echo _ADMIN_EDIT_STUDENT_1_ENTRY_RECORD?></td>
	    		<td><? echo _ADMIN_EDIT_STUDENT_1_NOTES?></td></tr><?
		    		foreach($entries as $entry) {
		    			?><tr class="tblcont"><td><?
		    			echo(ucwords($entry->action_code));
		    			if($entry->action_code == 'entry') {echo _ADMIN_EDIT_STUDENT_1_INTO;}
		    			if($entry->action_code == 'exit') {echo _ADMIN_EDIT_STUDENT_1_FROM;}
		    			echo($entry->school_names_desc);
		    			?> on <? echo($entry->action_date);
		    			?> for year <? echo($entry->school_years_desc);
		    			?></td><td><? echo($entry->action_notes);
		    			?></td></tr><?
		    		} 
		    		?></table></td></tr><?
		    } //end entry actions
			?>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_HOME?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_TEACHER?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ROUTE?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->school_rooms_desc; ?></td>
		    <td width="33%">&nbsp;<? if($studentinfo->teachers_fname=="Select"){echo "";}else{echo $studentinfo->teachers_fname." ".$studentinfo->teachers_lname;}; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_bus; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_BIRTHCITY?></td>
			<td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_BIRTHSTATE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_BIRTHCOUNTRY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->studentbio_birthcity; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_birthstate; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_birthcountry; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLNAME?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLADDRESS?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCITY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->studentbio_prevschoolname; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_prevschooladdress; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_prevschoolcity; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLSTATE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLZIP?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCOUNTRY?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $studentinfo->studentbio_prevschoolstate; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_prevschoolzip; ?></td>
		    <td width="33%">&nbsp;<? echo $studentinfo->studentbio_prevschoolcountry; ?></td>
		  </tr>
		  <?
		  //display custom field list by Joshua
            if(count($student_custom_fields)) {
			?><tr><td colspan=3><h2><? echo _ADMIN_EDIT_STUDENT_1_CUSTOM_FIELDS?></h2></td></tr>
			<tr><td colspan=3><table width="100%"><?
     	     foreach($student_custom_fields as $student_custom_field) {
  				?><tr><td class="tblhead"><?
  				echo($student_custom_field->name);
  				?>:</td><td class="tblcont"><?
				echo($student_custom_field->data);
     	     	?></td></tr><?
     	     }
			?></table></td></tr><?
		 } 
		 //end of custom fields
		 ?>
		  <tr>
		    <td width="100%" colspan="3" align="right"><a href="admin_edit_student_3.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_1_EDIT_STUDENT?></a>&nbsp;</td>
		  </tr></table> 
		<p><h2><? echo _ADMIN_EDIT_STUDENT_1_PRIMARY_CONTACT?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $title_desc 
. " " . 
$primcontinfo->studentcontact_fname . " " .$primcontinfo->studentcontact_lname . " (" . $primcontinfo->relation_codes_desc . ")" ;?>
			<? if ($primcontinfo->contact_to_students_residence==1){echo " <font color=#FF0000><b>" . _ADMIN_EDIT_STUDENT_1_RESIDENCE . "</b></font>";}; ?>
			</td>
		  </tr>
		  <tr class="tblhead">
		    <td width="100%" colspan="3">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ADDRESS?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="100%" colspan="3">&nbsp;<? echo $primcontinfo->studentcontact_address1 . " " . $primcontinfo->studentcontact_address2 ;?> </td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_CITY?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_STATE?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ZIP?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $primcontinfo->studentcontact_city ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->state_name ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_zip ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PHONE1?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PHONE2?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_PHONE3?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="34%">&nbsp;<? echo $primcontinfo->studentcontact_phone1 ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_phone2 ; ?></td>
		    <td width="33%">&nbsp;<? echo $primcontinfo->studentcontact_phone3 ; ?></td>
		  </tr>
		  <tr class="tblhead">
		    <td width="67%" colspan="2">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_EMAIL?></td>
		    <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_WEB_USER?></td>
		  </tr>
		  <tr class="tblcont">
		    <td width="67%" colspan="2">&nbsp;<? echo $primcontinfo->studentcontact_email ; ?></td>
		    <td width="33%">&nbsp;<? if($primcontinfo->contact_to_students_internet==1){echo _YES;}else{echo _NO;};?></td>
		  </tr>
		  <tr>
		    <td width="100%" colspan="3" align="right"><a href="admin_add_edit_contact_5.php?&contactid=<? echo $primarycontact; ?>&studentid=<? echo $studentid; ?>&type=Primary&contacttostudentsid=<? echo $primcontinfo->contact_to_students_id; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_1_EDIT_PRIMARY?></a>&nbsp;</td>
		  </tr>
	</table>
	<?
	if ($ac==1){
	?>
		<h2><? echo _ADMIN_EDIT_STUDENT_1_ADD_CONTACTS?></h2>
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		  <tr class="tblhead">
		    <td width="30%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ADD_FIRST_NAME?></td>
			<td width="30%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ADD_LAST_NAME?></td>
			<td width="15%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ADD_RELATION?></td>
			<td width="25%" colspan="2">&nbsp;<? echo _ADMIN_EDIT_STUDENT_1_ADD_WEB_USER?></td>
		  </tr>
		  <?foreach($addcontlist as $adc){?>
			  <tr class="tblcont">
			    <td width="30%">&nbsp;<? echo $adc->studentcontact_fname; ?></td>
				<td width="30%">&nbsp;<? echo $adc->studentcontact_lname; if($adc->contact_to_students_residence==1){echo " <font color=#FF0000><b>R</b></font>";}?></td>
				<td width="15%">&nbsp;<? echo $adc->relation_codes_desc; ?></td>
				<td width="15%">&nbsp;<? if($adc->contact_to_students_internet==1){echo _YES;}else{echo _NO;};?></td>
				<td width="10%">&nbsp;<a href="admin_edit_student_2.php?studentid=<?echo $studentid;?>&contactid=<?echo $adc->studentcontact_id; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_1_DETAILS?></a></td>
			  </tr>
		  <? };?>
		</table>
	<?
	};
	?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
