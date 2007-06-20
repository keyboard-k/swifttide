<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML><HEAD>
<TITLE><?=$session->config->title?>: <?=$lng["admin"]?></TITLE>
</HEAD>
<FRAMESET cols="20%,*" framespacing="1" frameborder="1" marginwidth="0" marginheight="0" onload="window.focus();">
  <FRAME name="left" src="main.php?include=14&session_id=<?=$session_id?>" scrolling="auto" marginwidth="0" marginheight="0">
  <FRAME name="main" src="main.php?include=15&session_id=<?=$session_id?>" scrolling="auto" marginwidth="0" marginheight="0">
</FRAMESET>
<NOFRAMES>
  Sorry, this chat needs a browser that understands framesets.
</NOFRAMES>
</HTML>