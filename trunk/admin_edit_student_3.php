<?
//*
// admin_edit_student_3.php
// Admin Section
// Edit student info
//v1.5 12-07-05 true multiyear features
//*


//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}


//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// config
include_once "configuration.php";

//Gather info from post
$studentid=get_param("studentid");

//Set variable for menu
$menustudent=1;

//Get current year
$current_year=$_SESSION['CurrentYear'];

$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_desc";
$rooms = $db->get_results($sSQL);

//Gather student info
$sSQL="SELECT studentbio.*, DATE_FORMAT(studentbio.studentbio_dob, 
'%m/%d/%Y') as sdob, ethnicity.ethnicity_desc, 
school_names.school_names_desc, generations.generations_desc, 
grades.grades_desc, school_rooms_desc 
FROM (((((studentbio INNER JOIN generations ON 
studentbio.studentbio_generation = generations.generations_id) 
INNER JOIN ethnicity ON studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) 
INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) 
INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) 
INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id) 
INNER JOIN school_rooms ON school_rooms_id=studentbio_homeroom 
WHERE studentbio.studentbio_id=$studentid AND 
student_grade_year.student_grade_year_year = '$current_year'";
$studentinfo=$db->get_row($sSQL);

//Gather all information for drop-downs from basic tables
$sSQL="SELECT * FROM school_names ORDER BY school_names_desc";
$schools = $db->get_results($sSQL);

$sSQL="SELECT * FROM ethnicity ORDER BY ethnicity_desc";
$ethnicities = $db->get_results($sSQL);

$sSQL="SELECT * FROM generations ORDER BY generations_desc";
$generations = $db->get_results($sSQL);

$sSQL="SELECT * FROM grades ORDER BY grades_desc";
$grades = $db->get_results($sSQL);

$sSQL="SELECT teachers_id, teachers_fname, teachers_lname FROM teachers ORDER BY teachers_lname";
$teachers=$db->get_results($sSQL);

//Get Current Year
$sSQL="SELECT school_years_desc FROM school_years WHERE school_years_id=$current_year";
$current_year_desc = $db->get_var($sSQL);

//get student's custom fields
$cfSQL = "SELECT * FROM custom_studentbio, custom_fields 
	WHERE (custom_fields.custom_field_id = custom_studentbio.custom_field_id) 
	AND (custom_studentbio.studentbio_id = '$studentid')";
$student_custom_fields = $db->get_results($cfSQL);

//get the entry action history for this student by Joshua
$entries_sql = "SELECT * from entry_actions, school_names, school_years, tbl_config
	WHERE (entry_actions.school_id = school_names.school_names_id)
	AND (entry_actions.school_year_id = school_years.school_years_id)
	AND (entry_actions.student_id = '$studentid') ";
