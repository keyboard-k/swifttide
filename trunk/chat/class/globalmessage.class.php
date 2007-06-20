<?PHP
/****************************************************************************
CLASS globalMessage
-----------------------------------------------------------------------------
Task:
  Manage global messages
****************************************************************************/

CLASS globalMessage{

  /* Class variables */

  /* Message type
  *  Type: int
  *  Values:
  *     0:      Normal message
  *     1:      Pop-Up
  *
  */
  VAR $type=0;

  /* User ID
  *  Type: int
  */
  VAR $user_id=0;

  /* Message body
  *  Type: string
  */
  VAR $body=0;

  /* Message post time (TIMESTAMP)
  *  Type: int
  */
  VAR $post_time=0;



  /**************************************************************************
  Constructor
  ---------------------------------------------------------------------------
  Task:
    Creates globalMessage object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION globalMessage(){
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
    $delete_time=$session->config->main_refresh+1;
    $query="DELETE FROM ".PREFIX."globalmessage WHERE post_time + $delete_time < UNIX_TIMESTAMP()";
    $session->db->query($query);
  }

  /**************************************************************************
  insertMessage
  ---------------------------------------------------------------------------
  Task:
    Inserts new global message into database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Sessionhandle
    $user_id          int           User ID
    $message_body     string        Message body
    $type             int           Message type
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION insertMessage(&$session,$user_id=0,$message_body,$type=0){
    IF(!EMPTY($message_body)){
      // Inserting a message
      $query="INSERT into ".PREFIX."globalmessage (type, user_id, body, post_time) VALUES ($type, $user_id, '$message_body', UNIX_TIMESTAMP())";
      $session->db->query($query);
      IF($session->config->logfile){
        log::saveMessage($session,0,$user_id,$message_body);
      }
    }
  }

  /**************************************************************************
  readNewMessages
  ---------------------------------------------------------------------------
  Task:
    Read new global messages from database
  ---------------------------------------------------------------------------
  Parameters:
    $session      Object      Sessionhandle
  ---------------------------------------------------------------------------
  Return:
                  Array       Messages list
  **************************************************************************/
  FUNCTION readNewMessages(&$session){
    $query="SELECT * FROM ".PREFIX."globalmessage WHERE id > {$session->last_globalmessage} ORDER BY id ASC";
    $result=$session->db->query($query);
    WHILE($data=$session->db->fetchArray($result)){
      /* Adding message to list */
    	$messagelist[]=$data;
    }
    /* Updating session */
    $session->updateSession("last_globalmessage = {$messagelist[COUNT($messagelist)-1][id]}");
    RETURN $messagelist;
  }

  /**************************************************************************
  readMessage
  ---------------------------------------------------------------------------
  Task:
    Read global message from database
  ---------------------------------------------------------------------------
  Parameters:
    $session      Object      Sessionhandle
    $id           int         Message ID
  ---------------------------------------------------------------------------
  Return:
                  Array       Message
  **************************************************************************/
  FUNCTION readMessage(&$session,$id=0){
    IF($id){
      $query="SELECT * FROM ".PREFIX."globalmessage WHERE id = $id LIMIT 1";
      $result=$session->db->query($query);
      RETURN $session->db->fetchArray($result);
    }
  }



}
?>