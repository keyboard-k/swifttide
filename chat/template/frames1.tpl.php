<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<HTML><HEAD>
<TITLE><?=$session->config->title?></TITLE>
</HEAD>
<FRAMESET rows="*,1" framespacing="0" frameborder="0" marginwidth="0" marginheight="0">
  <FRAME name="main" src="main.php?include=<?=$include?>&session_id=<?=$session_id?>&frame=main&old_room_id=<?=$old_room_id?>&m=<?=$m?>&u=<?=$u?>&t=<?=$t?>&x=<?=$x?>&submitted=<?=$submitted?>" scrolling="auto" noresize marginwidth="0" marginheight="0">
  <FRAME name="refresher" src="main.php?include=<?=$include?>&session_id=<?=$session_id?>&frame=refresher" scrolling="no" noresize marginwidth="0" marginheight="0">
</FRAMESET>
<NOFRAMES>
  Sorry, this chat needs a browser that understands framesets.
</NOFRAMES>
</HTML>