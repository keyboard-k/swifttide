<?php
//*
// admin_edit_student_4.php
// Admin Section
// Process the new student and add primary contact
//v1.5 12-08-05 true multiyear features
//v1.5.1 12-08-05 homeroom was not being updated if student was edited
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

//Set variable for menu
$menustudent=1;

//Gather info from form post
$internalid=trim(strtoupper(get_param("internalid")));
$active=get_param("active");
if($active=="")
	$active=0;
$slname=tosql(get_param("slname"), "Text");
$sfname=tosql(get_param("sfname"), "Text");
$mi=get_param("mi");
$generation=get_param("generation");
$sped=get_param("sped");
if($sped=="")
	$sped=0;
$gender=get_param("gender");
$ethnicity=get_param("ethnicity");
// $dob=strtotime(get_param("dob"));
// $dob=date("Y/m/d", $dob);
// $dob=date("Y-m-d", strtotime(get_param("dob")));
$dob=get_param("dob");
$bcity=tosql(get_param("bcity"), "Text");
$bstate=tosql(get_param("bstate"), "Text");
$bcountry=tosql(get_param("bcountry"), "Text");
$pschoolname=tosql(get_param("pschoolname"), "Text");
$pschooladdress=tosql(get_param("pschooladdress"), "Text");
$pschoolcity=tosql(get_param("pschoolcity"), "Text");
$pschoolstate=tosql(get_param("pschoolstate"), "Text");
$pschoolzip=tosql(get_param("pschoolzip"), "Text");
$pschoolcountry=tosql(get_param("pschoolcountry"), "Text");
$school=get_param("school");
$homed=get_param("homed");
if($homed=="")
	$homed=0;
$grade=get_param("grade");
$current_year_id=$_SESSION['CurrentYear'];
$studentid=get_param("studentid");
$teacher=get_param("teacher");
$homeroom=tosql(get_param("homeroom"), "Text");
$bus=tosql(get_param("bus"), "Text");
//get custom fields
$student_custom_fields = get_param("student_custom_fields");	//array
$custom_fields = get_param("custom_fields");	//array
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");

//get new action entry
$do_new_action = get_param("do_new_action");
$new_action_school = get_param("new_action_school");
$new_action_code = get_param("new_action_code");
$new_action_date = get_param("new_action_date");
$new_action_school_year = get_param("new_action_school_year");
$new_action_notes = get_param("new_action_notes");
$delete_entry_actions = get_param("delete_entry_actions");	//array

//Validate mandatory fields
$msgFormErr="";
if(!strlen($internalid))
      $msgFormErr .= _ADMIN_EDIT_STUDENT_4_ENTER_ID . "<br>";
if(!strlen($slname))
      $msgFormErr .= _ADMIN_EDIT_STUDENT_4_ENTER_LAST . "<br>";
if(!strlen($sfname))
      $msgFormErr .= _ADMIN_EDIT_STUDENT_4_ENTER_FIRST . "<br>";
