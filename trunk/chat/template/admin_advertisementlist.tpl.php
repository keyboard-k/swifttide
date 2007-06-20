<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>

<SCRIPT>
  function checkAdvertisement(advertisementHTML){
    advertisementHTML=advertisementHTML.split("|_/CR_|").join("\r");
    advertisementHTML=advertisementHTML.split("|_/LF_|").join("\n");
    advertisementWindow=window.open("about:blank", "advertisement_test", "fullscreen=no, toolbar=no, status=no, menubar=no, scrollbars=auto, resizable=yes, directories=no, width=600, height=400");
    advertisementWindow.window.document.open();
    advertisementWindow.window.document.write(advertisementHTML);
    advertisementWindow.window.document.close();
    advertisementWindow.window.focus();
  }
</SCRIPT>
</HEAD>
<BODY>
<DIV align="center">
  <TABLE class="dforeground" width="90%" border="0" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="hforeground" align="center" colspan="2">
        <B><?=$lng["advertisements"]?></B>
      </TD>
    </TR>
  </TABLE>
  <BR><BR>
<?
IF($advertisements_count){
  FOR($i=0;$i<$advertisements_count;$i++){
?>
  <TABLE class="dforeground" width="90%" border="0" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="hforeground" align="left" colspan="2">
        <?=HTMLENTITIES($advertisements[$i][text])?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left" width="50%">
        <B><?=$lng["start"]?>:</B>
      </TD>
      <TD class="hforeground" align="left" width="50%">
        <?=common::convertDateFromTimestamp(&$session,$advertisements[$i][start])?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["stop"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=common::convertDateFromTimestamp(&$session,$advertisements[$i][stop])?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["period"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=$advertisements[$i][period]?>&nbsp;<?=$lng["minutes"]?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["minimumusersinroom"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=$advertisements[$i][min_roomusers]?>&nbsp;<?=$lng["userssmall"]?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["alsoshowinprivaterooms"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=STR_REPLACE("0",$lng["no"],STR_REPLACE("1",$lng["yes"],$advertisements[$i][show_private]))?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="center" colspan="2">
        <A href="#" onclick="checkAdvertisement('<?=STR_REPLACE("\n","|_/LF_|",STR_REPLACE("\r","|_/CR_|",HTMLENTITIES($advertisements[$i][text])))?>');"><?=$lng["check"]?></A>
        &nbsp;
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&advertisement_id=<?=$advertisements[$i][id]?>"><?=$lng["edit"]?></A>
        &nbsp;
        <A href="main.php?session_id=<?=$session_id?>&include=<?=$include?>&edit=1&delete=1&advertisement_id=<?=$advertisements[$i][id]?>"><?=$lng["delete"]?></A>
      </TD>
    </TR>
  </TABLE>
  <BR><BR>
<?
  }
}ELSE{
?>
  <TABLE class="dforeground" width="90%" border="0" cellspacing="0" cellpadding="6">
    <TR>
      <TD class="error">
        <B><I><?=$lng["noadvertisementsfound"]?></I></B>
      </TD>
    </TR>
  </TABLE>
<?
}
?>
</DIV>
</BODY>
</HTML>
