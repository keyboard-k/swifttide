<?php
$next_include=1400;

// Defaults
if(!isset($admin_login)) $admin_login='';
if(!isset($admin_pw)) $admin_pw='';
if(!isset($admin_email)) $admin_email='';

// Which data shall be imported?
$keep_users=false;
$result=mysql_query('SELECT `value` FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "keep_settings" LIMIT 1', $conn);
if(!mysql_errno($conn)){
  $data=mysql_fetch_array($result);
  if(!empty($data['value']) && false!==$keep_settings=unserialize($data['value'])){
    $keep_users=!empty($keep_settings['Users']);
  }
}

if(!empty($submitted)){
  if(empty($do_skip)){
    // Validate form
    $admin_login=trim($admin_login);
    $admin_email=trim($admin_email);
    if($admin_login==''){
      // Empty username
      $errortext[]='Administrator username cannot be empty';
    }elseif($keep_users){
      // User accounts shall be imported. Check them.
      $result=mysql_query('SELECT * FROM `'.PREFIX.'user` WHERE `login` = "'.mysql_real_escape_string($admin_login).'" LIMIT 1', $conn);
      if(!mysql_errno($conn)){
        if($data=mysql_fetch_array($result)){
          if(!empty($data['id'])){
            // User already exists
            $errortext[]='User "'.$admin_login.'" already exists!';
          }
        }
      }
    }
    if($admin_email==''){
      $errortext[]='Administrator Email address cannot be empty';
    }elseif(!common::checkEmail($admin_email, 1)){
      $errortext[]='Administrator Email address appears to be invalid';
    }
    if($admin_pw==''){
      $errortext[]='Administrator password cannot be empty';
    }elseif(strlen($admin_pw)<3){
      $errortext[]='Administrator password is too short';
    }
  }

  if(empty($errortext)){
    mysql_query('DELETE FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "admin_account" LIMIT 1', $conn);
    if(empty($do_skip)){
      // Save data
      $admindata=array('login'=>$admin_login,
                       'email'=>$admin_email,
                       'password'=>md5($admin_pw));
      mysql_query('INSERT INTO `'.PREFIX.'_chat_installdata` (`name`, `value`) VALUES ("admin_account", "'.mysql_real_escape_string(serialize($admindata), $conn).'")', $conn);
    }
    // Load next page
    header('Location: ./install.php?framed=1&include='.$next_include.'&timestamp='.md5(microtime()));
    die();
  }
}

$_body_onload.=' checkChkBox(); ';

// Load template
require_once(PCPIN_INSTALL_TEMPLATES.'/admin_account.tpl.php');
?>