<?PHP
/* This is a user profile page. */

// Check rights
IF(!($current_user->level&8)){
  DIE("HACK?");
}

/* Read userdata from database */
$user=NEW user();
$user->readUser($session,$profile_user_id);
if($user->level>=131071){
  // Superuser protection
  die('Access denied');
}
/* Prepare nickname */
common::doHtmlEntities($user->login);

IF($delete){
  /* Delete user */
  // Get user's session ID
  $session2=NEW session($session->getUsersSession($profile_user_id));
  IF($session2->id){
    // User is online
    // Deleting user's session
    $session2->logout();
  }
  // Deleting user from database
  $user->deleteUser($session,$profile_user_id);
?>
<HTML><BODY onload="document.redirectform.submit();">
<FORM name="redirectform" action="main.php" method="post">
<INPUT type="hidden" name="session_id" value="<?=$session_id?>">
<INPUT type="hidden" name="include" value="11">
<INPUT type="hidden" name="edit" value="1">
</FORM></BODY></HTML>
<?
  DIE();
}

IF(!EMPTY($delete_photo) && $user->photo!='' && $user->photo!='nophoto.jpg'){
  // Delete photo
  @UNLINK(IMAGEPATH.'/userphotos/'.$user->photo);
  $user->updateUser($session,$profile_user_id,'photo = ""');
}

IF($update_profile){
  // Validate email address
  IF(common::checkEmail($email, $session->config->email_validation_level)){
    // Calculate privileges
    $level=0;
    IF(IS_ARRAY($set_rights)){
      WHILE(LIST($key,$val)=EACH($set_rights)){
        IF($current_user->level&$key){
          $level+=$key;
        }
      }
    }
    // Update userprofile
    $user->updateUser($session,$profile_user_id,"color = '".STR_REPLACE("#","",$color)."', name = '$name', sex = '$sex', email = '$email', age = '$age', location = '$location', about = '$about', hide_email = '$hide_email', level = '$level'");
    // Inserting 'update user in userlist' command
    $systemmessage=NEW systemmessage();
    $systemmessage->insertMessage(&$session,$profile_user_id,3);
  }ELSE{
    $user->email=$email;
    $errortext=$lng["emailinvalid"];
  }
}
${'selected_sex_'.$user->sex}='selected';
${'selected_hide_email_'.$user->hide_email}='selected';
// Default photo
IF(!$user->photo){
  $user->photo="nophoto.jpg";
}

// Calculate privileges
$privileges=ARRAY();
IF($current_user->level&1024){
  $i=1;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["chatstatistics"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["chatstatistics"],"value"=>$i,"checked"=>"");
    }
  }
  $i=2;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["chatdesign"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["chatdesign"],"value"=>$i,"checked"=>"");
    }
  }
  $i=4;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["chatsettings"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["chatsettings"],"value"=>$i,"checked"=>"");
    }
  }
  $i=8;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["editusers"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["editusers"],"value"=>$i,"checked"=>"");
    }
  }
  $i=16;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["kickusers"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["kickusers"],"value"=>$i,"checked"=>"");
    }
  }
  $i=32;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["banusersip"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["banusersip"],"value"=>$i,"checked"=>"");
    }
  }
  $i=64;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["postglobalmessage"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["postglobalmessage"],"value"=>$i,"checked"=>"");
    }
  }
  $i=128;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["manageadvertisements"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["manageadvertisements"],"value"=>$i,"checked"=>"");
    }
  }
  $i=256;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["managesmilies"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["managesmilies"],"value"=>$i,"checked"=>"");
    }
  }
  $i=512;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["managebadwords"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["managebadwords"],"value"=>$i,"checked"=>"");
    }
  }
  $i=1024;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["manageprivileges"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["manageprivileges"],"value"=>$i,"checked"=>"");
    }
  }
  $i=2048;
  IF($current_user->level&$i){
    IF($user->level&$i){
      $privileges[]=ARRAY("name"=>$lng["managerooms"],"value"=>$i,"checked"=>"checked");
    }ELSE{
      $privileges[]=ARRAY("name"=>$lng["managerooms"],"value"=>$i,"checked"=>"");
    }
  }
}

REQUIRE(TEMPLATEPATH."/admin_editusers.tpl.php");
?>
