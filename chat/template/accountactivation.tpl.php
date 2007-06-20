<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<TITLE><?=$session->config->title?></TITLE>
<?=$css?>
</HEAD>
<BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
<?
IF($password_changed){
?>
    <FORM name="profileform" action="main.php" method="post">
      <INPUT type="hidden" name="language" value="<?=$language?>">
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <B><?=$lng["passchanged"]?></B>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["ok"]?>">
        </TD>
      </TR>
<?
}ELSE{
?>
      <TR>
        <TD colspan="2" class="hforeground" align="center">
          <B><?=$lng["accountactivation"]?></B>
        </TD>
      </TR>
<?
  IF(IS_ARRAY($errortext)){
    FOR($i=0;$i<COUNT($errortext);$i++){
?>
      <TR>
        <TD colspan="2" class="error" align="left">
          <B><?=$errortext[$i]?></B>
        </TD>
      </TR>
<?
    }
  }
?>
    <FORM name="profileform" action="main.php" method="post">
      <INPUT type="hidden" name="language" value="<?=$language?>">
      <INPUT type="hidden" name="include" value="2">
      <INPUT type="hidden" name="confirm" value="1">
      <INPUT type="hidden" name="a" value="<?=$a?>">
      <INPUT type="hidden" name="id" value="<?=$id?>">
      <INPUT type="hidden" name="type" value="<?=$type?>">
      <INPUT type="hidden" name="submitted" value="1">
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["newpass"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="password" class="textinputs" name="new_password_1" maxlength="<?=$session->config->password_length_max?>">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["newpassagain"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="password" class="textinputs" name="new_password_2" maxlength="<?=$session->config->password_length_max?>">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["savechanges"]?>">
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
