<?php
//*
// admin_users_2.php
// Admin Section
// Search and display list of results for removing/editing web users
//*
//Version 1.01, April 4 2005
//V1.02, May 10, 2005.  Added "remove" to remove teachers from the db.
//V1.03, (on its own, no longer admin_teacher_2.php)

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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//Get search field info
$action=get_param("action");
$human=$_POST['group1'];;

//Determine what field(s) to search
switch ($action){
	case "srchlname":
	   $tlname=get_param("tlname");
	      if ($human=="Teacher") {
		$tot = $db->get_var("SELECT count(*) FROM teachers WHERE teachers_lname='$tlname'");
		  } else {
		$tot = $db->get_var("SELECT count(*) FROM studentcontact WHERE studentcontact_lname='$tlname'");
		  }

			if ($tot > 0){
				//Set paging appearence
				$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
				$ezr->results_close = "</table>";
				$ezr->results_row = "<tr><td class=paging width=30%>COL1</td><td class=paging 
width=30%>COL2</td></td><td class=paging width=30%>COL3</td><td class=paging width=10% align=center><a 
href=admin_users_3.php?action=edit&teacherid=COL4 class=aform>&nbsp;" . _ADMIN_USERS_1_SELECT . "</a></td></tr>";
			}else{
				$msgFormErr=_ADMIN_USERS_2_FORM_ERROR . $tlname;
			};
			if ($human=="Teacher")
				$sSQL="SELECT teachers.teachers_lname, 
teachers.teachers_fname, teachers.teachers_id FROM teachers WHERE 
teachers.teachers_lname = '$tlname' ORDER BY teachers.teachers_lname";
			elseif ($human=="Contact")
				$sSQL="SELECT studentcontact_lname, 
studentcontact_fname, studentcontact_id FROM studentcontact WHERE 
studentcontact_lname = '$tlname' ORDER BY studentcontact_lname";
			
				$ezr->query_mysql($sSQL);
				$ezr->set_qs_val("tlname", $tlname);
				$ezr->set_qs_val("action", "srchlname"); 
		break;
	case "letter":
		$letter=get_param("letter");
		//Set paging appearence
		$ezr->results_open = "<table width=100% cellpadding=2 cellspacing=0 border=1>";
		$ezr->results_close = "</table>";
		$ezr->results_row = "<tr><td class=paging width=30%>COL1</td><td class=paging 
width=30%>COL2</td></td><td class=paging width=30%>COL3</td><td class=paging width=10% align=center><a 
href=admin_users_3.php?action=edit&teacherid=COL4 class=aform>&nbsp;" . _ADMIN_USERS_2_SELECT . "</a></td></tr>";
		$sSQL="SELECT teachers.teachers_lname, teachers.teachers_fname, school_names.school_names_desc, teachers.teachers_id FROM teachers INNER JOIN school_names ON teachers.teachers_school = school_names.school_names_id WHERE teachers.teachers_lname LIKE '$letter%' ORDER BY teachers.teachers_lname";
		$ezr->query_mysql($sSQL);
		$ezr->set_qs_val("letter", $letter);
		$ezr->set_qs_val("action", "letter"); 
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_USERS_2_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo $human ?> <?php echo _ADMIN_USERS_2_SEARCH_RESULTS?></h1>
	<br>
	<?php
	if (strlen($msgFormErr)){
		//No results
	?>
		<h3><?php echo $msgFormErr; ?></h3>
	<?php
	}else{
		//Dislay results with paging options
		$ezr->display();
	};
	?>
	<br>
	<A class="aform" href="admin_users_1.php"><?php echo _ADMIN_USERS_2_NEW?></a>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
