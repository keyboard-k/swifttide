<?PHP
/* Chat design */

// Check rights
IF(!($current_user->level&2)){
  DIE("Hack?");
}

$cssurl=NEW cssURL($session->db);

IF($submitted){
  // Save changes
  IF(!$css_source && !EMPTY($css_url)){
    // Use external CSS
    // Add 'http://' if needed
    $css_url=TRIM($css_url);
    IF(SUBSTR(STRTOLOWER($css_url),0,7)!='http://' && SUBSTR($css_url, 0, 2)!='./' && SUBSTR($css_url, 0, 1)!='/'){
      $css_url='http://'.$css_url;
    }
    $cssurl->updateCSSURL($session->db, $css_url);
  }ELSE{
    // Use local settings
    $cssurl->updateCSSURL($session->db, '');
    // Extract variables
    $vars=get_defined_vars();
    WHILE(LIST($key,$val)=EACH($vars)){
      IF(SUBSTR($key,0,11)=="properties_"){
        $tmp=EXPLODE("_",STR_REPLACE("properties_","",$key));
        IF(SUBSTR($val,0,1)=="#"){
          $val=SUBSTR($val,1);
        }
        fk_cssvalue::changeCSSValue($session->db,$tmp[0],$tmp[1],$val);
      }
    }
  }
  // Restarting all users
  systemMessage::insertMessage($session,"",10);
}

$css_url=$cssurl->cssurl;

IF(!EMPTY($css_url)){
  $css_source_0_checked='checked="checked"';
  $css_source_1_checked='';
}ELSE{
  $css_source_0_checked='';
  $css_source_1_checked='checked="checked"';
}

// Load design
$cssclass=NEW cssclass();
$cssclass->loadStructure($session->db);
$css_structure=$cssclass->cssList;

REQUIRE(TEMPLATEPATH."/admin_design.tpl.php");
?>
