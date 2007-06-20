<?PHP
/* Create new room page */

// Set defaults
IF(!ISSET($protect)){
  $protect=0;
}

// Check rights
IF($admin_manage_rooms){
  IF(!($current_user->level&2048)){
    UNSET($admin_manage_rooms);
  }
}
IF(   !($session->config->allow_userrooms==2 || $session->config->allow_userrooms==1 && !($current_user->guest))
   && !$admin_manage_rooms){
  DIE();
}

IF($createroom){
  // Validate form
  $roomname=TRIM($roomname);
  IF(STRLEN($roomname)>0){
    // Room name is not empty
    // Looking for roms with the same name
    $room=NEW room();
    $room->listRooms($session);
    $roomlist=$room->roomlist;
    $roomlist_count=COUNT($roomlist);
    $room_found=FALSE;
    $roomname_lo=STRTOLOWER($roomname);
    FOR($i=0;$i<$roomlist_count&&!$room_found;$i++){
      IF($roomname_lo==STRTOLOWER($roomlist[$i][name])){
        // Room with the same name already exists
        $room_found=TRUE;
      }
    }
    IF(!$room_found){
      // Create a room
      IF($protect){
        $room_type=3;
      }ELSE{
        $room_type=1;
      }
      // Image?
      $image_name='';
      IF(EMPTY($bgimg['error']) && !EMPTY($bgimg['size'])){
        // Check file size.
        IF($bgimg['size']<=$session->config->max_roomimage_size){
          // File size is OK
          // Store file
          $tmp_name=MD5($session_id.MICROTIME().RAND(-TIME(), TIME()));
          $tmp_fullname=IMAGEPATH.'/rooms/'.$tmp_name;
          MOVE_UPLOADED_FILE($bgimg['tmp_name'], $tmp_fullname);
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
              $image_name=$tmp_name.$extension;
              BREAK;
            }
          }
          IF(!$type_ok){
            // File is not an image or has non-supported format
            UNLINK($tmp_fullname);
          }
        }
      }
      $room->createRoom($session,$roomname,$room_type-$admin_manage_rooms,MD5($roompassword),$image_name);
      $room->listRooms($session,0,$roomname,$room_type-$admin_manage_rooms);
      $new_room_id=$room->roomlist[0][id];
      // Updating all roomlists
      systemmessage::insertMessage($session,$new_room_id,5);
      // Redirect user into the new room
?>
<HTML><BODY onload="document.entermyroom.submit();">
<?
      IF(!$admin_manage_rooms){
?>
<FORM name="entermyroom" action="main.php" method="post" target="_parent">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="room_password" value="<?=$roompassword?>">
  <INPUT type="hidden" name="room_id" value="<?=$new_room_id?>">
<?
      }ELSE{
?>
<FORM name="entermyroom" action="main.php" method="post">
  <INPUT type="hidden" name="include" value="29">
  <INPUT type="hidden" name="frame" value="main">
<?
      }
?>
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
</FORM>
</BODY></HTML>
<?
      DIE();
    }ELSE{
      // Room with the same name already exists
      $errortext=STR_REPLACE("{ROOM}",$roomname,$lng["roomalreadyexists"]);
    }
  }ELSE{
    // Room name is empty
    $errortext=$lng["roomnameempty"];
  }
}

// Display form
$protect_0_checked=($protect==0)?'checked="checked"':'';
$protect_1_checked=($protect==1)?'checked="checked"':'';

/* Load page template */
REQUIRE(TEMPLATEPATH."/createroom_main.tpl.php");
?>
