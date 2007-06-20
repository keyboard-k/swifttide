<?PHP
/****************************************************************************
CLASS fk_cssvalue
-----------------------------------------------------------------------------
Task:
  Manage CSS values
****************************************************************************/

CLASS fk_cssvalue{


  /**************************************************************************
  changeCSSValue
  ---------------------------------------------------------------------------
  Task:
    Change CSS property value
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
    $class_id       int             CSS class ID
    $property_id    int             CSS property ID
    $value          string          Value
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION changeCSSValue(&$db,$class_id=0,$property_id=0,$value=""){
    IF($class_id&&$property_id){
      $query="UPDATE ".PREFIX."fk_cssvalue SET value = '$value' WHERE class_id = $class_id AND property_id = $property_id LIMIT 1";
      $db->query($query);
    }
  }


}
?>