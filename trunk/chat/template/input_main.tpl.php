<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD><BODY class="inputframe" onunload="parent.closeSmiliesWindow(); parent.closePMWindows();">
<DIV align="left">
<TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
  <TR>
    <FORM name="i" onsubmit="parent.post(m.value); m.value=''; return false;">
      <TD>
        <INPUT type="text" class="textinputs" name="m" maxlength="<?=$session->config->input_maxsize?>">
        <INPUT type="submit" class="buttons" value="<?=$lng["say"]?>" name="s">
        &nbsp;&nbsp;&nbsp;
        <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="B" name="bold" onclick="parent.setMessageFlags(1);">
        <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="I" name="italic" onclick="parent.setMessageFlags(2);">
        <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="U" name="underlined" onclick="parent.setMessageFlags(4);">
      </TD>
    </FORM>
    <TD><A href="#" onclick="parent.triggerTimeStamp(); return false;" onFocus="blur();"><IMG src="<?=IMAGEPATH?>/clearpixel.gif" name="timestampbutton" border="0" alt=""></A>&nbsp;<A href="" onclick="parent.triggerSound(); return false;" onFocus="this.blur();"><IMG src="<?=IMAGEPATH?>/clearpixel.gif" name="soundbutton" border="0" alt=""></A></TD>
  </TR>
</TABLE>
</DIV>
</BODY>
</HTML>