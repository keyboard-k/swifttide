<?
//12-26-06 Fix link to Health System so when you click it, you get the 
//health summary on that kid.
?>

<?
// config
include_once "configuration.php";
?>

<DIV id="menuSystem">
<TABLE id="mainTable">
	<TR>
			<?
			include_once "ez_sql.php";
			$nyear=$_SESSION['CurrentYear'];
			$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
			?>
		<TD class ="year">
			<? echo _ADMIN_MENU_INC_YEAR?> <? echo $cyear; ?>
		</td>
	</TR>
	<TR>
		 <td>
		 	<hr>
		 </td>
	</TR>
	<TR>
		<TH>
			<? echo _ADMIN_MENU_INC_DATA?>
		</TH>
	</TR>
	<TR>
		<TD>
			<a href="admin_maint_menu.php" title="<? echo _ADMIN_MENU_INC_MAINT?>"><? echo _ADMIN_MENU_INC_MAINT_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_backup.php" title="<? echo _ADMIN_MENU_INC_BACKUP?>"><? echo _ADMIN_MENU_INC_BACKUP_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_users_1.php" title="<? echo _ADMIN_MENU_INC_USER?>"><? echo _ADMIN_MENU_INC_USER_TEXT?></a>
			<!-- end:  added custom fields and reports -->
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_books.php" title="<? echo _ADMIN_MENU_INC_BOOK?>"><? echo _ADMIN_MENU_INC_BOOK_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<? echo _ADMIN_MENU_INC_FORUM?>"><? echo _ADMIN_MENU_INC_FORUM_TEXT?></a>
		</TD>
	</TR>
	<!--
	<TR>
		<TD>
			<a href="admin_chat.php" title="<? echo _ADMIN_MENU_INC_CHAT?>"><? echo _ADMIN_MENU_INC_CHAT_TEXT?></a>
		</TD>
	</TR>
	<TR>
	//
	-->
		<TD>
			<a href="admin_change_password.php" title="<? echo _ADMIN_MENU_INC_PASS?>"><? echo _ADMIN_MENU_INC_PASS_TEXT?></a>
		</TD>
	</TR>
	<tr>
		<td>
			<hr>
		</td>
	</tr>
	<TR>
		<TH>
			<? echo _ADMIN_MENU_INC_STUDENTS?>
		</TH>
	</TR>
	<TR>

		<TD>
			<a href="admin_student_1.php" title="<? echo _ADMIN_MENU_INC_MAN_STU?>"><? echo _ADMIN_MENU_INC_MAN_STU_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_manage_attendance_1.php?studentid=<?echo $studentid; ?>" title="<? echo _ADMIN_MENU_INC_MAN_ATT?>"><? echo _ADMIN_MENU_INC_MAN_ATT_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="nurse_info_3.php?action=edit&studentid=<?echo $studentid; ?>" 
title="<? echo _ADMIN_MENU_INC_HEALTH?>"><? echo _ADMIN_MENU_INC_HEALTH_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_manage_discipline_1.php?studentid=<?echo $studentid; ?>" title="<? echo _ADMIN_MENU_INC_DIS?>"><? echo _ADMIN_MENU_INC_DIS_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_manage_grades_1.php?studentid=<?echo $studentid; ?>" title="<? echo _ADMIN_MENU_INC_GRA?>"><? echo _ADMIN_MENU_INC_GRA_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_manage_media_1.php?studentid=<?echo $studentid; ?>" title="<? echo _ADMIN_MENU_INC_MEDIA?>"><? echo _ADMIN_MENU_INC_MEDIA_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_change_student_year.php?studentid=<?echo $studentid; ?>" title="<? echo _ADMIN_MENU_INC_CHANGE?>"><? echo _ADMIN_MENU_INC_CHANGE_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<td>
	   		<hr>
		</td>
	</tr>
	<TR>
		<TH>
			<? echo _ADMIN_MENU_INC_TEACHERS_AREA?>
		</TH>
	</TR>
	<TR>
		<TD>
			<a href="admin_teacher_1.php" title="<? echo _ADMIN_MENU_INC_TEACHERS?>"><? echo _ADMIN_MENU_INC_TEACHERS_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_exams_1.php" title="<? echo _ADMIN_MENU_INC_EXAMS?>"><? echo _ADMIN_MENU_INC_EXAMS_TEXT?></a></TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_speak.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_SPEAK?>"><? echo _ADMIN_MAINT_TABLES_MENU_SPEAK_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="admin_mass_email.php" title="<? echo _ADMIN_MENU_INC_MASS?>"><? echo _ADMIN_MENU_INC_MASS_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<HR>
		</TD>
	</TR>
	<TR>
		<TH>
			<? echo _ADMIN_MENU_INC_REPORTS?>
		</TH>
	</TR>
	<TR>
                <TD>
			<a href="admin_reports.php" title="<? echo _ADMIN_MENU_INC_REP?>"><? echo _ADMIN_MENU_INC_REP_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="down_reports.php" title="<? echo _ADMIN_MENU_INC_DOWN?>"><? echo _ADMIN_MENU_INC_DOWN_TEXT?></a>
		</TD>
	</TR>
	<TR>
		<TD>
			<a href="generatereportcardnew.php" title="<? echo _ADMIN_MENU_INC_GEN?>"><? echo _ADMIN_MENU_INC_GEN_TEXT?></a>
		</TD>
	</TR>
	<tr>
		<td>
			<hr>
		</td>
	</tr>
	<TR>
		<TD>
			<a href="logout.php" title="<? echo _ADMIN_MENU_INC_LOGOUT?>"><? echo _ADMIN_MENU_INC_LOGOUT_TEXT?></a>
		</TD>
	</TR>
</TABLE>
</DIV>
