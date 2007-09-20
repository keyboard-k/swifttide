<?php
//*
// teacher_manage_grades_4.php
// Admin Section
// Add or update grade note
//V1.1 11-27-05 Properly add subject to DB.  Due to table changes.
//v1.51 12-28-05 subject display fix
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
$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";
$msgHeader = "";

//Get student id
$studentid=get_param("studentid");
//Get grade id
$gradeid=get_param("gradeid");
//Get action
$action=get_param("action");
//Get subject
$subject_id=get_param("subject");
$sSQL="SELECT grade_subject_desc FROM grade_subjects WHERE 
grade_subject_id=$subject_id";
$subject_name=$db->get_var($sSQL);

//Get info from form
$quarter=get_param("quarter");
$grade=get_param("grade");
$effort=get_param("effort");
$conduct=get_param("conduct");
$gradenotes=tosql(get_param("gradenotes"), "Text");
$comment1=get_param("comment1");
$comment2=get_param("comment2");
$comment3=get_param("comment3");
$subject=get_param("subject");

//get custom fields
$custom_grade_fields = get_param("custom_grade_fields");	//array
$custom_fields = get_param("custom_fields");
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");

//Validate fields
$msgFormErr="";
if(!strlen($quarter)){
	$msgFormErr.=_TEACHER_MANAGE_GRADES_4_ENTER_TERM . "<br>";
};
if(!strlen($grade)){
	$msgFormErr.=_TEACHER_MANAGE_GRADES_4_ENTER_GRADE . "<br>";
};
if(!strlen($effort)){
	$msgFormErr.=_TEACHER_MANAGE_GRADES_4_ENTER_EFFORT . "<br>";
};
if(!strlen($conduct)){
	$msgFormErr.=_TEACHER_MANAGE_GRADES_4_ENTER_CONDUCT . "<br>";
};


//No errors found

//Now convert the grades to text to avoid MySQL errors
$grade=tosql(get_param("grade"), "Text");
$effort=tosql(get_param("effort"), "Text");
$conduct=tosql(get_param("conduct"), "Text");

if(!strlen($msgFormErr)){
	if($action=="update"){
		$msgheader="Updating";
		$sSQL="UPDATE grade_history SET 
grade_history_quarter=$quarter, grade_history_grade=$grade, 
grade_history_effort=$effort, 
grade_history_subject=$subject_id, grade_history_conduct=$conduct, 
grade_history_comment1=$comment1, grade_history_comment2=$comment2, grade_history_comment3=$comment3, grade_history_notes=$gradenotes WHERE grade_history_id=$gradeid";
		$db->query($sSQL);

		//update custom fields added by Joshua
		if(count($custom_grade_fields) && $custom_grade_fields != NULL) {
			while(list($custom_grade_id, $custom_grade_data)  = each($custom_grade_fields)) {
				if($custom_grade_id == '0') {
					//delete the field if delete is selected
					$custom_grade_update_sql = "DELETE from custom_grade_history 
						WHERE custom_grade_history_id = '$custom_grade_id'";
				} else {
					$custom_grade_update_sql = "UPDATE custom_grade_history SET custom_field_id = '";
					$custom_grade_update_sql .= $custom_fields[$custom_grade_id];
					$custom_grade_update_sql .= "', data = '$custom_grade_data' 
						WHERE custom_grade_history_id = '";
					$custom_grade_update_sql .= $custom_grade_id;
					$custom_grade_update_sql .= "'";
				}
				$db->query($custom_grade_update_sql);
			}
		} 
		//adding a new field if one has been entered
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_grade_insert_sql = "INSERT into custom_grade_history SET 
				custom_field_id = '$new_custom_field_id', 
				grade_history_id = '$gradeid', 
				data = '$new_custom_field_data'";
			$db->query($custom_grade_insert_sql);
		} //end custom fields

		$url="teacher_manage_grades_2.php?studentid=".$studentid."&gradeid=".$gradeid;
		header("Location: $url");
		exit();
	}else{
		$sschool=get_param("sschool");
		$notify=get_param("notify");
		$msgheader="Adding";
		$sSQL="INSERT INTO grade_history (grade_history_student, 
grade_history_year, grade_history_school, grade_history_quarter, 
grade_history_effort, grade_history_grade, grade_history_conduct, 
grade_history_notes, grade_history_user, grade_history_comment1, 
grade_history_comment2, grade_history_comment3, grade_history_subject) 
VALUES($studentid, 
$current_year, $sschool, $quarter, $effort, $grade, $conduct, $gradenotes, 
$web_user, $comment1, $comment2, $comment3, $subject_id)";

		$db->query($sSQL);
		if ($notify==1){
			$sSQL="SELECT studentcontact.studentcontact_email, studentcontact.studentcontact_fname, studentcontact.studentcontact_lname, contact_to_students.contact_to_students_student FROM contact_to_students INNER JOIN studentcontact ON contact_to_students.contact_to_students_contact = studentcontact.studentcontact_id WHERE contact_to_students_student=$studentid";
			if($addresses=$db->get_results($sSQL)){
				$sSQL="SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id=$studentid";
				$student=$db->get_row($sSQL);
				$sfname=$student->studentbio_fname;
				$slname=$student->studentbio_lname;
				require_once "class.phpmailer.php";
				$mail = new PHPMailer();
//				$mail->IsSMTP();                                   // send via SMTP
//				$mail->Host     = SMTP_SERVER; // SMTP servers
//				$mail->SMTPAuth = true;     // turn on SMTP authentication
//				$mail->Username = SMTP_USER;  // SMTP username
//				$mail->Password = SMTP_PASSWORD; // SMTP password
				$mail->From     = $SMTP_FROM_EMAIL;
				$mail->FromName = $SMTP_FROM_NAME;
				foreach($addresses as $address){
					$mail->AddAddress($address->studentcontact_email, $address->studentcontact_fname." ".$address->studentcontact_lname);
					};
				$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
				$mail->WordWrap = 70;                              // set word wrap
				$mail->Subject  = _TEACHER_MANAGE_GRADES_4_SUBJECT . $sfname." ".$slname; 
				$mail->Body = _TEACHER_MANAGE_GRADES_4_BODY1 . $sfname." ".$slname . _TEACHER_MANAGE_GRADES_4_BODY2;
				$mio=$mail->Send();
			};
		};

		//adding a new field if one has been entered by Joshua
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_grade_insert_sql = "INSERT into custom_grade_history SET 
				custom_field_id = '$new_custom_field_id', 
				grade_history_id = '$gradeid',
				data = '$new_custom_field_data'";
			$db->query($custom_grade_insert_sql);
		} //end custom fields

		$url="teacher_manage_grades_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	};
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
	<h1><?php echo _ERROR?> <?php echo $msgheader; ?> <?php echo _TEACHER_MANAGE_GRADES_4_GRADE_NOTE?></h1>
	<br>
	<h2><?php echo _TEACHER_MANAGE_GRADES_4_ERROR_BACK?></h2>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php include "teacher_menu.inc.php"; ?>
</body>

</html>

