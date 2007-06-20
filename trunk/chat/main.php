<?PHP
/* This is a PCPIN Chat main file */

// Check "/install" directory
IF(FILE_EXISTS('./install')){
  DIE('<html><body><center><h3>Chat locked</h3><br />Delete directory <b>install</b> in order to continue.</center></body></html>');
}

/* Offset */
DEFINE("OFFSET","./");

/* Load configuration */
REQUIRE("./config/config.inc.php");

/* Execute global actions and load classes */
REQUIRE("./config/prepend.inc.php");

/* Load database connection settings */
INCLUDE("./config/db.inc.php");

/* Creating session handle */
IF(EMPTY($session_id)){
  $session_id='';
}
$session=NEW session($session_id);

/* Deleting old sessions */
$session->cleanUp();

/* Update max users online counters */
$maxusers=NEW maxusers($session);

IF(!$session->user_id){
  /* Session is timed out or does not exists. Loading login page. */
  $include=2;
}ELSEIF($session->kicked){
  /* User was kicked */
  // Delete session
  $session->logout($session_id);
  // Redirect user
?>
<HTML>
<HEAD>
<SCRIPT>
  parent.window.location.href="<?=$session->config->kick_url?>";
</SCRIPT>
</HEAD>
</HTML>
<?
  HEADER("Location: ".$session->config->kick_url);
  DIE();
}ELSE{
  /* Session is OK. Loading user. */
  $current_user=NEW user();
  $current_user->readUser($session,$session->user_id);
}

IF(!$include){
  $include=2;
}

/* Check language */
IF(EMPTY($language)){
  IF(!EMPTY($session->language)){
    $language=$session->language;
  }ELSE{
    $language='';
  }
}
/* Looking for language file */
$lng_files_realpath=STR_REPLACE("\\", '/', STRTOLOWER(REALPATH(LANGUAGEPATH)));
$lng_path=LANGUAGEPATH.'/'.$language.'.lng.php';
$lng_realpath=STR_REPLACE("\\", '/', STRTOLOWER(REALPATH(DIRNAME($lng_path))));
IF(   $lng_realpath==$lng_files_realpath
   && FILE_EXISTS($lng_path)
   && IS_FILE($lng_path)
   && IS_READABLE($lng_path)){
  // Language file found. Loading it
  $ISO_639_LNG=NULL;
  INCLUDE($lng_path);
}
IF(EMPTY($ISO_639_LNG)){
  IF($session->config->standard_language){
    $lng_path=LANGUAGEPATH.'/'.$session->config->standard_language.'.lng.php';
    $lng_realpath=STR_REPLACE("\\", '/', STRTOLOWER(REALPATH(DIRNAME($lng_path))));
    IF(   $lng_realpath==$lng_files_realpath
       && FILE_EXISTS($lng_path)
       && IS_FILE($lng_path)
       && IS_READABLE($lng_path)){
      INCLUDE($lng_path);
    }
  }
}
IF(EMPTY($ISO_639_LNG)){
  /* No language selected or language file not found or language file is invalid.
     Redirecting to language selection page. */
  $include=1;
}

$cssurl=NEW cssURL($session->db);
IF(!EMPTY($cssurl->cssurl)){
  // Use external CSS
  $css='<link rel="stylesheet" type="text/css" href="'.$cssurl->cssurl.'">';
  $css_short='<link rel="stylesheet" type="text/css" href="'.$cssurl->cssurl.'">';
}ELSE{
  // Read CSS from database
  $cssclass=NEW cssClass();
  $css=$cssclass->generateCSS($session->db);
  // Short CSS for refreshers (Body background color only)
  $css_short=$cssclass->generateCSSBodyBGColor($session->db);
}

