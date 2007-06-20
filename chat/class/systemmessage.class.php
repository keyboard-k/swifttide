<?PHP
/****************************************************************************
CLASS systemMessage
-----------------------------------------------------------------------------
Task:
  Manage system messages
****************************************************************************/

CLASS systemMessage{

  /* Class variables */

  /* Message type
  *  Type: int
  *  Values:
  *     1   :     User 'xxx' entered room 'yyy'
  *                 message body: "user_id|room_id"
  *     2   :     User 'xxx' left room 'yyy'
  *                 message body: "user_id|room_id"
  *     3   :     Userinfo changed
  *                 message body: "user_id"
  *     4   :     Room was deleted
  *                 message body: "room_id"
  *     5   :     Room was created
  *                 message body: "room_id"
  *     6   :     User 'xxx' was kicked out
  *                 message body: "user_id"
  *     7   :     Invite user
  *                 message body: "user_id|target_user_id|room_id"
  *     8   :     Invitation accepted / rejected
  *                 message body: "user_id|responser_user_id|status"
  *     9   :     Change room
  *                 message body: "user_id|new_room_id"
  *     10  :     Restart room
  *                 message body: "room_id"
  *     11  :     Show advertisement
  *                 message body: "room_id|advertisement_html"
  *     12  :     Clear room screen
  *                 message body: "room_id"
  *
  */
  VAR $type=0;

  /* Message post time (TIMESTAMP)
  *  Type: int
  */
  VAR $post_time=0;

  /* Message body
  *  Type: string
  */
  VAR $body='';

  /* Messages list
  *  Type: array
  */
  VAR $messagelist=null;



  /**************************************************************************
  Constructor
  ---------------------------------------------------------------------------
  Task:
    Creates systemMessage object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION systemMessage(){
  }

  /**************************************************************************
  deleteOldMessages
  ---------------------------------------------------------------------------
  Task:
    Deletes old system messages from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Sessionhandle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteOldMessages(&$session){
    $delete_time=$session->config->main_refresh+1;
    $query="DELETE FROM ".PREFIX."systemmessage WHERE post_time + $delete_time < UNIX_TIMESTAMP()";
    $session->db->query($query);
  }

  /**************************************************************************
  insertMessage
  ---------------------------------------------------------------------------
  Task:
    Insert system message into database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Sessionhandle
    $message_body     string        Message body
    $type             int           Message type
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION insertMessage(&$session,$message_body="",$type=0){
    $query="INSERT into ".PREFIX."systemmessage (type, body, post_time) VALUES ($type, '$message_body', UNIX_TIMESTAMP())";
    $session->db->query($query);
  }

  /**************************************************************************
  readNewMessages
  ---------------------------------------------------------------------------
  Task:
    Read system messages from database
  ---------------------------------------------------------------------------
  Parameters:
    $session      Object      Sessionhandle
  ---------------------------------------------------------------------------
  Return:
                  Array       Messages list
  **************************************************************************/
  FUNCTION readNewMessages(&$session){
    $query="SELECT * FROM ".PREFIX."systemmessage WHERE id > {$session->last_systemmessage} ORDER BY id ASC";
    /* Reading messages */
    $result=$session->db->query($query);
    WHILE($data=$session->db->fetchArray($result)){
      /* Adding message to list */
    	$messagelist[]=$data;
    }
    /* Updating session */
    $session->updateSession("last_systemmessage = {$messagelist[COUNT($messagelist)-1][id]}");
    RETURN $messagelist;
  }


}
?>