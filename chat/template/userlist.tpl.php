<HTML><HEAD>
<META http-equiv="Content-Language" content="<?=$ISO_639_LNG?>">
<META http-equiv="Content-Type" content="text/html; charset=<?=$lng["charset"]?>">
<?=$css?>
</HEAD>
<BODY class="ulist">
<TABLE border="0" cellspacing="3" cellpadding="0" width="100%">
  <TR>
    <TD align="center">
      <B><?=$roomname?></B>
    </TD>
  </TR>
</TABLE>
<BR>
<TABLE border="0" cellspacing="3" cellpadding="0">
  {USERS}
</TABLE>
<BR><BR>
<TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
  <TR valign="center">
    <FORM action="main.php" method="post" target="chat_users">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="11">
      <TD align="center">
        <INPUT type="button" class="buttons" value="<?=$lng["memberlist"]?>" onclick="parent.openPopUp('main.php?include=11&session_id=<?=$session_id?>',0,3);">
      </TD>
    </FORM>
  </TR>
</TABLE>
</BODY></HTML>