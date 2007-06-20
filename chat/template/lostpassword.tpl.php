<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<TITLE><?=$conf[title]?></TITLE>
<?=$css?>
</HEAD>
<BODY>
<DIV align="center">
  <IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="1" height="150" border="0" alt="">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="5">
<?
IF(IS_ARRAY($errortext)){
  FOR($i=0;$i<COUNT($errortext);$i++){
?>
    <TR valign="center">
      <TD class="hforeground" colspan="2" align="center">
        <B><?=$lng["lostpassword"]?></B>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="error" colspan="2">
        <B><?=$errortext[$i]?></B>
      </TD>
    </TR>
<?
  }
}
IF($statustext){
?>
    <FORM name="loginform" action="main.php" method="post">
      <INPUT type="hidden" name="language" value="<?=$language?>">
      <TR valign="center">
        <TD class="hforeground" colspan="2">
          <B><?=$statustext?></B>
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <INPUT type="submit" class="buttons" value="<?=$lng["ok"]?>">
        </TD>
      </TR>
<?
}ELSE{
?>
    <TR valign="center">
      <TD class="hforeground" colspan="2" align="center">
        <B><?=$lng["lostpassword"]?></B>
      </TD>
    </TR>
    <FORM name="loginform" action="main.php" method="post" onload="document.loginform.login.focus(); document.loginform.login.select();">
      <INPUT type="hidden" name="include" value="2">
      <INPUT type="hidden" name="language" value="<?=$language?>">
      <INPUT type="hidden" name="lostpassword" value="1">
      <INPUT type="hidden" name="submitted" value="1">
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["login"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="login" value="<?=$login?>" maxlenght="<?=$session->config->login_length_max?>">
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["email"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="email" value="<?=$email?>" maxlength="255">
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <INPUT type="submit" class="buttons" value="<?=$lng["sendpassword"]?>">
          &nbsp;
          <INPUT type="button" class="buttons" value="<?=$lng["cancel"]?>" onclick="document.loginform.lostpassword.value=''; document.loginform.submit();">
        </TD>
      </TR>
<?
}
?>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