/* Loading appropriate page */
SWITCH($include){
  CASE 1  :  /* Language selection page */
             REQUIRE(INCLUDEPATH."/language.inc.php");
             BREAK;
  CASE 2  :  /* Login page */
             REQUIRE(INCLUDEPATH."/login.inc.php");
             BREAK;
  CASE 3  :  /* Room selection */
             // Save screen height
             $session->updateSession('screen_height = '.$screen_height);
             REQUIRE(INCLUDEPATH."/selectroom.inc.php");
             BREAK;
  CASE 4  :  /* Main chat page */
             SWITCH($frame){
               CASE "i" :    /* Input frame */
                             REQUIRE(INCLUDEPATH."/input.inc.php");
                             BREAK;
               CASE "c" :    /* Control frame */
                             REQUIRE(INCLUDEPATH."/control.inc.php");
                             BREAK;
               DEFAULT  :    /* Frameset */
                             REQUIRE(INCLUDEPATH."/frames_main.inc.php");
                             BREAK;
             }
             BREAK;
  CASE 5  :  /* Show/edit user profile */
             REQUIRE(INCLUDEPATH."/userprofile.inc.php");
             BREAK;
  CASE 6  :  /* Color select box */
             REQUIRE(INCLUDEPATH."/colorbox.inc.php");
             BREAK;
  CASE 7  :  /* Private message window */
             REQUIRE(INCLUDEPATH."/frames_pm.inc.php");
             BREAK;
  CASE 8  :  /* 'Create new room' form */
             REQUIRE(INCLUDEPATH."/createroom.inc.php");
             BREAK;
  CASE 9  :  /* Exit chat */
             REQUIRE(INCLUDEPATH."/logout.inc.php");
             BREAK;
  CASE 10 :  /* Password promt for password-protected rooms */
             REQUIRE(INCLUDEPATH."/askroompassword.inc.php");
             BREAK;
  CASE 11 :  /* Memberlist */
             REQUIRE(INCLUDEPATH."/memberlist.inc.php");
             BREAK;
  CASE 12 :  /* Invite user */
             REQUIRE(INCLUDEPATH."/invite.inc.php");
             BREAK;
  CASE 13 :  /* Admin frameset */
             REQUIRE(INCLUDEPATH."/admin_frames.inc.php");
             BREAK;
  CASE 14 :  /* Admin: left frame */
             REQUIRE(INCLUDEPATH."/admin_left.inc.php");
             BREAK;
  CASE 15 :  /* Admin: chat statistics */
             REQUIRE(INCLUDEPATH."/admin_statistics.inc.php");
             BREAK;
  CASE 16 :  /* Admin: chat design */
             REQUIRE(INCLUDEPATH."/admin_design.inc.php");
             BREAK;
  CASE 17 :  /* Admin: chat settings */
             REQUIRE(INCLUDEPATH."/admin_settings.inc.php");
             BREAK;
  CASE 18 :  /* Admin: edit users */
             REQUIRE(INCLUDEPATH."/admin_editusers.inc.php");
             BREAK;
  CASE 19 :  /* Admin: kick users */
             REQUIRE(INCLUDEPATH."/admin_kickusers.inc.php");
             BREAK;
  CASE 20 :  /* Admin: ban users */
             REQUIRE(INCLUDEPATH."/admin_banusers.inc.php");
             BREAK;
  CASE 22 :  /* Photo upload */
             REQUIRE(INCLUDEPATH."/photo_upload.inc.php");
             BREAK;
  CASE 23 :  /* Admin: Post global message */
             REQUIRE(INCLUDEPATH."/admin_globalmsg.inc.php");
             BREAK;
  CASE 24 :  /* Global message Pop-Up */
             REQUIRE(INCLUDEPATH."/globalmsg_popup.inc.php");
             BREAK;
  CASE 25 :  /* Admin: Advertisement */
             REQUIRE(INCLUDEPATH."/admin_advertisement.inc.php");
             BREAK;
  CASE 26 :  /* Admin: Smilies */
             REQUIRE(INCLUDEPATH."/admin_smilies.inc.php");
             BREAK;
  CASE 27 :  /* Smilies */
             REQUIRE(INCLUDEPATH."/smilies.inc.php");
             BREAK;
  CASE 28 :  /* Admin: Bad words */
             REQUIRE(INCLUDEPATH."/admin_badwords.inc.php");
             BREAK;
  CASE 29 :  /* Admin: Rooms */
             REQUIRE(INCLUDEPATH."/admin_rooms.inc.php");
             REQUIRE(INCLUDEPATH."/selectroom.inc.php");
             BREAK;
  CASE 30 :  /* Dummy form */
             REQUIRE(INCLUDEPATH."/dummyform.inc.php");
             BREAK;
  CASE 31 :  /* Admin: Export design */
             REQUIRE(INCLUDEPATH."/admin_export_design.inc.php");
             BREAK;
  CASE 32 :  /* Admin: Edit room */
             REQUIRE(INCLUDEPATH."/admin_edit_room.inc.php");
             BREAK;
  CASE 33 :  /* Messages frame template */
             REQUIRE(INCLUDEPATH."/mainframe.inc.php");
             BREAK;
  CASE 40 :  /* Admin: clear screen */
             REQUIRE(INCLUDEPATH."/admin_clearscreen.inc.php");
             BREAK;
  DEFAULT :  /* Hack? */
             DIE("Hack?");
             BREAK;
}
DIE();
?>
