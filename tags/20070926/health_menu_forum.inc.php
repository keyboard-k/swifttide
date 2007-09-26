<?php
// config
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
			    //include_once "ez_sql.php";
				//$nyear=$_SESSION['CurrentYear'];
				//$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
				?>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
        <tr><td><a href="health_menu.php" title="<?php echo _HEALTH_MENU_INC_TITLE?>"><?php echo _HEALTH_MENU_INC_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
        <tr><td><a href="nurse_info_1.php" title="<?php echo _HEALTH_MENU_INC_SUMMARY?>"><?php echo _HEALTH_MENU_INC_SUMMARY_TEXT?></a></td></tr>
	<tr><td><a href="health_manage_1.php?studentid=<?echo $studentid; 
?>" title="<?php echo _HEALTH_MENU_INC_VISITS?>"><?php echo _HEALTH_MENU_INC_VISITS_TEXT?></a></td></tr>
	<tr><td><a href="health_med_student_1.php?studentid=<?echo $studentid; ?>" title="<?php echo _HEALTH_MENU_INC_MED?>"><?php echo _HEALTH_MENU_INC_MED_TEXT?></a></td></tr>
	<tr><td><a href="health_immunz_student_1.php?studentid=<?echo 
$studentid; ?>" title="<?php echo _HEALTH_MENU_INC_IMM?>"><?php echo _HEALTH_MENU_INC_IMM_TEXT?></a></td></tr>
	<tr><td><a href="health_allergy_1.php?studentid=<?echo $studentid; 
?>" title="<?php echo _HEALTH_MENU_INC_ALL?>"><?php echo _HEALTH_MENU_INC_ALL_TEXT?></a></td></tr>
	<tr><td><a href="health_change_student_year.php" title="<?php echo _HEALTH_MENU_INC_CHANGE?>"><?php echo _HEALTH_MENU_INC_CHANGE_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<?php echo _HEALTH_MENU_INC_FORUM?>"><?php echo _HEALTH_MENU_INC_FORUM_TEXT?></a></td></tr>
	<tr><td><a href="health_codes.php" title="<?php echo _HEALTH_MENU_INC_EDIT_HEALTH?>"><?php echo _HEALTH_MENU_INC_EDIT_HEALTH_TEXT?></a></td></tr>
	<tr><td><a href="health_immunz.php" title="<?php echo _HEALTH_MENU_INC_EDIT_IMM?>"><?php echo _HEALTH_MENU_INC_EDIT_IMM_TEXT?></a></td></tr>
	<tr><td><a href="health_medicine.php" title="<?php echo _HEALTH_MENU_INC_EDIT_MED?>"><?php echo _HEALTH_MENU_INC_EDIT_MED_TEXT?></a></td></tr>
	<tr><td><a href="health_allergies.php" title="<?php echo _HEALTH_MENU_INC_EDIT_ALL?>"><?php echo _HEALTH_MENU_INC_EDIT_ALL_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="health_change_password.php" title="<?php echo _HEALTH_MENU_INC_PASSWORD?>"><?php echo _HEALTH_MENU_INC_PASSWORD_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="logout.php" title="<?php echo _HEALTH_MENU_INC_LOGOUT?>"><?php echo _HEALTH_MENU_INC_LOGOUT_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="admin_student_1.php" title="<?php echo _HEALTH_MENU_INC_ADMIN_AREA?>"><?php echo _HEALTH_MENU_INC_ADMIN_AREA_TEXT?></a></td></tr></table></table>
</div>
