<?php
$next_include=1300;

// Create temporary table
mysql_query('DROP TABLE IF EXISTS `'.PREFIX.'_chat_installdata`', $conn);
mysql_query('CREATE TABLE `'.PREFIX.'_chat_installdata` (`name` varchar(255) NOT NULL default "", `value` longtext NOT NULL, PRIMARY KEY (`name`)) TYPE=MyISAM', $conn);


// Search for existing installations and data
$existsing_data=array('Chat settings'   =>false,
                      'Chat design'     =>false,
                      'Users'           =>false,
                      'Rooms'           =>false,
                      'Bad words filter'=>false,
                      'Advertisements'  =>false,
                      'Smilies'         =>false,
                      'Bans'            =>false);

$result=mysql_query('SELECT `version` FROM `'.$db_prefix.'version` ORDER BY `version` DESC LIMIT 1', $conn);
$version=null;
if(!mysql_errno($conn)){
  $data=mysql_fetch_array($result, MYSQL_ASSOC);
  ////////////////////////////////////////////////////////////////
  // Workaround for a problem caused by PCPIN Chat 5.06, which has not stored it's version number
  if(empty($data)){
    $data=array('version'=>'5.06');
  }
  // END: Workaround
  ////////////////////////////////////////////////////////////////
  if(!empty($data['version'])){
    $old_version=$data['version'];
    $version_parts=EXPLODE('.', $old_version);
    $version=$version_parts[0];
    IF($version=='4' || $version=='5'){
      // ... Bad words
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'badword` LIMIT 1', $conn);
      if(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Bad words filter']=!empty($data[0]);
      }
      // ... Advertisements
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'advertisement` LIMIT 1', $conn);
      IF(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Advertisements']=!empty($data[0]);
      }
      // ... Rooms
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'room` LIMIT 1', $conn);
      IF(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Rooms']=!empty($data[0]);
      }
      // ... Users
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'user` LIMIT 1', $conn);
      IF(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Users']=!empty($data[0]);
      }
      // ... Settings
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'configuration` LIMIT 1', $conn);
      IF(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Chat settings']=!empty($data[0]);
      }
      // ... Design
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'cssclass` LIMIT 1', $conn);
      IF(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Chat design']=!empty($data[0]);
      }
      // ... Smilies
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'smilie` LIMIT 1', $conn);
      if(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Smilies']=!empty($data[0]);
      }
      // ... Bans
      $result=mysql_query('SELECT * FROM `'.$db_prefix.'ban` LIMIT 1', $conn);
      if(!mysql_errno($conn)){
        $data=mysql_fetch_array($result, MYSQL_NUM);
        $existsing_data['Bans']=!empty($data[0]);
      }
    }
  }
}
$data_found=   $existsing_data['Bad words filter']
            || $existsing_data['Advertisements']
            || $existsing_data['Rooms']
            || $existsing_data['Users']
            || $existsing_data['Users']
            || $existsing_data['Chat settings']
            || $existsing_data['Chat design']
            || $existsing_data['Smilies']
            || $existsing_data['Bans'];

if(!empty($import_submitted)){
  mysql_query('DELETE FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "keep_settings" LIMIT 1', $conn);
  $keep_settings_valid=array();
  if(!empty($keep_settings) && is_array($keep_settings)){
    foreach($keep_settings as $setting){
      if(!empty($existsing_data[$setting])){
        $keep_settings_valid[$setting]=true;
      }
    }
  }
  if(!empty($keep_settings_valid)){
    mysql_query('INSERT INTO `'.PREFIX.'_chat_installdata` (`name`, `value`) VALUES ("keep_settings", "'.mysql_real_escape_string(serialize($keep_settings_valid), $conn).'")', $conn);
  }
  // Load next page
  header('Location: ./install.php?framed=1&include='.$next_include.'&timestamp='.md5(microtime()));
  die();
}

// Load template
require_once(PCPIN_INSTALL_TEMPLATES.'/import_settings.tpl.php');
?>