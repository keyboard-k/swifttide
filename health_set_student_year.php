<?php
//*
// health_set_student_year.php
// Health Section
// Change Current year for selected operations on students
// V1.0 11-26-05.  New creation
//*

//Check if nurse or admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A"  && 
$_SESSION['UserType'] != "N")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

$yearid=get_param("yearid");
set_session("CurrentYear", $yearid);
$year_name=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$yearid");
set_session("YearName", $year_name);
header("Location: health_menu.php");
exit();
?>
