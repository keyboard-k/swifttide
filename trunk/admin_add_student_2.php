<?
//*
// admin_add_student_2.php
// Admin Section
// Process the new student and add primary contact
//v1.5 12-08-05 true multiyear feature
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

//Get current year
$current_year=$_SESSION['CurrentYear'];

//Gather info from form post
$internalid=trim(strtoupper(get_param("internalid")));
$active=get_param("active");
$slname=get_param("slname");
$sfname=get_param("sfname");
$mi=get_param("mi");
$generation=get_param("generation");
$sped=get_param("sped");
$gender=get_param("gender");
$ethnicity=get_param("ethnicity");
$dob=get_param("dob");
$sdob=strtotime($dob);
$dob=date( "Y/m/d", $sdob);
$bcity=get_param("bcity");
$bstate=get_param("bstate");
$bcountry=get_param("bcountry");
$pschoolname=get_param("pschoolname");
$pschooladdress=get_param("pschooladdress");
$pschoolcity=get_param("pschoolcity");
$pschoolstate=get_param("pschoolstate");
$pschoolzip=get_param("pschoolzip");
$pschoolcountry=get_param("pschoolcountry");
$school=get_param("school");
$homed=get_param("homed");
$grade=get_param("grade");
$current_year_id=get_param("current_year_id");
$teacher=get_param("teacher");
$homeroom=get_param("homeroom");
$bus=get_param("bus");


//Validate mandatory fields
$msgFormErr="";
if(!strlen($internalid))
      $msgFormErr .= _ADMIN_ADD_STUDENT_2_ENTER_ID . "<br>";
if(!strlen($slname))
      $msgFormErr .= _ADMIN_ADD_STUDENT_2_ENTER_LAST . "<br>";
if(!strlen($sfname))
      $msgFormErr .= _ADMIN_ADD_STUDENT_2_ENTER_FIRST . "<br>";
if(!strlen($dob)){
      $msgFormErr .= _ADMIN_ADD_STUDENT_2_ENTER_DOB . "<br>";
}else{
	list($year, $month, $day) = explode("/",$dob);
	if (!checkdate($month, $day, $year))
		$msgFormErr .= _ADMIN_ADD_STUDENT_2_FORM_ERROR . "<br>";
};

