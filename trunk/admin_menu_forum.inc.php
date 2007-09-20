<?php
// config
include_once "configuration.php";
?>

<DIV id="menuSystem">
<TABLE id="mainTable">
	<TR>
		<TD>
		<TABLE>
			<tr>
			<?php
			   // include_once "ez_sql.php";
			   //pq - 2007-02-22 - Remove "Year" if we cant get the year.
			   // why? Helmut
				$nyear=$_SESSION['CurrentYear'];
				//$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
				?>
			   <td class ="year"><?php echo _ADMIN_MENU_FORUM_INC_YEAR?> <?php echo $cyear; ?></td>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
			<TR>
			<TR>
			   <TD><a href="admin_maint_menu.php" title="<?php echo _ADMIN_MENU_FORUM_INC_MAINT?>"><?php echo _ADMIN_MENU_FORUM_INC_MAINT_TEXT?></a></TD>
			</TR>
			<tr><td><a href="admin_users_1.php" title="<?php echo _ADMIN_MENU_FORUM_INC_USER?>"><?php echo _ADMIN_MENU_FORUM_INC_USER_TEXT?></a></td></tr>
			<TR>
			</TR>
			<!-- end:  added custom fields and reports -->

		</TABLE>
		</TD>
	</TR>
	<tr>
	   <td><hr></td>
	</tr>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><?php echo _ADMIN_MENU_FORUM_INC_STUDENTS?></TH>
			</TR>
			<TR>
				<TD><a href="admin_student_1.php" title="<?php echo _ADMIN_MENU_FORUM_INC_MAN_STU?>"><?php echo _ADMIN_MENU_FORUM_INC_MAN_STU_TEXT?></a></A></TD>
			</TR>
			<TR>
				<TD><a href="admin_manage_attendance_1.php?studentid=<?echo $studentid; ?>" title="<?php echo _ADMIN_MENU_FORUM_INC_MAN_ATT?>"><?php echo _ADMIN_MENU_FORUM_INC_MAN_ATT_TEXT?></a></TD>
			</TR>
			<TR>	
				<TD><a href="health_manage_1.php" title="<?php echo _ADMIN_MENU_FORUM_INC_HEALTH?>"><?php echo _ADMIN_MENU_FORUM_INC_HEALTH_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_manage_discipline_1.php?studentid=<?echo $studentid; ?>" title="<?php echo _ADMIN_MENU_FORUM_INC_DIS?>"><?php echo _ADMIN_MENU_FORUM_INC_DIS_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_manage_grades_1.php?studentid=<?echo $studentid; ?>" title="<?php echo _ADMIN_MENU_FORUM_INC_GRA?>"><?php echo _ADMIN_MENU_FORUM_INC_GRA_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_change_student_year.php?studentid=<?echo $studentid; ?>" title="<?php echo _ADMIN_MENU_FORUM_INC_CHANGE?>"><?php echo _ADMIN_MENU_FORUM_INC_CHANGE_TEXT?></a></TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<tr>
	   <td><hr></td>
	</tr>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><a href="admin_teacher_1.php" title="<?php echo _ADMIN_MENU_FORUM_INC_TEACHERS?>"><?php echo _ADMIN_MENU_FORUM_INC_TEACHERS_TEXT?></a></TH>
			</TR>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><a href="admin_mass_email.php" title="<?php echo _ADMIN_MENU_FORUM_INC_MASS?>"><?php echo _ADMIN_MENU_FORUM_INC_MASS_TEXT?></a></TH>
			</TR>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<?php echo _ADMIN_MENU_FORUM_INC_FORUM?>"><?php echo _ADMIN_MENU_FORUM_INC_FORUM_TEXT?></a></TH>
			</TR>
		</TABLE>
		</TD>
	</TR>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><a href="admin_change_password.php" title="<?php echo _ADMIN_MENU_FORUM_INC_PASS?>"><?php echo _ADMIN_MENU_FORUM_INC_PASS_TEXT?></a></TH>
			</TR>
		</TABLE>
		</TD>
	</TR>
	<tr>
	  <td><hr></td>
	</tr>
	<TR> <TD> <TABLE> <TR>
                   		<TH><a href="admin_reports.php" title="<?php echo _ADMIN_MENU_FORUM_INC_REP?>"><?php echo _ADMIN_MENU_FORUM_INC_REP_TEXT?></a></TH></TR>
				<TR><TH><a href="down_reports.php" title="<?php echo _ADMIN_MENU_FORUM_INC_DOWN?>"><?php echo _ADMIN_MENU_FORUM_INC_DOWN_TEXT?></a></TH></TR>
				<TR><TH><a 
href="generatereportcardnew.php" title="<?php echo _ADMIN_MENU_FORUM_INC_GEN?>"><?php echo _ADMIN_MENU_FORUM_INC_GEN_TEXT?></a></TH></TR>
	</TR> </TABLE></TD></TR>
	<tr>
	   <td><hr></td>
	</tr>
	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><a href="logout.php" title="<?php echo _ADMIN_MENU_FORUM_INC_LOGOUT?>"><?php echo _ADMIN_MENU_FORUM_INC_LOGOUT_TEXT?></a></TH>
			</TR>
		</TABLE>
		</TD>
	</TR>
</TABLE>
</DIV>
