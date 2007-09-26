<?php
//*
// admin_schedule_students_5.php
// Administrator Area
// Write selected students from admin_schedule_students_2.php to the
// schedule_students table
// Version 1.0, April 20, 2006
//*

// Check to see if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A"){
    header ("Location: index.php?action=notauth");
        exit;
};

include_once "ez_sql.php";
// config
include_once "configuration.php";

$clear = $_POST['clear'];
reset($clear);
echo('Schedule ID -> ' . substr($_POST['id'],0,strlen($_POST['id'])-4) . '<br><br>');
echo "id0 is $_POST[0], id1 $_POST[1], id2 $_POST[2], id3 $_POST[3], id4 
$_POST[4]";
//Cycle thru the array

foreach($clear as $clr)
{
	//if clr==1 then the checkbox has been checked
	if($clr==1)
	{
		$sSQL= "SELECT 
		$query = "INSERT INTO 
`student_schedule`(`student_schedule_id`,`student_schedule_studentid`,`student_schedule_year`,`student_schedule_schoolid`,`student_schedule_schedid`) VALUES(0," . key($clear) . ",0,0," . substr($_POST['id'],0,strlen($_POST['id'])-4) . ");";
		echo($query."<br><br>");
		$db->query($query);
		//echo('Student ID -> ' . key($clear) . '... to be inserted<br>');
	}
	next($clear);
}

?>
