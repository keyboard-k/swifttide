<div id="Menu">
<?
if($menustudent<>1){
?>
	<a href="admin_config.php?action=edit" title="General Configuration">Configuration</a><br /> 
	<a href="admin_school_names.php" title="Manage School Names">School Names</a><br />
	<a href="admin_ethnicity.php" title="Manage Ethnicity">Ethnicities</a><br />
	<a href="admin_sgrades.php" title="Manage Grades">Grades</a><br />
	<a href="admin_attendance_codes.php" title="Manage Attendance Codes">Attendance Codes</a><br />
	<a href="admin_infraction_codes.php" title="Manage Infraction Codes">Infraction Codes</a><br />
	<a href="admin_generations.php" title="Manage Generations">Generations</a><br />
	<a href="admin_titles.php" title="Manage Titles">Titles</a><br />
	<a href="admin_custom_fields.php" title="Custom Fields">Custom Fields</a><br />
	<a href="admin_reports.php title="Reports">Reports</a><br />
	<a href="admin_student_1.php" title="Manage Students">Students</a><br />
	<a href="admin_teacher_1.php" title="Manage Teachers">Teachers</a><br />
	<a href="logout.php" title="Logout from System">Logout</a><br />
	<a href="admin_change_password.php" title="Change Password">Change Password</a><br />
<?
}else{
?>
	<a href="admin_main_menu.php" title="Back to Main Menu">Main Menu</a><br />
	&nbsp;<a href="admin_student_1.php" title="Manage Students">Manage Students</a><br />
	&nbsp;<a href="admin_manage_attendance_1.php?studentid=<?echo $studentid; ?>" title="Manage Attendance">Attendance</a><br />
	&nbsp;<a href="admin_manage_discipline_1.php?studentid=<?echo $studentid; ?>" title="Manage Discipline">Discipline</a><br />
	&nbsp;<a href="admin_manage_grades_1.php?studentid=<?echo $studentid; ?>" title="Manage Grades Reporting">Grades Reporting</a><br />
<?
};
?>
</div>
