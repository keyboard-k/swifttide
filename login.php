<?
//*
// login.php
// All Sections
// Process login for user
//*

// Include configuration
include_once "configuration.php";

session_start();
//Check if the user comes from the index page
// if(!$_SERVER['HTTP_REFERER'] == "http://www.swifttide.info/SMS/index.php"){
	// header("Location: index.php?action=notauth");
	// exit();
// };
if($_SESSION['tryattempts']>=_MAX_ATTEMPTS){
	header("Location: index.php?action=attempt");
	exit();
};
//Inizialize database functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";

//Gather form posts
$username= get_param("username");
$password= get_param("password");
//Validate fields
if(!strlen($username)){
   set_session("tryattempts", ($_SESSION['tryattempts']+1));
   header("Location: index.php?action=errlog");
   exit();
};
if(!strlen($password)){
   set_session("tryattempts", ($_SESSION['tryattempts']+1));
   header("Location: index.php?action=errlog");
   exit();
};
//Check if uname/pwd match
$sSQL="SELECT * FROM web_users WHERE web_users_username =" . tosql($username, "Text") . " AND web_users_password=" . tosql($password, "Text")." and active = 1";
if($isuser=$db->get_row($sSQL)){
	  $current_year=$db->get_var("SELECT current_year FROM tbl_config WHERE id=1");
	  $user_type=$isuser->web_users_type;
	  $user_id=$isuser->web_users_id;
	  $year_name=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year");
	  switch ($user_type){
		  case "A" :
			  set_session("UserType", "A");
			  set_session("UserId", $user_id);
			  set_session("CurrentYear", $current_year);
			  set_session("YearName", $year_name);
			  $redirurl="admin_main_menu.php";
			  break;
		  case "T" :
			  $tid=$isuser->web_users_relid;
			  $teacher=$db->get_row("SELECT * FROM teachers WHERE teachers_id=$tid");
			  $tlname=$teacher->teachers_lname;
			  $tfname=$teacher->teachers_fname;
			  $tschool=$teacher->teachers_school;
			  set_session("UserType", "T");
			  set_session("UserId", $user_id);
			  set_session("teacherid", $tid);
			  set_session("tfname", $tfname);
			  set_session("tlname", $tlname);
			  set_session("tschool", $tschool);
			  set_session("CurrentYear", $current_year);
			  set_session("YearName", $year_name);
			  $redirurl="teachers_menu.php";
			  break;
		case "N" :
			  $tid=$isuser->web_users_relid;
			  $teacher=$db->get_row("SELECT * FROM teachers WHERE teachers_id=$tid");
			  $tlname=$teacher->teachers_lname;
			  $tfname=$teacher->teachers_fname;
			  $tschool=$teacher->teachers_school;
			  set_session("UserType", "N");
			  set_session("UserId", $user_id);
			  set_session("tfname", $tfname);
			  set_session("tlname", $tlname);
			  set_session("tschool", $tschool);
			  set_session("CurrentYear", $current_year);
			  set_session("YearName", $year_name);
			  $redirurl="health_menu.php";
			  break;
		  case "C" :
			  $cid=$isuser->web_users_relid;
		      $contact=$db->get_row("SELECT studentcontact_lname, studentcontact_fname FROM studentcontact WHERE studentcontact_id=$cid");
			  $clname=$contact->studentcontact_lname;
			  $cfname=$contact->studentcontact_fname;
			  set_session("UserType", "C");
			  set_session("UserId", $cid);
			  set_session("cfname", $cfname);
			  set_session("clname", $clname);
			  set_session("CurrentYear", $current_year);
			  set_session("YearName", $year_name);
			  $redirurl="contacts_menu.php";
			  break;
	  };	
	  header("Location: " . $redirurl);
      exit;
}else{
      set_session("tryattempts", ($_SESSION['tryattempts']+1));
	  header("Location: index.php?action=errlog");
      exit;
};
?>
