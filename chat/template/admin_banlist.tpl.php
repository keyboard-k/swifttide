<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<SCRIPT>
  var users=false;

  function selectAllUsers(){
    if(users){
      users=false;
    }else{
      users=true;
    }
<?
    FOR($i=0;$i<$banlist_users_count;$i++){
?>
    document.banform.elements["ban_id[<?=$banlist_users[$i][id]?>]"].checked=users;
<?
    }
?>
  }

  var ips=false;

  function selectAllIps(){
    if(ips){
      ips=false;
    }else{
      ips=true;
    }
<?
    FOR($i=0;$i<$banlist_ips_count;$i++){
?>
    document.banform.elements["ban_id[<?=$banlist_ips[$i][id]?>]"].checked=ips;
<?
    }
?>
  }
</SCRIPT>
<?=$css?>
</HEAD><BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="hforeground" align="center">
        <B><?=$lng[banlist]?></B>
      </TD>
    </TR>
  </TABLE>
  <FORM name="banform" action="main.php" mathod="post">
    <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
    <INPUT type="hidden" name="include" value="<?=$include?>">
    <INPUT type="hidden" name="list" value="1">
    <INPUT type="hidden" name="removefromlist" value="1">
<?
IF($banlist_users_count){
  $usr_sortdir_new=$usr_sortdir? 0 : 1;
  // List banned users
?>
    <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
      <TR>
        <TD colspan="3" class="hforeground" align="left">
          <B><?=$lng["bannedusers"]?></B>
        </TD>
      </TR>
      <TR>
        <TD width="20" class="hforeground">&nbsp;</TD>
        <TD class="hforeground" align="left">
          <A href="main.php?include=20&amp;list=1&amp;session_id=<?=$session_id?>&amp;usr_sortby=0&amp;usr_sortdir=<?=$usr_sortdir_new?>&amp;ip_sortby=<?=$ip_sortby?>&amp;ip_sortdir=<?=$ip_sortdir?>">
            <B><?=$lng["username"]?></B>
          </A>
        </TD>
        <TD class="hforeground" align="left">
          <A href="main.php?include=20&amp;list=1&amp;session_id=<?=$session_id?>&amp;usr_sortby=1&amp;usr_sortdir=<?=($usr_sortby==1)? $usr_sortdir_new : 0?>&amp;ip_sortby=<?=$ip_sortby?>&amp;ip_sortdir=<?=$ip_sortdir?>">
            <B><?=$lng["bannedsince"]?></B>
          </A>
        </TD>
      </TR>
<?
  FOR($i=0;$i<$banlist_users_count;$i++){
?>
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="checkbox" name="ban_id[<?=$banlist_users[$i][id]?>]">
        </TD>
        <TD class="hforeground" align="left">
          <?=$banlist_users[$i][name]?>
        </TD>
        <TD class="hforeground" align="left">
          <?=$banlist_users[$i][bandate]?>
        </TD>
      </TR>
<?
  }
?>
      <TR>
        <TD class="hforeground" align="left" colspan="3">
          <A href="" onclick="selectAllUsers(); return false;"><?=$lng["de_activateall"]?></A>
        </TD>
      </TR>
    </TABLE>
    <BR>
<?
}ELSE{
  // No banned users
?>
    <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
      <TR>
        <TD class="error" align="left">
          <B><I><?=$lng["nobannedusers"]?></I></B>
        </TD>
      </TR>
    </TABLE>
    <BR>
<?
}
IF($banlist_ips_count){
  $ip_sortdir_new=$ip_sortdir? 0 : 1;
  // List banned IP addresses
?>
    <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
      <TR>
        <TD colspan="3" class="hforeground" align="center">
          <B><?=$lng["bannedips"]?></B>
        </TD>
      </TR>
      <TR>
        <TD width="20" class="hforeground">&nbsp;</TD>
        <TD class="hforeground" align="left">
          <A href="main.php?include=20&amp;list=1&amp;session_id=<?=$session_id?>&amp;ip_sortby=0&amp;ip_sortdir=<?=$ip_sortdir_new?>&amp;usr_sortby=<?=$usr_sortby?>&amp;usr_sortdir=<?=$usr_sortdir?>">
            <B><?=$lng["ipaddress"]?></B>
          </A>
        </TD>
        <TD class="hforeground" align="left">
          <A href="main.php?include=20&amp;list=1&amp;session_id=<?=$session_id?>&amp;ip_sortby=1&amp;ip_sortdir=<?=($ip_sortby==1)? $ip_sortdir_new : 0?>&amp;usr_sortby=<?=$usr_sortby?>&amp;usr_sortdir=<?=$usr_sortdir?>">
            <B><?=$lng["bannedsince"]?></B>
          </A>
        </TD>
      </TR>
<?
  FOR($i=0;$i<$banlist_ips_count;$i++){
?>
      <TR>
        <TD class="hforeground" align="center">
          <INPUT type="checkbox" name="ban_id[<?=$banlist_ips[$i][id]?>]">
        </TD>
        <TD class="hforeground" align="left">
          <?=$banlist_ips[$i][ip]?>
        </TD>
        <TD class="hforeground" align="left">
          <?=$banlist_ips[$i][bandate]?>
        </TD>
      </TR>
<?
  }
?>
      <TR>
        <TD class="hforeground" align="left" colspan="3">
          <A href="" onclick="selectAllIps(); return false;"><?=$lng["de_activateall"]?></A>
        </TD>
      </TR>
    </TABLE>
    <BR>
<?
}ELSE{
  // No banned IP addresses
?>
    <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
      <TR>
        <TD class="error" align="left">
          <B><I><?=$lng["nobannedips"]?></I></B>
        </TD>
      </TR>
    </TABLE>
    <BR>
<?
}
IF($banlist_users_count||$banlist_ips_count){
?>
    <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
      <TR>
        <TD class="hforeground" colspan="3" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["removeselectedfrombanlist"]?>">
        </TD>
      </TR>
    </TABLE>
<?
}
?>
  </FORM>
</DIV>
</BODY>
</HTML>
