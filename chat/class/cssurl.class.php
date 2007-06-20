<?PHP
/****************************************************************************
CLASS cssURL
-----------------------------------------------------------------------------
Task:
  Manage URL of external CSS
****************************************************************************/

CLASS cssURL{

  // URL to external CSS
  VAR $cssurl;

  /**************************************************************************
  cssURL
  ---------------------------------------------------------------------------
  Task:
    Load (if any) CSS URL from database
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION cssURL(&$db){
    $query='SELECT * FROM '.PREFIX.'cssurl LIMIT 1';
    $result=$db->query($query);
    IF($data=$db->fetchArray($result)){
      WHILE(LIST($key,$val)=EACH($data)){
        IF(!PREG_MATCH("/^\d+$/",$key)){
          /* Using alphanumerical keys only */
          $this->$key=$val;
        }
      }
    }
  }

  /**************************************************************************
  updateCSSURL
  ---------------------------------------------------------------------------
  Task:
    Updates CSS URL
  ---------------------------------------------------------------------------
  Parameters:
    $db               Object        Database handle
    url               string        New URL
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION updateCSSURL(&$db, $url=''){
    $query='UPDATE '.PREFIX.'cssurl SET cssurl = "'.$url.'"';
    $db->query($query);
    // Refresh object
    $this->cssURL($db);
  }





}
?>