<?
//*
// admin_users_3.php
// Admin Section
// Remove teachers/contacts from the login table
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
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";

//	case "remove":
		$web_users_id=get_param("id");
//		if($norem=$db->get_results("SELECT studentbio_ethnicity FROM studentbio WHERE studentbio_ethnicity=$ethnicity_id")){
//			$msgFormErr=_ADMIN_USERS_3_FORM_ERROR;
//		}else{
//			$sSQL="DELETE FROM web_users WHERE web_users_id=$web_users_id";
//			$db->query($sSQL);
echo "user id is $web_users_id";

//Set paging appearence
$ezr->results_open = "<table width=65% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_row = "<tr><td class=paging width=70%>COL2</td><td class=paging width=15% align=center><a href=admin_ethnicity.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_USERS_3_EDIT . "</a></td><td class=paging width=15% align=center><a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_USERS_3_REMOVE . "</a></td></tr>";
$ezr->query_mysql("SELECT ethnicity_id, ethnicity_desc FROM ethnicity ORDER BY ethnicity_desc");
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
    f.submit();
  else
    alert("<? echo _ENTER_VALUE?>");
}
/* Javascript function to ask confirmation before removing record */
function cnfremove(id) {
	var answer;	
	answer = window.confirm("<? echo _ADMIN_USERS_3_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_ethnicity.php?action=remove&id=" + id;
		window.location = url; // other browsers
		href_remove.href = url; // explorer 
	}
	return false;
}

</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_USERS_3_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_USERS_3_ETH?></h1>
	<br>
	<?
	if ($action!="edit"){
		//Dislay results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addethnicity" method="post" action="admin_ethnicity.php">						
		  <p class="pform"><? echo _ADMIN_USERS_3_ADD_NEW?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="ethnicityname" size="20">&nbsp;<A class="aform" href="javascript: submitform('ethnicityname')"><? echo _ADMIN_USERS_3_ADD?></a>
	      <input type="hidden" name="action" value="add">
	      </p>
	    </form>
	<?
	}else{
	?>
		<br>
		<form name="editethnicity" method="post" action="admin_ethnicity.php">						
		  <p class="pform"><? echo _ADMIN_USERS_3_UPDATE_ETH?><br>
	      <input type="text" onChange="capitalizeMe(this)" name="ethnicityname" size="20" value="<? echo $ethnicity_desc; ?>">&nbsp;<A class="aform" href="javascript: submitform('ethnicityname')"><? echo _ADMIN_USERS_3_UPDATE?></a>
	      <input type="hidden" name="action" value="update">
		  <input type="hidden" name="id" value="<? echo $ethnicity_id; ?>">
	      </p>
	    </form>
	<?
	};
	?>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
