<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML><HEAD>
<TITLE><?=STR_REPLACE("{USER}",$target_user->login,$lng["talkprivateto"])?></TITLE>
<?
/* Load JavaScript */
REQUIRE(SCRIPTPATH."/frames_pm.js.php");
?>
</HEAD>
<FRAMESET rows="*,60,1" framespacing="0" frameborder="0" marginwidth="0" marginheight="0" onload="firstRun();" onUnload="closeThisWindow();">
  <FRAME name="main" src="about:blank" scrolling="auto" noresize marginwidth="0" marginheight="0">
  <FRAME name="input" src="main.php?include=4&session_id=<?=$session_id?>&frame=i&t=2" scrolling="no" noresize marginwidth="0" marginheight="0">
  <FRAME name="dummyform" src="main.php?include=30&session_id=<?=$session_id?>" scrolling="no" noresize marginwidth="0" marginheight="0">
</FRAMESET>
<NOFRAMES>
  Sorry, this chat needs a browser that understands framesets.
</NOFRAMES>
</HTML>