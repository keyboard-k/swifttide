<?php
//v1.5 doug.  write to active field, not webusers_active
//v1.51 01-15-06.  if no entry in webusers, send them to admin_contacts, and can't reset passsword or deactivate, so display that message.
// pq - 2007-02-22 - I didnt understand alot of what was going on here and commented out a bunch.  It wouldnt even compile.
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth"); 
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

$teacherid=get_param("teacherid");
$contactid =get_param("contactid");


//pq--What does this do???
//$cid =get_param("contactid");

//$sSQL="SELECT count(*) FROM web_users WHERE web_users_relid=$teacherid AND web_users_type='T'";
//$tot=$db->get_var($sSQL);
//$tSQL="SELECT COUNT(*) FROM web_users WHERE web_users_relid=$cid and web_users_type='C'";
//$ctot=$db->get_var($tSQL);


//if (($teacherid) AND ($tot<1)) { 
//	header("Location: admin_teachers_2.php");
//	break;
//}

//if (($cid) AND ($tot<1)) {
//	header("Location: admin_edit_student_1.php?action=edit&studentid="<? 
//	echo $sSQL="SELECT * FROM web_users WHERE web_users_relid=$teacherid";
//$teach=$db->get_row($sSQL);

switch ($act) {
	case 1:
		if ($teacherid)
			mysql_query("update web_users SET active = 1 where web_users_type='T' and web_users_relid = '$teacherid'");
		if ($contactid)
			mysql_query("update web_users set active = 1 where web_users_type='C' and web_users_flname LIKE '$contactid'");
		break;
	case 0:
		if ($teacherid)
			mysql_query("update web_users set active = 0 where web_users_type='T' and web_users_relid = '$teacherid'");
		if ($contactid)
			mysql_query("update web_users set active = 0 where web_users_type='C' and web_users_flname LIKE '$contactid'");
		break;
}

header("Location: admin_users_1.php");
?>
