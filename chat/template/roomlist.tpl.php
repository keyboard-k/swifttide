<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD>
<DIV align="center">
  <BODY class="rlist">
  <TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
    <TR>
      <TD align="left">
        <TABLE border="0" cellspacing="0" cellpadding="0">
          <TR valign="bottom">
            <TD>
              <FORM name="changeroom" action="main.php" method="post" target="_parent">
                <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
                <INPUT type="hidden" name="include" value="4">
                <INPUT type="hidden" name="room_password" value="">
                <SELECT name="room_id" class="selects">
                  {OPTIONS}
                </SELECT>
                <INPUT type="button" class="buttons" value="<?=$lng["go"]?>" onclick="parent.goAnotherRoom(document.changeroom.room_id.value); return false;">
              </FORM>
            </TD>
<?
IF($session->config->allow_userrooms==2 || $session->config->allow_userrooms==1 && !($current_user->guest)){
?>
            <TD>
              <FORM action="main.php" method="post" target="_parent">
                <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
                <INPUT type="hidden" name="include" value="8">
                <INPUT type="hidden" name="old_room_id" value="<?=$session->room_id?>">
                <INPUT type="submit" class="buttons" value="<?=$lng["createroom"]?>">
              </FORM>
            </TD>
<?
}
?>
            <TD>
              <FORM>
                <INPUT type="button" class="buttons" value="<?=$lng["smilies"]?>" onclick="parent.smiliesWindow=window.open('main.php?session_id=<?=$session_id?>&include=27','smiliesPopUp','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=1,height=1,left=0,top=0');">
              </FORM>
            </TD>
          </TR>
        </TABLE>
      </TD>
      <TD align="right">
        <TABLE border="0" cellspacing="0" cellpadding="0">
          <TR>
<?
IF($user->level){
  // Show 'Admin' button
?>
            <TD>
              <FORM>
                <INPUT type="button" class="buttons" value="<?=$lng["admin"]?>" onclick="parent.openPopUp('main.php?session_id=<?=$session_id?>&include=13',0,4);" onfocus="parent.focusInput();">
              </FORM>
            </TD>
<?
}
?>
            <TD>
              <FORM action="main.php" method="post" target="_parent">
                <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
                <INPUT type="hidden" name="include" value="9">
                <INPUT type="submit" class="buttons" value="<?=$lng["logout"]?>">
              </FORM>
            </TD>
          </TR>
        </TABLE>
      </TD>
    </TR>
  </TABLE>
</DIV>
</BODY></HTML>