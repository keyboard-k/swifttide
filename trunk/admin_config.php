<?php
//*
// admin_config.php
// Admin Section
// General default configurations
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

//Get list of states
$states=$db->get_results("SELECT * FROM tbl_states ORDER BY state_code");

//Get current year
$nyear=$_SESSION['CurrentYear'];
$cyear=$db->get_var("SELECT school_years_desc FROM school_years WHERE school_years_id=$nyear");

$action=get_param("action");

if ($action=="edit"){
	//Gather Stored Config
	$config = $db->get_row("SELECT * FROM tbl_config WHERE id=1");
	$set_state=$config->default_state;
}else{
	$messageto_teachers=get_param("messageto_teachers");
	$messageto_parents=get_param("messageto_parents");
	$messageto_all=get_param("messageto_all");
	$default_city=get_param("default_city");
	$default_state=get_param("default_state");
	$default_zip=get_param("default_zip");
	$default_entry_date=get_param("default_entry_date");		//default entry date added by Joshua
	$sSQL="UPDATE tbl_config SET messageto_teachers=".tosql($messageto_teachers, "Text").", messageto_parents=".tosql($messageto_parents, "Text").",messageto_all=".tosql($messageto_all, "Text").", default_city=".tosql($default_city, "Text").", default_state='$default_state', default_zip=".tosql($default_zip, "Text").", default_entry_date=".tosql($default_entry_date, "Text")." WHERE id=1";
	$db->query($sSQL);
	$config = $db->get_row("SELECT * FROM tbl_config WHERE id=1");
	$set_state=$config->default_state;
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script language="JavaScript" src="datepicker.js"></script>
<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_CONFIG_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_CONFIG_TITLE?></h1>
	<br>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form name="config" method="POST" action="admin_config.php">
  <tr class="trform">
    <td width="100%"><?php echo _ADMIN_CONFIG_CURRENT?>: <?php echo $cyear; ?> <a href="admin_change_year.php" class="aform"><?php echo _ADMIN_CONFIG_NEXT?></a></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_LOGIN?></td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_all" cols="46" rows="4"><?php echo strip($config->messageto_all); ?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_TEACHERS?></td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_teachers" cols="46" rows="4"><?php echo strip($config->messageto_teachers); ?></textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%">
      <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr class="trform">
          <td width="100%">&nbsp;<?php echo _ADMIN_CONFIG_PARENTS?></td>
        </tr>
        <tr>
          <td width="100%" class="tdinput"><textarea name="messageto_parents" cols="46" rows="4"><?php echo strip($config->messageto_parents); ?> </textarea></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr class="trform">
    <td width="100%" class="tdinput">
    <table border=0 cellspacing="3">
    <tr>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_CITY?>:</td>
      <td><input type="text" onChange="capitalizeMe(this)" name="default_city" size="20" value="<?php echo strip($config->default_city); ?>"></td> 
      <td>
      <?php echo _ADMIN_CONFIG_DEF_STATE?>:</td>
      <td><select name="default_state">
	   <?php
	   //Display states from table
	   foreach($states as $state){
	   ?>
	   <option value="<?php echo $state->state_code; ?>" <? if ($state->state_code==$set_state){echo "selected=selected";};?>><?php echo $state->state_name; ?></option>
	   <?php
	   };
	   ?>
	  </select></td></tr>
    <tr>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_ZIP?>:</td>
      <td><input type="text" onChange="capitalizeMe(this)" name="default_zip" size="12" value="<?php echo strip($config->default_zip); ?>"></td>
      <td>
      <?php echo _ADMIN_CONFIG_DEF_DATE?>:</td>
      <td><input type="text" size=10 name="default_entry_date" value="<?php echo($config->default_entry_date); ?>"  READONLY onclick="javascript:show_calendar('config.default_entry_date');"><a href="javascript:show_calendar('config.default_entry_date');"><img src="images/cal.gif" border="0" class="imma"></a>
    </td></tr>
    </table>
 </td>
  </tr>
  <tr>
    <td width="100%" align="right"><input type="submit" name="submit" value="<?php echo _ADMIN_CONFIG_DEF_UPDATE?>" class="frmbut"></td>
	<input type="hidden" name="action" value="update">
	</form>
  </tr>
</table>

</div>
<?php include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
