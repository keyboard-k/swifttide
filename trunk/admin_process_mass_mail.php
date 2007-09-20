<?php
session_start();
//Inizialize database functions
include_once "ez_sql.php";

//Include global functions
include_once "common.php";

// config
include_once "configuration.php";

$mailto=get_param("mailto");
$message=stripslashes(get_param("message"));
$subject=get_param("subject");

if ($mailto!="both"){
	$sSQL="SELECT ".$mailto."_email AS email FROM $mailto";
	$emails = $db->get_results($sSQL);
}else{
	$sSQL1="SELECT teachers_email AS email FROM teachers";
	$sSQL2="SELECT studentcontact_email AS email FROM studentcontact";
	$emails_teach=$db->get_results($sSQL1);
	$emails_conta=$db->get_results($sSQL2);
};

require_once "class.phpmailer.php";
$mail = new PHPMailer();

$mail->IsSMTP();  // send via SMTP
$mail->Host     = $SMTP_SERVER; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $SMTP_USER;  // SMTP username
$mail->Password = $SMTP_PASSWORD; // SMTP password
$mail->From     = $SMTP_FROM_EMAIL;
$mail->FromName = $SMTP_FROM_NAME;
$mail->AddAddress($SMTP_FROM_EMAIL,_ADMIN_PROCESS_MASS_MAIL_GENERAL);
if ($mailto!="both"){
   foreach ($emails as $emails){
     if ($emails->email != "") { $mail->AddBCC($emails->email); }
   };
}else{
   foreach ($emails_teach as $emails){
     if ($emails->email != "") { $mail->AddBCC($emails->email); }
   };
   foreach ($emails_conta as $emails){
     if ($emails->email != "") { $mail->AddBCC($emails->email); }
   };
};
$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
$mail->WordWrap = 70;     // set word wrap
$mail->Subject  =  $subject;
$mail->Body = $message;
if($mail->Send()){
	header("Location: admin_main_menu.php");
	exit();
};
echo $mail->ErrorInfo;
?>
