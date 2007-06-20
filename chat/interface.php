<?PHP
/* This is a PCPIN Chat interface file */

/* Call
interface.php?t=TYPE&list_type=LIST_TYPE

TYPE - see SWITCH() below
LIST_TYPE - Comma-separated list (1) or formated with HTML <li> tags (2)
*/


/* Offset */
DEFINE('OFFSET','./');

/* Load configuration */
REQUIRE('./config/config.inc.php');

/* Execute global actions and load classes */
REQUIRE('./config/prepend.inc.php');

/* Load database connection settings */
INCLUDE('./config/db.inc.php');

/* Creating session handle */
$session_id='';
$session=NEW session($session_id);

/* Deleting old sessions */
$session->cleanUp();

/* Update max users online counters */
$maxusers=NEW maxusers($session);

IF(!ISSET($list_type)){
  $list_type='';
}

IF(!ISSET($t)){
  $t=NULL;
}
SWITCH($t){
  CASE 1  :   /* Show total online users count */
              ECHO $session->countRoomUsers();
              BREAK;
  CASE 2  :   /* Show total rooms count */
              $room=NEW room();
              $room->listRooms($session);
              ECHO COUNT($room->roomlist);
              BREAK;
  CASE 3  :   /* Show online users list */
              $userlist=$session->listRoomUsers();
              $userlist_count=COUNT($userlist);
              $user=NEW user();
              $users=ARRAY();
              FOR($i=0; $i<$userlist_count; $i++){
                $user->readUser($session, $userlist[$i]['user_id']);
                $users[]=$user->login;
              }
              showList($users);
              BREAK;
  CASE 4  :   /* Show colored online users list */
              $userlist=$session->listRoomUsers();
              $userlist_count=COUNT($userlist);
              $user=NEW user();
              $users=ARRAY();
              FOR($i=0; $i<$userlist_count; $i++){
                $user->readUser($session, $userlist[$i]['user_id']);
                $users[]='<font color="#'.$user->color.'">'.$user->login.'</font>';
              }
              showList($users);
              BREAK;
  CASE 5  :   /* Show rooms list */
              $room=NEW room();
              $room->listRooms($session);
              $roomlist=$room->roomlist;
              $roomlist_count=COUNT($roomlist);
              $rooms=ARRAY();
              FOR($i=0; $i<$roomlist_count; $i++){
                $rooms[]=$roomlist[$i]['name'];
              }
              showList($rooms);
              BREAK;
  CASE 6  :   /* Show rooms with online users count list */
              $room=NEW room();
              $room->listRooms($session);
              $roomlist=$room->roomlist;
              $roomlist_count=COUNT($roomlist);
              $rooms=ARRAY();
              FOR($i=0; $i<$roomlist_count; $i++){
                $rooms[]=$roomlist[$i]['name'].' ('.$session->countRoomUsers($roomlist[$i]['id']).')';
              }
              showList($rooms);
              BREAK;
  CASE 7  :   /* Show rooms with online usernames list */
              $room=NEW room();
              $user=NEW user();
              $room->listRooms($session);
              $roomlist=$room->roomlist;
              $roomlist_count=COUNT($roomlist);
              $rooms=ARRAY();
              FOR($i=0; $i<$roomlist_count; $i++){
                $users=ARRAY();
                $roomusers=$session->listRoomUsers($roomlist[$i]['id']);
                $roomusers_count=COUNT($roomusers);
                FOR($ii=0; $ii<$roomusers_count; $ii++){
                  $user->readUser($session, $roomusers[$ii]['user_id']);
                  $users[]=$user->login;
                }
                $rooms[]=$roomlist[$i]['name'].' ('.IMPLODE(', ', $users).')';
              }
              showList($rooms);
              BREAK;
  CASE 8  :   /* Show rooms with colored online user names list */
              $room=NEW room();
              $user=NEW user();
              $room->listRooms($session);
              $roomlist=$room->roomlist;
              $roomlist_count=COUNT($roomlist);
              $rooms=ARRAY();
              FOR($i=0; $i<$roomlist_count; $i++){
                $users=ARRAY();
                $roomusers=$session->listRoomUsers($roomlist[$i]['id']);
                $roomusers_count=COUNT($roomusers);
                FOR($ii=0; $ii<$roomusers_count; $ii++){
                  $user->readUser($session, $roomusers[$ii]['user_id']);
                  $users[]='<font color="#'.$user->color.'">'.$user->login.'</font>';
                }
                $rooms[]=$roomlist[$i]['name'].' ('.IMPLODE(', ', $users).')';
              }
              showList($rooms);
              BREAK;
}
DIE();

FUNCTION showList($list){
  GLOBAL $list_type;
  IF(IS_ARRAY($list) && COUNT($list)){
    SWITCH($list_type){
      DEFAULT     :   // DEFAULT: Comma-separated list
                      ECHO IMPLODE(', ', $list);
                      BREAK;
      CASE 'list' :   // Format list using <li> tags
                      ECHO '<li>'.IMPLODE('</li><li>', $list).'</li>';
                      BREAK;
    }
  }
}
?>