<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD><BODY class="inputframe" onunload="parent.closeSmiliesWindow(); parent.firstRun();">
<DIV align="center">
  <TABLE border="0" cellspacing="0" cellpadding="1" width="100%">
    <FORM name="i" onsubmit="parent.post(document.i.m.value); document.i.m.value=''; return false;">
      <TR>
        <TD align="left" colspan="2">
          <INPUT type="text" class="textinputs" name="m" maxlength="<?=$session->config->input_maxsize?>">
        </TD>
      </TR>
      <TR>
        <TD align="left">
          <INPUT type="submit" class="buttons" value="<?=$lng['say']?>" name="s">
          <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="B" name="bold" onclick="parent.setMessageFlags(1);">
          <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="I" name="italic" onclick="parent.setMessageFlags(2);">
          <INPUT type="button" class="buttons" style="font-weight: normal; font-style: normal; dext-decoration: none; width: 20px;" value="U" name="underlined" onclick="parent.setMessageFlags(4);">
        </TD>
        <TD align="right">
          <INPUT type="button" class="buttons" value="<?=$lng["smilies"]?>" onclick="parent.smiliesWindow=window.open('main.php?session_id=<?=$session_id?>&include=27','smiliesPopUp','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=1,height=1,left=0,top=0');">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY></HTML>