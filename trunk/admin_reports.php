<?
//*
// admin_reports.php
// Admin Section
// The start of the report section.
// Last edit 11-24-2005, removed Report Cards as an option.  They are now 
// a separate link on the main menu.
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

?>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>

<script language="JavaScript" src="datepicker.js"></script>
<script language="JavaScript">
//<!--
function changeReport() {
	if(document.forms.report_selection.report.value == "students") {
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled  = 0;		
		document.forms.report_selection.sorted_2.selectedIndex = 1;
		document.forms.report_selection.start_date.value = '';
		document.forms.report_selection.start_date.disabled = 1;
		document.forms.report_selection.end_date.value = '';
		document.forms.report_selection.end_date.disabled = 1;
	} else if(document.forms.report_selection.report.value == "attendance") {
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled = 0;
		document.forms.report_selection.start_date.disabled = 0;
		document.forms.report_selection.end_date.value = '';
		document.forms.report_selection.end_date.disabled = 1;
	} else if(document.forms.report_selection.report.value == "discipline") {
		document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_1.disabled  = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		document.forms.report_selection.sorted_2.disabled = 0;
		document.forms.report_selection.start_date.disabled = 0;
		document.forms.report_selection.end_date.disabled = 0;
	} else if(document.forms.report_selection.report.value == "grades") {
	        document.forms.report_selection.sorted_1.selectedIndex = 0;
		document.forms.report_selection.sorted_2.selectedIndex = 0;
		
	}
		
}

function displayReport() {
	var report_type = document.forms.report_selection.report.value;
	var url = "report_" + report_type + ".php?sorted_1=" + 
		document.forms.report_selection.sorted_1.value + 
		"&sorted_2=" + document.forms.report_selection.sorted_2.value + 
		"&start_date=" + document.forms.report_selection.start_date.value + 
		"&end_date=" + document.forms.report_selection.end_date.value;
	window.open(url, "report","scrollbars=yes,menubar=yes,status=no,toolbar=yes,resizable=yes");

	return false;
}
//-->
</script>

</head>
<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2"><b>&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></b></font></td>
    <td width="50%"><b><? echo _ADMIN_REPORTS_UPPER?></b></td>
  </tr>
</table>
</div>

<div id="Content">
<h1><? echo _ADMIN_REPORTS_TITLE?></h1>
<br>
<form name="report_selection" method="POST" action="<?echo($_SERVER['PHP_SELF']);?>">
<table border="0" cellpadding="1" cellspacing="1" width="80%">
<tr class="trform">
<td>
<select name="report" onChange="javascript: changeReport()">
<option value="students"><? echo _ADMIN_REPORTS_STUDENTS?></option>
<option value="attendance"><? echo _ADMIN_REPORTS_ATTENDANCE?></option>
<option value="discipline"><? echo _ADMIN_REPORTS_DISCIPLINE?></option>
<!-- <option value="grades"><? echo _ADMIN_REPORTS_GRADES?></option> -->
</select>
<? echo _ADMIN_REPORTS_SORTED?>
<select name="sorted_1" onChange="javascript: changeSorted_1()">
<option value="school_names_desc"><? echo _ADMIN_REPORTS_SCHOOL?></option>
<option value="grades_id"><? echo _ADMIN_REPORTS_GRADES?></option>
<option value="studentbio_ethnicity"><? echo _ADMIN_REPORTS_ETH?></option>
<option value="studentbio_gender"><? echo _ADMIN_REPORTS_GENDER?></option>
<option value="studentbio_bus"><? echo _ADMIN_REPORTS_ROUTE?></option>
<option value="studentbio_homeroom"><? echo _ADMIN_REPORTS_HOME?></option>
</select>
<? echo _ADMIN_REPORTS_BY?>
<select name="sorted_2" onChange="javascript: changeSorted_2()">
<option value="none"><? echo _ADMIN_REPORTS_NONE?></option>
<option value="school_names_desc"><? echo _ADMIN_REPORTS_SCHOOL?></option>
<option value="grades_id"><? echo _ADMIN_REPORTS_GRADES?></option>
<option value="studentbio_ethnicity"><? echo _ADMIN_REPORTS_ETH?></option>
<option value="studentbio_gender"><? echo _ADMIN_REPORTS_GENDER?></option>
<option value="studentbio_bus"><? echo _ADMIN_REPORTS_ROUTE?></option>
<option value="studentbio_homeroom"><? echo _ADMIN_REPORTS_HOME?></option>
</select>
</td>
</tr>
<tr class="trform"><td><? echo _ADMIN_REPORTS_FROM?> <input type="text" size=10 name="start_date" READONLY onclick="javascript:show_calendar('report_selection.start_date');"><a href="javascript:show_calendar('report_selection.start_date');"><img src="cal.gif" border="0" class="imma"></a> 
<? echo _ADMIN_REPORTS_TO?> <input type="text" size=10 name="end_date" READONLY onclick="javascript:show_calendar('report_selection.end_date');"><a href="javascript:show_calendar('report_selection.end_date');"><img src="cal.gif" border="0" class="imma"></a>
</td></tr>

<tr class="trform">
<td align="right"><input type="submit" name="submit" onClick="return displayReport()" value="<? echo _ADMIN_REPORTS_DOWNLOAD?>" class="frmbut">
</td></tr>
</table>
</form>

</div>
<? include "admin_menu.inc.php"; ?>
</body>

</html>
