<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD><BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <FORM name="smilieform" action="main.php" method="post" enctype="multipart/form-data">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="smilie_id" value="<?=$smilie_id?>">
      <INPUT type="hidden" name="add" value="<?=$add?>">
      <INPUT type="hidden" name="edit" value="<?=$edit?>">
      <INPUT type="hidden" name="submitted" value="1">
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <B><?=$lng["addsmilie"]?></B>
        </TD>
      </TR>
<?
IF(IS_ARRAY($error)){
  FOR($i=0;$i<COUNT($error);$i++){
?>
      <TR>
        <TD class="error" colspan="2" align="left">
          <B><I><?=$error[$i]?></I></B>
        </TD>
      </TR>
<?
  }
}
?>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["textequivalent"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="text" value="<?=$text?>" size="5" maxlength="64">
        </TD>
      </TR>
<?
IF(!$edit){
?>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["smilieimage"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="file" name="smiliefile">
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["save"]?>">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
