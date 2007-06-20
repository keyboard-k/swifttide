<?PHP
/* This is a language selection page */

/* Open languages directory */
$handle=OPENDIR(LANGUAGEPATH);
$lng_array=ARRAY();
/* Read each entry */
WHILE($file=READDIR($handle)){
  IF(IS_FILE(LANGUAGEPATH."/".$file) && SUBSTR($file,-8,8)==".lng.php" && IS_READABLE(LANGUAGEPATH."/".$file)){
    /* Adding each passed language file to array */
    $lng_array[]=$file;
  }
}
CLOSEDIR($handle);
IF(EMPTY($lng_array)){
  /* If no languages were found */
  DIE("There are no available language files!");
}

// Sort language list alphabeticaly
SORT($lng_array);

/* Trying to get language from user's browser HTTP request */
/* Some browsers can accept multiple languages */
$lng_files_realpath=STR_REPLACE("\\", '/', STRTOLOWER(REALPATH(LANGUAGEPATH)));
$accept_array=EXPLODE(",",$_SERVER['HTTP_ACCEPT_LANGUAGE']);
/* Checking each language */
$found=FALSE;
FOR($i=0; $i<COUNT($accept_array)&&!$found; $i++){
  $one_lng_array=EXPLODE(";",$accept_array[$i]);
  $accept_language=STRTOLOWER(TRIM($one_lng_array[0]));
  IF(!EMPTY($accept_language)){
    /* Acept-Language aquired. Trying to find passed language file */
    FOREACH($lng_array AS $lng_name){
      $lng_path=LANGUAGEPATH.'/'.$lng_name;
      $lng_realpath=STR_REPLACE("\\", '/', STRTOLOWER(REALPATH(DIRNAME($lng_path))));
      IF(   $lng_realpath==$lng_files_realpath
         && IS_FILE($lng_path)
         && IS_READABLE($lng_path)
         ){
        $ISO_639_LNG=NULL;
        REQUIRE($lng_path);
        IF(   !EMPTY($ISO_639_LNG)
           && IS_SCALAR($ISO_639_LNG)
           && $accept_language==STRTOLOWER(TRIM($ISO_639_LNG))
           ){
          /* Language passed to request was found */
          $language=$lng_name;
          $found=TRUE;
          BREAK;
        }
      }
    }
  }
}
/* Load language selection page template */
REQUIRE(TEMPLATEPATH."/language.tpl.php");
?>
