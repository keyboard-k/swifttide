<?php
//*
// admin_sgrades.php
// Admin Section
// Display and Manage Gradse Table
//*
//Version 1.03, Doug, 04-02-05
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
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Remove grades according to admin choice
switch ($action){
	case "remove":
		$grade_id=get_param("id");
		if($norem=$db->get_results("SELECT grade_history_id FROM grade_history WHERE grade_history_grade=$grade_id OR grade_history_effort=$grade_id OR grade_history_conduct=$grade_id")){
			$msgFormErr=_ADMIN_SGRADES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM grade_names WHERE grade_names_id=$grade_id";
			$db->query($sSQL);
		};
		break;
	case "add":
		$grade_desc=tosql(get_param("gradename"), "Text");
		$sSQL="INSERT INTO grade_names (grade_names_desc) VALUES (".$grade_desc.")"; 
		$db->query($sSQL);
		break;
	case "edit":
		$grade_id=get_param("id");
		$sSQL="SELECT grade_names_desc FROM grade_names WHERE grade_names_id=$grade_id";
		$grade_desc = $db->get_var($sSQL);
		break;
	case "update":
		$grade_id=get_param("id");
		$grade_desc=get_param("gradename");
		$sSQL="UPDATE grade_names SET grade_names_desc='$grade_desc' WHERE grade_names_id=$grade_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=80% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_sgrades.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_SGRADES_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_SGRADES_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT grade_names_id, grade_names_desc FROM grade_names ORDER BY grade_names_desc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    f.submit();
  else
    alert("<?php echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<?php echo _ADMIN_SGRADES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_sgrades.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_SGRADES_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_SGRADES_TITLE?></h1>
	<br>
	<?php
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addgrade" method="post" action="admin_sgrades.php">	
		  <p class="pform"><?php echo _ADMIN_SGRADES_ADD_NEW?><br>
	      <input type="text" name="gradename" size="50" maxlength="80">&nbsp;<A class="aform" href="javascript: submitform('gradename')"><?php echo _ADMIN_SGRADES_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?php
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" action="admin_sgrades.php">						
		  <p class="pform"><?php echo _ADMIN_SGRADES_UPDATE_COMMENT?><br>
	      <input type="text" name="gradename" size="50" maxlength="80" value="<?php echo $grade_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('gradename')"><?php echo _ADMIN_SGRADES_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<?php echo $grade_id; ?>">
	      </p>
	    </form>
	<?php
	};
	?>
	<h3><?php echo $msgFormErr; ?></h3>
</div>
<?php include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
