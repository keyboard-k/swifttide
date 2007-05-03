<?php

include_once "ez_sql.php";
// config
include_once "configuration.php";

$clear = $_POST['clear'];
reset($clear);
echo('Student ID -> ' . $_POST['id'] . '<br><br>');
foreach($clear as $clr)
{
	if($clr==1)
	{
		$query = "DELETE FROM student_schedule WHERE student_schedule_studentid=" . $_POST['id'] . " AND student_schedule_schedid=". key($clear) .";";
		echo($query."<br><br>");
		$db->query($query);
		//echo('Student ID -> ' . key($clear) . '... to be inserted<br>');
	}
	next($clear);
}

?>
