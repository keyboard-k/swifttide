<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD>
<BODY onload="window.focus();">
<DIV align="center">
  <TABLE class="dforeground" border="0" width="100%" cellspacing="1" cellpadding="6">
    <FORM name="photo_upload" action="main.php" method="post" enctype="multipart/form-data">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="back" value="<?=$back?>">
      <INPUT type="hidden" name="profile_user_id" value="<?=$profile_user_id?>">
      <INPUT type="hidden" name="submitted" value="1">
      <TR>
        <TD class="hforeground" align="center">
          <B><?=$lng["photoupload"]?></B>
        </TD>
      </TR>
<?
IF($errortext){
?>
      <TR>
        <TD class="error" align="center">
          <B><?=$errortext?></B>
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="file" name="photo">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="Save changes">
          &nbsp;
          <INPUT type="button" class="buttons" value="<?=$lng["cancel"]?>" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=<?=$back?>&profile_user_id=<?=$profile_user_id?>';">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
