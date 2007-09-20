<?php
//*
// grade_student_4.php
// Teacher Section
// Add bulk grades
//*
//Version 1.01 April 15, 2005
//Version 1.01 fixed validation of fields, doesn't add data if valid. fails
//V1.02 not adding web user creating DB errors.  Fixed.
//V1.03 May 15, 2005.  Subject reports correctly.  Added "go to next student" link.

//Check if teacher is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "T")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];
$current_year=$_SESSION[currentyear];
$web_user=$_SESSION['UserId'];

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

//Get student id
$studentid=$_SESSION[kidid];
//Get grade id
$gradeid=get_param("gradeid");
//Get action
//$action=get_param("action");
$grade_history_student = $studentid;

$grade_history_year = $current_year;
$term=$_SESSION[term];

//Get info from form
$term2=tosql($term, "Text");
$grade=get_param("overall");
$effort=get_param("effort");
$conduct=get_param("conduct");
$gradenotes=tosql(get_param("gradenotes"), "Text");
$comment1=get_param("comment1");
$comment2=get_param("comment2");
$comment3=get_param("comment3");

$sSQL="SELECT web_users_relid FROM web_users WHERE web_users_id='".$web_user."'";
$hold=$db->get_var($sSQL);
$sSQL="SELECT teachers_school FROM teachers WHERE teachers_id='".$hold."'";
$sschool=$db->get_var($sSQL);

//Validate fields
$msgFormErr="";
if(!strlen($term)){
	$msgFormErr.=_GRADE_STUDENT_4_ENTER_QUARTER . "<br>";
};
if(strlen($grade)<1) {
	$msgFormErr.=_GRADE_STUDENT_4_ENTER_OVERALL . "<br>";
};
if(!strlen($effort)){
	$msgFormErr.=_GRADE_STUDENT_4_ENTER_EFFORT . "<br>";
};
if(!strlen($conduct)){
	$msgFormErr.=_GRADE_STUDENT_4_ENTER_CONDUCT . "<br>";
};

//After validation, we must convert the grade,effort,conduct fields to text for insertion into the db.
$grade=tosql($grade, "Text");
$effort=tosql($effort, "Text");
$conduct=tosql($conduct, "Text");

//Errors found
if(strlen($msgFormErr>0)){
   $msgheader=_GRADE_STUDENT_4_FORMERROR;
};

//No errors found
if(!strlen($msgFormErr)){
//	if($action=="update"){
//		$msgheader="Updating";
//		$sSQL="UPDATE grade_history SET grade_history_quarter='".$quarter."', grade_history_grade='".$grade."', grade_history_effort='".$effort."', grade_history_conduct='".$conduct."', grade_history_comment1='".$comment1."', grade_history_comment2='".$comment2."', grade_history_comment3='".$comment3."', grade_history_notes='".$gradenotes."' WHERE grade_history_id='".$gradeid."'";
//		$db->query($sSQL);
//		$url="teacher_manage_grades_2.php?studentid=".$studentid."&gradeid=".$gradeid;
//		header("Location: $url");
//		exit();
//	}else{
		$term = $_SESSION[term];
		$notify=get_param("notify");
		// $msgheader="Adding";
		$msgheader="Adding";
		$sSQL="INSERT INTO grade_history (grade_history_student, 
grade_history_year, grade_history_school, grade_history_quarter, 
grade_history_grade, grade_history_effort, grade_history_conduct, 
grade_history_notes, grade_history_user, grade_history_comment1, 
grade_history_comment2, grade_history_comment3, grade_history_subject) VALUES($studentid, $current_year, $sschool, $term2, $grade, $effort, $conduct, $gradenotes, $web_user, $comment1, $comment2, $comment3, $subject)";
		$db->query($sSQL);
		if ($notify==1){
			$sSQL="SELECT studentcontact.studentcontact_email, studentcontact.studentcontact_fname, studentcontact.studentcontact_lname, contact_to_students.contact_to_students_student FROM contact_to_students INNER JOIN studentcontact ON contact_to_students.contact_to_students_contact = studentcontact.studentcontact_id WHERE contact_to_students_student='".$studentid."'";
			if($addresses=$db->get_results($sSQL)){
				$sSQL="SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id='".$studentid."'";
				$student=$db->get_row($sSQL);
				$sfname=$student->studentbio_fname;
				$slname=$student->studentbio_lname;
				require_once "class.phpmailer.php";
				$mail = new PHPMailer();
				$mail->IsSMTP();                                   // send via SMTP
				$mail->Host     = $SMTP_SERVER; // SMTP servers
				$mail->SMTPAuth = true;     // turn on SMTP authentication
				$mail->Username = $SMTP_USER;  // SMTP username
				$mail->Password = $SMTP_PASSWORD; // SMTP password
				$mail->From     = $SMTP_FORM_EMAIL;
				$mail->FromName = $SMTP_FORM_NAME;
				foreach($addresses as $address){
					$mail->AddAddress($address->studentcontact_email, $address->studentcontact_fname." ".$address->studentcontact_lname);
					};
				$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FORM_NAME);
				$mail->WordWrap = 70;                              // set word wrap
				$mail->Subject  = _GRADE_STUDENT_4_SUBJECT . $sfname." ".$slname; 
				$mail->Body = _GRADE_STUDENT_4_BODY1 . $sfname." ".$slname . _GRADE_STUDENT_4_BODY2;
				$mio=$mail->Send();
			};
		};
		//$url="grade_student_2.php?studentid=".$studentid;
		//header("Location: $url");
		//exit();
	};
//};
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
	<h1> <?php echo $msgheader; ?> <?php echo _GRADE_STUDENT_4_TITLE?></h1>
	<br>
	<a href="javascript:window.close();"><h2><?php echo _GRADE_STUDENT_4_CONTINUE?></h2></a>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php if($_SESSION['UserType'] == "A") {
        include "admin_menu.inc.php";
        } else {
        include "teacher_menu.inc.php";
}; ?>
</body>

</html>
