<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML>
<HEAD>
<SCRIPT>
  function answer(status){
    document.invite.response.value=status;
    document.invite.submit();
  }
</SCRIPT>
<?=$css?>
</HEAD>
<BODY onload="window.focus();">
<DIV align="center">
  <IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="1" height="30" border="0" alt="">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
<?
IF($message){
?>
      <TR>
        <TD class="hforeground" align="center">
          <?=STR_REPLACE("{USER}","<B><FONT color=\"#$color\">".$login."</FONT></B>",$message)?>
          <BR><BR>
          <INPUT type="button" class="buttons" value="<?=$lng["closewindow"]?>" onClick="window.close();">
        </TD>
      </TR>
<?
}ELSEIF($invited){
?>
    <FORM name="invite" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="user_id" value="<?=$user_id?>">
      <INPUT type="hidden" name="room_id" value="<?=$room_id?>">
      <INPUT type="hidden" name="invited" value="1">
      <INPUT type="hidden" name="response" value="">
      <TR valign="center">
        <TD class="hforeground" align="center">
          <?=STR_REPLACE("{USER}","<B><FONT color=\"#$color\">".$login."</FONT></B>",STR_REPLACE("{ROOM}","<B>".$roomname."</B>",$lng["youwereinvited"]))?>
          <BR><BR>
          <INPUT type="button" class="buttons" value="<?=$lng["acceptinvitation"]?>" onclick="answer(1);">
          <INPUT type="button" class="buttons" value="<?=$lng["rejectinvitation"]?>" onclick="answer(0);">
        </TD>
      </TR>
    </FORM>
<?
}ELSEIF(!$do_invite){
?>
    <FORM name="invite" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="user_id" value="<?=$user_id?>">
      <INPUT type="hidden" name="do_invite" value="1">
      <TR valign="center">
        <TD class="hforeground" align="center">
          <?=STR_REPLACE("{USER}","<B><FONT color=\"#$color\">".$login."</FONT></B>",$lng["inviteuser"])?>
          <BR><BR>
          <INPUT type="submit" class="buttons" value="<?=$lng["yes"]?>">
          &nbsp;
          <INPUT type="button" class="buttons" value="<?=$lng["no"]?>" onClick="window.close();">
        </TD>
      </TR>
    </FORM>
<?
}ELSE{
?>
    <TR valign="center">
      <TD class="hforeground" align="center">
        <?=STR_REPLACE("{USER}","<B><FONT color=\"#$color\">".$login."</FONT></B>",$lng["userinvited"])?>
        <BR><BR>
        <INPUT type="button" class="buttons" value="<?=$lng["closewindow"]?>" onClick="window.close();">
      </TD>
    </TR>
<?
}
?>
  </TABLE>
</DIV>
</BODY></HTML>