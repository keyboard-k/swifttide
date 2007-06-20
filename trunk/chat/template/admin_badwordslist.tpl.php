<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD>
<DIV align="center">
<TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
  <TR valign="center">
    <TD class="hforeground" align="center" colspan="3">
      <B><?=$lng["badwords"]?></B>
    </TD>
  </TR>
<?
IF($badwords_count){
?>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <B><?=$lng["badword"]?></B>
      </TD>
      <TD class="hforeground" align="left">
        <B><?=$lng["replacement"]?></B>
      </TD>
      <TD class="hforeground">
        &nbsp;
      </TD>
    </TR>
<?
  FOR($i=0;$i<$badwords_count;$i++){
?>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$badwords[$i][word]?>
      </TD>
      <TD class="hforeground" align="left">
        <?=$badwords[$i][replacement]?>
      </TD>
      <TD class="hforeground" align="center">
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&badword_id=<?=$badwords[$i][id]?>"><?=$lng["edit"]?></A>
        &nbsp;
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&delete=1&badword_id=<?=$badwords[$i][id]?>"><?=$lng["delete"]?></A>
      </TD>
    </TR>
<?
  }
?>
  </TABLE>
  <BR><BR>
<?
}ELSE{
?>
  <TABLE class="dforeground" width="90%" border="0" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="error" align="left">
        <B><I><?=$lng["nobadwordsfound"]?></I></B>
      </TD>
    </TR>
  </TABLE>
<?
}
?>
</DIV>
</BODY>
</HTML>
