<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><HEAD>
<TITLE><?=$session->config->title?></TITLE>
<?=$css?>
</HEAD>
<BODY onload="document.loginform.submit_button.focus();">
<DIV align="center">
  <IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="1" height="150" border="0" alt="">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <FORM name="loginform" action="main.php" method="post">
      <INPUT type="hidden" name="admin" value="<?=$admin?>">
      <TR>
        <TD class="hforeground">
          Choose your language:
          <SELECT name="language" class="selects">
<?
FOREACH($lng_array AS $lng_filename){
  $selected=($lng_filename==$language)? 'selected' : '';
?>
            <OPTION value="<?=SUBSTR($lng_filename, 0, -8)?>" <?=$selected?>><?=UCFIRST(SUBSTR($lng_filename, 0, -8))?></OPTION>
<?
}
?>
          </SELECT>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="submit" name="submit_button" class="buttons" style="width:50px" value="GO">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
