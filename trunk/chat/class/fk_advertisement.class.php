<?PHP
/****************************************************************************
CLASS fk_advertisement
-----------------------------------------------------------------------------
Task:
  Foreign keys between 'advertisement' and 'room' tables
****************************************************************************/

CLASS fk_advertisement{

  /* Class variables */

  /* Advertisement ID
  *  Type: int
  */
  VAR $advertisement_id=0;

  /* Room ID
  *  Type: int
  */
  VAR $room_id=0;

  /* Last advertisement show time (UNIX timestamp)
  *  Type: int
  */
  VAR $last_time=0;



  /**************************************************************************
  advertisement
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create fk_advertisement object
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION fk_advertisement(){
  }

  /**************************************************************************
  update
  ---------------------------------------------------------------------------
  Task:
    Update record in database
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $room_id              int           Room ID
    $advertisement_id     int           Advertisement ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION update(&$session,$room_id=0,$advertisement_id=0){
    IF($room_id&&$advertisement_id){
      // Look for the record
      $query="SELECT 1 FROM ".PREFIX."fk_advertisement WHERE room_id = $room_id AND advertisement_id = $advertisement_id LIMIT 1";
      $result=$session->db->query($query);
      IF(!$session->db->fetchArray($result)){
        // Record does not exists. Create new one.
        $query="INSERT INTO ".PREFIX."fk_advertisement (advertisement_id, room_id, last_time) VALUES($advertisement_id, $room_id, UNIX_TIMESTAMP())";
      }ELSE{
        // Record exists. Update.
        $query="UPDATE ".PREFIX."fk_advertisement SET last_time = UNIX_TIMESTAMP() WHERE room_id = $room_id AND advertisement_id = $advertisement_id LIMIT 1";
      }
      $session->db->query($query);
    }
  }

  /**************************************************************************
  getTime
  ---------------------------------------------------------------------------
  Task:
    Read last advertisement show time from database
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $room_id              int           Room ID
    $advertisement_id     int           Advertisement ID
  ---------------------------------------------------------------------------
  Return:
    Last advertisement show time (UNIX timestamp)
  **************************************************************************/
  FUNCTION check(&$session,$room_id=0,$advertisement_id=0){
    IF($room_id&&$advertisement_id){
      // Look for the record
      $query="SELECT last_time FROM ".PREFIX."fk_advertisement WHERE room_id = $room_id AND advertisement_id = $advertisement_id LIMIT 1";
      $result=$session->db->query($query);
      $data=$session->db->fetchArray($result);
      RETURN $data[0];
    }
  }



}
?>