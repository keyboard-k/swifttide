<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><BODY>
<HEAD>
<?=$css?>
</HEAD>
<DIV align="center">
  <B><?=$lng["smilies"]?></B>
  <BR><BR>
<?
IF($smilies_count){
?>
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <TR valign="center">
      <TD class="hforeground" align="center">
        <B><?=$lng["image"]?></B>
      </TD>
      <TD class="hforeground" align="left">
        <B><?=$lng["textequivalent"]?></B>
      </TD>
      <TD class="hforeground">
        &nbsp;
      </TD>
    </TR>
<?
  FOR($i=0;$i<$smilies_count;$i++){
?>
    <TR valign="center">
      <TD class="hforeground" align="center">
        <IMG src="<?=IMAGEPATH."/smilies/".$smilies[$i][image]?>" border="0" alt="">
      </TD>
      <TD class="hforeground" align="left">
        <?=$smilies[$i][text]?>
      </TD>
      <TD class="hforeground" align="center">
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&smilie_id=<?=$smilies[$i][id]?>"><?=$lng["edit"]?></A>
        &nbsp;
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&delete=1&smilie_id=<?=$smilies[$i][id]?>"><?=$lng["delete"]?></A>
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
  <TABLE class="hforeground" width="90%" border="0" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="error" align="left">
        <B><I><?=$lng["nosmiliesfound"]?></I></B>
      </TD>
    </TR>
  </TABLE>
<?
}
?>
</DIV>
</BODY>
</HTML>
