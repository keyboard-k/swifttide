<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><BODY>
<HEAD>
<?=$css?>
</HEAD>
<DIV align="center">
  <B><?=$lng["chatstatistics"]?></B>
  <BR><BR>
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6" width="90%">
    <TR valign="center">
      <TD class="hforeground" colspan="2" align="center">
        <B><?=$lng["users"]?></B>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["registeredusers"]?>:
      </TD>
      <TD class="hforeground" width="40" align="right">
        <?=$registered_users_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["registeredusersonline"]?>:
      </TD>
      <TD class="hforeground" align="right">
        <?=$registered_users_online_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["guestsonline"]?>:
      </TD>
      <TD class="hforeground" align="right">
        <?=$guests_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <B><?=$lng["totalusersonline"]?>:</B>
      </TD>
      <TD class="hforeground" align="right">
        <B><?=$total_users_online_count?></B>
      </TD>
    </TR>
  </TABLE>
  <BR><BR>
  <TABLE class="dforegroud" border="0" cellspacing="1" cellpadding="6" width="90%">
    <TR valign="center">
      <TD class="hforeground" colspan="2" align="center">
        <B><?=$lng["rooms"]?></B>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["mainroomsnopass"]?>:
      </TD>
      <TD class="hforeground" width="40" align="right">
        <?=$main_rooms_no_pass_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["mainroomspass"]?>:
      </TD>
      <TD class="hforeground" align="right">
        <?=$main_rooms_pass_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["userroomsnopass"]?>:
      </TD>
      <TD class="hforeground" align="right">
        <?=$user_rooms_no_pass_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <?=$lng["userroomspass"]?>:
      </TD>
      <TD class="hforeground" align="right">
        <?=$user_rooms_pass_count?>
      </TD>
    </TR>
    <TR valign="center">
      <TD class="hforeground" align="left">
        <B><?=$lng["totalrooms"]?>:</B>
      </TD>
      <TD class="hforeground" align="right">
        <B><?=$total_rooms_count?></B>
      </TD>
    </TR>
  </TABLE>
<?
IF($need_optimization){
?>
  <BR><BR>
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6" width="90%">
    <FORM action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="optimize_db" value="1">
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["optimizedatabase"]?>">
        </TD>
      </TR>
    </FORM>
  </TABLE>
<?
}
?>
</DIV>
</BODY>
</HTML>
