<?
//*
// admin_media_codes.php
// Admin Section
// Display and Manage Books and other media
//
// Sept 1, 2007 Doug
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
$msgFormErr="";

//Check what we have to do
$action=get_param("action");

if (!strlen($action))
	$action="none";
//Add or Media entries according to admin choice
switch ($action){
	case "remove":
		$media_codes_id=get_param("id");
		if($norem=$db->get_results("SELECT discipline_history_code FROM discipline_history WHERE discipline_history_code=$media_codes_id")){
			$msgFormErr=_ADMIN_MEDIA_CODES_FORM_ERROR;
		}else{
			$sSQL="DELETE FROM media_codes WHERE media_codes_id=$media_codes_id";
			$db->query($sSQL);
		};
		break;
case "add":
		$media_codes_desc=get_param("medianame");
		$media_codes_id1=get_param("id1");
		$media_codes_id2=get_param("id2");
		/*Duplicates are fine (i.e. textbooks) so don't check for them
		$tot = $db->get_var("SELECT count(*) FROM media_codes WHERE media_codes.media_codes_desc = '$media_codes_desc'");
		if ($tot>0){
			$msgFormErr=_ADMIN_MEDIA_CODES_DUP;
		}else{
		*/	
		$sSQL="INSERT INTO media_codes (media_codes_desc, id1, id2) 
		VALUES (".tosql($media_codes_desc, "Text")." ,'$media_codes_id1', '$media_codes_id2')"; 
		$db->query($sSQL);
		//};
		break;
	case "edit":
		$media_codes_id=get_param("id");
		$sSQL="SELECT media_codes_desc, id1, id2 FROM media_codes WHERE 
media_codes_id=$media_codes_id";
		$media_all= $db->get_row($sSQL);
		$media_codes_desc = $media_all->media_codes_desc;
		$id1=$media_all->id1;
		$id2=$media_all->id2;
		// echo $media_codes_desc, $id1, $id2;
		break;
	case "update":
		$media_codes_id=get_param("id");
		$media_codes_desc=get_param("medianame");
		$sSQL="UPDATE media_codes SET media_codes_desc='$media_codes_desc' WHERE media_codes_id=$media_codes_id";
		$db->query($sSQL);
		break;

};


//Set paging appearence
$ezr->results_open = "<table width=90% cellpadding=2 cellspacing=0 border=1>";
$ezr->results_close = "</table>";
$ezr->results_heading = "<tr class=tblhead>
	<td width=30% align=left>" . _ADMIN_MEDIA_CODES_LINE_1 . "</td>
	<td width=20% align=left>" . _ADMIN_MEDIA_CODES_LINE_2 . "</td>
	<td width=20% align=left>" . _ADMIN_MEDIA_CODES_LINE_3 . "</td>
	<td width=15% align=left>&nbsp;</td>
	<td width=15% align=left>&nbsp;</td></tr>";
$ezr->results_row = "<tr>
	<td class=paging width=30%>COL2</td>
	<td class=paging width=20%>COL3</td>
	<td class=paging width=20%>COL4</td>
	<td class=paging width=15% align=center>
	  <a href=admin_media_codes.php?action=edit&id=COL1 class=aform>&nbsp;" . _ADMIN_MEDIA_CODES_EDIT . "</a></td>
	<td class=paging width=15% align=center>
	  <a name=href_remove href=# onclick=cnfremove(COL1); class=aform>&nbsp;" . _ADMIN_MEDIA_CODES_REMOVE . "</a></td>
	  </tr>";
$ezr->query_mysql("SELECT media_codes_id, media_codes_desc, id1, id2 FROM media_codes ORDER BY media_codes_desc");
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
	answer = window.confirm("<? echo _ADMIN_MEDIA_CODES_SURE?>");
	if (answer == 1) {
		var url;
		url = "admin_media_codes.php?action=remove&id=" + id;
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
    <td width="50%"><? echo _ADMIN_MEDIA_CODES_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_MEDIA_CODES_TITLE?></h1>
	<br>
	<?
	if ($action!="edit"){ 

		//Display results with paging options
		$ezr->display();
		?>
		<br>
		<form name="addmedia" method="post" action="admin_media_codes.php">
		<table border="0">
		<tr>
		  <td colspan="3"><p class="pform"><h2><? echo _ADMIN_MEDIA_CODES_ADD_NEW?></h2></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
		<tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_1;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="medianame" size="30">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_2;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id1" size="30">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_3;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id2" size="30"></td>
		  <td><a class="aform" href="javascript: submitform('medianame')">
		  <? echo _ADMIN_MEDIA_CODES_ADD?></a></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="add">
		</form>
	<?
	}else{
	?>
		<br>
		<form name="editmedia" method="post" action="admin_media_codes.php">
		<table border="0">
                <tr>
		  <td colspan="3"><p class="pform"><h2><? echo _ADMIN_MEDIA_CODES_UPDATE?></h2></td>
		</tr>
		<tr>
		  <td colspan="3">&nbsp;</td>
		</tr>
                <tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_1;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="medianame" size="30" value="<?echo $media_codes_desc; ?>">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
                <tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_2;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id1" size="30" value="<?echo $id1; ?>">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
                <tr>
		  <td><? echo _ADMIN_MEDIA_CODES_LINE_3;?></td>
		  <td><input type="text" onChange="capitalizeMe(this)" name="id2" size="30" value="<?echo $id2; ?>">&nbsp;</td>
		  <td><a class="aform" href="javascript: submitform('medianame')">
		  <? echo _ADMIN_MEDIA_CODES_ADD?></a></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="id" value="<? echo $media_codes_id; ?>">
		</form>
	<?
	};
	?>
	<br>
	<table>
	<tr>
	  <!-- link to check if media are due within 7 days -->
	  <td width="100%" align="left">
	  <a href="admin_media_codes_2.php" class="aform"><? echo _ADMIN_MANAGE_MEDIA_1_CHECK?></a></td>
	</tr>
	</table>
	<h3><? echo $msgFormErr; ?></h3>
</div>
<? include "admin_maint_tables_menu.inc.php"; ?>
</body>

</html>
