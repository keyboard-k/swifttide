<?PHP
// Check rights
IF(!($current_user->level&1)){
  DIE("");
}

// Check database tables
IF($session->testDB()){
  // One or more tables needs to be optimized.
  $need_optimization=TRUE;
  IF($optimize_db){
    // Optimize database tables
    $session->optimizeDB();
    $need_optimization=FALSE;
  }
}ELSE{
  // No database tables optimization needed
  $need_optimization=FALSE;
}

// Users
$user=NEW user();
$user->countUsers($session, $registered_users_count=0, $registered_users_online_count=0, $guests_count=0, $total_users_online_count=0);

// Rooms
$room=NEW room();
// Main rooms without password
$room->listRooms($session,0,"",0);
$main_rooms_no_pass_count=COUNT($room->roomlist);
// Main rooms with password
$room->listRooms($session,0,"",2);
$main_rooms_pass_count=COUNT($room->roomlist);
// User rooms without password
$room->listRooms($session,0,"",1);
$user_rooms_no_pass_count=COUNT($room->roomlist);
// Main rooms with password
$room->listRooms($session,0,"",3);
$user_rooms_pass_count=COUNT($room->roomlist);
$total_rooms_count=$main_rooms_no_pass_count+$main_rooms_pass_count+$user_rooms_no_pass_count+$user_rooms_pass_count;


// Load teplate
REQUIRE(TEMPLATEPATH."/admin_statistics.tpl.php");
?>
