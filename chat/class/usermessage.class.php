<?PHP
/****************************************************************************
CLASS userMessage
-----------------------------------------------------------------------------
Task:
  Manage user messages
****************************************************************************/

CLASS userMessage{

  /* Class variables */

  /* Message type
  *  Type: int
  *  Values:
  *     1:      Normal message
  *     2:      Private message
  *     3:      Whispered message
  *
  */
  VAR $type=0;

  /* User ID
  *  Type: int
  */
  VAR $user_id=0;

  /* Target user ID (for private messages)
  *  Type: int
  */
  VAR $target_user_id=0;

  /* Message body
  *  Type: string
  */
  VAR $body='';

  /* Binary coded message flags
  *   Values:
  *     bit#          Description (if bit set)
  *      0 (1)          Bold
  *      1 (2)          Italic
  *      2 (3)          Underlined
  *  Type: integer
  */
  VAR $flags=0;

  /* Message post time (TIMESTAMP)
  *  Type: int
  */
  VAR $post_time=0;

  /* Messages list
  *  Type: array
  */
  VAR $messagelist=null;



  /**************************************************************************
  Constructor
  ---------------------------------------------------------------------------
  Task:
    Creates message object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION message(){
  }

  /**************************************************************************
  deleteOldMessages
  ---------------------------------------------------------------------------
  Task:
    Deletes old user messages from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Sessionhandle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteOldMessages(&$session){
    $delete_time=$session->config->main_refresh+60;
    $query="DELETE FROM ".PREFIX."usermessage WHERE post_time + $delete_time < UNIX_TIMESTAMP()";
    $session->db->query($query);
  }

  /**************************************************************************
  insertMessage
  ---------------------------------------------------------------------------
  Task:
    Inserts user message into database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Sessionhandle
    $target_user_id   int           Target user ID (for private messages)
    $message_body     string        Message body
    $type             int           Message type
    $flags            int           Message flags
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION insertMessage(&$session,$target_user_id=0,&$message_body,$type=0,$flags=0){
    // 'Flood' protection
    IF($session->last_message==$message_body){
      $session->message_repeat++;
      $session->updateSession("message_repeat = {$session->message_repeat}");
      IF($session->message_repeat>$session->config->flood_max){
        // User will be kicked due to flooding
        // Superuser protection
        $tmp_user=new user();
        $tmp_user->readUser($session, $session->user_id);
        if($tmp_user->level<131071){
          systemMessage::insertMessage($session,$session->user_id,6);
          // Update user's session
          $session->updateSession("kicked = 1");
        }
      }
    }ELSE{
      $session->updateSession("last_message = '$message_body', message_repeat = 1");
    }
    IF($message_body!=''){
      // Inserting a message
      $query="INSERT into ".PREFIX."usermessage (type, user_id, target_user_id, body, post_time, flags) VALUES ($type, {$session->user_id}, $target_user_id, '$message_body', UNIX_TIMESTAMP(), $flags)";
      $session->db->query($query);
      IF($session->config->logfile){
        IF($session->config->logfile==2 || $type==1){
          // Log message
          // Convert special chars
          FOR($i=0;$i<255;$i++){
            $i_str=($i<100)?'0'.(string)$i:(string)$i;
            $message_body=STR_REPLACE("\\\\\\\\","\\",STR_REPLACE("\\\\&#".$i_str.';', CHR($i), $message_body));
          }
          log::saveMessage($session,$type,$session->room_id,$session->user_id,$target_user_id,URLDECODE($message_body));
        }
      }
    }
  }

  /**************************************************************************
  readNewMessages
  ---------------------------------------------------------------------------
  Task:
    Read new user messages from database
  ---------------------------------------------------------------------------
  Parameters:
    $session      Object      Sessionhandle
  ---------------------------------------------------------------------------
  Return:
                  Array       Messages list
  **************************************************************************/
  FUNCTION readNewMessages(&$session){
    $query="SELECT um.* FROM
                          ".PREFIX."usermessage um,
                          ".PREFIX."session se
                        WHERE
                          se.user_id = um.user_id
                          AND se.room_id = {$session->room_id}
                          AND um.id > {$session->last_usermessage}
                        ORDER BY
                          um.id ASC";
    $result=$session->db->query($query);
    WHILE($data=$session->db->fetchArray($result)){
      /* Adding message to list */
    	$messagelist[]=$data;
    }
    /* Updating session */
    $session->updateSession("last_usermessage = {$messagelist[COUNT($messagelist)-1][id]}");
    RETURN $messagelist;
  }

  /**************************************************************************
  readMessage
  ---------------------------------------------------------------------------
  Task:
    Read user message from database
  ---------------------------------------------------------------------------
  Parameters:
    $session        Object      Sessionhandle
    $message_id     int         Message ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readMessage(&$session,$message_id=0){
    IF($message_id){
      $query="SELECT * FROM ".PREFIX."usermessage WHERE id = $message_id LIMIT 1";
      $result=$session->db->query($query);
      WHILE($data=$session->db->fetchArray($result)){
        WHILE(LIST($key,$val)=EACH($data)){
          IF(!PREG_MATCH("/^\d+$/",$key)){
            /* Using alfanumerical keys only */
            $this->$key=$val;
          }
        }
      }
    }
  }



}
?>