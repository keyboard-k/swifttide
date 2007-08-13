<?
//*
// admin_backup.php
// Admin Section
// Backup MySQL Table
//*

//Check if Admin is logged in
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
$action = get_param("action");

if (strlen($action))
{
$tables = mysql_list_tables($db);
while ($td = mysql_fetch_array($tables))
{
  $table = $td[0];
  $r = mysql_query("SHOW CREATE TABLE `$table`");
  if ($r)
  {
    $insert_sql = "";
    $d = mysql_fetch_array($r);
    $d[1] .= ";";
    $SQL[] = str_replace("\n", "", $d[1]);
    $table_query = mysql_query("SELECT * FROM `$table`");
    $num_fields = mysql_num_fields($table_query);
    while ($fetch_row = mysql_fetch_array($table_query))
    {
      $insert_sql .= "\nINSERT INTO $table VALUES(";
      for ($n=1;$n<=$num_fields;$n++)
      {
        $m = $n - 1;
        $insert_sql .= "'".mysql_real_escape_string($fetch_row[$m])."', ";
      }
      $insert_sql = substr($insert_sql,0,-2);
      $insert_sql .= ");";
    }
    if ($insert_sql!= "")
    {
      $SQL[] = $insert_sql;
    }
  }
}

// send it to the User

switch ($action) {
case "file":
	// write it to a file called "backup" (is there a better solution?)
	if (!($handle = fopen("backup", 'r+'))) {	// open for read and write
	  print _ADMIN_BACKUP_ERROR_OPENING_FILE;
	}
	rewind($handle);			// go to beginning
	foreach ($SQL as $key=>$val) {
	  fwrite($handle, $val);		// write to file
	}
	fclose($handle);			// close file handle
	break;

case "screen":
	// this is for ouput on screen
	// return implode("\r", $SQL);
	echo implode("\r", $SQL);
	break;

case "download":
	if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	  header('Content-Type: application/force-download');
	else
	  header('Content-Type: application/octet-stream');
	  if(headers_sent())
	    $this->Error('Some data has already been output to browser, can\'t send file');
	  // header('Content-Length: '.strlen($SQL));
	  $name = "backup-" . date("Y-m-d");
	  header('Content-disposition: attachment; filename="'.$name.'"');
	  echo $SQL;
	  break;

default:
	break;
} // end switch

} // end if

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_BACKUP_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><? echo _ADMIN_BACKUP_TITLE?></h1>
	<br>
	<h2><? echo _ADMIN_BACKUP_SUBTITLE?></h2>
	<BR>

	<form name="backup" method="post" action="<?echo($_SERVER['PHP_SELF']);?>">                       
	  <p class="pform">
	    <input type="radio" name="action" value="download" selected="selected"><? echo _ADMIN_BACKUP_DOWNLOAD?><BR>
	    <input type="radio" name="action" value="file"><? echo _ADMIN_BACKUP_FILE?><BR>
	    <input type="radio" name="action" value="screen"><? echo _ADMIN_BACKUP_SCREEN?><BR>
	    <br>

	    <input type="submit" name="submit" value="<? echo _ADMIN_BACKUP_SUBMIT?>"><BR>
	  </p>
	</form>


</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
