<?php
//*
//* admin_books_2.php
//* processes book order
//*

session_start();
//Inizialize databse functions
include_once "ez_sql.php";
//Include global functions
include_once "common.php";
// config
include_once "configuration.php";

$isbn = get_param("isbn");
$sub_id = get_param("sub_id");

$ending = array( 'en'=>'com', 'de'=>'de');
$url = 'http://webservices.amazon.' . $ending[_LANG] . '/onca/xml?Service=AWSECommerceService&SubscriptionId=' . $sub_id . '&Operation=ItemLookup&IdType=ASIN&ItemId=' . $isbn . '&MerchantId=All&ResponseGroup=Large' ;

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
</SCRIPT>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_BOOKS_2_ADMIN_AREA?></td>
  </tr>
</table>
</div>

<div id="Content">
	<h1><?php echo _ADMIN_BOOKS_2_TITLE?></h1>
	<br>
	<h2><?php echo _ADMIN_BOOKS_2_SUBTITLE?></h2>
	<br>
	<table border="0">
	<?php
	// echo $url . "<BR><BR>";
	$info = file($url);
	$lines = explode("<",$info[0]);

	foreach ($lines as $linenumber => $line) {
	  // check for TITLE
	  if (preg_match ("/\btitle\b>(.+)/i", $line, $hit)) { $booktitle = $hit[1]; break; }
	}

	foreach ($lines as $linenumber => $line) {
	  // check for PUBLISHER
	  if (preg_match ("/\bpublisher\b>(.+)/i", $line, $hit)) { $bookpublisher = $hit[1]; break; }
	}

	foreach ($lines as $linenumber => $line) {
	  // check for SUMMARY
	  if (preg_match ("/\bsummary\b>(.+)/i", $line, $hit)) { $booksummary = $hit[1]; break; }
	}

	?>

	<form name="orderbooks" method="post" action="admin_books_3.php">
	  <table cellpadding=0>
	  <tr>
	    <td colspan="2"><?php echo "<b>" . _ADMIN_BOOKS_2_ISBN . ":</b> " . $isbn;?></td></tr>
	  <tr>
	    <td colspan="2"><?php echo "<b>" . _ADMIN_BOOKS_2_BOOKTITLE . ":</b> " . $booktitle?></td></tr>
	  <tr>
	    <td colspan="2"><?php echo "<b>" . _ADMIN_BOOKS_2_BOOKPUBLISHER . ":</b> " . $bookpublisher?></td></tr>
	  <tr>
	    <td colspan="2"><?php echo "<b>" . _ADMIN_BOOKS_2_BOOKSUMMARY . ":</b> " . $booksummary?></td></tr>
	  </table>
	  <table>
	  <tr>
	    <td><?php echo _ADMIN_BOOKS_2_QUANTITY?></td>
	    <td class=tdinput><input type="text" name="quantity" size="5" value="10"></td></tr>
	  <tr>
	    <td><?php echo _ADMIN_BOOKS_2_SCHOOLNAME?></td>
	    <td class=tdinput><input type="text" name="schoolname" size="50" value=""></td></tr>
	  <tr>
	    <td><?php echo _ADMIN_BOOKS_2_SCHOOLADDRESS?></td>
	    <td class=tdinput><input type="text" name="schooladdress" size="50" value=""></td></tr>
	  <tr>
	    <td><?php echo _ADMIN_BOOKS_2_SCHOOLADDRESS2?></td>
	    <td class=tdinput><input type="text" name="schooladdress2" size="50" value=""></td></tr>
	  <tr>
	    <td colspan="2"><a class="aform" href="javascript: submitform('isbn')"><?php echo _ADMIN_BOOKS_2_ORDER?></a></td></tr>
	  </table>
	<input type="hidden" name="isbn" value="<?php echo $isbn?>">
	<input type="hidden" name="booktitle" value="<?php echo $booktitle?>">
	<input type="hidden" name="bookpublisher" value="<?php echo $bookpublisher?>">
	<input type="hidden" name="booksummary" value="<?php echo $booksummary?>">
	<input type="hidden" name="sub_id" value="<?php echo $sub_id?>">
	</form>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
