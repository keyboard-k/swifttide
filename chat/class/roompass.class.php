<?PHP
/****************************************************************************
CLASS roompass
-----------------------------------------------------------------------------
Task:
  Manage temporary passes for password-protected rooms
****************************************************************************/

CLASS roompass{


  /* Class variables */

  /* Room ID
  *  Type: int
  */
  VAR $room_id=0;

  /* User ID
  *  Type: int
  */
  VAR $user_id=0;


  /**************************************************************************
  roompass
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create roompass object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION roompass(){
  }

  /**************************************************************************
  createPass
  ---------------------------------------------------------------------------
  Task:
    Create 'one-time' pass for user to enter password-protected room
  ---------------------------------------------------------------------------
  Parameters:
    $session          object        Session handle
    $room_id          int           Room ID
    $user_id          int           Pass owner
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION createPass(&$session,$room_id=0,$user_id=0){
    IF($room_id&&$user_id){
      // Delete old pass if exists
      $this->deletePass($session,$room_id,$user_id);
      // Insert new pass
      $query="INSERT INTO ".PREFIX."roompass VALUES ($room_id, $user_id)";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  deletePass
  ---------------------------------------------------------------------------
  Task:
    Delete 'one-time' pass for user to enter password-protected room
  ---------------------------------------------------------------------------
  Parameters:
    $session          object        Session handle
    $room_id          int           Room ID
    $user_id          int           Pass owner
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deletePass(&$session,$room_id=0,$user_id=0){
    IF($room_id||$user_id){
      $where="1";
      IF($room_id){
        $where.=" AND room_id = $room_id";
      }
      IF($user_id){
        $where.=" AND user_id = $user_id";
      }
      $query="DELETE FROM ".PREFIX."roompass WHERE $where";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  checkPass
  ---------------------------------------------------------------------------
  Task:
    Check 'one-time' pass for user to enter password-protected room
  ---------------------------------------------------------------------------
  Parameters:
    $session          object        Session handle
    $room_id          int           Room ID
    $user_id          int           Pass owner
    $delete           bool          Whether to delete pass or not
  ---------------------------------------------------------------------------
  Return:
    Booleat TRUE if pass exists
  **************************************************************************/
  FUNCTION checkPass(&$session,$room_id=0,$user_id=0,$delete=0){
    IF($room_id&&$user_id){
      // Read pass
      $query="SELECT 1 FROM ".PREFIX."roompass WHERE room_id = $room_id AND user_id = $user_id LIMIT 1";
      $result=$session->db->query($query);
      IF($data=$session->db->fetchArray($result)){
        // Password found
        IF($delete){
          $this->deletePass($session,$room_id,$user_id);
        }
        RETURN TRUE;
      }
    }
  }



}
?>