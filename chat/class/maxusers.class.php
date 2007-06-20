<?PHP
/****************************************************************************
CLASS maxusers
-----------------------------------------------------------------------------
Task:
  Save top online users count for day, month, week, year and total.
****************************************************************************/

CLASS maxusers{

  /* Class variables */

  /* Users online count
  *  Type: int
  */
  VAR $max_users=0;

  /* Top count time (UNIX TIMESTAMP)
  *  Type: int
  */
  VAR $time=0;


  /**************************************************************************
  maxusers
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Creates maxusers object.
    Read max users value from database. Update max users value.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION maxusers(&$session){
    $this->readMaxUsers($session);
    $this->updateMaxUsers($session);
  }

  /**************************************************************************
  readMaxUsers
  ---------------------------------------------------------------------------
  Task:
    Read top online users count from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readMaxUsers(&$session){
    $this->max_users=0;
    $this->time=0;
    $query='SELECT * FROM '.PREFIX.'maxusers LIMIT 1';
    $result=$session->db->query($query);
    IF($data=$session->db->fetchArray($result, MYSQL_ASSOC)){
      WHILE(LIST($key,$val)=EACH($data)){
        $this->$key=$val;
      }
    }
  }

  /**************************************************************************
  updateMaxUsers
  ---------------------------------------------------------------------------
  Task:
    Update top online users count, if needed.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateMaxUsers(&$session){
    // Get current users count
    $users_count=$session->countRoomUsers();
    IF($users_count > $this->max_users){
      $query='UPDATE '.PREFIX.'maxusers SET max_users = '.$users_count.', time = UNIX_TIMESTAMP() LIMIT 1';
      $session->db->query($query);
      $this->readMaxUsers($session);
    }
  }




}
?>