if ($msgFormErr==""){
	//Check for duplicate internalid
	$sSQL="SELECT studentbio_lname, studentbio_fname FROM studentbio WHERE studentbio_internalid='$internalid'";
	$dblid=$db->get_row($sSQL);
	if (strlen($dblid->studentbio_lname))
		$msgFormErr.= _ADMIN_ADD_STUDENT_2_FORM_ERROR2 . $dblid->studentbio_fname ." ".$dblid->studentbio_lname ."<br>";
	//Get list of states
	$states=$db->get_results("SELECT * FROM tbl_states ORDER BY state_code");

	//Get list of Salutations
	$titles=$db->get_results("SELECT * FROM tbl_titles ORDER BY title_id");

	//Get list of relations
	$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");
	
	//Get default values
	$config = $db->get_row("SELECT * FROM tbl_config WHERE id=1");
	$set_state=$config->default_state;
	$set_city=strip($config->default_city);
	$set_zip=strip($config->default_zip);
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    return true;
  else
    alert("<? echo _ENTER_VALUE?>");
    return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_ADD_STUDENT_2_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?
	//Found errors validating fields
	if ($msgFormErr!=""){
	?>
	   <h1><? echo _ADMIN_ADD_STUDENT_2_TITLE?></h1>
	   <br>
	   <h2><? echo _ADMIN_ADD_STUDENT_2_ERROR_BACK?></h2>
	   <br>
	   <h3><? echo $msgFormErr; ?></h3>
	<?
	//No errors found, add primary contact
	}else{
	?>
	   <h1><? echo _ADMIN_ADD_STUDENT_2_TITLE_PRIMARY?></h1>
	   <br>
	   <h2><? echo $sfname." ".$slname; ?></h2>
	   <br>
	   <p class="ltxt"><? echo _ADMIN_ADD_STUDENT_2_DB_PRIMARY?>: </p>
	   <form name="srchcontact" method="POST" action="admin_add_student_4.php" onsubmit="return submitform('clname');">
	   <p class="ltxt"><? echo _ADMIN_ADD_STUDENT_2_LAST?> <input type = "text" name="clname" size="20">&nbsp;<input type="submit" name="submit" value="<? echo _ADMIN_ADD_STUDENT_2_SEARCH?>" class="frmbut">
	   <input type="hidden" name="internalid" value="<? echo $internalid; ?>">	
	   <input type="hidden" name="active" value="<? echo $active; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname; ?>">
	   <input type="hidden" name="mi" value="<? echo $mi; ?>">
	   <input type="hidden" name="generation" value="<? echo $generation; ?>">
	   <input type="hidden" name="sped" value="<? echo $sped; ?>">
	   <input type="hidden" name="gender" value="<? echo $gender; ?>">
	   <input type="hidden" name="ethnicity" value="<? echo $ethnicity; ?>">
	   <input type="hidden" name="dob" value="<? echo $dob; ?>">
	   <input type="hidden" name="bcity" value="<? echo $bcity; ?>">
	   <input type="hidden" name="bstate" value="<? echo $bstate; ?>">
	   <input type="hidden" name="bcountry" value="<? echo $bcountry; ?>">
	   <input type="hidden" name="pschoolname" value="<? echo $pschoolname; ?>">
	   <input type="hidden" name="pschooladdress" value="<? echo $pschooladdress; ?>">
	   <input type="hidden" name="pschoolcity" value="<? echo $pschoolcity; ?>">
	   <input type="hidden" name="pschoolstate" value="<? echo $pschoolstate; ?>">
	   <input type="hidden" name="pschoolzip" value="<? echo $pschoolzip; ?>">
	   <input type="hidden" name="pschoolcountry" value="<? echo $pschoolcountry; ?>">
	   <input type="hidden" name="school" value="<? echo $school; ?>">
	   <input type="hidden" name="homed" value="<? echo $homed; ?>">
	   <input type="hidden" name="grade" value="<? echo $grade; ?>">
	   <input type="hidden" name="current_year_id" value="<? echo $current_year_id; ?>">
	   <input type="hidden" name="teacher" value="<? echo $teacher; ?>">
	   <input type="hidden" name="homeroom" value="<? echo $homeroom; ?>">
	   <input type="hidden" name="bus" value="<? echo $bus; ?>">
	   </form></p>
	   <table border="0" cellpadding="1" cellspacing="1" width="100%">
	    <tr>
		<form name="addcontact" method="POST" action="admin_add_student_3.php">
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_P_TITLE?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_FIRST?></td>
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_LAST?></td>
	              <td width="15%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_RESIDENCE?></td>
	            </tr>
	            <tr>
	              <td width="15%" class="tdinput">
				  <select name="title">
				   <?
				   //Display titles from table
				   foreach($titles as $title){
				   ?>
			       <option value="<? echo $title->title_desc; ?>"><? echo $title->title_desc; ?></option>
				   <?
				   };
				   ?>
					</select>
	              </td>
	              <td width="35%" class="tdinput">
	                  <input type="text" onChange="capitalizeMe(this)" name="cfname" size="25">
	              </td>
		          <td width="35%" class="tdinput">
		              <input type="text" onChange="capitalizeMe(this)" name="clname" size="25">
	              </td>
	              <td width="15%" class="tdinput" align="center">
					  <input type="checkbox" name="residence" value="1" checked=checked>
	              </td>
	            </tr>
		      </table>
	        </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="20%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_RELATION?></td>
	              <td width="40%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_ADDRESS?></td>
		          <td width="40%">&nbsp;</td>
				</tr>
				<tr>
	              <td width="20%" class="tdinput">
				  <select name="relation">
				   <?
				   //Display relations from table
				   foreach($relations as $relation){
				   ?>
			       <option value="<? echo $relation->relation_codes_id; ?>"><? echo $relation->relation_codes_desc; ?></option>
				   <?
				   };
				   ?>
					</select>
		          </td>
		          <td width="40%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="address1" size="40">
	              </td>
		          <td width="40%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="address2" size="40">
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="35%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_CITY?></td>
	              <td width="10%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_STATE?></td>
		          <td width="10%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_ZIP?></td>
				  <td width="45%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_EMAIL?></td>
				</tr>
				<tr>
	              <td width="35%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="city" size="20" value="<? echo $set_city; ?>">
		          </td>
		          <td width="10%" class="tdinput">
					<select name="state">
				   <?
				   //Display states from table
				   foreach($states as $state){
				   ?>
			       <option value="<? echo $state->state_code; ?>" <? if ($state->state_code==$set_state){echo "selected=selected";};?>><? echo $state->state_name; ?></option>
				   <?
				   };
				   ?>
					</select>
	              </td>
		          <td width="10%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="zip" size="10" value="<? echo $set_zip; ?>">
		          </td>
		          <td width="45%" class="tdinput">
					<input type="text" onchange="this.value=this.value.toLowerCase();" name="email" size="50">
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="30%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_PHONE1?></td>
	              <td width="30%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_PHONE2?></td>
		          <td width="30%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_PHONE3?></td>
				  <td width="10%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_MAILINGS?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone1" size="20">
		          </td>
		          <td width="30%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="phone2" size="20">
	              </td>
		          <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone3" size="20">
		          </td>
		          <td width="10%" class="tdinput">
					  <input type="checkbox" name="mailings" value="1" CHECKED>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="100%">&nbsp;<? echo _ADMIN_ADD_STUDENT_2_OTHER?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput" align="center">
					<textarea name="other" cols="40" rows="5"></textarea>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
      </td>
    </tr>
    <tr>
      <td width="100%" align="right">
	   <input type="submit" name="sumbit" value="<? echo _ADMIN_ADD_STUDENT_2_ADD?>" class="frmbut">
	   <input type="hidden" name="internalid" value="<? echo $internalid; ?>">	
	   <input type="hidden" name="active" value="<? echo $active; ?>">
	   <input type="hidden" name="slname" value="<? echo $slname; ?>">
	   <input type="hidden" name="sfname" value="<? echo $sfname; ?>">
	   <input type="hidden" name="mi" value="<? echo $mi; ?>">
	   <input type="hidden" name="generation" value="<? echo $generation; ?>">
	   <input type="hidden" name="sped" value="<? echo $sped; ?>">
	   <input type="hidden" name="gender" value="<? echo $gender; ?>">
	   <input type="hidden" name="ethnicity" value="<? echo $ethnicity; ?>">
	   <input type="hidden" name="dob" value="<? echo $dob; ?>">
	   <input type="hidden" name="bcity" value="<? echo $bcity; ?>">
	   <input type="hidden" name="bstate" value="<? echo $bstate; ?>">
	   <input type="hidden" name="bcountry" value="<? echo $bcountry; ?>">
	   <input type="hidden" name="pschoolname" value="<? echo $pschoolname; ?>">
	   <input type="hidden" name="pschooladdress" value="<? echo $pschooladdress; ?>">
	   <input type="hidden" name="pschoolcity" value="<? echo $pschoolcity; ?>">
	   <input type="hidden" name="pschoolstate" value="<? echo $pschoolstate; ?>">
	   <input type="hidden" name="pschoolzip" value="<? echo $pschoolzip; ?>">
	   <input type="hidden" name="pschoolcountry" value="<? echo $pschoolcountry; ?>">
	   <input type="hidden" name="school" value="<? echo $school; ?>">
	   <input type="hidden" name="homed" value="<? echo $homed; ?>">
	   <input type="hidden" name="grade" value="<? echo $grade; ?>">
	   <input type="hidden" name="current_year_id" value="<? echo $current_year_id; ?>">
	   <input type="hidden" name="teacher" value="<? echo $teacher; ?>">
	   <input type="hidden" name="homeroom" value="<? echo $homeroom; ?>">
	   <input type="hidden" name="bus" value="<? echo $bus; ?>">

	  </td>
    </tr>
  </form>
</table>
<?
};
?>
</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
