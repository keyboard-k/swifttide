<?PHP
/****************************************************************************
CLASS advertisement
-----------------------------------------------------------------------------
Task:
  Manage advertisement
****************************************************************************/

CLASS advertisement{

  /* Class variables */

  /* ID
  *  Type: int
  */
  VAR $id=0;

  /* Advertisement text
  *  Type: string
  */
  VAR $text='';

  /* Start show advertisement at
  *  Type: int (UNIX timestamp)
  */
  VAR $start=0;

  /* Stop show advertisement at
  *  Type: int (UNIX timestamp)
  */
  VAR $stop=0;

  /* Delay between advertisement show
  *  Type: int (UNIX timestamp)
  */
  VAR $period=0;

  /* Minimum count users in room to show advertisement
  *  Type: int
  */
  VAR $min_roomusers=0;

  /* Show advertisement in private rooms too?
  *  Type: int
  */
  VAR $show_private=0;

  /* How many times were advertisement shown?
  *  Type: int
  */
  VAR $shows_count=0;




  /**************************************************************************
  advertisement
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create advertisement object
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION advertisement(){
  }

  /**************************************************************************
  listAdvertisements
  ---------------------------------------------------------------------------
  Task:
    List advertisements
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $active           int           Active only
  ---------------------------------------------------------------------------
  Return:
    Array with advertisements
  **************************************************************************/
  FUNCTION listAdvertisements(&$session,$active=0){
    IF($actie){
      $where="WHERE start <= UNIX_TIMESTAMP() AND stop >= UNIX_TIMESTAMP()";
    }ELSE{
      $where="";
    }
    $query="SELECT * FROM ".PREFIX."advertisement $where";
    // List all advertisements
    $result=$session->db->query($query);
    RETURN $session->db->fetchAll($result);
  }

  /**************************************************************************
  insertAdvertisement
  ---------------------------------------------------------------------------
  Task:
    Insert advertisement into database
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $advertisement_id     int           Advertisement ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION insertAdvertisement(&$session,$advertisement_id=0){
    IF($advertisement_id){
      // Delete old advertisement
      $this->deleteAdvertisement($session,$advertisement_id);
      $query="INSERT INTO ".PREFIX."advertisement (id, text, start, stop, period, min_roomusers, show_private) VALUES ($advertisement_id, '{$this->text}', '{$this->start}', '{$this->stop}', '{$this->period}', '{$this->min_roomusers}', '{$this->show_private}')";
    }ELSE{
      $query="INSERT INTO ".PREFIX."advertisement (text, start, stop, period, min_roomusers, show_private) VALUES ('{$this->text}', '{$this->start}', '{$this->stop}', '{$this->period}', '{$this->min_roomusers}', '{$this->show_private}')";
    }
    $session->db->query($query);
  }

  /**************************************************************************
  readAdvertisement
  ---------------------------------------------------------------------------
  Task:
    Read advertisement from database
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $advertisement_id     int           Advertisement ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readAdvertisement(&$session,$advertisement_id=0){
    IF($advertisement_id){
      $query="SELECT * FROM ".PREFIX."advertisement WHERE id = $advertisement_id LIMIT 1";
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
  deleteAdvertisement
  ---------------------------------------------------------------------------
  Task:
    Delete advertisement from database
  ---------------------------------------------------------------------------
  Parameters:
    $session              Object        Session handle
    $advertisement_id     int           Advertisement ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteAdvertisement(&$session,$advertisement_id=0){
    IF($advertisement_id){
      // Clean up 'fk_advertisement' table
      $query="DELETE FROM ".PREFIX."fk_advertisement WHERE advertisement_id = $advertisement_id";
      $session->db->query($query);
      // Delete advertisement
      $query="DELETE FROM ".PREFIX."advertisement WHERE id = $advertisement_id LIMIT 1";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  updateAdvertisement
  ---------------------------------------------------------------------------
  Task:
    Updates advertisement
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    id                int           Advertisement ID
    fields            string        Fields to update
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateAdvertisement(&$session,$id=0,$fields=""){
    IF($id&&$fields){
      $query="UPDATE ".PREFIX."advertisement SET $fields WHERE id = $id";
      $session->db->query($query);
      $this->readAdvertisement($session,$id);
    }
  }


}
?>