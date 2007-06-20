<?PHP
// Check rights
IF(!($current_user->level&256)){
  DIE("HACK?");
}

// Declare class
$smilie=NEW smilie();

IF($add||$edit&&$smilie_id&&$submitted){
  // Add new smilie
  IF($submitted){
    // Save smilie
    // Validate form
    $error=ARRAY();
    // Check text equivalent
    $text=TRIM($text);
    IF(EMPTY($text)){
      $error[]=$lng["textequivalentempty"];
    }ELSEIF(STRPOS($text,"'")||STRPOS($text,"\\")||STRPOS($text,"\"")||STRPOS($text,"<")||STRPOS($text,">")){
      $error[]=$lng["invalidcharsintextequiv"];
    }ELSE{
      IF(!$edit){
        $smilie=NEW smilie();
        $smilie->readSmilie($session,0,$text);
        IF($smilie->id){
          // Smilie with this text equivalent already exists
          $error[]=$lng["equivalentexists"];
        }
      }
    }
    // Check file
    IF(!$edit){
      IF($smiliefile['error']){
        $error[]=$lng["uploaderror"];
      }ELSEIF(!IS_UPLOADED_FILE($smiliefile['tmp_name'])){
        $error[]=$lng["uploaderror"];
      }ELSE{
        // Store file
        $tmp_name=MD5($session_id.MICROTIME().RAND(-TIME(), TIME())).'.gif';
        $tmp_fullname=IMAGEPATH.'/smilies/'.$tmp_name;
        MOVE_UPLOADED_FILE($smiliefile['tmp_name'], $tmp_fullname);
        // Check file mime type
        $type_ok=FALSE;
        IF(FUNCTION_EXISTS('getimagesize')){
          $imgdata=GETIMAGESIZE($tmp_fullname);
          IF(EMPTY($imgdata) || EMPTY($imgdata['mime'])){
            $imgdata=NULL;
          }
        }ELSE{
          $imgdata=NULL;
        }
        IF(!EMPTY($imgdata)){
          $type_ok=   !EMPTY($imgdata[0])
                   && !EMPTY($imgdata[1])
                   && FALSE!==STRPOS(STRTOLOWER($imgdata['mime']), 'gif');
        }ELSE{
          $type_ok=FALSE!==STRPOS(STRTOLOWER($smiliefile['type']), 'gif');
        }
        IF(!$type_ok){
          $error[]=$lng["onlygifsallowed"];
          // Delete invalid file
          UNLINK($tmp_fullname);
        }
      }
    }
    IF(EMPTY($error)){
      // No errors
      IF($smilie_id){
        // Update smile
        $smilie->updateSmilie($session,$smilie_id,"text = '$text'");
        UNSET($smilie_id);
      }ELSE{
        // Saving new smilie
        $smilie->text=$text;
        $smilie->insertSmilie($session);
        $edit=1;
        // Saving image file
        $smilie->readSmilie($session, 0, $text);
        $smilie->updateSmilie($session, $smilie->id, 'image = "'.$tmp_name.'"');
      }
    }ELSE{
      IF(!$edit){
        UNSET($submitted);
      }
    }
  }
  IF(!$submitted){
    // Show form
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_smilie.tpl.php");
  }
}

IF($edit){
  IF($delete&&$smilie_id){
    // Delete smilie
    $smilie->deleteSmilie($session,$smilie_id);
    UNSET($smilie_id);
  }
  // Edit smilie
  IF(!$smilie_id){
    // List smilies
    $smilies=$smilie->listSmilies($session);
    $smilies_count=COUNT($smilies);
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_smilieslist.tpl.php");
  }ELSE{
    // Load smilie
    $smilie->readSmilie($session,$smilie_id);
    $text=$smilie->text;
    $image=$smilie->image;
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_smilie.tpl.php");
  }
}


?>