<?PHP
IF(!EMPTY($confirm)){
  // Account activation
  IF($submitted){
    // Changing password
    $user=NEW user();
    $result=$user->generatePassword($session,$id,$a,$new_password_1,$new_password_2);
    SWITCH($result){
      CASE 0  :   // Password generated
                  $password_changed=TRUE;
                  // Activate user (if needed)
                  $user->updateUser($session,$user->id,"activated = 1");
                  BREAK;
      CASE 2  :   // New passwords are not ident
                  $errortext[]=$lng["passwordsnotident"];
                  BREAK;
      CASE 3  :   // Password length incorrect
                  $errortext[]=STR_REPLACE("{MIN}",$session->config->password_length_min,STR_REPLACE("{MAX}",$session->config->password_length_max,$lng["passwordlengthwrong"]));
                  BREAK;
      CASE 4  :   // Illegal characters in password
                  $errortext[]=$lng["passwordillegalchars"];
                  BREAK;
      DEFAULT :   DIE("HACK ?");
                  BREAK;
    }
  }
  // Load template
  REQUIRE(TEMPLATEPATH."/accountactivation.tpl.php");
}ELSEIF($register){
  // Register user
  IF($submitted){
    // Check login
    UNSET($errortext);
    $login=TRIM($login);
    $email=TRIM($email);
    $user=NEW user();
    IF(STRLEN($login)<$session->config->login_length_min||STRLEN($login)>$session->config->login_length_max){
      // Login length wrong
      $errortext[]=STR_REPLACE("{MIN}",$session->config->login_length_min,STR_REPLACE("{MAX}",$session->config->login_length_max,$lng["loginlengthwrong"]));
    }ELSE{
      IF(IS_ARRAY($user->listUsers(&$session,$login))){
        // Username already taken
        $errortext[]=STR_REPLACE("{USERNAME}",$login,$lng["usernametaken"]);
      }
    }
    // Check email address
    IF(EMPTY($email)){
      $errortext[]=$lng["emailempty"];
    }ELSEIF(!common::checkEmail($email, $session->config->email_validation_level)){
      $errortext[]=$lng["emailinvalid"];
    }ELSE{
      // Check wether email address already exists in database
      $user_tmp=NEW user();
      $user_tmp->findUser($session, '', $email);
      IF(!EMPTY($user_tmp->login)){
        $errortext[]=STR_REPLACE('{EMAIL}',$email,$lng["emailtaken"]);
      }
    }
    IF(!$session->config->require_activation){
      // Check password
      // Compare new passwords
      IF($new_password_1==$new_password_2){
        // Check new password length
        IF(STRLEN($new_password_1)>=$session->config->password_length_min&&STRLEN($new_password_1)<=$session->config->password_length_max){
          // Check characters in new password
          IF(EREG_REPLACE("[^0-9a-zA-Z]","",$new_password_1)<>$new_password_1){
            // Illegal characters in new password
            $errortext[]=$lng["passwordillegalchars"];
          }
        }ELSE{
          // Illegal password length
          $errortext[]=STR_REPLACE("{MIN}",$session->config->password_length_min,STR_REPLACE("{MAX}",$session->config->password_length_max,$lng["passwordlengthwrong"]));
        }
      }ELSE{
        // New passwords are not ident
        $errortext[]=$lng["passwordillegalchars"];
      }
    }
    IF(!IS_ARRAY($errortext)){
      // Save user
      $user=NEW user();
      $user->login=$login;
      $user->level=0;
      $user->email=$email;
      $user->hide_email=1;
      $user->color=LTRIM($session->config->guest_color, '#');
      $user->addUser($session);
      IF($session->config->require_activation){
        // Generate activation code
        $passcode=$user->generatePassCode($session,$user->id,12);
        // Email template
        $email_template=STR_REPLACE("{USER}",$login,
                        STR_REPLACE("{ACTIVATIONURL}",$session->config->homepage."/main.php?confirm=1&language=".$language."&a=".$passcode."&id=".$user->id,
                        STR_REPLACE("{CHATURL}",$session->config->homepage,
                        STR_REPLACE("{CHATOWNER}",$session->config->sender_name,
                        $lng["activateregistration"]))));
      }ELSE{
        $user->updateUser($session,$user->id,"password = '".MD5($new_password_1)."', activated = '1'");
        // Email template
        $email_template=STR_REPLACE("{USER}",$login,
                        STR_REPLACE("{PASSWORD}",$new_password_1,
                        STR_REPLACE("{CHATURL}",$session->config->homepage,
                        STR_REPLACE("{CHATOWNER}",$session->config->sender_name,
                        $lng["instantregistration"]))));
      }
      $user_saved=TRUE;
      // Send email
      email::send($session->config->sender_email,$session->config->sender_name,$user->email,$lng["registration"],$email_template);
    }
  }
  // Load template
  REQUIRE(TEMPLATEPATH."/register.tpl.php");
}ELSEIF($lostpassword){
  // Lost password
  IF($submitted){
    IF(!$login){
      $errortext[]=$lng["loginempty"];
    }
    IF(!$email){
      $errortext[]=$lng["emailempty"];
    }
    IF(!IS_ARRAY($errortext)){
      // Look for user
      $user=NEW user();
      $user->findUser($session,$login,$email);
      IF($user->id){
        // User found
        // Generate new password
        $passcode=$user->generatePassCode($session,$user->id,12);
        // Send email
        $body=STR_REPLACE("{USER}",$user->login,
              STR_REPLACE("{URL}",$session->config->homepage."/main.php?confirm=1&type=1&language=".$language."&a=".$passcode."&id=".$user->id,
              STR_REPLACE("{CHATOWNER}",$session->config->sender_name,
              $lng["email_lostpassword"])));
        email::send($session->config->sender_email,$session->config->sender_name,$user->email,$lng["lostpassword"],$body);
        $statustext=STR_REPLACE("{EMAIL}",$user->email,$lng["activationsent"]);
        common::doHtmlEntities($statustext);
      }ELSE{
        // User not found
        $tmp=STR_REPLACE("{USER}",$login,STR_REPLACE("{EMAIL}",$email,$lng["usernotfound"]));
        common::doHtmlEntities($tmp);
        $errortext[]=$tmp;
      }
    }
  }
  // Load template
  REQUIRE(TEMPLATEPATH."/lostpassword.tpl.php");
}ELSE{
  /* Check login and password or cookie (if any) */
  $login=TRIM($login);
  common::dTrim($login);
  if(!empty($login) || !empty($pcpin_cookie) && $pcpin_cookie{0}!='@'){
    // Check that IP address is not in the banlist
    IF(!ban::checkIP($session,IP)){
      // IP address is banned
      $errortext=$lng["ipbanned"];
    }ELSE{
      $user=NEW user();
      $user->login=$login;
      $user->cookie=(!empty($pcpin_cookie))? $pcpin_cookie : '';
      $user->password=MD5($password);
      $user->checkLogin($session);
      IF($user->id){
        /* Login and password are OK */
        /* Ensure that user not already logged in */
        IF($session->checkUserUnique($user->id, true)){
          /* Check that user is not in the banlist */
          IF(ban::checkUser($session,$user->id)){
            // If user has Admin level and has been logged in directly, update user's session
            $session_id=$session->getUsersSession($user->id);
            if(!empty($session_id)){
              $session->id=$session_id;
              $session->readSession();
              if(!empty($session->user_id) && !empty($session->direct_login)){
                $session->updateSession('direct_login = 0');
                $next_include='3';
              }else{
                $session_id='';
              }
            }
            if(empty($session_id)){
              // Creating new session
              $session->newSession($user->id);
              $session_id=$session->id;
              /* Updating user's language */
              $session->updateSession('language = "'.$language.'"');
              $session->updateSession('direct_login = '.(!empty($admin)? '"1"' : '"0"'));
              // Next include
              $next_include=(!empty($admin) && $user->level>0)? '13' : '3';
            }
            /* Save cookie */
            setcookie('pcpin_cookie', $user->cookie, time()+COOKIE_LIFETIME);
          }ELSE{
            // User is banned
            $errortext=$lng["youarebanned"];
          }
        }ELSE{
          // User already logged in
          IF(!EMPTY($user->login)){
            $login=$user->login;
          }
          $errortext=STR_REPLACE("{USER}",$login,$lng["useralreadyloggedin"]);
        }
      }elseif(isset($login)){
        $login=TRIM($login);
        IF(STRLEN($login)<$session->config->login_length_min||STRLEN($login)>$session->config->login_length_max){
          $errortext=STR_REPLACE("{MIN}",$session->config->login_length_min,STR_REPLACE("{MAX}",$session->config->login_length_max,$lng["loginlengthwrong"]));
        }ELSEIF(empty($password) && $session->config->allow_guests){
          // Guest are allowed
          // Check username
          $login=ADDSLASHES($login);
          $user_list=$user->listUsers(&$session,$login);
          IF(EMPTY($user_list)){
            // Username is free
            $next_include=3;
            // Inserting guest into database
            $user=NEW user();
            $user->login=$login;
            $user->password=MD5(mt_rand(-time(), time()));
            $user->guest=1;
            $user->color=$session->config->guest_color;
            $user->addUser($session);
            $user->checkLogin($session);
            $session->newSession($user->id);
            $session->updateSession("language = '$language'");
            $session_id=$session->id;
          }ELSE{
            $errortext=STR_REPLACE("{USERNAME}",$login,$lng["usernametaken"]);
          }
        }ELSE{
          // Wrong login/password
          $errortext=$lng["loginincorrect"];
        }
      }
    }
  }
  IF(!EMPTY($errortext) || EMPTY($login) && EMPTY($user->id)){
    /* Load login page template */
    IF(EMPTY($login) && !EMPTY($pcpin_cookie) && $pcpin_cookie{0}=='@'){
      $login=SUBSTR($pcpin_cookie,1);
    }
    REQUIRE(TEMPLATEPATH."/login.tpl.php");
  }ELSE{
    /* Proceed to room selection */
?>
<HTML>
<BODY onload="document.loginform.submit();">
  <FORM name="loginform" action="main.php" method="post">
    <INPUT type="hidden" name="include" value="<?=$next_include?>">
    <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
    <INPUT type="hidden" name="guest" value="<?=$guest?>">
    <INPUT type="hidden" name="admin" value="<?=$admin?>">
    <INPUT type="hidden" name="screen_height" value="">
  </FORM>
</BODY>
</HTML>
<?
  }
}
?>
