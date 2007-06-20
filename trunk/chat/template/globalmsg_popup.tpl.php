<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
<TITLE><?=STR_REPLACE("{USER}",$sender->login,$lng["globalmessageby"])?></TITLE>
</HEAD>
<BODY>
<DIV align="center">
  <B><?=STR_REPLACE("{USER}",$sender->login,$lng["globalmessageby"])?></B>
  <BR>
</DIV>
<BR>
<?=NL2BR($message['body'])?>
<BR><BR>
<DIV align="center">
  <A href="" onclick="window.close(); return false;"><?=$lng["closewindow"]?></A>
</DIV>
</BODY>
</HTML>