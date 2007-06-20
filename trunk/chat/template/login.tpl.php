<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<TITLE><?=$conf[title]?></TITLE>
<?=$css?>
</HEAD>
<BODY onload="document.loginform.login.focus(); document.loginform.login.select();">
<DIV align="center">
<IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="1" height="150" border="0" alt="">
<TABLE class="dforeground" border="0" cellspacing="1" cellpadding="5">
  <FORM name="loginform" action="main.php" method="post">
    <INPUT type="hidden" name="include" value="2">
    <INPUT type="hidden" name="language" value="<?=$language?>">
    <INPUT type="hidden" name="register" value="">
    <INPUT type="hidden" name="lostpassword" value="">
    <INPUT type="hidden" name="admin" value="<?=$admin?>">
<?
IF($errortext){
?>
    <TR valign="center">
      <TD class="error" colspan="2">
        <B><I><?=$errortext?></I></B>
      </TD>
    </TR>
<?
}
?>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <B><?=$lng["login"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <INPUT type="text" class="textinputs" name="login" value="<?=$login?>" maxlength="255">
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <B><?=$lng["password"]?>:</B>
<?
IF($session->config->allow_guests){
?>
        <BR>(<?=$lng["registeredonly"]?>)
<?
}
?>
      </TD>
      <TD class="hforeground" align="left">
        <INPUT type="password" class="textinputs" name="password" maxlength="<?=$session->config->password_length_max?>">
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="center" colspan="2">
        <INPUT type="submit" class="buttons" value="<?=$lng["enter"]?>" onClicK="document.loginform.register.value=0; document.loginform.lostpassword.value=0">
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="center" colspan="2">
        <INPUT type="button" class="buttons" value="<?=$lng["register"]?>" onClick="document.loginform.register.value=1; document.loginform.submit();">
        &nbsp;
        <INPUT type="button" class="buttons" value="<?=$lng["lostpassword"]?>" onClick="document.loginform.lostpassword.value=1; document.loginform.submit();">
      </TD>
    </TR>
  </FORM>
</TABLE>
</DIV>
</BODY>
</HTML>
