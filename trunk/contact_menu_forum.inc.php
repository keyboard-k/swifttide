<?php
// Include configuration
include_once "configuration.php";
?>

<!--pq - 2007-02-22 - made consistent with the rest -->
<div id="menuSystem">
<TABLE id="mainTable">
        <TR>
                <TD>
                <TABLE>
                        <tr>
                        <?
                            //include_once "ez_sql.php";
                                //$nyear=$_SESSION['CurrentYear'];
                                //$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");
                                ?>
                        </tr>
                        <tr>
                           <td><hr></td>
                        </tr>
	<tr><td><a href="contacts_menu.php" title="<? echo _CONTACT_MENU_FORUM_INC_TITLE?>"><? echo 
_CONTACT_MENU_FORUM_INC_TITLE_TEXT?></a></td></tr>
                        <tr>
                           <td><hr></td>
                        </tr>
	<tr><td><a href="contact_manage_attendance_1.php" title="<? echo _CONTACT_MENU_FORUM_INC_ATT?>"><? echo 
_CONTACT_MENU_FORUM_INC_ATT_TEXT?></a></td></tr>
	<tr><td><a href="contact_manage_discipline_1.php" title="<? echo _CONTACT_MENU_FORUM_INC_DIS?>"><? echo 
_CONTACT_MENU_FORUM_INC_DIS_TEXT?></a></td></tr>
	<tr><td><a href="contact_manage_grades_1.php" title="<? echo _CONTACT_MENU_FORUM_INC_GRADE?>"><? echo 
_CONTACT_MENU_FORUM_INC_GRADE_TEXT?></a></td></tr>
	<tr><td><a href="contact_change_student_year.php" title="<? echo _CONTACT_MENU_FORUM_INC_CHANGE?>"><? echo 
_CONTACT_MENU_FORUM_INC_CHANGE_TEXT?></a></td></tr>
                        <tr>
                           <td><hr></td>
                        </tr>
	<tr><td><a href="contacts_homework.php" title="<? echo _CONTACT_MENU_FORUM_INC_HOMEWORK?>"><? echo 
_CONTACT_MENU_FORUM_INC_HOMEWORK_TEXT?></a></td></tr>
	<tr><td><a href="displayforum.php?forumid=SCHOOL&position=0&sort_by=date_posted&order=desc" title="<? echo 
_CONTACT_MENU_FORUM_INC_FORUM?>"><? echo _CONTACT_MENU_FORUM_INC_FORUM_TEXT?></a></td></tr>
                        <tr>
                           <td><hr></td>
                        </tr>
	<tr><td><a href="contact_change_password.php" title="<? echo _CONTACT_MENU_FORUM_INC_PASS?>"><? echo 
_CONTACT_MENU_FORUM_INC_PASS_TEXT?></a></td></tr>
                        <tr>
                           <td><hr></td>
                        </tr>
	<tr><td><a href="logout.php" title="<? echo _CONTACT_MENU_FORUM_INC_LOGOUT?>"><? echo 
_CONTACT_MENU_FORUM_INC_LOGOUT_TEXT?></a></td></tr>


</div>
