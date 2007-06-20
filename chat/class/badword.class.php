<?PHP
/****************************************************************************
CLASS badword
-----------------------------------------------------------------------------
Task:
  Manage bad words
****************************************************************************/

CLASS badword{

  /* Class variables */

  /* Bad word ID
  *  Type: int
  */
  VAR $id=0;

  /* Bad word
  *  Type: string
  */
  VAR $word='';

  /* Bad word replacement
  *  Type: string
  */
  VAR $replacement='';



  /**************************************************************************
  badword
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Creates badword object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION badword(){
  }

  /**************************************************************************
  listBadWords
  ---------------------------------------------------------------------------
  Task:
    Read all bad words from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
  ---------------------------------------------------------------------------
  Return:
    Array with bad words
  **************************************************************************/
  FUNCTION listBadWords(&$session){
    $query="SELECT * FROM ".PREFIX."badword ORDER BY word ASC";
    $result=$session->db->query($query);
    RETURN $session->db->fetchAll($result);
  }

  /**************************************************************************
  readBadWord
  ---------------------------------------------------------------------------
  Task:
    Read bad word from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $id               int           Bad word ID
    $word             string        Bad word
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION readBadWord(&$session,$id=0,$word=""){
    IF($id||$word){
      IF($id){
        $where="id = $id";
      }ELSEIF($word){
        $where="word = '$word'";
      }
    }
    $query="SELECT * FROM ".PREFIX."badword WHERE $where LIMIT 1";
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
  deleteBadWord
  ---------------------------------------------------------------------------
  Task:
    Delete bad word from database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $word             string        Bad word
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION deleteBadWord(&$session,$id=0){
    IF($id){
      $query="DELETE FROM ".PREFIX."badword WHERE id = $id LIMIT 1";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  saveBadWord
  ---------------------------------------------------------------------------
  Task:
    Add bad word into database.
  ---------------------------------------------------------------------------
  Parameters:
    $session          Object        Session handle
    $word             string        Bad word
    $replacement      string        Replacement
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION saveBadWord(&$session,$word="",$replacement=""){
    IF($word){
      $query="INSERT INTO ".PREFIX."badword (word, replacement) VALUES ('$word', '$replacement')";
      $session->db->query($query);
    }
  }



}
?>