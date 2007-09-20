<?php
//*
// nurse_student_1.php
// Nurse Section
// Form to search for student 
//*

//Check if Nurse is logged in

session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "N"  && 
$_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}
$tfname=$_SESSION['tfname'];
$tlname=$_SESSION['tlname'];


//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
// Include configuration
include_once "configuration.php";

//Gather all information for drop-downs from basic tables
$sSQL="SELECT * FROM school_names ORDER BY school_names_desc";
$schools = $db->get_results($sSQL);

$sSQL="SELECT * FROM ethnicity ORDER BY ethnicity_desc";
$ethnicities = $db->get_results($sSQL);

$sSQL="SELECT * FROM grades ORDER BY grades_desc";
$grades = $db->get_results($sSQL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-health.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to check if field is empty */
function submitform(fldName, frmNumb)
{
  var f = document.forms[frmNumb];
  var t = f.elements[fldName]; 
  if (t.value!="") 
	return true;
  else
	alert("<?php echo _NURSE_STUDENT_1_ENTER_VALUE?>");
	return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _WELCOME?>, <? echo $tfname. " " .$tlname; ?></td>
  </tr>
</table>
</div>
<div id="Content">
	<h1><?php echo _NURSE_STUDENT_1_TITLE?></h1>
	<br>
	<h2><?php echo _NURSE_STUDENT_1_SEARCH_DB?></h2>
	<br>
	<table border="0" cellpadding="1" cellspacing="1" width="100%">
	  <tr>
	    <td width="100%" height="45">
	      <table border="1" cellpadding="0" cellspacing="0" width="100%">
	        <tr class="trform">
	          <td width="50%">&nbsp;<?php echo _NURSE_STUDENT_1_BY_INTERNAL?></td>
	          <td width="50%">&nbsp;<?php echo _NURSE_STUDENT_1_BY_LAST?></td>
		    </tr>
	        <tr>
			   <form name="srchid" method="POST" action="nurse_student_2.php" onsubmit="return submitform('internalid', 0);">
		       <td width="50%" class="tdinput">
	           <input type="text" onChange="capitalizeMe(this)" name="internalid" size="22"><input type="submit" value="<?php echo _NURSE_STUDENT_1_SEARCH?>" name="submit" class="frmbut">
			   <input type="hidden" name="action" value="srchid">
	          </td>
			  </form>
			  <form name="srchlname" method="POST" action="nurse_student_2.php" onsubmit="return submitform('slname', 1);">
		      <td width="50%" class="tdinput">
		        <input type="text" onChange="capitalizeMe(this)" name="slname" size="25"><input type="submit" value="<?php echo _NURSE_STUDENT_1_SEARCH?>" name="submit" class="frmbut">
			    <input type="hidden" name="action" value="srchlname">
	          </td>
				</form>
			    </tr>
	      </table>
	    </td>
	  </tr>
	  <tr>
	    <td width="100%" height="21">
	      <table border="1" cellpadding="0" cellspacing="0" width="100%">
		    <tr class="trform">
	          <td width="100%" colspan="4">&nbsp;<?php echo _NURSE_STUDENT_1_OR_BY?></td>
	        </tr>
		    <tr>
			  <form name="srchall" method="POST" action="nurse_student_2.php">
	          <td width="100%" class="tdinput" colspan="4">
			    <select name="grade">
				   <option value="" selected=selected><?php echo _NURSE_STUDENT_1_BY_GRADE?></option>
				   <?php
				   //Display grades from table
				   foreach($grades as $grade){
				   ?>
			       <option value="<?php echo $grade->grades_id; ?>"><? echo $grade->grades_desc; ?></option>
				   <?php
				   };
				   ?>
			    </select>
			     <select size="1" name="gender">
				    <option value="" selected=selected><?php echo _NURSE_STUDENT_1_BY_GENDER?></option>
					<option value="male">Male</option>
					<option value="female">Female</option>
	             </select> 
			     <select size="1" name="ethnicity">
				   <option value="" selected=selected><?php echo _NURSE_STUDENT_1_BY_ETHNICITY?></option>
				   <?php
				   //Display Ethnicities from table
				   foreach($ethnicities as $ethnicity){
				   ?>
                    <option value="<?php echo $ethnicity->ethnicity_id; ?>"><? echo $ethnicity->ethnicity_desc; ?></option>
				   <?php
				   };
				   ?>
                 </select>
		      </td>
	        </tr>
		    <tr class="trform">
	          <td width="25%" class="tdinput">
			  &nbsp;<?php echo _NURSE_STUDENT_1_ACTIVE?>: <input type="radio" value="1" name="active" checked=checked> <? echo _YES?> <input type="radio" value="" name="active"> <? echo _NO?></td>
	          <td width="25%" class="tdinput">
	          &nbsp;<?php echo _NURSE_STUDENT_1_HOMED?>: <input type="radio" value="1" name="homed"> <? echo _YES?> <input type="radio" value="" name="homed" checked=checked> <? echo _NO?></td>
			  <td width="25%" class="tdinput">			  
			  &nbsp;<?php echo _NURSE_STUDENT_1_SPED?>: <input type="radio" value="1" name="sped"> <? echo _YES?> <input type="radio" value="" name="sped" checked=checked> <? echo _NO?></td>
			  <td width="25%" class="tdinput" align="center">			  
	          <input type="submit" value="<?php echo _NURSE_STUDENT_1_SEARCH?>" name="submit" class="frmbut">
			  <input type="hidden" name="action" value="srchall"></td>
			  </form>
	        </tr>
			  </table>
	    </td>
	  </tr>
	  <tr>
	    <td width="100%">
	      <table border="1" cellpadding="0" cellspacing="0" width="100%">
		    <tr class="trform">
	          <td width="100%" colspan="4">&nbsp;<?php echo _NURSE_STUDENT_1_SEARCH_LAST?></td>
	        </tr>
			<tr>
				<td width="100%" align="center">
				<?php
				for($letters = 'A'; $letters != 'AA'; $letters++)
				{
				    echo "<a 
href='nurse_student_2.php?action=letter&letter=$letters' 
class='aform'>$letters</a> &nbsp;";
				}
				?> 
				</td>
			</tr>
		</table>
	  </td>
	</tr>
	</table>
</div>
<?php include "health_menu.inc.php"; ?>
</body>

</html>

