<?
//*
// teacher_manage_discipline_4.php
// Teachers Section
// Add or update discipline note
// Version 1.01, May 8 2005.
//V1.01 Fixed mailer issue.
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
// Include Configuration
include_once "configuration.php";

//Get student id
$studentid=get_param("studentid");
//Get discipline id
$disid=get_param("disid");
//Get action
$action=get_param("action");

//Get info from form
$discode=get_param("discode");
$disdate=date("Y/m/d", strtotime(get_param("disdate")));
$sdate=date("Y/m/d", strtotime(get_param("sdate")));
$edate=date("Y/m/d", strtotime(get_param("edate")));
$disaction=get_param("disaction");
$disreporter=get_param("disreporter");
$disnotes=get_param("disnotes");

//get custom fields
$custom_discipline_fields = get_param("custom_discipline_fields");	//array
$custom_fields = get_param("custom_fields");	//array
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");

//Validate mandatory fields
$msgFormErr="";
if(!$discode){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_CODE."<br>";
};
if(!strlen($disdate)){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_DATE."<br>";
};
if(!strlen($sdate)){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_START."<br>";
};
if(!strlen($edate)){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_END."<br>";
};
if(!strlen($disaction)){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_ACTION."<br>";
};
if(!strlen($disreporter)){
	$msgFormErr.=_TEACHER_MANAGE_DISCIPLINE_4_ENTER_WHO."<br>";
};

if(!strlen($msgFormErr)){
	if($action=="update"){
		$sSQL="UPDATE discipline_history SET discipline_history_code=$discode, discipline_history_date='$disdate', discipline_history_sdate='$sdate', discipline_history_edate='$edate', discipline_history_action=".tosql($disaction, "Text").", discipline_history_reporter=".tosql($disreporter, "Text").", discipline_history_notes=".tosql($disnotes, "Text")." WHERE discipline_history_id=$disid";
		$db->query($sSQL);

		//update custom fields added by Joshua
		if(count($custom_discipline_fields) && $custom_discipline_fields != NULL) {
			while(list($custom_discipline_id, $custom_discipline_data)  = each($custom_discipline_fields)) {
				if($custom_discipline_id == '0') {
					//delete the field if delete is selected
					$custom_discipline_update_sql = "DELETE from custom_discipline_history 
						WHERE custom_discipline_history_id = '$custom_discipline_id'";
				} else {
					$custom_discipline_update_sql = "UPDATE custom_discipline_history SET custom_field_id = '";
					$custom_discipline_update_sql .= $custom_fields[$custom_discipline_id];
					$custom_discipline_update_sql .= "', data = '$custom_discipline_data' 
						WHERE custom_discipline_history_id = '";
					$custom_discipline_update_sql .= $custom_discipline_id;
					$custom_discipline_update_sql .= "'";
				}
				$db->query($custom_discipline_update_sql);
			}
		} 
		//adding a new field if one has been entered
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_discipline_history SET 
				custom_field_id = '$new_custom_field_id', 
				discipline_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields

		$url="teacher_manage_discipline_2.php?studentid=".$studentid."&disid=".$disid;
		header("Location: $url");
		exit();
	}else{
		$sschool=get_param("sschool");
		$notify=get_param("notify");
		$sSQL="INSERT INTO discipline_history (discipline_history_student, discipline_history_school, discipline_history_year, discipline_history_code, discipline_history_date, discipline_history_sdate, discipline_history_edate, discipline_history_action, discipline_history_notes, discipline_history_reporter, discipline_history_user) VALUES ($studentid, $sschool, $current_year, $discode, '$disdate', '$sdate', '$edate', ".tosql($disaction, "Text").", ".tosql($disnotes, "Text").", ".tosql($disreporter, "Text").", $web_user)";
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
//			//	$mail->IsSMTP();                   // send via SMTP
//			//	$mail->Host     = SMTP_SERVER; // SMTP servers
//			//	$mail->SMTPAuth = true;     // turn on SMTP authentication
//			//	$mail->Username = SMTP_USER;  // SMTP username
//			//	$mail->Password = SMTP_PASSWORD; // SMTP password
//			//	$mail->From     = SMTP_SMS_ADMIN_EMAIL;
//			//	$mail->FromName = SMTP_SMS_ADMIN_NAME;
				$mail->From     = $SMTP_FROM_EMAIL;
				$mail->FromName = $SMTP_FROM_NAME;

				foreach($addresses as $address){
					$mail->AddAddress($address->studentcontact_email, $address->studentcontact_fname." ".$address->studentcontact_lname);
					};
				$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);

				$mail->WordWrap = 70;                              // set word wrap
				$mail->Subject  = _TEACHER_MANAGE_DISCIPLINE_4_SUBJECT.$sfname." ".$slname; 
				$mail->Body = _TEACHER_MANAGE_DISCIPLINE_4_BODY1 .$sfname." ".$slname. _TEACHER_MANAGE_DISCIPLINE_4_BODY2;
				$mio=$mail->Send();
				if (!$mio)
					echo $mail->ErrorInfo;
			};
		};

		//adding a new field if one has been entered by Joshua
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_discipline_history SET 
				custom_field_id = '$new_custom_field_id', 
				discipline_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields

		$url="teacher_manage_discipline_1.php?studentid=".$studentid;
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
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
  <h1><?php echo _ERROR?></h1>
   <br>
   <h2><?php echo _TEACHER_MANAGE_DISCIPLINE_4_ERROR_BACK?></h2>
   <br>
   <h3><? echo $msgFormErr; ?></h3>
</div>
<? include "teacher_menu.inc.php"; ?>
</body>

</html>

