<?PHP
/****************************************************************************
CLASS session
-----------------------------------------------------------------------------
Task:
  Manage Sessions.
****************************************************************************/

CLASS session EXTENDS dbaccess{

  /* Class variables */

  /* Database handle
  *  Type: object
  */
  VAR $db=null;

  /* Configuration handle
  *  Type: object
  */
  VAR $config=null;

  /* Session ID
  *  Type: string
  */
  VAR $id;

  /* User ID
  *  Type: int
  */
  VAR $user_id=0;

  /* Room ID
  *  Type: int
  *  If value is negative, then user is:
  *     -1  :   At 'select room' page
  *     -2  :   At 'create room' page
  *     -3  :   Entering password for password-protected room
  */
  VAR $room_id=0;

  /* Last ping
  *  Type: int
  */
  VAR $last_ping=0;

  /* Last user message read
  *  Type: int
  */
  VAR $last_usermessage=0;

  /* Last system message read
  *  Type: int
  */
  VAR $last_systemmessage=0;

  /* Last global message read
  *  Type: int
  */
  VAR $last_globalmessage=0;

  /* Used language
  *  Type: string
  */
  VAR $langauge='';

  /* IP address
  *  Type: string
  */
  VAR $ip='';

  /* Last posted message
  *  Type: string
  */
  VAR $last_message='';

  /* How many times last posted messages been repeated
  *  Type: string
  */
  VAR $message_repeat=0;

  /* Display welcome message?
  *  Type: int (1: Yes, 0: No)
  */
  VAR $welcome=0;

  /* Last message post time (UNIX TIMESTAMP)
  *  Type: int
  */
  VAR $last_post_time=0;

  /* Flag: If user was logged in using direct login, then 1
  *  Type: int
  */
  VAR $direct_login=0;


  /**************************************************************************
  session
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create session object.
    Load chat configuration from database.
    Update current session (if exists).
  ---------------------------------------------------------------------------
  Parameters:
    id          string        Session ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION session($id=""){
    /* Creating database handle */
    $this->db=NEW dbaccess();
    /* Connecting to database */
    $this->db->connect();
    /* Loading configuration */
    $this->config=NEW configuration($this->db);
    IF($id){
      $this->id=$id;
      /* Updating ping */
      $this->updateSession("last_ping = UNIX_TIMESTAMP()");
    }
  }

  /**************************************************************************
  readSession
  ---------------------------------------------------------------------------
  Task:
    Delete old sessions.
    Read session data.
    Update current session last ping.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readSession(){
    IF($this->id){
      /* Loading session */
      $query="SELECT * FROM ".PREFIX."session WHERE id = '{$this->id}' LIMIT 1";
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      IF(IS_ARRAY($data)){
        WHILE(LIST($key,$val)=EACH($data)){
          IF(!PREG_MATCH("/^\d+$/",$key)){
            /* Using alfanumerical keys only */
            $this->$key=$val;
          }
        }
      }
    }
  }

  /**************************************************************************
  updateSession
  ---------------------------------------------------------------------------
  Task:
    Updates session data.
  ---------------------------------------------------------------------------
  Parameters:
    fields        string        Fields to update
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateSession($fields=""){
    IF($fields){
      $query="UPDATE ".PREFIX."session SET $fields WHERE id = '{$this->id}' LIMIT 1";
      $this->db->query($query);
      /* Reload session */
      $this->readSession($this->id);
    }
  }

  /**************************************************************************
  newSession
  ---------------------------------------------------------------------------
  Task:
    Creates new session.
  ---------------------------------------------------------------------------
  Parameters:
    user_id         int         User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION newSession($user_id=0){
    IF($user_id){
      $this->user_id=$user_id;
      $ok=FALSE;
      WHILE(!$ok){
        /* Generate new random session ID */
        $this->id=common::randomString(16);
        /* Is new session ID unique? */
        $query="SELECT id FROM ".PREFIX."session WHERE id = '{$this->id}' LIMIT 1";
        $result=$this->db->query($query);
        IF(!$this->db->fetchArray($result)){
          /* Session ID is unique */
          $ok=TRUE;
          $this->last_ping=TIME();
          /* Saving session */
          $query="INSERT INTO ".PREFIX."session (id, user_id, room_id, last_ping, ip, last_message) VALUES ('{$this->id}', {$this->user_id}, -1, {$this->last_ping}, '".IP."', '')";
          $this->db->query($query);
        }
      }
    }
  }

  /**************************************************************************
  listRoomUsers
  ---------------------------------------------------------------------------
  Task:
    List users in one room or in whole chat.
  ---------------------------------------------------------------------------
  Parameters:
    room_id         int           Room ID
  ---------------------------------------------------------------------------
  Return:
                    array         Array with user IDs
  **************************************************************************/
  FUNCTION listRoomUsers($room_id=0){
    $where='';
    IF($room_id){
      $where.=' AND room_id = '.$room_id;
    }
    $query="SELECT user_id FROM ".PREFIX."session WHERE direct_login = 0 $where";
    $result=$this->db->query($query);
    $data=$this->db->fetchAll($result);
    RETURN $data;
  }

  /**************************************************************************
  countRoomUsers
  ---------------------------------------------------------------------------
  Task:
    Count users in one room or in whole chat.
  ---------------------------------------------------------------------------
  Parameters:
    room_id         int           Room ID
  ---------------------------------------------------------------------------
  Return:
    Users count (int)
  **************************************************************************/
  FUNCTION countRoomUsers($room_id=0){
    IF($room_id){
      $query='SELECT COUNT(1) FROM '.PREFIX.'session WHERE direct_login = 0 AND room_id = '.$room_id;
    }ELSE{
      $query='SELECT COUNT(1) FROM '.PREFIX.'session WHERE direct_login = 0';
    }
    $result=$this->db->query($query);
    $data=$this->db->fetchAll($result);
    RETURN $data[0][0];
  }

  /**************************************************************************
  cleanUp
  ---------------------------------------------------------------------------
  Task:
    Delete old sessions.
    Delete empty userrooms tah are not used anymore.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION cleanUp(){
    /* Looking for old sessions */
    $query="SELECT id FROM ".PREFIX."session WHERE direct_login = 0 AND last_ping + {$this->config->max_ping} < UNIX_TIMESTAMP()";
    $result=$this->db->query($query);
    WHILE($data=$this->db->fetchArray($result)){
      /* Deleting session */
      $tmp=NEW session();
      $tmp->id=$data[0];
      $tmp->readSession();
      $tmp->logout();
    }
    /* Clean up userrooms */
    $room=NEW room();
    $room->cleanUp($this);
    /* Clean up users */
    $user=NEW user();
    $user->cleanUp($this);
  }

  /**************************************************************************
  checkUserUnique
  ---------------------------------------------------------------------------
  Task:
    Check whether user not logged in
  ---------------------------------------------------------------------------
  Parameters:
    user_id             int           User ID
    skip_direct_login   boolean       Do not check directly logged in sessions
  ---------------------------------------------------------------------------
  Return:
    TRUE if user is NOT logged in
    FALSE if user already logged in
  **************************************************************************/
  FUNCTION checkUserUnique($user_id=0, $skip_direct_login=false){
    IF($user_id){
      if($skip_direct_login){
        $query="SELECT 1 FROM ".PREFIX."session WHERE user_id = $user_id AND direct_login = 0 LIMIT 1";
      }else{
        $query="SELECT 1 FROM ".PREFIX."session WHERE user_id = $user_id LIMIT 1";
      }
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      IF(!empty($data) && IS_ARRAY($data)){
        RETURN FALSE;
      }ELSE{
        RETURN TRUE;
      }
    }
  }

  /**************************************************************************
  logout
  ---------------------------------------------------------------------------
  Task:
    Delete session.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION logout(){
    IF($this->id && $this->user_id){
      $tmp=NEW user();
      $tmp->readUser($this);
      IF($tmp->guest){
        // User is guest. Deleting user.
        $tmp->deleteUser($this,$tmp->id);
      }ELSE{
        // Updating user
        $tmp->updateUser($this,$tmp->id,"last_login = UNIX_TIMESTAMP()");
      }
      // Deleting passes, if any
      $roompass=NEW roompass();
      $roompass->deletePass($this,0,$this->user_id);
      // Deleting a session
      $query="DELETE FROM ".PREFIX."session WHERE id = '{$this->id}' LIMIT 1";
      $this->db->query($query);
      // Posting a system message into user's room
      IF($this->room_id){
        systemmessage::insertMessage($this,$this->user_id."|".$this->room_id,2);
      }
    }
  }

  /**************************************************************************
  isOnline
  ---------------------------------------------------------------------------
  Task:
    Chek whether user is online or not
  ---------------------------------------------------------------------------
  Parameters:
    $user_id              int               User ID
  ---------------------------------------------------------------------------
  Return:
    TRUE if user is online
    FALSE if user is not online
  **************************************************************************/
  FUNCTION isOnline($user_id=0){
    IF($user_id){
      $query="SELECT 1 FROM ".PREFIX."session WHERE direct_login = 0 AND user_id = \"$user_id\" LIMIT 1";
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      IF(!$data){
        // No owner found
        RETURN 0;
      }ELSE{
        // Owner found
        RETURN 1;
      }
    }
  }

  /**************************************************************************
  getUsersRoom
  ---------------------------------------------------------------------------
  Task:
    Get user's room ID
  ---------------------------------------------------------------------------
  Parameters:
    $user_id              int               User ID
  ---------------------------------------------------------------------------
  Return:
    Room ID (int)
  **************************************************************************/
  FUNCTION getUsersRoom($user_id=0){
    IF($user_id){
      $query="SELECT room_id FROM ".PREFIX."session WHERE direct_login = 0 AND user_id = $user_id LIMIT 1";
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      RETURN $data[0];
    }
  }

  /**************************************************************************
  getUsersSession
  ---------------------------------------------------------------------------
  Task:
    Get user's session ID
  ---------------------------------------------------------------------------
  Parameters:
    $user_id              int               User ID
  ---------------------------------------------------------------------------
  Return:
    (string) Session ID
  **************************************************************************/
  FUNCTION getUsersSession($user_id=0){
    IF($user_id){
      $query="SELECT id FROM ".PREFIX."session WHERE user_id = $user_id LIMIT 1";
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      RETURN $data[0];
    }
  }


}
?>