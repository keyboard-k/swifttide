<?PHP
/****************************************************************************
CLASS log
-----------------------------------------------------------------------------
Task:
  Manage chat logs
****************************************************************************/

CLASS log{

  /**************************************************************************
  log
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create log object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION log(){
  }

  /**************************************************************************
  saveMessage
  ---------------------------------------------------------------------------
  Task:
    Save chat message
  ---------------------------------------------------------------------------
  Parameters:
    $session          object        Session handle
    $type             int           Message type
    $room_id          int           Room id
    $from_user_id     int           Message sender
    $to_user_id       int           Message receiver
    $body             string        Message body
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION saveMessage(&$session,$type=0,$room_id=0,$sender_id=0,$receiver_id=0,$body=''){
    $date=DATE('Y-m-d');
    $time=DATE('H:i:s');
    $room_name='';
    $sender_ip='';
    $sender_login='';
    $receiver_ip='';
    $receiver_login='';
    IF($room_id){
      $room=NEW room();
      $room->readRoom($session, $room_id);
      $room_name=$room->name;
    }
    // Sender's data
    IF($sender_id>0){
      $user=NEW user();
      $user->readUser($session, $sender_id);
      $sender_login=$user->login;
      $sender_ip=$session->ip;
    }ELSE{
      $sender_login='';
      $sender_ip='';
    }
    // Receiver's data
    IF($receiver_id>0){
      $user=NEW user();
      $user->readUser($session, $receiver_id);
      $receiver_login=$user->login;
      $session_tmp=NEW session($session->getUsersSession($receiver_id));
      $receiver_ip=$session_tmp->ip;
    }ELSE{
      $receiver_id='';
      $receiver_ip='';
    }
    $record=ARRAY($date,
                  $time,
                  $type,
                  $room_id,
                  $room_name,
                  $sender_ip,
                  $sender_id,
                  $sender_login,
                  $receiver_ip,
                  $receiver_id,
                  $receiver_login,
                  $body);
    FOR($i=0; $i<COUNT($record); $i++){
      IF(STRPOS($record[$i], '"')!==FALSE || STRPOS($record[$i], ';')!==FALSE){
        $record[$i]='"'.STR_REPLACE('"','""',$record[$i]).'"';
      }
    }
    $record_string=IMPLODE(';',$record);
    
    // Check directory
    CLEARSTATCACHE();
    IF(!IS_DIR('logs/'.$session->config->logdir)){
      // Directory does not exists, attempting to create it.
      MKDIR(LOGSPATH.'/'.$session->config->logdir);
      // Creating index.php in new directory (to avoid directory listing)
      $handle=FOPEN(LOGSPATH.'/'.$session->config->logdir.'/index.php','w');
      FCLOSE($handle);
    }
    // Open (create) log file
    $handle=FOPEN(LOGSPATH.'/'.$session->config->logdir.'/'.DATE('Ymd').'_log.csv','a');
    // Write line into file
    FWRITE($handle,$record_string."\r\n");
    // Close file
    FCLOSE($handle);
  }



}
?>