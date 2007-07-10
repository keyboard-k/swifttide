<?
//*
// admin_add_student_1.php
// Admin Section
// Add a new student to database
// highlighted must-have entries in red (Helmut)
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

$sSQL="SELECT * FROM school_rooms ORDER BY school_rooms_desc";
$rooms = $db->get_results($sSQL);

//Get Current Year
$sSQL="SELECT school_years_desc, school_years_id FROM tbl_config t, school_years s WHERE s.school_years_id=t.current_year";
$current_year = $db->get_row($sSQL);
$current_year_id = $current_year->school_years_id;
$current_year_desc = $current_year->school_years_desc;




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
    <td width="50%"><? echo _ADMIN_ADD_STUDENT_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_ADD_STUDENT_1_TITLE?></h1>
	<br>
  <table border="0" cellpadding="1" cellspacing="1" width="100%">
    <tr>
	<form name="addstudent" method="POST" action="admin_add_student_2.php">
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="35%">&nbsp;<FONT COLOR=Red><? echo _ADMIN_ADD_STUDENT_1_FIRST?></FONT></td>
              <td width="15%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_MIDDLE?></td>
              <td width="35%">&nbsp;<FONT COLOR=Red><? echo _ADMIN_ADD_STUDENT_1_LAST?></FONT></td>
              <td width="15%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_GEN?></td>
            </tr>
            <tr>
              <td width="35%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="sfname" size="24" value="<?php echo $_POST['sfname_1'];?>">
              </td>
              <td width="15%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="mi" size="8" value="<?php echo $_POST['mi_1'];?>">
              </td>
              <td width="35%" class="tdinput">
                  <input type="text" onChange="capitalizeMe(this)" name="slname" size="24" value="<?php echo $_POST['slname_1'];?>">
              </td>
              <td width="15%" class="tdinput">
                  <select size="1" name="generation">
				   <?
				   //Display Generations from table
				   foreach($generations as $generation){
						if ($_POST['generation_1'] == $generation->generations_id) {
		                    echo "<option value=".$generation->generations_id."  selected='selected'>".$generation->generations_desc."</option>";
						} else {
							echo "<option value=".$generation->generations_id.">".$generation->generations_desc."</option>";
						}
				   }
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
              <td width="20%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_GENDER?></td>
              <td width="35%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_ETHNICITY?></td>
			  <td width="15%" align="center"><? echo _ADMIN_ADD_STUDENT_1_ACTIVE?></td>
              <td width="15%" align="center"><? echo _ADMIN_ADD_STUDENT_1_HOMED?></td>
              <td width="15%" align="center"><? echo _ADMIN_ADD_STUDENT_1_SPED?></td>
            </tr>
            <tr>
              <td width="20%" class="tdinput">
			     <select size="1" name="gender">
				 <?php
					if ($_POST['gender_1'] == _MALE) {
					      echo "<option value='" . _MALE . "' selected='selected'>" . _MALE . "</option>";
				   } else {
						  echo "<option value='" . _MALE . "'>" . _MALE . "</option>";
				   }
                  	if ($_POST['gender_1'] == _FEMALE) {
					      echo "<option value='" . _FEMALE . "' selected='selected'>" . _FEMALE . "</option>";
				   } else {
						  echo "<option value='" . _FEMALE . "'>" . _FEMALE . "</option>";
				   }
				  ?>
                 </select>
              </td>
              <td width="35%" class="tdinput">
			     <select size="1" name="ethnicity">
				   <?php
				   //Display Ethnicities from table
				   foreach($ethnicities as $ethnicity){
	                    if ($_POST['ethnicity_1'] == $ethnicity->ethnicity_id) {
							echo "<option value=".$ethnicity->ethnicity_id.">$ethnicity->ethnicity_desc</option>";
						} else {
							echo "<option value=".$ethnicity->ethnicity_id.">$ethnicity->ethnicity_desc</option>";
						}
				   }
				   ?>
                 </select>
              </td>
              <td width="15%" align="center"><input type="checkbox" name="active" value="1" CHECKED>
              </td>
              <td width="15%" align="center">
				<?php
				if ($_POST['homed_1']) {
					echo "<input type='checkbox' name='homed' value='1' checked>";
			   } else {
					echo "<input type='checkbox' name='homed' value='1'>";
			   }
			   ?>
              </td>
              <td width="15%" align="center">
			<?php
				if ($_POST['sped_1']) {
					echo "<input type='checkbox' name='sped' value='1' checked>";
			   } else {
					echo "<input type='checkbox' name='sped' value='1'>";
			   }
			   ?>
              </td>
		    </tr>
		  </table>
		 </td>
	   </tr>
	<tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="50%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_SCHOOL?></td>
              <td width="25%">&nbsp;<FONT COLOR=Red><? echo _ADMIN_ADD_STUDENT_1_INTERNAL_ID?></FONT></td>
              <td width="25%">&nbsp;<FONT COLOR=Red><? echo _ADMIN_ADD_STUDENT_1_BIRTHDATE?></FONT></td>
			</tr>
			<tr>
              <td width="50%" class="tdinput">
			    <select size="1" name="school">
				   <?
				   //Display Schools from table
				   foreach($schools as $school){
					   if ($_POST['school_1']) {
		                    echo "<option value='".$school->school_names_id."'  selected='selected'>".$school->school_names_desc."</option>";
					   } else {
						   echo "<option value='".$school->school_names_id."'>".$school->school_names_desc."</option>";
					   }
				   }
				   ?>
                </select>
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="internalid" size="13" value="<?php echo $_POST['internalid_1'];?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" name="dob" size="18" value="<?php echo $_POST['dob_1'];?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
	<tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_HOME?></td>
              <td width="50%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_TEACHER?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_ROUTE?></td>
			</tr>
			<tr>
              <!--
	      <td width="25%" class="tdinput"><input type="text" onchange="this.value=this.value.toUpperCase();" name="homeroom" size="13" value="<?php echo $_POST['homeroom_1'];?>">
              </td>
	      -->
              <td width="50%" class="tdinput">
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
				   <?php
				   //Display teachers from table
				   foreach($teachers as $teacher){
					   if ($_POST['teacher_1'] == $teacher->teachers_id) {
						   echo "<option value=".$teacher->teachers_id." selected='selected'>".$teacher->teachers_fname." ".$teacher->teachers_lname."</option>";
					   } else {
						echo "<option value=".$teacher->teachers_id.">".$teacher->teachers_fname." ".$teacher->teachers_lname."</option>";
					   }
				   }
				   ?>
                </select>
              </td>
              <td width="25%" class="tdinput"><input type="text" onchange="this.value=this.value.toUpperCase();" name="bus" size="18" value="<?php echo $_POST['bus_1'];?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="33%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_BIRTHCITY?></td>
              <td width="33%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_BIRTHSTATE?></td>
              <td width="34%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_BIRTHCOUNTRY?></td>
            </tr>
            <tr>
              <td width="33%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bcity" size="26" value="<?php echo $_POST['bcity_1'];?>">
              </td>
              <td width="33%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bstate" size="24" value="<?php echo $_POST['bstate_1'];?>">
              </td>
              <td width="34%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="bcountry" size="24" value="<?php echo $_POST['bcountry_1'];?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="50%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLNAME?></td>
              <td width="50%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLADDRESS?></td>
            </tr>
            <tr>
              <td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolname" size="33" value="<?php echo $_POST['pschoolname_1'];?>">
              </td>
              <td width="50%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschooladdress" size="42" value="<?php echo $_POST['pschooladdress_1'];?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr>
      <td width="100%">
          <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr class="trform">
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCITY?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLSTATE?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLZIP?></td>
              <td width="25%">&nbsp;<? echo _ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCOUNTRY?></td>
            </tr>
            <tr>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolcity" size="26" value="<?php echo $_POST['pschoolcity_1'];?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolstate" size="17" value="<?php echo $_POST['pschoolstate_1'];?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolzip" size="10" value="<?php echo $_POST['pschoolzip_1'];?>">
              </td>
              <td width="25%" class="tdinput"><input type="text" onChange="capitalizeMe(this)" name="pschoolcountry" size="24" value="<?php echo $_POST['pschoolcountry_1'];?>">
              </td>
            </tr>
          </table>
      </td>
    </tr>
    <tr class="trform">
      <td width="100%">
		<? echo _ADMIN_ADD_STUDENT_1_MESSAGE?> (<? echo $current_year_desc; ?>)&nbsp;
	   <select name="grade">
	   <?php
	   //Display grades from table
	   foreach($grades as $grade){
	       if ($_POST['grade_1']) {
			   echo "<option value=".$grade->grades_id." selected='selected'>".$grade->grades_desc."</option>";
		   } else {
			   echo "<option value=".$grade->grades_id.">".$grade->grades_desc."</option>";
		   }
	   };
	   ?>
	   </select>
	   <input type="hidden" name="current_year_id" value="<? echo $current_year_id; ?>">
	  </td>
    </tr>
    <tr>
      <td width="100%" align="right">
	   <input type="submit" name="sumbit" value="<? echo _ADMIN_ADD_STUDENT_1_ADD?>" class="frmbut">
	  </td>
    </tr>
	</form>
  </table>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
