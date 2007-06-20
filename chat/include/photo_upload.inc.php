<?PHP
/* This is a photo upload page. */

/* Read userdata from database */
$user=NEW user();
$user->readUser($session,$profile_user_id);
/* Prepare nickname */
common::doHtmlEntities($user->login);
/* Current user */
$current_user=NEW user();
$current_user->readUser($session,$session->user_id);

IF($session->user_id==$profile_user_id||$current_user->level&8){
  IF($submitted){
    $errortext='';
    IF($photo[error]){
      // No files uploaded
      $errortext=$lng["noimageselected"];
    }ELSE{
      // Check file size.
      IF($photo['size']>$session->config->max_photo_size){
        // Uploaded file is too large
        $errortext=STR_REPLACE('{SIZE}', $session->config->max_photo_size, $lng['filesizetoobig']);
      }ELSE{
        // Store file
        $tmp_name=MD5($session_id.MICROTIME().RAND(-TIME(), TIME()));
        $tmp_fullname=IMAGEPATH.'/userphotos/'.$tmp_name;
        MOVE_UPLOADED_FILE($photo['tmp_name'], $tmp_fullname);
        // Check file mime type
        $type_ok=FALSE;
        $allowed_types=ARRAY('jpg'  =>  '.jpg',
                             'jpeg' =>  '.jpeg',
                             'gif'  =>  '.gif',
                             'ief'  =>  '.ief',
                             'png'  =>  '.png',
                             'tiff' =>  '.tiff',
                             'bmp'  =>  '.bmp',
                             'wbmp' =>  '.wbmp');
        IF(FUNCTION_EXISTS('getimagesize')){
          $imgdata=GETIMAGESIZE($tmp_fullname);
          IF(EMPTY($imgdata) || EMPTY($imgdata['mime'])){
            $imgdata=NULL;
          }
        }ELSE{
          $imgdata=NULL;
        }
        FOREACH($allowed_types AS $chk_type=>$extension){
          IF(!EMPTY($imgdata)){
            $type_ok=   !EMPTY($imgdata[0])
                     && !EMPTY($imgdata[1])
                     && FALSE!==STRPOS(STRTOLOWER($imgdata['mime']), $chk_type);
          }ELSE{
            $type_ok=FALSE!==STRPOS(STRTOLOWER($photo['type']), $chk_type);
          }
          IF($type_ok){
            RENAME($tmp_fullname, $tmp_fullname.$extension);
            $tmp_name.=$extension;
            BREAK;
          }
        }
        IF(!$type_ok){
          // File is not an image or has non-supported format
          $errortext=$lng['notanimage'];
          UNLINK($tmp_fullname);
        }ELSE{
          // Image is OK
          // Delete old image
          if ($user->photo!='' && $user->photo!='nophoto.jpg') {
            UNLINK(IMAGEPATH.'/userphotos/'.$user->photo);
          }
          // Update user's profile
          $user->updateUser($session, $profile_user_id, 'photo = "'.$tmp_name.'"');
          // Show user's profile
          HEADER("Location: main.php?include=$back&profile_user_id=$profile_user_id&session_id=$session_id");
          DIE();
        }
      }
    }
  }
  REQUIRE(TEMPLATEPATH."/photo_upload.tpl.php");
}

?>
