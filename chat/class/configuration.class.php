<?PHP
/****************************************************************************
CLASS configuration
-----------------------------------------------------------------------------
Task:
  Manage configuration
****************************************************************************/

CLASS configuration{

  /* Class variables: Diverse configuration variables */

  /**************************************************************************
  Constructor
  ---------------------------------------------------------------------------
  Task:
    Create configuration object.
    Load configuration.
  ---------------------------------------------------------------------------
  Parameters:
          $db         Object          Database handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION configuration(&$db){
    $this->loadConfiguration($db);
  }

  /**************************************************************************
  loadConfiguration
  ---------------------------------------------------------------------------
  Task:
    Load configuration from database
  ---------------------------------------------------------------------------
  Parameters:
          $db         Object          Database handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION loadConfiguration(&$db){
    $query="SELECT * FROM ".PREFIX."configuration";
    $result=$db->query($query);
    WHILE($data=$db->fetchArray($result)){
      IF(!PREG_MATCH("/^\d+$/",$data['name'])){
        /* Using alfanumerical keys only */
        $this->$data['name']=$data['value'];
      }
    }
  }

  /**************************************************************************
  loadFullConfiguration
  ---------------------------------------------------------------------------
  Task:
    Load full configuration with comments from database
  ---------------------------------------------------------------------------
  Parameters: --
    $session          Object          Session handle
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION loadFullConfiguration(&$session){
    $query="SELECT * FROM ".PREFIX."configuration";
    $result=$session->db->query($query);
    RETURN $session->db->fetchAll($result);
  }

  /**************************************************************************
  changeParameter
  ---------------------------------------------------------------------------
  Task:
    Change value of one parameter
  ---------------------------------------------------------------------------
  Parameters: --
    $session            Object          Session handle
    $parameter_name     string          Name of the parameter
    $value              string          New value
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION changeParameter(&$session,$parameter_name="",$value=""){
    IF($parameter_name){
      $query="UPDATE `".PREFIX."configuration` SET `value` = '$value' WHERE `name` = '$parameter_name'";
      $session->db->query($query);
    }
  }

}
?>