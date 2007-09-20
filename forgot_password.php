<?php
//*
// forgot_password.php
// All Sections
// Form to retreive forgot password
//*

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

$action=get_param("action");

if ($action=="retrieve"){
	$forgotemail=get_param("forgotemail");
	//Validate email
	$oEmail = new email;
	if (!$oEmail->valida($forgotemail)){
		$msgFormErr = _FORGOT_PASSWORD_FORM_ERROR . "<br>";
	}else{
		if($retreive=$db->get_row("SELECT studentcontact_id, studentcontact_lname, studentcontact_fname FROM studentcontact WHERE studentcontact_email='$forgotemail'")){
			$name=$retreive->studentcontact_fname." ".$retreive->studentcontact_lname;
			$id=$retreive->studentcontact_id;
			$lostpassword=$db->get_var("SELECT web_users_password FROM web_users WHERE web_users_type='C' AND web_users_relid=$id");
		}else{
			if($retreive=$db->get_row("SELECT teachers_id, teachers_lname, teachers_fname FROM teachers WHERE teachers_email='$forgotemail'")){
				$name=$retreive->teachers_fname." ".$retreive->teachers_lname;
				$id=$retreive->teachers_id;
				$lostpassword=$db->get_var("SELECT web_users_password FROM web_users WHERE web_users_type='T' AND web_users_relid=$id");
			};
		};
	};
	if(strlen($lostpassword)){
		require_once "class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP();                                   // send via SMTP
		$mail->Host     = SMTP_SERVER; // SMTP servers
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = SMTP_USER;  // SMTP username
		$mail->Password = SMTP_PASSWORD; // SMTP password
		$mail->From     = SMTP_FROM_EMAIL;
		$mail->FromName = SMTP_FROM_NAME;
		$mail->AddAddress($forgotemail, $name);
		$mail->AddReplyTo(SMTP_REPLY_TO,SMTP_FROM_NAME);
		$mail->WordWrap = 70;                              // set word wrap
		$mail->Subject  = _FORGOT_PASSWORD_SUBJECT; 
		$mail->Body = _FORGOT_PASSWORD_BODY1 . $lostpassword . _FORGOT_PASSWORD_BODY2;
		$mio=$mail->Send();
		header("Location: index.php?action=gotpass");
		exit();
	}else{
		$msgFormErr=_FORGOT_PASSWORD_FORM_ERROR2;

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

<body onLoad="document.forms.login.username.focus()">
<div id="loginerr">
<?php echo $msgFormErr; ?>
</div>
<div id="login">
	<form name="login" method="POST" action="forgot_password.php">
	<img src=<?php echo _FORGOT_PASSWORD_PICTURE_SMALL?> border="0" class="smlogo"><br>
	<p class="ltext"><?php echo _FORGOT_PASSWORD_EMAIL?><br> <input type="text" onchange="this.value=this.value.toLowerCase();" name="forgotemail" size="40"><br>
	<input type="submit" name="submit" value="<?php echo _FORGOT_PASSWORD_SUBMIT?>" class="frmlogin">
	<input type="hidden" name="action" value="retrieve"></form>
</div>
</body>

</html>
