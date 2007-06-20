<?php
// Load database connection settings
@include('./config/db.inc.php');
// Establish database connection
$quiet=true;
$read_only=true;
require_once(PCPIN_INSTALL_INCLUDES.'/db_connection.inc.php');

if(isset($step)){

  // Load database connection settings
  require_once('./config/db.inc.php');
  // Establish database connection
  $quiet=true;
  $read_only=true;
  require_once(PCPIN_INSTALL_INCLUDES.'/db_connection.inc.php');
  $in_progress=false;
  switch($step){
    case  0   :   // Store import data
                  storeImportData($conn);
                  break;
    case  1   :   // Create database structure
                  makeDatabase($conn);
                  break;
    case  2   :   // Install data
                  installData($conn);
                  break;
    case  3   :   // Import stored data
                  if(restoreImportData($conn)){
                    $step--;
                    $in_progress=true;
                  }
                  break;
    case  4   :   // Save admin account
                  saveAdminAccount($conn);
                  // Set new version number
                  setVersion($conn);
                  // Save data from "Final configuration" form
                  storeSettings($conn);
                  break;
    case  5   :   // Cleanup
                  doCleanup($conn);
                  break;
    case  6   :   // Empty step
                  $in_progress=true;
                  break;
    case  7   :   // Empty step
                  break;
    default   :   // End
                  $step=-1;
                  break;
  }
  if($step>=0){
    $_body_onload.=' doStep('.($step+1).', '.($in_progress? 'true' : 'false').'); ';
  }
}

// Load template
require_once(PCPIN_INSTALL_TEMPLATES.'/ctl.tpl.php');



function storeImportData(&$conn){
  $keep_data=false;
  $result=mysql_query('SELECT `value` FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "keep_settings" LIMIT 1', $conn);
  if(!mysql_errno($conn)){
    $data=mysql_fetch_array($result, MYSQL_ASSOC);
    if(!empty($data['value'])){
      $keep_data=@unserialize($data['value']);
    }else{
      $keep_data=false;
    }
  }
  if(!empty($keep_data)){
    $backup_tables=array();
    $keep_data=array_keys($keep_data);
    foreach($keep_data as $name){
      switch($name){
        case  'Chat settings'   :   // Chat settings
                                    $tables=array('configuration',
                                                  'maxusers');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Chat design'     :   // Chat design
                                    $tables=array('cssclass',
                                                  'cssproperty',
                                                  'cssurl',
                                                  'fk_cssvalue');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Users'           :   // Users
                                    $tables=array('user');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Rooms'           :   // Rooms
                                    $tables=array('room');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Bad words filter':   // Bad words filter
                                    $tables=array('badword');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Advertisements'  :   // Advertisements
                                    $tables=array('advertisement',
                                                  'fk_advertisement');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Smilies'         :   // Smilies
                                    $tables=array('smilie');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
        case  'Bans'            :   // Bans
                                    $tables=array('ban');
                                    storeTables($conn, $backup_tables, $tables);
                                    break;
      }
    }
  }
  mysql_query('DELETE FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "keep_settings" LIMIT 1', $conn);
  mysql_query('DELETE FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "stored_tables" LIMIT 1', $conn);
  if(!empty($backup_tables)){
    mysql_query('INSERT INTO `'.PREFIX.'_chat_installdata` (`name`, `value`) VALUES ("stored_tables", "'.mysql_real_escape_string(serialize($backup_tables)).'")', $conn);
  }
}


function storeTables(&$conn, &$backup_tables, $tables){
  foreach($tables as $table){
    mysql_query('ALTER TABLE `'.PREFIX.$table.'` RENAME `'.PREFIX.'_STORED_'.$table.'`', $conn);
    $backup_tables[PREFIX.$table]=PREFIX.'_STORED_'.$table;
  }
}


function storeSettings($conn){
  $result=mysql_query('SELECT `value` FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "configuration" LIMIT 1', $conn);
  if(!mysql_errno($conn)){
    if($data=mysql_fetch_array($result, MYSQL_ASSOC)){
      if($settings=@unserialize($data['value'])){
        foreach($settings as $name=>$value){
          mysql_query('UPDATE `'.PREFIX.'configuration` SET `value` = "'.mysql_real_escape_string($value).'" WHERE `name` = BINARY "'.$name.'" LIMIT 1', $conn);
        }
      }
    }
  }
}

function makeDatabase($conn){
  if($h=fopen(PCPIN_INSTALL_BASEDIR.'/db_structure.dat', 'r')){
    while(!feof($h) && false!==$line=fgets($h)){
      $line=trim($line);
      $line=rtrim(rtrim($line, ';'));
      if($line<>''){
        $line=str_replace('$$$PREFIX$$$', PREFIX, $line);
        mysql_query($line);
      }
    }
    fclose($h);
  }
}

function installData($conn){
  if($h=fopen(PCPIN_INSTALL_BASEDIR.'/db_data.dat', 'r')){
    while(!feof($h) && false!==$line=fgets($h)){
      $line=trim($line);
      $line=rtrim(rtrim($line, ';'));
      if($line<>''){
        $line=str_replace('$$$PREFIX$$$', PREFIX, $line);
        mysql_query($line);
      }
    }
    fclose($h);
  }
}


function restoreImportData(&$conn){
  $done=false;
  $result=mysql_query('SELECT `value` FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "stored_tables" LIMIT 1', $conn);
  if(!mysql_errno($conn)){
    $data=mysql_fetch_array($result, MYSQL_ASSOC);
    if(!empty($data['value'])){
      $tables=@unserialize($data['value']);
    }
  }
  if(!empty($tables)){
    foreach($tables as $tgt=>$src){ break; }
    array_shift($tables);
    mysql_query('TRUNCATE TABLE `'.$tgt.'`');
    mysql_query('INSERT INTO `'.$tgt.'` SELECT * FROM `'.$src.'`');
    if(!mysql_errno($conn)){
      mysql_query('DROP TABLE `'.$src.'`');
    }
    if($done=!empty($tables)){
      mysql_query('UPDATE `'.PREFIX.'_chat_installdata` SET `value` = "'.mysql_real_escape_string(serialize($tables)).'" WHERE `name` = BINARY "stored_tables" LIMIT 1', $conn);
    }
  }
  return $done;
}


function doCleanup(&$conn){
  mysql_query('DROP TABLE `'.PREFIX.'_chat_installdata`', $conn);
}


function setVersion(&$conn){
  mysql_query('TRUNCATE TABLE `'.PREFIX.'version`', $conn);
  mysql_query('INSERT INTO `'.PREFIX.'version` VALUES ("'.mysql_real_escape_string(PCPIN_CHAT_VERSION).'")', $conn);
}


function saveAdminAccount(&$conn){
  $result=mysql_query('SELECT `value` FROM `'.PREFIX.'_chat_installdata` WHERE `name` = BINARY "admin_account" LIMIT 1', $conn);
  if(!mysql_errno($conn)){
    $data=mysql_fetch_array($result, MYSQL_ASSOC);
    if(!empty($data['value'])){
      $admin=@unserialize($data['value']);
      mysql_query('INSERT INTO `'.PREFIX.'user` (`login`, `email`, `password`, `level`, `joined`, `activated`, `last_login`, `cookie`) VALUES ("'.mysql_real_escape_string($admin['login']).'", "'.mysql_real_escape_string($admin['email']).'", "'.mysql_real_escape_string($admin['password']).'", 131071, UNIX_TIMESTAMP(), 1, UNIX_TIMESTAMP(), "")', $conn);
    }
  }
}

?>