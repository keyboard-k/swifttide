<?PHP
/****************************************************************************
CLASS cssClass
-----------------------------------------------------------------------------
Task:
  Manage CSS classes
****************************************************************************/

CLASS cssClass{

  // CSS settings structure
  VAR $cssList=null;

  /**************************************************************************
  generateCSS
  ---------------------------------------------------------------------------
  Task:
    Generate CSS
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
  ---------------------------------------------------------------------------
  Return:
    CSS
  **************************************************************************/
  FUNCTION generateCSS(&$db){
    $this->loadStructure($db);
    $css_text="<STYLE>";
    WHILE(LIST($class_id,$class_properties)=EACH($this->cssList)){
      $css_text.=$class_properties['name']."{";
      WHILE(LIST($property_id,$property_data)=EACH($class_properties['properties'])){
        IF($property_data['value']){
          $css_text.=$property_data['name'].":".$property_data['value'].";";
        }
      }
      $css_text.="}";
    }
    $css_text.="</STYLE>";
    RETURN $css_text;
  }

  /**************************************************************************
  generateCSSBodyBGColor
  ---------------------------------------------------------------------------
  Task:
    Generate short CSS with body background-color property only.
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
  ---------------------------------------------------------------------------
  Return:
    CSS
  **************************************************************************/
  FUNCTION generateCSSBodyBGColor(&$db){
    $this->loadStructure($db);
    $found=FALSE;
    WHILE(!$found&&LIST($class_id,$class_properties)=EACH($this->cssList)){
      IF(STRTOLOWER($class_properties['name'])=="body"){
        WHILE(!$found&&LIST($property_id,$property_data)=EACH($class_properties['properties'])){
          IF(STRTOLOWER($property_data['name'])=="background-color"){
            $found=TRUE;
            $css_text="<STYLE>body{background-color:".$property_data['value']."}</STYLE>";
          }
        }
      }
    }
    RETURN $css_text;
  }

  /**************************************************************************
  loadStructure
  ---------------------------------------------------------------------------
  Task:
    Load CSS structure with values from database
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
  ---------------------------------------------------------------------------
  Return:
    Array with CSS classes
  **************************************************************************/
  FUNCTION loadStructure(&$db){
    UNSET($this->cssList);
    // List CSS classes
    $query="SELECT * FROM ".PREFIX."cssclass";
    $result=$db->query($query);
    WHILE($data=$db->fetchArray($result)){
      $classes[$data['id']]=ARRAY("name"=>$data['name'],"description"=>$data['description']);
    }
    // List CSS properties
    $query="SELECT * FROM ".PREFIX."cssproperty";
    $result=$db->query($query);
    WHILE($data=$db->fetchArray($result)){
      $properties[$data['id']]=ARRAY("name"=>$data['name'],"choice"=>$data['choice'],"description"=>$data['description']);
    }
    // List CSS values
    $query="SELECT * FROM ".PREFIX."fk_cssvalue ORDER BY class_id, property_id";
    $result=$db->query($query);
    WHILE($data=$db->fetchArray($result)){
      $this->cssList[$data['class_id']]['name']=$classes[$data['class_id']]['name'];
      $this->cssList[$data['class_id']]['description']=$classes[$data['class_id']]['description'];
      $this->cssList[$data['class_id']]['properties'][$data['property_id']]=ARRAY("name"=>$properties[$data['property_id']]['name'],
                                                                            "choice"=>$properties[$data['property_id']]['choice'],
                                                                            "description"=>$properties[$data['property_id']]['description'],
                                                                            "value"=>$data['value']
                                                                            );
    }
  }

  /**************************************************************************
  generateFormattedCSS
  ---------------------------------------------------------------------------
  Task:
    Generate formatted CSS
  ---------------------------------------------------------------------------
  Parameters:
    $db             Object          Database handle
  ---------------------------------------------------------------------------
  Return:
    CSS
  **************************************************************************/
  FUNCTION generateFormattedCSS(&$db){
    $css_formatted='';
    $this->loadStructure($db);
    $css_classes=$this->cssList;
    RESET($css_classes);
    WHILE(LIST($key, $class)=EACH($css_classes)){
      $css_formatted.="/********************************\r\n* ".STRTOUPPER($class['description'])."\r\n*********************************/\r\n";
      $css_formatted.=$class['name']."{\r\n";
      WHILE(LIST($key, $property)=EACH($class['properties'])){
        IF(STRLEN($property['value'])){
          IF($property['choice']=='~color~'){
            $property['value']='#'.$property['value'];
          }
          $css_formatted.="  ".$property['name'].":".$property['value'].";\r\n";
        }
      }
      $css_formatted.="}";
    }
    RETURN $css_formatted;
  }



}
?>