$entries = $db->get_results($entries_sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script language="JavaScript" src="datepicker.js"></script>
<SCRIPT LANGUAGE="JAVASCRIPT">
<!--


// -->
</SCRIPT>


<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_EDIT_STUDENT_3_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_EDIT_STUDENT_3_TITLE?></h1>
	<br>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
	<form name="addstudent" method="POST" action="admin_edit_student_4.php">
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="35%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_FIRST?></td>
              <td width="15%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_MIDDLE?></td>
              <td width="35%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_LAST?></td>
              <td width="15%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_GEN?></td>
            </tr>
            <tr>
              <td width="35%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="sfname" size="24" value="<? echo strip($studentinfo->studentbio_fname); ?>">
              </td>
              <td width="15%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="mi" size="8" value="<? echo strip($studentinfo->studentbio_mi); ?>">
              </td>
              <td width="35%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="slname" size="24" value="<? echo strip($studentinfo->studentbio_lname); ?>">
              </td>
              <td width="15%" class="tdinput">
                  <select size="1" name="generation">
				   <?
				   //Display Generations from table
				   foreach($generations as $generation){
				   ?>
                    <option value="<? echo $generation->generations_id; ?>" <?if ($generation->generations_id==$studentinfo->studentbio_generation){echo "selected=selected";};?>><? echo $generation->generations_desc; ?></option>
				   <?
				   };
				   ?>
                  </select>
              </td>
            </tr>
          </table>
        </td>
    </tr>
    <tr>
      <td width="100%">
         <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="20%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_GENDER?></td>
              <td width="35%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_ETHNICITY?></td>
	      <td width="15%" align="center"><? echo _ADMIN_EDIT_STUDENT_3_ACTIVE?></td>
              <td width="15%" align="center"><? echo _ADMIN_EDIT_STUDENT_3_HOMED?></td>
              <td width="15%" align="center"><? echo _ADMIN_EDIT_STUDENT_3_SPED?></td>
            </tr>
            <tr>
              <td width="20%" class="tdinput">
			     <select size="1" name="gender">
			      <option value="Male" <? if($studentinfo->studentbio_gender=='Male'){echo "selected=selected";};?>>Male</option>
                  <option value="Female" <? if($studentinfo->studentbio_gender=='Female'){echo "selected=selected";};?>>Female</option>
                 </select>
              </td>
              <td width="35%" class="tdinput">
			     <select size="1" name="ethnicity">
				   <?
				   //Display Ethnicities from table
				   foreach($ethnicities as $ethnicity){
				   ?>
                    <option value="<? echo $ethnicity->ethnicity_id; ?>" <?if ($ethnicity->ethnicity_id==$studentinfo->studentbio_ethnicity){echo "selected=selected";};?>><? echo $ethnicity->ethnicity_desc; ?></option>
				   <?
				   };
				   ?>
                 </select>
              </td>
              <td width="15%" align="center"><input type="checkbox" name="active" value="1" <? if($studentinfo->studentbio_active==1){echo "checked=checked";};?>>
              </td>
              <td width="15%" align="center"><input type="checkbox" name="homed" value="1" <? if($studentinfo->studentbio_homed==1){echo "checked=checked";};?>>
              </td>
              <td width="15%" align="center"><input type="checkbox" name="sped" value="1" <? if($studentinfo->studentbio_sped==1){echo "checked=checked";};?>>
              </td>
		    </tr>
		  </table>
		 </td>
	   </tr>
	   <!-- student entry and exit actions by Joshua -->
	   <tr><td><table cellpadding="0" cellspacing="0" width="100%"><?
	   //display existing entry actions
	    if(count($entries)) {
	    		?><tr class="trform"><td><? echo _ADMIN_EDIT_STUDENT_3_ENTRY_RECORD?></td>
	    		<td><? echo _ADMIN_EDIT_STUDENT_3_NOTES?></td>
	    		<td align="right"><? echo _ADMIN_EDIT_STUDENT_3_DELETE?></td></tr><?
	    		foreach($entries as $entry) {
	    			?><tr class="tblcont"><td><?
	    			echo(ucwords($entry->action_code));
	    			if($entry->action_code == 'entry') {echo _ADMIN_EDIT_STUDENT_3_INTO;}
		    		if($entry->action_code == 'exit') {echo _ADMIN_EDIT_STUDENT_3_FROM;}
				echo($entry->school_names_desc);
	    			?> on <? echo($entry->action_date);
	    			?> for year <? echo($entry->school_years_desc);
	    			?></td><td><? echo($entry->action_notes);
	    			?></td><td align="right">
	    			<input type="checkbox" name="delete_entry_actions[]" value="<?
	    			echo($entry->entry_actions_id);
	    			?>"></td></tr><?
	    		} 
	    } else {
	    		?><tr class="tblhead"><td><? echo _ADMIN_EDIT_STUDENT_3_ENTRY_RECORD?></td><?
	    }
         ?></table></td></tr><tr><td><table border="1" cellpadding="0" cellspacing="0" width="100%">
	   <tr><td class="tblcont" align="center"><? echo _NEW?> 
	   <input type="checkbox" name="do_new_action" value="1"></td><td class="tblcont">
	   <select name="new_action_code">
		   <option value="entry" <?if ($studentinfo->studentbio_active == "0") {echo" selected";}?>><? echo _ADMIN_EDIT_STUDENT_3_ENTRY?>
		   <option value="exit" <?if($studentinfo->studentbio_active == "1")  {echo" selected";}?>><? echo _ADMIN_EDIT_STUDENT_3_EXIT?>
	   </select> from <select name="new_action_school"> <?
	    	$sq = "SELECT * from school_names";
	    	$all_schools = $db->get_results($sq);
	    	foreach($all_schools as $s) {
	    		?><option value="<? echo($s->school_names_id); ?>" <?
	    		if($s->school_names_id == $studentinfo->studentbio_school) {echo" selected";}?>>
	    	<?echo($s->school_names_desc);?></option><?
	    	}
	   ?> </select> <? echo _ADMIN_EDIT_STUDENT_3_ON?> <input type="text" name="new_action_date" size=10 value="<?
	   $default_date_sql = "SELECT default_entry_date FROM tbl_config";
	   $default_entry_date = $db->get_var($default_date_sql);
	   echo($default_entry_date); ?>"  READONLY onclick="javascript:show_calendar('addstudent.new_action_date');"><a href="javascript:show_calendar('addstudent.new_action_date');"><img src="images/cal.gif" border="0" class="imma"></a> <? echo _ADMIN_EDIT_STUDENT_3_FOR_YEAR?><select name="new_action_school_year"><?
	   $syq = "SELECT * FROM school_years";
	   $all_school_years = $db->get_results($syq);
	   foreach($all_school_years as $sy) {
	   	?><option value="<?echo($sy->school_years_id);?>"<?
	   	if($sy->school_years_id == $current_year_id) {echo" selected";} ?>><?
	   	echo($sy->school_years_desc);
	   	?></option><?
	   }
	   ?></select></td><td class="tblcont"><? echo _ADMIN_EDIT_STUDENT_3_NOTES?>: <input type="text" name="new_action_notes">
	   	</td></tr></table></td></tr>
	<tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="50%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_SCHOOL?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_INTERNAL_ID?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_BIRTHDATE?></td>
			</tr>
			<tr>
              <td width="50%" class="tdinput">
			    <select size="1" name="school">
				   <?
				   //Display Schools from table
				   foreach($schools as $school){
				   ?>
                    <option value="<? echo $school->school_names_id; ?>" <? if($school->school_names_id==$studentinfo->studentbio_school){echo "selected=selected";};?>><? echo $school->school_names_desc; ?></option>
				   <?
				   };
				   ?>
                </select>
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="internalid" size="13" value="<? echo strip($studentinfo->studentbio_internalid); ?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" name="dob" size="18" value="<? echo $studentinfo->sdob; ?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
	<tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_HOME?></td>
              <td width="50%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_TEACHER?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_ROUTE?></td>
			</tr>
			<tr>
              <!--
	      <td width="25%" class="tdinput"><input type="text" 
onchange="this.value=this.value.toUpperCase();" name="homeroom" size="13" value="<? echo 
strip($studentinfo->school_rooms_desc); ?>">
              </td>
	      -->
		<td width="25%" class="tdinput">
		<select size="1" name="homeroom">
		<?php
		//Display rooms from table
		foreach($rooms as $room){
		if ($_POST['homeroom'] == $room->school_rooms_id) {
		echo "<option value=".$room->school_rooms_id." selected='selected'>".$room->school_rooms_desc."</option>";
		} else {
		echo "<option value=".$room->school_rooms_id.">".$room->school_rooms_desc."</option>";
		}
		}
		?>
		</select>
		</td>
              <td width="50%" class="tdinput">
			    <select size="1" name="teacher">
				   <?
				   //Display teachers from table
				   foreach($teachers as $teacher){
				   ?>
                    <option value="<? echo $teacher->teachers_id; ?>" <? if($teacher->teachers_id==$studentinfo->studentbio_teacher){echo "selected=selected";};?>><? echo $teacher->teachers_fname." ".$teacher->teachers_lname; ?></option>
				   <?
				   };
				   ?>
                </select>
              </td>
              <td width="25%" class="tdinput"><input type="text" onchange="this.value=this.value.toUpperCase();" name="bus" size="18" value="<? echo $studentinfo->studentbio_bus; ?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_BIRTHCITY?></td>
              <td width="33%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_BIRTHSTATE?></td>
              <td width="34%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_BIRTHCOUNTRY?></td>
            </tr>
            <tr>
              <td width="33%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bcity" size="26" value="<? echo strip($studentinfo->studentbio_birthcity); ?>">
              </td>
              <td width="33%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bstate" size="24" value="<? echo strip($studentinfo->studentbio_birthstate); ?>">
              </td>
              <td width="34%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bcountry" size="24" value="<? echo strip($studentinfo->studentbio_birthcountry); ?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="50%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLNAME?></td>
              <td width="50%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLADDRESS?></td>
            </tr>
            <tr>
              <td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolname" size="33" value="<? echo strip($studentinfo->studentbio_prevschoolname); ?>">
              </td>
              <td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschooladdress" size="42" value="<? echo strip($studentinfo->studentbio_prevschooladdress); ?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCITY?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLSTATE?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLZIP?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCOUNTRY?></td>
            </tr>
            <tr>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolcity" size="26" value="<? echo strip($studentinfo->studentbio_prevschoolcity); ?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolstate" size="17" value="<? echo strip($studentinfo->studentbio_prevschoolstate); ?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolzip" size="10" value="<? echo strip($studentinfo->studentbio_prevschoolzip); ?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolcountry" size="24" value="<? echo strip($studentinfo->studentbio_prevschoolcountry); ?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr class="trform">
      <td width="100%">
		<? echo _ADMIN_EDIT_STUDENT_3_MESSAGE?> (<? echo $current_year_desc; ?>)&nbsp;
		
	   <select name="grade">
	   <?
	   //Display grades from table
	   foreach($grades as $grade){
	   ?>
       <option value="<? echo $grade->grades_id; ?>" <? if ($grade->grades_id==$studentinfo->studentbio_grade){echo "selected=selected";};?>><? echo $grade->grades_desc; ?></option>
	   <?
	   };
	   ?>
	   </select>
	   <input type="hidden" name="current_year_id" value="<? echo $current_year_id; ?>">
	  </td>
    </tr>
    
    <? //custom fields added by Joshua
    	//get all the custom field names for the select loops
     $cfSQL = "SELECT * FROM custom_fields";
     $custom_fields = $db->get_results($cfSQL);

	?> <tr><td><h2><? echo _ADMIN_EDIT_STUDENT_3_CUSTOM_FIELDS?></h2></td></tr>
	<tr><td><table width="100%"> <?

    	if($student_custom_fields) {
		foreach($student_custom_fields as $student_custom_field) {
			?> <tr><td><select name="custom_fields[<?
			echo($student_custom_field->custom_studentbio_id);
			?>]"><option value="0"><? echo _ADMIN_EDIT_STUDENT_3_DELETE?>...</option><?
			foreach($custom_fields as $custom_field) {
				?><option value="<? echo($custom_field->custom_field_id);
				?>" <?
				if($custom_field->custom_field_id == $student_custom_field->custom_field_id) {
					echo" selected";
				}
				?>><?
				echo($custom_field->name);
				?></option><?
			}
			?></select></td><td><input type="text" name="student_custom_fields[<?
	    		echo($student_custom_field->custom_studentbio_id);
	    		?>]" value="<? echo($student_custom_field->data);
	    		?>" size=70></td></tr> <?
		} 
	}
	?><tr><td><select name="new_custom_field_id">
	<option value="0" selected><? echo _ADMIN_EDIT_STUDENT_3_ADD_NEW?>...</option><?
	foreach($custom_fields as $custom_field) {
		?><option value="<?echo($custom_field->custom_field_id);
		?>"><? echo($custom_field->name);
		?></option><?
	} 
	?></td><td><input type="text" name="new_custom_field_data" size=70>
	</td></tr></table></td></tr><?
	//end custom fields
	?>
    <tr>    
      <td width="100%" align="right">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
		    <td width="50%"><a href="admin_edit_student_1.php?studentid=<? echo $studentid; ?>" class="aform"><? echo _ADMIN_EDIT_STUDENT_3_BACK?></a>
			</td>
			<td width="50%" align="right">
			   <input type="submit" name="sumbit" value="<? echo _ADMIN_EDIT_STUDENT_3_UPDATE?>" class="frmbut">
			   <input type="hidden" name="studentid" value="<? echo $studentid; ?>">
			</td>
		  </tr>
	   </table>
	  </td>
    </tr>
	</form>
  </table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
