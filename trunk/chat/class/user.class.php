<?PHP
/****************************************************************************
CLASS user
-----------------------------------------------------------------------------
Task:
  Manage users
****************************************************************************/

CLASS user{

  /* Class variables */

  /* User ID
  *  Type: int
  */
  VAR $id=0;

  /* User login name
  *  Type: string
  */
  VAR $login=0;

  /* User password (MD5 encoded)
  *  Type: string
  */
  VAR $password=0;

  /* Binary-represented user level
  *  Type: int
  *  Values:
  *     bit#          Description (if bit set)
  *     0 (1)           Chat statistics
  *     1 (2)           Chat design
  *     2 (4)           Chat settings
  *     3 (8)           Edit users
  *     4 (16)          Kick users
  *     5 (32)          Ban users and IP addresses
  *     6 (64)          Post global messages
  *     7 (128)         Manage advertisements
  *     8 (256)         Manage smilies
  *     9 (512)         Manage bad words
  *     10 (1024)       Manage privileges
  *     11 (2048)       Manage rooms
  *     12 (4096)       
  *     13 (8192)       
  *     14 (16384)      
  *     15 (32768)      
  *     16 (65536)      
  */
  VAR $level=0;

  /* User join date and time (UNIX TIMESTAMP)
  *  Type: int
  */
  VAR $joined=0;

  /* Real name
  *  Type: string
  */
  VAR $name=0;

  /* user sex
  *  Type: string
  */
  VAR $sex='';

  /* User nik color
  *  Type: string
  */
  VAR $color='';

  /* User email
  *  Type: string
  */
  VAR $email='';

  /* Whether to hide email from other users or not
  *  Type: int
  *  Possible values:
  *    1: Hide email
  *    2: Don't hide email
  */
  VAR $hide_email=0;

  /* User age
  *  Type: int
  */
  VAR $age=0;

  /* User location
  *  Type: string
  */
  VAR $location='';

  /* User about himself
  *  Type: string
  */
  VAR $about='';

  /* User's photo filename
  *  Type: string
  */
  VAR $photo;

  /* Is user guest?
  *  Type: int
  *  Values:
  *     0: No
  *     1: Yes
  */
  VAR $guest=0;

  /* Passcode. Need to activate account or to get new password.
  *  Type: string
  */
  VAR $passcode='';

  /* Activated
  *  Type: int
  */
  VAR $activated=0;

  /* Last login time (UNIX TIMESTAMP)
  *  Type: int
  */
  VAR $last_login=0;

  /* User's cookie
  *  Type: string
  */
  VAR $cookie='';

  /* Last used IP address
  *  Type: string
  */
  VAR $last_ip='';



  /**************************************************************************
  user
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Creates user object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION user(){
  }

  /**************************************************************************
  readUser
  ---------------------------------------------------------------------------
  Task:
    Read userdata from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $user_id          int           User ID: OPTIONAL (if not set then will
                                                       be taken from the
                                                       current session)
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readUser(&$session,$user_id=0){
    IF(!$user_id){
      /* user ID not set. Using current user's ID. */
      $user_id=$session->user_id;
    }
    /* Read user data from database */
    $query="SELECT * FROM ".PREFIX."user WHERE id = $user_id LIMIT 1";
    $result=$session->db->query($query);
    WHILE($data=$session->db->fetchArray($result)){
      WHILE(LIST($key,$val)=EACH($data)){
        IF(!PREG_MATCH("/^\d+$/",$key)){
          /* Using alfanumerical keys only */
          $this->$key=$val;
        }
      }
    }
    /* Get user's IP address */
    $query="SELECT ip FROM ".PREFIX."session WHERE user_id = {$this->id} LIMIT 1";
    $result=$session->db->query($query);
    $data=$session->db->fetchArray($result);
    $this->ip=$data[0];
  }

  /**************************************************************************
  checkLogin
  ---------------------------------------------------------------------------
  Task:
    Check login and password.
    If login and password are OK then load user data.
    Update user's last login time.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION checkLogin(&$session){
    $query='SELECT * FROM '.PREFIX.'user WHERE (cookie = "'.$this->cookie.'" AND cookie <> "") OR (login = "'.$this->login.'" AND password = "'.$this->password.'") AND activated = "1" LIMIT 1';
    $result=$session->db->query($query);
    IF($data=$session->db->fetchArray($result)){
      // Login is OK
      $this->readuser($session,$data['id']);
      // Generate new cookie
      $this->cookie=common::randomString(32);
      $this->updateUser($session,$this->id,'passcode = "", last_login = UNIX_TIMESTAMP(), cookie = "'.$this->cookie.'", last_ip = "'.IP.'"');
    }
  }

  /**************************************************************************
  updateUser
  ---------------------------------------------------------------------------
  Task:
    Updates userdata
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    id                int           User ID
    fields            string        Fields to update
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateUser(&$session,$id=0,$fields=""){
    IF($id&&$fields){
      $query="UPDATE ".PREFIX."user SET $fields WHERE id = $id";
      $session->db->query($query);
      $this->readUser($session,$id);
    }
  }

  /**************************************************************************
  changePassword
  ---------------------------------------------------------------------------
  Task:
    Change user's password
  ---------------------------------------------------------------------------
  Parameters:
    $session            Object        Session handle
    $old_password       string        Old password
    $new_password_1     string        New password
    $new_password_2     string        New password again
  ---------------------------------------------------------------------------
  Return:
    int     error code
  **************************************************************************/
  FUNCTION changePassword(&$session,$old_password="",$new_password_1="",$new_password_2=""){
    // Check current password
    IF($this->password==MD5($old_password)){
      // Compare new passwords
      IF($new_password_1==$new_password_2){
        // Check new password length
        IF(STRLEN($new_password_1)>=$session->config->password_length_min&&STRLEN($new_password_1)<=$session->config->password_length_max){
          // Check characters in new password
          IF(EREG_REPLACE("[^0-9a-zA-Z]","",$new_password_1)==$new_password_1){
            $this->updateUser($session,$session->user_id,"password = '".MD5($new_password_1)."'");
            RETURN 0;
          }ELSE{
            // Illegal characters in new password
            RETURN 4;
          }
        }ELSE{
          // Illegal password length
          RETURN 3;
        }
      }ELSE{
        // New passwords are not ident
        RETURN 2;
      }
    }ELSE{
      // Wrong current password
      RETURN 1;
    }
  }

  /**************************************************************************
  listUsers
  ---------------------------------------------------------------------------
  Task:
    List chat users
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $username         string        Username
    $orderby          string        Field to order by
    $startfrom        int           Start from dataset number X
    $limit            int           Return max Y datasets
    $online_status    int           Online status (0: any, 1: online, 2: offline)
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION listUsers(&$session,$username="",$orderby="", $startfrom=0, $limit=0, $online_status=0){
    $where=" 1 ";
    IF($username){
      $where.=" AND us.login = '$username'";
    }
    IF(!$orderby){
      $orderby="us.login ASC";
    }
    $limitby='';
    IF(!EMPTY($limit)){
      IF(!EMPTY($startfrom)){
        $limitby="LIMIT $startfrom,$limit";
      }ELSE{
        $limitby="LIMIT $limit";
      }
    }
    IF($online_status==1){
      $where.=' AND se.id IS NOT NULL ';
    }ELSEIF($online_status==2){
      $where.=' AND se.id IS NULL ';
    }
    $query="SELECT us.* FROM ".PREFIX."user us LEFT JOIN ".PREFIX."session se ON (se.user_id = us.id) WHERE $where ORDER BY $orderby $limitby";
    $result=$session->db->query($query);
    UNSET($list);
    WHILE($data=$session->db->fetchArray($result)){
      IF($session->isOnline($data[id])){
        $data[online]=1;
      }
      $list[]=$data;
    }
    RETURN $list;
  }

  /**************************************************************************
  addUser
  ---------------------------------------------------------------------------
  Task:
    Add new user
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION addUser(&$session){
    $query="INSERT INTO ".PREFIX."user (login, password, level, joined, name, sex, color, email, hide_email, age, location, about, photo, guest, activated) VALUES ('$this->login', '$this->password', '$this->level', UNIX_TIMESTAMP(), '$this->name', '$this->sex', '$this->color', '$this->email', '$this->hide_email', '$this->age', '$this->location', '$this->about', '$this->photo', '$this->guest', '$this->activated')";
    $session->db->query($query);
    // Reload user
    $this->findUser($session,$this->login);
  }

  /**************************************************************************
  deleteUser
  ---------------------------------------------------------------------------
  Task:
    Delete user
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $user_id          int           User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteUser(&$session,$user_id){
    IF($user_id){
      // Read user data
      $tmp=NEW user();
      $tmp->readUser($session,$user_id);
      // Delete photo
      if ($tmp->photo!='' && $tmp->photo!='nophoto.jpg') {
        UNLINK(IMAGEPATH."/userphotos/{$tmp->photo}");
      }
      // Delete user from database
      $query="DELETE FROM ".PREFIX."user WHERE id = $user_id LIMIT 1";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  findUser
  ---------------------------------------------------------------------------
  Task:
    Find user and read his data
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $login            string        Login
    $email            string        Email address
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION findUser(&$session,$login="",$email=""){
    $where="";
    IF($login){
      $where.=" AND login = '$login'";
    }
    IF($email){
      $where.=" AND email = '$email'";
    }
    IF($where){
      /* Read user ID data from database */
      $query="SELECT id FROM ".PREFIX."user WHERE 1 $where LIMIT 1";
      $result=$session->db->query($query);
      IF($data=$session->db->fetchArray($result)){
        /* Read user data */
        $this->readUser($session,$data[0]);
      }
    }
  }

  /**************************************************************************
  generatePassCode
  ---------------------------------------------------------------------------
  Task:
    Generate new passcode
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $user_id          int           User ID
    $length           int           Passcode length
  ---------------------------------------------------------------------------
  Return:
    (string)  Passcode
  **************************************************************************/
  FUNCTION generatePassCode(&$session,$user_id=0,$length=0){
    $passcode="";
    $this->readUser($session,$user_id);
    IF($this->id){
      // Generate new code
      IF($length<3){
        $length=3; // Default value
      }
      $passcode='';
      $loop=CEIL($length/32);
      WHILE($loop){
        $passcode.=MD5(MT_RAND(-TIME(), TIME()).MICROTIME());
        $loop--;
      }
      $passcode=SUBSTR($passcode, 0, $length);
      // Save code into database
      $this->updateUser($session, $this->id, 'passcode = "'.MD5($passcode).'"');
    }
    RETURN $passcode;
  }

  /**************************************************************************
  generatePassword
  ---------------------------------------------------------------------------
  Task:
    Generate new password
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object          Session handle
    $user_id              int             User ID
    $activation_code      string          Activation code
    $password_1           string          New password
    $password_2           string          New password again
  ---------------------------------------------------------------------------
  Return:
    (int)  error code
  **************************************************************************/
  FUNCTION generatePassword(&$session,$user_id=0,$activation_code="",$new_password_1="",$new_password_2=""){
    // Read userdata
    $this->readUser($session,$user_id);
    IF($this->id){
      // Check activation code
      IF($this->passcode<>'' && $this->passcode==MD5($activation_code)){
        // Activation code OK
        // Compare new passwords
        IF($new_password_1==$new_password_2){
          // Check new password length
          IF(STRLEN($new_password_1)>=$session->config->password_length_min&&STRLEN($new_password_1)<=$session->config->password_length_max){
            // Check characters in new password
            IF(EREG_REPLACE("[^0-9a-zA-Z]","",$new_password_1)==$new_password_1){
              // Save new password
              $this->updateUser($session,$this->id,"passcode = '', password = '".MD5($new_password_1)."'");
              RETURN 0;
            }ELSE{
              // Illegal characters in new password
              RETURN 4;
            }
          }ELSE{
            // Illegal password length
            RETURN 3;
          }
        }ELSE{
          // New passwords are not ident
          RETURN 2;
        }
      }ELSE{
        // Wrong activation code
        RETURN 1;
      }
    }ELSE{
      RETURN 1;
    }
  }

  /**************************************************************************
  cleanUp
  ---------------------------------------------------------------------------
  Task:
    Clean up users
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION cleanUp(&$session){
    // Delete non-activated user accounts
    IF($session->config->delete_notactivated){
      $delete_before=TIME()-$session->config->delete_notactivated*3600;
      $query="DELETE FROM ".PREFIX."user WHERE activated = '0' AND joined < $delete_before";
      $session->db->query($query);
    }
    // Kick idle users out
    IF($session->config->kick_idle){
      $kick_before=TIME()-$session->config->kick_idle;
      $query="SELECT se.user_id FROM ".PREFIX."session se LEFT JOIN ".PREFIX."user us ON us.id = se.user_id WHERE us.level = 0 AND se.direct_login = 0 AND se.room_id > 0 AND se.last_post_time < $kick_before";
      $result=$session->db->query($query);
      WHILE($data=$session->db->fetchArray($result)){
        // Update user's session
        $session2=NEW session($session->getUsersSession($data[0]));
        $session2->updateSession("kicked = 1");
        // Post a system message
        systemMessage::insertMessage($session,$data[0],6);
      }
    }
    // Delete inactive user accounts
    IF($session->config->delete_inactive){
      $delete_before=TIME()-$session->config->delete_inactive*86400;
      // Get all inactive user IDs (non-priveleged users only)
      $query="SELECT id FROM ".PREFIX."user WHERE level = 0 AND (last_login = 0 AND joined < $delete_before OR last_login > 0 AND last_login < $delete_before)";
      $result=$session->db->query($query);
      WHILE($data=$session->db->fetchArray($result)){
        // Delete offline users only
        IF(!$session->isOnline($data[0])){
          $this->deleteUser($session,$data[0]);
        }
      }
    }

  }


  /**************************************************************************
  countUsers
  ---------------------------------------------------------------------------
  Task:
    Count chat users
  ---------------------------------------------------------------------------
  Parameters:
    $session                Object        Session handle
    &$registered            int           Registered users count
    &$registered_online     int           Online registered users count
    &$guests_online         int           Online guest users count
    &$total_online          int           Total online count
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION countUsers(&$session, &$registered, &$registered_online, &$guests_online, &$total_online){
    $registered=0;
    $registered_online=0;
    $guests_online=0;
    $total_online=0;
    $query='SELECT
                   COUNT(DISTINCT se.id) AS total_online,
                   COUNT(DISTINCT IF(us.guest = 0, us.id, NULL)) AS registered,
                   COUNT(DISTINCT IF(us.guest = 0, se.id, NULL)) AS registered_online,
                   COUNT(DISTINCT IF(us.guest = 1, se.id, NULL)) AS guests_online
              FROM '.PREFIX.'user us
                   LEFT JOIN '.PREFIX.'session se ON se.user_id = us.id';
    $result=$session->db->query($query);
    IF($data=$session->db->fetchArray($result, MYSQL_ASSOC)){
      $registered=$data['registered'];
      $registered_online=$data['registered_online'];
      $guests_online=$data['guests_online'];
      $total_online=$data['total_online'];
    }
  }

}
?>