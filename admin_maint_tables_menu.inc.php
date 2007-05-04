<?
// config
include_once "configuration.php";
?>

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
			   <td class ="year"><? echo _ADMIN_MAINT_TABLES_MENU_YEAR?> <? echo $cyear; ?></td>
			</tr>
			<tr>
			   <td><hr></td>
			</tr>
				<TH><? echo _ADMIN_MAINT_TABLES_MENU_TABLES?></TH>
			</TR>
			<tr>
				<td><a href="admin_config.php?action=edit" title="<? echo _ADMIN_MAINT_TABLES_MENU_CONF?>"><? echo _ADMIN_MAINT_TABLES_MENU_CONF_TEXT?></a></td>
			</tr>
			<TR>
				<TD><a href="admin_school_names.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_SCHOOL?>"><? echo _ADMIN_MAINT_TABLES_MENU_SCHOOL_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_subjects.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_SUB?>"><? echo _ADMIN_MAINT_TABLES_MENU_SUB_TEXT?></a></TD>
			</TR><TR>
				<TD><a href="admin_grades.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_GRADE?>"><? echo _ADMIN_MAINT_TABLES_MENU_GRADE_TEXT?></a></TD></TR>
			<TR>    <TD><a href="admin_rooms.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_ROOMS?>"><? echo _ADMIN_MAINT_TABLES_MENU_ROOMS_TEXT?></a></TD></TR>
			<TR><TD ALIGN="left">---</TD></TR>
			<TR>    <TD><a href="admin_terms.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_TERMS?>"><? echo _ADMIN_MAINT_TABLES_MENU_TERMS_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_school_years.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_YEARS?>"><? echo _ADMIN_MAINT_TABLES_MENU_YEARS_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_ethnicity.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_ETH?>"><? echo _ADMIN_MAINT_TABLES_MENU_ETH_TEXT?></a></TD></TR>
			<TR>	<TD><a href="admin_sgrades.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_COMM?>"><? echo _ADMIN_MAINT_TABLES_MENU_COMM_TEXT?></a></TD></TR>
			<TR>
				<TD><a href="admin_attendance_codes.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_ATT?>"><? echo _ADMIN_MAINT_TABLES_MENU_ATT_TEXT?></a></TD>
			</TR>
			<TR><TD ALIGN="left">---</TD></TR>
			<TR>
				<TD><a href="admin_infraction_codes.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_INFR?>"><? echo _ADMIN_MAINT_TABLES_MENU_INFR_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_generations.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_GEN?>"><? echo _ADMIN_MAINT_TABLES_MENU_GEN_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_relations.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_REL?>"><? echo _ADMIN_MAINT_TABLES_MENU_REL_TEXT?></a></TD>
			</TR>
			<TR>
				<TD><a href="admin_titles.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_TITLES?>"><? echo _ADMIN_MAINT_TABLES_MENU_TITLES_TEXT?></a></TD>
			</TR>
			<!-- start:  added custom fields and reports by Joshua -->
			<TR>
				<TD><a href="admin_custom_fields.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_CUS?>"><? echo _ADMIN_MAINT_TABLES_MENU_CUS_TEXT?></a></TD>
			</TR></TABLE></TD></TR>
			<TR><TD ALIGN="left">---</TD></TR>
			<TR>    <TD><a href="admin_exams_types.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES?>"><? echo _ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES_TEXT?></a></TD></TR>
			<tr><td><hr></td></tr>
			<TR>
				<TD> <TABLE>
			   <TR>	<TH><? echo _ADMIN_MAINT_TABLES_MENU_HEALTH?></TH>
			</TR>
			<TR><TD><a href="health_codes.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_OFF?>"><? echo _ADMIN_MAINT_TABLES_MENU_OFF_TEXT?></a></TD></TR>
			<TR><TD><a href="health_immunz.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_IMM?>"><? echo _ADMIN_MAINT_TABLES_MENU_IMM_TEXT?></a></TD></TR>
			<TR><TD><a href="health_medicine.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_MED?>"><? echo _ADMIN_MAINT_TABLES_MENU_MED_TEXT?></a></TD></TR>
			<TR><TD><a href="health_allergies.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_ALL?>"><? echo _ADMIN_MAINT_TABLES_MENU_ALL_TEXT?></a></TD></TR>
</TABLE></TD></TR>
	<tr>
	<td><hr></td></tr>

	<TR>
		<TD>
		<TABLE>
			<TR>
				<TH><? echo _ADMIN_MAINT_TABLES_MENU_MENU?></TH>
			</TR>
			<TR>
				<TD>
				<a href="admin_main_menu.php" title="<? echo _ADMIN_MAINT_TABLES_MENU_ADMIN?>">
				<? echo _ADMIN_MAINT_TABLES_MENU_ADMIN_TEXT?></a>
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
                                <TD><a href="logout.php" title="<? echo _ADMIN_MENU_INC_LOGOUT?>"><? echo 
_ADMIN_MENU_INC_LOGOUT_TEXT?></a></TD>
                        </TR>
                </TABLE>
                </TD>
        </TR>
</TABLE></DIV>
