<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<SCRIPT>
  function checkBody(){
    if(document.globalmsg.message.value!=""){
      var tmp=document.globalmsg.message.value;
      tmp=tmp.split(" ").join("");
      tmp=tmp.split("\r").join("");
      tmp=tmp.split("\n").join("");
      if(tmp!=""){
        document.globalmsg.submit();
      }
    }
  }
</SCRIPT>
<?=$css?>
</HEAD><BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <FORM name="globalmsg" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <B><?=$lng["postglobalmessage"]?></B>
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["messagetype"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="radio" name="type" value="0" checked>&nbsp;<?=$lng["normal"]?>
          <BR>
          <INPUT type="radio" name="type" value="1">&nbsp;<?=$lng["popup"]?>
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["messagebody"]?>:</B>
          <BR>(<?=$lng["htmlnotallowed"]?>)
        </TD>
        <TD class="hforeground" align="left">
          <TEXTAREA name="message" class="textinputs" rows="10" cols="30"></TEXTAREA>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["post"]?>" onclick="checkBody(); return false;">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
