<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<SCRIPT>
  function checkAdvertisement(){
    advertisementWindow=window.open("about:blank");
    advertisementWindow.window.document.open();
    advertisementWindow.window.document.write(document.advertisementform.text.value);
    advertisementWindow.window.document.close();
  }
</SCRIPT>
<?=$css?>
</HEAD><BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
    <FORM name="advertisementform" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="advertisement_id" value="<?=$advertisement_id?>">
      <INPUT type="hidden" name="add" value="1">
      <INPUT type="hidden" name="submitted" value="1">
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <B><?=$lng["addadvertisement"]?></B>
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
          <B><?=$lng["advertisementtext"]?>:</B>
          <BR>(<?=$lng["htmlallowed"]?>)
        </TD>
        <TD class="hforeground" align="left">
          <TEXTAREA name="text" class="textinputs" rows="8" cols="40"><?=$text?></TEXTAREA>
          <BR>
          <INPUT type="button" class="buttons" onclick="checkAdvertisement();" value="<?=$lng["check"]?>">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["start"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <?=$lng["date"]?>:
          <INPUT type="text" class="textinputs" name="start_year" value="<?=$start_year?>" size="3" maxlength="4">
          .&nbsp;<INPUT type="text" class="textinputs" name="start_month" value="<?=$start_month?>" size="1" maxlength="2">
          .&nbsp;<INPUT type="text" class="textinputs" name="start_day" value="<?=$start_day?>" size="1" maxlength="2">
          &nbsp;(<?=$lng["yyyymmdd"]?>)
          <BR><?=$lng["time"]?>:
          <INPUT type="text" class="textinputs" name="start_hour" value="<?=$start_hour?>" size="1" maxlength="2">
          :&nbsp;<INPUT type="text" class="textinputs" name="start_minute" value="<?=$start_minute?>" size="1" maxlength="2">
          :&nbsp;<INPUT type="text" class="textinputs" name="start_second" value="<?=$start_second?>" size="1" maxlength="2">
          &nbsp;(<?=$lng["hhmmss"]?>)
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["stop"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <?=$lng["date"]?>:
          <INPUT type="text" class="textinputs" name="stop_year" value="<?=$stop_year?>" size="3" maxlength="4">
          .&nbsp;<INPUT type="text" class="textinputs" name="stop_month" value="<?=$stop_month?>" size="1" maxlength="2">
          .&nbsp;<INPUT type="text" class="textinputs" name="stop_day" value="<?=$stop_day?>" size="1" maxlength="2">
          &nbsp;(<?=$lng["yyyymmdd"]?>)
          <BR><?=$lng["time"]?>:
          <INPUT type="text" class="textinputs" name="stop_hour" value="<?=$stop_hour?>" size="1" maxlength="2">
          :&nbsp;<INPUT type="text" class="textinputs" name="stop_minute" value="<?=$stop_minute?>" size="1" maxlength="2">
          :&nbsp;<INPUT type="text" class="textinputs" name="stop_second" value="<?=$stop_second?>" size="1" maxlength="2">
          &nbsp;(<?=$lng["hhmmss"]?>)
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["period"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="period" value="<?=$period?>" size="4" maxlength="10">&nbsp;<?=$lng["minutes"]?>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["minimumusersinroom"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="min_roomusers" value="<?=$min_roomusers?>" size="4" maxlength="5">&nbsp;<?=$lng["userssmall"]?>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["alsoshowinprivaterooms"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="radio" name="show_private" value="0" <?=$checked_show_private_0?>>&nbsp;<?=$lng["no"]?>
          <BR>
          <INPUT type="radio" name="show_private" value="1" <?=$checked_show_private_1?>>&nbsp;<?=$lng["yes"]?>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["addadvertisement"]?>">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
