<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD><BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
    <FORM name="banform" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="profile_user_id" value="<?=$profile_user_id?>">
      <INPUT type="hidden" name="do_ban" value="1">
      <TR>
        <TD class="hforeground">
          <B><?=$lng[ban]?></B>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground">
          &nbsp;
        </TD>
      </TR>
      <TR>
        <TD class="hforeground">
<?
IF($user->guest){
  // Guest's username cannot be banned
  $disabled="disabled";
  $checked="";
}ELSE{
  $disabled="";
  $checked="checked";
}
?>
          <INPUT type="checkbox" name="user_id" value="<?=$profile_user_id?>" <?=$checked?> <?=$disabled?>>
          &nbsp;
          <B><?=$lng["banuser"]?>: <?=$user->login?></B>
        </TD>
      </TR>
<?
IF($user->ip){
?>
      <TR>
        <TD class="hforeground">
          <INPUT type="checkbox" name="ip" value="<?=$user->ip?>" checked>
          &nbsp;
          <B><?=$lng["banip"]?>: <?=$user->ip?></B>
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground">
          &nbsp;
        </TD>
      </TR>
      <TR>
        <TD class="hforeground">
          <INPUT type="submit" class="buttons" value="<?=$lng["ban"]?>">
          &nbsp;
          <INPUT type="button" class="buttons" value="<?=$lng["cancel"]?>" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=11&ban=1'">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
