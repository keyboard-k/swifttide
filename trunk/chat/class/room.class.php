<?PHP
/****************************************************************************
CLASS room
-----------------------------------------------------------------------------
Task:
  Manage rooms
****************************************************************************/

CLASS room{

  /* Class variables */

  /* Room ID
  *  Type: int
  */
  VAR $id=0;

  /* Room name
  *  Type: string
  */
  VAR $name='';

  /* Room type
  *  Type: int
  *  Values:
  *     0:  Main chat room
  *     1:  Room created by user
  *     2:  Main chat room with password
  *     3:  Room created by user with password
  */
  VAR $type=0;

  /* Time the room was created or visited
  *  Type: int
  */
  VAR $last_ping=0;

  /* Room password
  *  Type: string
  */
  VAR $password='';

  /* Background image
  *  Type: string
  */
  VAR $bgimg='';

  /* Room creator's user ID
  *  Type: int
  */
  VAR $creator_id=0;

  /* Roomlist
  *  Type: array
  */
  VAR $roomlist=null;



  /**************************************************************************
  room
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Creates room object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION room(){
  }

  /**************************************************************************
  listRooms
  ---------------------------------------------------------------------------
  Task:
    Reads chat rooms
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $id               int           Room ID
    $name             string        Room name
    $type             int           Room type
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION listRooms(&$session,$id=0,$name="",$type=-1){
    $where="1";
    /* Advanced search paramaters */
    IF($id){
      $where.=" AND id = $id";
    }
    IF($name){
      $where.=" AND name = '$name'";
    }
    IF($type>=0){
      $where.=" AND type = $type";
    }
    $query="SELECT * FROM ".PREFIX."room WHERE $where ORDER BY name ASC";
    $result=$session->db->query($query);
    $this->roomlist=$session->db->fetchAll($result);
  }

  /**************************************************************************
  updateRoom
  ---------------------------------------------------------------------------
  Task:
    Updates room
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    id                int           Room ID
    fields            string        Fields to update
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateRoom(&$session,$id=0,$fields=""){
    IF($id&&$fields){
      $query="UPDATE ".PREFIX."room SET $fields WHERE id = $id";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  createRoom
  ---------------------------------------------------------------------------
  Task:
    Create room
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $name                 string        Room name
    $type                 int           Room type
    $password_protected   string        Is the room password-protected? ('1': yes, '0': no)
    $password             string        Room password
    $bgimg                string        Background image filename
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION createRoom(&$session,$name="",$type=1,$password="",$bgimg=""){
    IF($name){
      $query="INSERT INTO ".PREFIX."room (name, type, last_ping, password, bgimg, creator_id) VALUES ('$name', $type, UNIX_TIMESTAMP(), '$password', '$bgimg', ".$session->user_id.")";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  cleanUp
  ---------------------------------------------------------------------------
  Task:
    Delete empty userrooms that are not used anymore
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION cleanUp(&$session){
    $deadline=TIME()-$session->config->userroom_life;
    // Read all timed-up user rooms
    $query="SELECT id FROM ".PREFIX."room WHERE last_ping < $deadline AND (type = 1 OR type = 3)";
    $result=$session->db->query($query);
    $roomlist=$session->db->fetchAll($result);
    $rooms_count=COUNT($roomlist);
    FOR($i=0;$i<$rooms_count;$i++){
      // Deleting user room
      $this->deleteRoom($session,$roomlist[$i][id]);
    }
  }

  /**************************************************************************
  readRoom
  ---------------------------------------------------------------------------
  Task:
    Read room from database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $room_id          int           Room ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readRoom(&$session,$room_id=0){
    IF($room_id){
      $query="SELECT * FROM ".PREFIX."room WHERE id = $room_id LIMIT 1";
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

  /**************************************************************************
  deleteRoom
  ---------------------------------------------------------------------------
  Task:
    Delete room from database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $room_id          int           Room ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteRoom(&$session,$room_id=0){
    IF($room_id){
      // Deleting room from all lists
      systemmessage::insertMessage($session,$room_id,4);
      // Clean up 'fk_advertisement' table
      $query="DELETE FROM ".PREFIX."fk_advertisement WHERE room_id = $room_id";
      $session->db->query($query);
      // Deleting background image, if exists
      $tmp=NEW room();
      $tmp->readRoom($session,$room_id);
      IF($tmp->bgimg){
        UNLINK(IMAGEPATH."/rooms/".$tmp->bgimg);
      }
      // Deleting passes, if any
      $roompass=NEW roompass();
      $roompass->deletePass($session,$room_id,0);
      // Deleting room
      $query="DELETE FROM ".PREFIX."room WHERE id = $room_id LIMIT 1";
      $session->db->query($query);
    }
  }


}
?>