<?php
//*
// admin_set_student_year.php
// Admin Section
// Change Current year for selected operations on students
//*

//Check if admin is logged in
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

$yearid=get_param("yearid");
set_session("CurrentYear", $yearid);
$year_name=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$yearid");
set_session("YearName", $year_name);
header("Location: admin_main_menu.php");
exit();
?>
