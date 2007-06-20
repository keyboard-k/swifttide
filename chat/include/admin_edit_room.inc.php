<?PHP
// Check rights
IF(!($current_user->level&2048)){
  DIE("HACK?");
}
IF(EMPTY($edit_room_id)){
  DIE("HACK?");
}

$room=NEW room();
$room->readRoom($session, $edit_room_id);

$errortext=ARRAY();
IF(!ISSET($roomname)){
  $roomname='';
}
IF(!ISSET($bgimg)){
  $bgimg=NULL;
}
IF(!ISSET($new_password)){
  $new_password='';
}
IF(!ISSET($room_type)){
  $room_type=1;
}

IF(EMPTY($save_room)){
  $roomname=$room->name;
}

IF(!EMPTY($delete_image) && !EMPTY($room->bgimg)){
  IF(UNLINK(IMAGEPATH.'/rooms/'.$room->bgimg)){
    $room->updateRoom($session, $edit_room_id, 'bgimg=""');
    // Restart room
    systemMessage::insertMessage($session, $edit_room_id, 10);
    HEADER('Location: main.php?session_id='.$session_id.'&include=29&frame=main');
    DIE();
  }
}ELSEIF(!EMPTY($save_room)){
  $roomname=TRIM($roomname);
  IF($roomname==''){
    $errortext[]=$lng['roomnameempty'];
  }ELSE{
    $room->listRooms($session, 0, $roomname);
    IF(!EMPTY($room->roomlist) && $room->roomlist[0]['id']<>$edit_room_id){
      $errortext[]=STR_REPLACE('{ROOM}', HTMLENTITIES($roomname), $lng['roomalreadyexists']);
    }
  }
  IF(EMPTY($errortext)){
    // New image?
    $image_name=$room->bgimg;
    IF(!EMPTY($bgimg) && EMPTY($bgimg['error']) && !EMPTY($bgimg['size'])){
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
    IF(!EMPTY($protectwithpass)){
      IF($new_password<>''){
        $new_password=MD5($new_password);
      }ELSE{
        $new_password=$room->password;
      }
    }ELSE{
      $new_password='';
    }
    IF($new_password<>''){
      $room_type|=2;
    }
    // Last main room cannot be declared as "userroom"
    IF($room_type<>0 && $room_type<>2){
      $room_type_new=$room_type-1;
      $room->listRooms($session);
      IF(!EMPTY($room->roomlist)){
        FOREACH($room->roomlist AS $room_record){
          IF(($room_record['type']==0 || $room_record['type']==2) && $room_record['id']<>$edit_room_id){
            $room_type_new++;
            BREAK;
          }
        }
      }
      $room_type=$room_type_new;
    }
    $room->updateRoom($session, $edit_room_id, 'bgimg = "'.$image_name.'", name = "'.$roomname.'", password = "'.$new_password.'", type = "'.$room_type.'"');
    HEADER('Location: main.php?session_id='.$session_id.'&include=29&frame=main');
    // Restart room
    systemMessage::insertMessage($session, $edit_room_id, 10);
    DIE();
  }
}

REQUIRE(TEMPLATEPATH.'/admin_edit_room.tpl.php');
?>