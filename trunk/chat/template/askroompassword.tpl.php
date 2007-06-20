<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<TITLE><?=$conf[title]?></TITLE>
<?=$css?>
</HEAD>
<BODY onload="document.loginform.t.focus();">
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <FORM name="loginform" action="main.php" method="post" target="_parent">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="m" value="<?=$m?>">
      <INPUT type="hidden" name="u" value="<?=$u?>">
      <INPUT type="hidden" name="x" value="<?=$x?>">
      <INPUT type="hidden" name="submitted" value="1">
      <TR>
        <TD class="hforeground" align="center">
          <B><?=STR_REPLACE("{ROOM}",$roomname,$lng["enterroompassword"])?></B>
        </TD>
      </TR>
<?
IF($errortext){
?>
      <TR>
        <TD class="error" align="center">
          <B><I><?=$errortext?></I></B>
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="password" class="textinputs" name="t" size="12" maxlength="32">
          &nbsp;<INPUT type="submit" class="buttons" value="<?=$lng["go"]?>">
        </TD>
      </TR>
      <TR>
        <TD align="center" class="hforeground">
          <INPUT type="button" class="buttons" value="<?=$lng["cancel"]?>" onclick="parent.window.location.href='main.php?session_id=<?=$session_id?>&include=<?=$x?>&room_id=<?=$u?>';">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
