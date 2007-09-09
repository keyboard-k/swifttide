<?
//*
// admin_manage_media_4.php
// Administrator Section
// Add or update media note
// Version 1, Sept 2007 Doug
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

$current_year=$_SESSION['CurrentYear'];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

$menustudent=1;

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


/* 
Though we don't have custom fields yet in this module, it would be 
easy enough to add them later, hence all this code stays, but commented.
//get custom fields
$custom_discipline_fields = get_param("custom_discipline_fields");	//array
$custom_fields = get_param("custom_fields");	//array
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");
*/

//Validate mandatory fields
$msgFormErr="";
if(!$discode){
	$msgFormErr.=_ADMIN_MANAGE_MEDIA_4_ENTER_CODE . "<br>";
};
if(!strlen($disdate)){
	$msgFormErr.=_ADMIN_MANAGE_MEDIA_4_ENTER_DATE . "<br>";
};
if(!strlen($sdate)){
	$msgFormErr.=_ADMIN_MANAGE_MEDIA_4_ENTER_START . "<br>";
};
if(!strlen($edate)){
	$msgFormErr.=_ADMIN_MANAGE_MEDIA_4_ENTER_END . "<br>";
};

if(!strlen($msgFormErr)){
	if($action=="update"){
		$sSQL="UPDATE media_history SET media_history_code=$discode, media_history_dateout='$disdate', media_history_datedue='$sdate', media_history_dateret='$edate', media_history_action=".tosql($disaction, "Text").", media_history_reporter=".tosql($disreporter, "Text").", media_history_notes=".tosql($disnotes, "Text")." WHERE media_history_id=$disid";
		$db->query($sSQL);

/* Again, comment out the stuff on custom fields

		//update custom fields added by Joshua
		if(count($custom_discipline_fields) && $custom_discipline_fields != NULL) {
			while(list($custom_discipline_id, $custom_discipline_data)  = each($custom_discipline_fields)) {
				if($custom_discipline_id == '0') {
					//delete the field if delete is selected
					$custom_discipline_update_sql = "DELETE from custom_media_history 
						WHERE custom_media_history_id = '$custom_discipline_id'";
				} else {
					$custom_discipline_update_sql = "UPDATE custom_media_history SET custom_field_id = '";
					$custom_discipline_update_sql .= $custom_fields[$custom_discipline_id];
					$custom_discipline_update_sql .= "', data = '$custom_discipline_data' 
						WHERE custom_media_history_id = '";
					$custom_discipline_update_sql .= $custom_discipline_id;
					$custom_discipline_update_sql .= "'";
				}
				$db->query($custom_discipline_update_sql);
			}
		} 
		//adding a new field if one has been entered
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_media_history SET 
				custom_field_id = '$new_custom_field_id', 
				media_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields
*/


$url="admin_manage_media_2.php?studentid=".$studentid."&disid=".$disid;
		header("Location: $url");
		exit();
	}else{
		$sschool=get_param("sschool");
		$notify=get_param("notify");
		$sSQL="INSERT INTO media_history (media_history_student, media_history_school, media_history_year, media_history_code, media_history_dateout, media_history_datedue, media_history_dateret, media_history_action, media_history_notes, media_history_reporter, media_history_user) VALUES ($studentid, $sschool, $current_year, $discode, '$disdate', '$sdate', '$edate', ".tosql($disaction, "Text").", ".tosql($disnotes, "Text").", ".tosql($disreporter, "Text").", $web_user)";
		$db->query($sSQL);
/* here was the mailer code to notify parents.  Should we ever want it
again, paste from admin_manage_discipline accordingly. */
/* Yeah, I did, cos I think it's a great feature! :-) */
                if ($notify==1){
                        $sSQL="SELECT studentcontact.studentcontact_email, studentcontact.studentcontact_fname, 
			studentcontact.studentcontact_lname, contact_to_students.contact_to_students_student 
			FROM contact_to_students 
			INNER JOIN studentcontact ON contact_to_students.contact_to_students_contact = studentcontact.studentcontact_id 
			WHERE contact_to_students_student=$studentid";
                        if($addresses=$db->get_results($sSQL)){
                                $sSQL="SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id=$studentid";
                                $student=$db->get_row($sSQL);
                                $sfname=$student->studentbio_fname;
                                $slname=$student->studentbio_lname;
                                require_once "class.phpmailer.php";
                                $mail = new PHPMailer();
//                      //      $mail->IsSMTP();                   // send via SMTP
//                      //      $mail->Host     = SMTP_SERVER; // SMTP servers
//                      //      $mail->SMTPAuth = true;     // turn on SMTP authentication
//                      //      $mail->Username = SMTP_USER;  // SMTP username
//                      //      $mail->Password = SMTP_PASSWORD; // SMTP password
//                      //      $mail->From     = SMTP_SMS_ADMIN_EMAIL;
//                      //      $mail->FromName = SMTP_SMS_ADMIN_NAME;
                                $mail->From     = $SMTP_FROM_EMAIL;
                                $mail->FromName = $SMTP_FROM_NAME;

                                foreach($addresses as $address){
                                        $mail->AddAddress($address->studentcontact_email, $address->studentcontact_fname." 
".$address->studentcontact_lname);
                                        };
//                              $mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);

                                $mail->WordWrap = 70;                              // set word wrap
                                $mail->Subject  = _ADMIN_MANAGE_MEDIA_4_SUBJECT . $sfname." ".$slname;
                                $mail->Body = _ADMIN_MANAGE_MEDIA_4_BODY1 . $sfname." ".$slname . 
				_ADMIN_MANAGE_MEDIA_4_BODY2;
                                $mio=$mail->Send();
                                if (!$mio)
                                        echo $mail->ErrorInfo;
                        };
                };


/* More custom field work
		//adding a new field if one has been entered by Joshua
		if($new_custom_field_id > 0 && $new_custom_field_data != '') {
			$custom_discipline_insert_sql = "INSERT into custom_media_history SET 
				custom_field_id = '$new_custom_field_id', 
				media_history_id = '$disid',
				data = '$new_custom_field_data'";
			$db->query($custom_discipline_insert_sql);
		} //end custom fields
*/
		$url="admin_manage_media_1.php?studentid=".$studentid;
		header("Location: $url");
		exit();
	};
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_MANAGE_MEDIA_4_UPPER?></td>
  </tr>
</table>
</div>
<div id="Content">
  <h1><? echo _ERROR?></h1>
   <br>
   <h2><? echo _ADMIN_MANAGE_MEDIA_4_ERROR_BACK ?></h2>
   <br>
   <h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
