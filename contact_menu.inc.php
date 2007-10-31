<?php
// Include configuration
include_once "configuration.php";
?>

<!--pq - 2007-02-22 - made consistent with the rest -->
<DIV id="menuSystem">
<TABLE id="mainTable">
	<TR>
		<TD>
		<TABLE>
			<tr>
			<?php
			    include_once "ez_sql.php";
				$nyear=$_SESSION['CurrentYear'];
				$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
				?>
    			   <td class ="year"><?php echo _CONTACT_MENU_INC_YEAR?> <?php echo $cyear; ?></td>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
        <tr><td><a href="contacts_menu.php" title="<?php echo _CONTACT_MENU_INC_TITLE?>"><?php echo _CONTACT_MENU_INC_TITLE_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="contact_manage_attendance_1.php" title="<?php echo _CONTACT_MENU_INC_ATT?>"><?php echo _CONTACT_MENU_INC_ATT_TEXT?></a></td></tr>
	<tr><td><a href="contact_manage_discipline_1.php" title="<?php echo _CONTACT_MENU_INC_DIS?>"><?php echo _CONTACT_MENU_INC_DIS_TEXT?></a></td></tr>
	<tr><td><a href="contact_manage_grades_1.php" title="<?php echo _CONTACT_MENU_INC_GRADE?>"><?php echo _CONTACT_MENU_INC_GRADE_TEXT?></a></td></tr>
	<tr><td><a href="contact_change_student_year.php" title="<?php echo _CONTACT_MENU_INC_CHANGE?>"><?php echo _CONTACT_MENU_INC_CHANGE_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="contacts_homework.php" title="<?php echo _CONTACT_MENU_INC_HOMEWORK?>"><?php echo _CONTACT_MENU_INC_HOMEWORK_TEXT?></a></td></tr>
	<tr><td><a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<?php echo _CONTACT_MENU_INC_FORUM?>"><?php echo _CONTACT_MENU_FORUM_INC_FORUM_TEXT?></a></td></tr>
	<!--
	<tr><td><a href="contact_chat.php" title="<?php echo _CONTACT_MENU_INC_CHAT?>"><?php echo _CONTACT_MENU_FORUM_INC_CHAT_TEXT?></a></td></tr>
	-->
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="contact_timetable.php" title="<?php echo _CONTACT_MENU_INC_TIMETABLE?>"><?php echo _CONTACT_MENU_INC_TIMETABLE_TEXT?></a></td></tr>
	<tr><td><a href="contact_exams.php" title="<?php echo _CONTACT_MENU_INC_EXAMS?>"><?php echo _CONTACT_MENU_INC_EXAMS_TEXT?></a></td></tr>
	<tr><td><a href="contact_speak.php" title="<?php echo _CONTACT_MENU_INC_SPEAK?>"><?php echo _CONTACT_MENU_INC_SPEAK_TEXT?></a></td></tr>
	<tr><td><a href="contact_change_password.php" title="<?php echo _CONTACT_MENU_INC_PASS?>"><?php echo _CONTACT_MENU_INC_PASS_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="logout.php" title="<?php echo _CONTACT_MENU_INC_LOGOUT?>"><?php echo _CONTACT_MENU_INC_LOGOUT_TEXT?></a></td></tr></table>

</div>
