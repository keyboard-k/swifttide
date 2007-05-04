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
			<?
			    include_once "ez_sql.php";
				$nyear=$_SESSION['CurrentYear'];
				$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
				?>
			   <td class ="year"><? echo _HEALTH_MENU_INC_YEAR . " $cyear"; ?></td>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
        <tr><td><a href="health_menu.php" title="<? echo _HEALTH_MENU_INC_TITLE?>"><? echo _HEALTH_MENU_INC_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
        <tr><td><a href="nurse_info_1.php" title="<? echo _HEALTH_MENU_INC_SUMMARY?>"><? echo _HEALTH_MENU_INC_SUMMARY_TEXT?></a></td></tr>
	<tr><td><a href="health_manage_1.php?studentid=<?echo $studentid; 
?>" title="<? echo _HEALTH_MENU_INC_VISITS?>"><? echo _HEALTH_MENU_INC_VISITS_TEXT?></a></td></tr>
	<tr><td><a href="health_med_student_1.php?studentid=<?echo $studentid; ?>" title="<? echo _HEALTH_MENU_INC_MED?>"><? echo _HEALTH_MENU_INC_MED_TEXT?></a></td></tr>
	<tr><td><a href="health_immunz_student_1.php?studentid=<?echo 
$studentid; ?>" title="<? echo _HEALTH_MENU_INC_IMM?>"><? echo _HEALTH_MENU_INC_IMM_TEXT?></a></td></tr>
	<tr><td><a href="health_allergy_1.php?studentid=<?echo $studentid; 
?>" title="<? echo _HEALTH_MENU_INC_ALL?>"><? echo _HEALTH_MENU_INC_ALL_TEXT?></a></td></tr>
	<tr><td><a href="health_change_student_year.php" title="<? echo _HEALTH_MENU_INC_CHANGE?>"><? echo _HEALTH_MENU_INC_CHANGE_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<? echo _HEALTH_MENU_INC_FORUM?>"><? echo _HEALTH_MENU_INC_FORUM_TEXT?></a></td></tr>
	<tr><td><a href="health_codes.php" title="<? echo _HEALTH_MENU_INC_EDIT_HEALTH?>"><? echo _HEALTH_MENU_INC_EDIT_HEALTH_TEXT?></a></td></tr>
	<tr><td><a href="health_immunz.php" title="<? echo _HEALTH_MENU_INC_EDIT_IMM?>"><? echo _HEALTH_MENU_INC_EDIT_IMM_TEXT?></a></td></tr>
	<tr><td><a href="health_medicine.php" title="<? echo _HEALTH_MENU_INC_EDIT_MED?>"><? echo _HEALTH_MENU_INC_EDIT_MED_TEXT?></a></td></tr>
	<tr><td><a href="health_allergies.php" title="<? echo _HEALTH_MENU_INC_EDIT_ALL?>"><? echo _HEALTH_MENU_INC_EDIT_ALL_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="health_change_password.php" title="<? echo _HEALTH_MENU_INC_PASSWORD?>"><? echo _HEALTH_MENU_INC_PASSWORD_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="logout.php" title="<? echo _HEALTH_MENU_INC_LOGOUT?>"><? echo _HEALTH_MENU_INC_LOGOUT_TEXT?></a></td></tr>
			<tr>
			   <td><hr></td>
			</tr>
	<tr><td><a href="admin_student_1.php" title="<? echo _HEALTH_MENU_INC_ADMIN_AREA?>"><? echo _HEALTH_MENU_INC_ADMIN_AREA_TEXT?></a></td></tr></table></table>
</div>