if(!strlen($dob)){
      $msgFormErr .= _ADMIN_EDIT_STUDENT_4_ENTER_DOB . "<br>";
}else{
	list($year, $month, $day) = explode("-",$dob);
	if (!checkdate($month, $day, $year))
		$msgFormErr .= _ADMIN_EDIT_STUDENT_4_FORM_ERROR . "<br>";
};
if (!strlen($msgFormErr)){
	//Check for duplicate internalid
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_internalid='$internalid' AND studentbio_id<>$studentid";
	if ($dblid=$db->get_row($sSQL)){
		$msgFormErr.="Internal ID already assigned to ".$dblid->studentbio_fname ." ".$dblid->studentbio_lname ."<br>";
	}else{
		$sSQL="UPDATE studentbio SET studentbio_internalid='$internalid', studentbio_active='".$active."', studentbio_lname='".$slname."', studentbio_fname='".$sfname."', studentbio_mi='".$mi."', studentbio_generation='".$generation."', studentbio_sped='".$sped."', studentbio_gender='".$gender."', studentbio_ethnicity='".$ethnicity."', studentbio_dob='".$dob."', studentbio_birthcity='".$bcity."', studentbio_birthstate='".$bstate."', studentbio_birthcountry='".$bcountry."', studentbio_prevschoolname='".$pschoolname."', studentbio_prevschoolcity='".$pschoolcity."', studentbio_prevschoolstate='".$pschoolstate."', studentbio_prevschoolzip='".$pschoolzip."', studentbio_prevschoolcountry='".$pschoolcountry."', studentbio_school='".$school."', studentbio_homed='".$homed."', studentbio_teacher='".$teacher."', studentbio_homeroom='".$homeroom."', studentbio_bus='".$bus."' WHERE studentbio_id='".$studentid."'";
		$db->query($sSQL);
		$sSQL="UPDATE student_grade_year SET student_grade_year_grade='".$grade."' WHERE student_grade_year_student='".$studentid."'";
		$db->query($sSQL);
		
		//update students custom fields added by Joshua
		if(count($student_custom_fields) && $student_custom_fields != NULL) {
			while(list($custom_student_id, $custom_student_data)  = each($student_custom_fields)) {
				if($custom_student_id == '0') {
					//delete the field if delete is selected
					$student_custom_update_sql = "DELETE from custom_studentbio 
						WHERE custom_studentbio_id = '$custom_student_id'";
				} else {
					$student_custom_update_sql = "UPDATE custom_studentbio SET custom_field_id = '";
					$student_custom_update_sql .= $custom_fields[$custom_student_id];
					$student_custom_update_sql .= "', data = '$custom_student_data' WHERE custom_studentbio_id = '";
					$student_custom_update_sql .= $custom_student_id;
					$student_custom_update_sql .= "'";
				}
				$db->query($student_custom_update_sql);
			}
		}
		//adding a new field if one has been entered
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$student_custom_insert_sql = "INSERT into custom_studentbio SET 
				custom_field_id = '$new_custom_field_id', 
				studentbio_id = '$studentid',
				data = '$new_custom_field_data'";
			$db->query($student_custom_insert_sql);
		} //end custom fields
		if($delete_entry_actions > 0) {
			foreach($delete_entry_actions as $delete_entry_id) {
				$delete_entry_sql = "DELETE from entry_actions WHERE entry_actions_id = '$delete_entry_id'";
				$db->query($delete_entry_sql);
			}
		}
		
		//new entry event
		if($do_new_action) {
			//convert the date from the javascript date picker to what mysql likes
			$tc = 0;
			$tok = strtok($new_action_date, "/");
			while ($tok) {
				$td[$tc] = $tok;
				$tc++;   			
   			$tok = strtok("/");
   		}
   		$new_action_db_date = $td[2]."-".$td[0]."-".$td[1];
			//insert the new entry
			$new_entry_action_sql = "INSERT INTO entry_actions SET 
				student_id = '$studentid',
				school_id = '$new_action_school',
				school_year_id = '$new_action_school_year',
				action_code = '$new_action_code',
				action_date = '$new_action_db_date',
				action_notes = '$new_action_notes'";
			$db->query($new_entry_action_sql);
		}

		$url="admin_edit_student_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_EDIT_STUDENT_4_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	   <h1><?php echo _ADMIN_EDIT_STUDENT_4_TITLE?></h1>
	   <br>
	   <h3><?php echo $msgFormErr ; ?></h2>
	   <br>
	   <h2><?php echo _ADMIN_EDIT_STUDENT_4_ERROR_BACK?></h2>
	   <br>
	   <a href="admin_edit_student_1.php?studentid=<?php echo $studentid; ?>" class="aform"><?php echo _ADMIN_EDIT_STUDENT_4_BACK?></a>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
