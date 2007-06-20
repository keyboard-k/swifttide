<?PHP
/* This is a user profile page. */

/* Read userdata from database */
$user=NEW user();
$user->readUser($session,$profile_user_id);
/* Prepare nickname */
common::doHtmlEntities($user->login);

// Default photo
IF(!$user->photo){
  $user->photo="nophoto.jpg";
}

IF($session->user_id==$profile_user_id){
	/* Own profile */
  IF($update_password){
    // Update password
    IF($submitted){
      // Changing password
      $result=$user->changePassword($session,$old_password,$new_password_1,$new_password_2);
      SWITCH($result){
        CASE 0  :   // Password changed
                    $password_changed=TRUE;
                    BREAK;
        CASE 1  :   // Old password incorrect
                    $errortext=$lng["oldpasswordincorrect"];
                    BREAK;
        CASE 2  :   // New passwords are not ident
                    $errortext=$lng["passwordsnotident"];
                    BREAK;
        CASE 3  :   // Password length incorrect
                    $errortext=STR_REPLACE("{MIN}",$session->config->password_length_min,STR_REPLACE("{MAX}",$session->config->password_length_max,$lng["passwordlengthwrong"]));
                    BREAK;
        CASE 4  :   // Illegal characters in password
                    $errortext=$lng["passwordillegalchars"];
                    BREAK;
      }
    }
  }ELSE{
    IF($update_profile){
      // Validate email address
      IF((EMPTY($email)&&$user->guest)||common::checkEmail($email, $session->config->email_validation_level)){
        // Update userprofile
        $user->updateUser($session,$session->user_id,"color = '".STR_REPLACE("#","",$color)."', name = '$name', sex = '$sex', email = '$email', age = '$age', location = '$location', about = '$about', hide_email = '$hide_email'");
        // Inserting 'update user in userlist' command
        systemmessage::insertMessage(&$session,$session->user_id,3);
      }ELSE{
        $user->email=$email;
        $errortext=$lng["emailinvalid"];
      }
    }ELSEIF($delete_photo){
      // Delete userphoto
      if ($user->photo!='' && $user->photo!='nophoto.jpg') {
        unlink(IMAGEPATH.'/userphotos/'.$user->photo);
      }
      $user->updateUser($session,$session->user_id,"photo = ''");
    }
    // Default photo
    IF(!$user->photo){
      $user->photo="nophoto.jpg";
    }
  }
  ${'selected_sex_'.$user->sex}='selected';
  ${'selected_hide_email_'.$user->hide_email}='selected';
  REQUIRE(TEMPLATEPATH."/edit_profile.tpl.php");
}ELSE{
  /* Other user's profile */
  REQUIRE(TEMPLATEPATH."/view_profile.tpl.php");
}

?>
