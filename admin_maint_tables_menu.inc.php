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
			    include_once "ez_sql.php";
				$nyear=$_SESSION['CurrentYear'];
				$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
				?>
			   <td class ="year"><?php echo _ADMIN_MAINT_TABLES_MENU_YEAR?> <?php echo $cyear; ?></td>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
				<TH><?php echo _ADMIN_MAINT_TABLES_MENU_TABLES?></TH>
			</TR>
			<tr>
				<td><a href="admin_config.php?action=edit" title="<?php echo _ADMIN_MAINT_TABLES_MENU_CONF?>"><?php echo _ADMIN_MAINT_TABLES_MENU_CONF_TEXT?></a></td>
			</tr>
			<TR>
				<TD><a href="admin_school_names.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_SCHOOL?>"><?php echo _ADMIN_MAINT_TABLES_MENU_SCHOOL_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_subjects.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_SUB?>"><?php echo _ADMIN_MAINT_TABLES_MENU_SUB_TEXT?></a></TD>
			</TR><TR>
				<TD><a href="admin_grades.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_GRADE?>"><?php echo _ADMIN_MAINT_TABLES_MENU_GRADE_TEXT?></a></TD></TR>
			<TR>    <TD><a href="admin_rooms.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_ROOMS?>"><?php echo _ADMIN_MAINT_TABLES_MENU_ROOMS_TEXT?></a></TD></TR>
			<TR><TD ALIGN="left">---</TD></TR>
			<TR>    <TD><a href="admin_terms.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_TERMS?>"><?php echo _ADMIN_MAINT_TABLES_MENU_TERMS_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_school_years.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_YEARS?>"><?php echo _ADMIN_MAINT_TABLES_MENU_YEARS_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_ethnicity.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_ETH?>"><?php echo _ADMIN_MAINT_TABLES_MENU_ETH_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_sgrades.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_COMM?>"><?php echo _ADMIN_MAINT_TABLES_MENU_COMM_TEXT?></a></TD></TR>
			<TR>
				<TD><a href="admin_attendance_codes.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_ATT?>"><?php echo _ADMIN_MAINT_TABLES_MENU_ATT_TEXT?></a></TD>
			</TR>
			<TR><TD ALIGN="left">---</TD></TR>
			<TR>
				<TD><a href="admin_infraction_codes.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_INFR?>"><?php echo _ADMIN_MAINT_TABLES_MENU_INFR_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_generations.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_GEN?>"><?php echo _ADMIN_MAINT_TABLES_MENU_GEN_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_relations.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_REL?>"><?php echo _ADMIN_MAINT_TABLES_MENU_REL_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_titles.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_TITLES?>"><?php echo _ADMIN_MAINT_TABLES_MENU_TITLES_TEXT?></a></TD>
			</TR>
			<!-- start:  added custom fields and reports by Joshua -->
			<TR>
				<TD><a href="admin_custom_fields.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_CUS?>"><?php echo _ADMIN_MAINT_TABLES_MENU_CUS_TEXT?></a></TD>
			</TR></TABLE></TD></TR>
			<TR>
				<TD ALIGN="left">---</TD>
			</TR>
			<TR>
				<TD><a href="admin_exams_types.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES?>"><?php echo _ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_media_codes.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_MEDIA?>"><?php echo _ADMIN_MAINT_TABLES_MENU_MEDIA_TEXT?></a></TD>
			</TR>
			<tr><td><hr></td></tr>
			<TR>
				<TD> <TABLE>
			   <TR>	<TH><?php echo _ADMIN_MAINT_TABLES_MENU_HEALTH?></TH>
			</TR>
			<TR><TD><a href="health_codes.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_OFF?>"><?php echo _ADMIN_MAINT_TABLES_MENU_OFF_TEXT?></a></TD></TR>
			<TR><TD><a href="health_immunz.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_IMM?>"><?php echo _ADMIN_MAINT_TABLES_MENU_IMM_TEXT?></a></TD></TR>
			<TR><TD><a href="health_medicine.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_MED?>"><?php echo _ADMIN_MAINT_TABLES_MENU_MED_TEXT?></a></TD></TR>
			<TR><TD><a href="health_allergies.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_ALL?>"><?php echo _ADMIN_MAINT_TABLES_MENU_ALL_TEXT?></a></TD></TR>
</TABLE></TD></TR>
	<tr>
	<td><hr></td></tr>

	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><?php echo _ADMIN_MAINT_TABLES_MENU_MENU?></TH>
			</TR>
			<TR>
				<TD>
				<a href="admin_main_menu.php" title="<?php echo _ADMIN_MAINT_TABLES_MENU_ADMIN?>">
				<?php echo _ADMIN_MAINT_TABLES_MENU_ADMIN_TEXT?></a>
				</TD>
			</TR>
		</TABLE>
	</TR>

	<tr>
	<td><hr></td></tr>
        <TR>
                <TD>
                <TABLE>
                        <TR>
                                <TD><a href="logout.php" title="<?php echo _ADMIN_MENU_INC_LOGOUT?>"><?php echo 
_ADMIN_MENU_INC_LOGOUT_TEXT?></a></TD>
                        </TR>
                </TABLE>
                </TD>
        </TR>
</TABLE></DIV>
