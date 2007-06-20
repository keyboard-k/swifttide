<?PHP
/****************************************************************************
CLASS smilie
-----------------------------------------------------------------------------
Task:
  Manage smilie
****************************************************************************/

CLASS smilie{

  /* Class variables */

  /* ID
  *  Type: int
  */
  VAR $id=0;

  /* Image name
  *  Type: string
  */
  VAR $image='';

  /* Text equivalent
  *  Type: string
  */
  VAR $text='';



  /**************************************************************************
  smilie
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Create smilie object
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION smilie(){
  }

  /**************************************************************************
  listSmilies
  ---------------------------------------------------------------------------
  Task:
    List smilies
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return:
    Array with smilies
  **************************************************************************/
  FUNCTION listSmilies(&$session){
    $query="SELECT * FROM ".PREFIX."smilie ORDER BY id";
    $result=$session->db->query($query);
    RETURN $session->db->fetchAll($result);
  }

  /**************************************************************************
  insertSmilie
  ---------------------------------------------------------------------------
  Task:
    Insert smilie into database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $smilie_id        int           Smilie ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION insertSmilie(&$session,$smilie_id=0){
    IF($smilie_id){
      // Delete old smilie
      $this->deleteSmilie($session,$advertisement_id);
    }
    $query="INSERT INTO ".PREFIX."smilie (image, text) VALUES ('{$this->image}', '{$this->text}')";
    $session->db->query($query);
  }

  /**************************************************************************
  readSmilie
  ---------------------------------------------------------------------------
  Task:
    Read smilie from database
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $smilie_id        int           Smilie ID
    $text             string        Text equivalent
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readSmilie(&$session,$smilie_id=0,$text=""){
    IF($smilie_id){
      // Smilie ID given
      $query="SELECT * FROM ".PREFIX."smilie WHERE id = $smilie_id LIMIT 1";
    }ELSEIF($text){
      // Text equivalent given
      $query="SELECT * FROM ".PREFIX."smilie WHERE text = '$text' LIMIT 1";
    }
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

  /**************************************************************************
  deleteSmilie
  ---------------------------------------------------------------------------
  Task:
    Delete smilie
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $smilie_id        int           Smilie ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteSmilie(&$session,$smilie_id=0){
    IF($smilie_id){
      // Read smilie
      $this->readSmilie($session,$smilie_id);
      // Delete from database
      $query="DELETE FROM ".PREFIX."smilie WHERE id = $smilie_id LIMIT 1";
      $session->db->query($query);
      // Delete file
      UNLINK(IMAGEPATH."/smilies/".$this->image);
    }
  }

  /**************************************************************************
  updateSmilie
  ---------------------------------------------------------------------------
  Task:
    Updates smilie
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    id                int           Smilie ID
    fields            string        Fields to update
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateSmilie(&$session,$id=0,$fields=""){
    IF($id&&$fields){
      $query="UPDATE ".PREFIX."smilie SET $fields WHERE id = $id";
      $session->db->query($query);
      $this->readSmilie($session,$id);
    }
  }



}
?>