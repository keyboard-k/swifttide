<?php
//*
// admin_media_codes_3.php
// Admin Section
// Send notifications to contacts of media due within 7 days
// Version 1.0 Sept 2007 Helmut
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

$menustudent=1;		// do we need this?
$current_year=$_SESSION['CurrentYear'];

// what to do
$action=get_param("action");

	$today = date("Y-m-d");

	// $startdate=mktime (0,0,0,9,13,2007);
	// $tage2=floor((time()-$startdate)/86400);
	// echo "<b>$tage2</b>";

	//Get media history
	$sSQL="SELECT studentcontact.studentcontact_email AS email, 
	media_codes.media_codes_desc AS code, 
	studentbio.studentbio_fname AS fname, 
	studentbio.studentbio_lname AS lname 
	FROM (((media_history 
	INNER JOIN media_codes ON media_history.media_history_code = media_codes.media_codes_id) 
	INNER JOIN studentbio ON studentbio.studentbio_id = media_history.media_history_student) 
	INNER JOIN studentcontact ON studentcontact.studentcontact_id = studentbio.studentbio_primarycontact) 
	WHERE media_history.media_history_year='$current_year' 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') <= 7) 
	AND (DATEDIFF(media_history.media_history_datedue, '" . $today . "') >= 0) 
	ORDER BY media_history.media_history_datedue ASC";
	$emails = $db->get_results($sSQL);

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
    <td width="50%"><?php echo _ADMIN_MEDIA_CODES_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
	if(!strlen($msgFormErr)){
	?>
	<h1><?php echo _ADMIN_MEDIA_CODES_2_TITLE?></h1>
	<br>
	<?php
	// $ezr->display();
	// print_r($emails);

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

foreach ($emails as $email){
  if ($email->email != "") {
    $mail->AddBCC($email->email);
    $subject  = _ADMIN_MEDIA_CODES_4_SUBJECT . ": " . $email->code;
    $message  = $email->fname . " " . $email->lname . ": ";
    $message .= $email->code . "... " . _ADMIN_MEDIA_CODES_4_MESSAGE;
    echo "<b>"._ADMIN_MEDIA_CODES_4_EMAIL.":</b> $email->email<br><b>" .
               _ADMIN_MEDIA_CODES_4_SUB.":</b> $subject<br><b>" .
	       _ADMIN_MEDIA_CODES_4_MESS.":</b> $message<br><br>";
  }
};
$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
$mail->WordWrap = 70;     // set word wrap
$mail->Subject  =  $subject;
$mail->Body = $message;
// if($mail->Send()){
//         header("Location: admin_media_codes.php");
//         exit();
// };
echo $mail->ErrorInfo;
?>

	<br>
	<table>

	</table>

	<?php
	}else{
	?>
	<h1><?php echo _ERROR?></h1>
	<br>
	<h3><?php echo $msgFormErr; ?></h3>
	<br>
	<?php
	};
	?>
</div>
<?php include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
