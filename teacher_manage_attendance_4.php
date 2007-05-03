<?
//*
// teacher_manage_attendance_4.php
// Teachers Section
// Add or update attendance note
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

//Get student id
$studentid=get_param("studentid");
//Get attendace id
$attid=get_param("attid");
//Get action
$action=get_param("action");

//Get info from form
$attcode=get_param("attcode");
$attdate=get_param("attdate");
$attdate=strtotime($attdate);
$attdate=date( "Y/m/d", $attdate);
$attnotes=get_param("attnotes");

//get custom fields
$custom_attendance_fields = get_param("custom_attendance_fields");	//array
$custom_fields = get_param("custom_fields");
$new_custom_field_id = get_param("new_custom_field_id");
$new_custom_field_data = get_param("new_custom_field_data");

if($action=="update"){
	$sSQL="UPDATE attendance_history SET attendance_history_date='$attdate', attendance_history_code=$attcode, attendance_history_notes=".tosql($attnotes, "Text")." WHERE attendance_history_id=$attid";
	$db->query($sSQL);

	//update students custom fields added by Joshua
	if(count($custom_attendance_fields) && $custom_attendance_fields != NULL) {
		while(list($custom_attendance_id, $custom_attendance_data)  = each($custom_attendance_fields)) {
			if($custom_attendance_id == '0') {
				//delete the field if delete is selected
				$custom_attendance_update_sql = "DELETE from custom_attendance_history 
					WHERE custom_attendance_history_id = '$custom_attendance_id'";
			} else {
				$custom_attendance_update_sql = "UPDATE custom_attendance_history SET custom_field_id = '";
				$custom_attendance_update_sql .= $custom_fields[$custom_attendance_id];
				$custom_attendance_update_sql .= "', data = '$custom_attendance_data' 
					WHERE custom_attendance_history_id = '";
				$custom_attendance_update_sql .= $custom_attendance_id;
				$custom_attendance_update_sql .= "'";
			}
			$db->query($custom_attendance_update_sql);
		}
	}
	//adding a new field if one has been entered
	if($new_custom_field_id > 0 && $new_custom_field_data != '') {
		$custom_attendance_insert_sql = "INSERT into custom_attendance_history SET 
			custom_field_id = '$new_custom_field_id', 
			attendance_history_id = '$attid',
			data = '$new_custom_field_data'";
		$db->query($custom_attendance_insert_sql);
	} //end custom fields

	$url="teacher_manage_attendance_2.php?studentid=".$studentid."&attid=".$attid;
	header("Location: $url");
	exit();
}else{
	$sschool=get_param("sschool");
	$notify=get_param("notify");
	$sSQL="INSERT INTO attendance_history (attendance_history_student, attendance_history_school, attendance_history_year, attendance_history_date, attendance_history_code, attendance_history_notes, attendance_history_user) VALUES ($studentid, $sschool, $current_year, '$attdate', $attcode, ".tosql($attnotes, "Text").", $web_user)";
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
//			$mail->IsSMTP();                                   // send via SMTP
//			$mail->Host     = SMTP_SERVER; // SMTP servers
//			$mail->SMTPAuth = true;     // turn on SMTP authentication
//			$mail->Username = SMTP_USER;  // SMTP username
//			$mail->Password = SMTP_PASSWORD; // SMTP password
//			$mail->From     = SMTP_SMS_ADMIN_EMAIL;
//			$mail->FromName = SMTP_SMS_ADMIN_NAME;
                        $mail->From	= $SMTP_FROM_EMAIL;
                        $mail->FromName = $SMTP_FROM_NAME;
			foreach($addresses as $address){
				$mail->AddAddress($address->studentcontact_email, $address->studentcontact_fname." ".$address->studentcontact_lname);
			};
			$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
			$mail->WordWrap = 70;                              // set word wrap
			$mail->Subject  = "New attendance note for ".$sfname." ".$slname; 
			$mail->Body = _TEACHER_MANAGE_ATTENDANCE_4_BODY1 .$sfname." ".$slname. _TEACHER_MANAGE_ATTENDANCE_4_BODY2;
			$mio=$mail->Send();
		};
	};

	//adding a new field if one has been entered by Joshua
	if($new_custom_field_id > 0 && $new_custom_field_data != '') {
		$custom_attendance_insert_sql = "INSERT into custom_attendance_history SET 
			custom_field_id = '$new_custom_field_id', 
			attendance_history_id = '$attid',
			data = '$new_custom_field_data'";
		$db->query($custom_attendance_insert_sql);
	} //end adding custom fields

	$url="teacher_manage_attendance_1.php?studentid=".$studentid;
	header("Location: $url");
	exit();
};
?>

