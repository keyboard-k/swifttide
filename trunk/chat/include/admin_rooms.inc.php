<?PHP
// Check rights
IF(!($current_user->level&2048)){
  DIE("HACK?");
}

$admin_manage_rooms=TRUE;

IF($delete){
  // Delete room
  $room=NEW room();
  // Are there any users in room?
  $roomusers=$session->listRoomUsers($room_id);
  $roomusers_count=COUNT($roomusers);
  IF($roomusers_count){
    // There are users in room. Redirect all users to room selection page.
    FOR($i=0;$i<$roomusers_count;$i++){
      // Posting control message
      systemmessage::insertMessage($session,$roomusers[$i][user_id]."|-1",9);
    }
  }
  $room->deleteRoom($session,$room_id);
}

?>
