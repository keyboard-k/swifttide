<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<TITLE><?=$lng['memberlist']?></TITLE>
<?=$css?>
</HEAD><BODY onload="window.focus();">
<?
IF($total_pages>1){
  FOR($i=1; $i<=$total_pages; $i++){
    IF($i==$page){
      ECHO "&nbsp;&nbsp;<b>$i</b>";
    }ELSE{
?>
&nbsp;&nbsp;<a href="main.php?include=11&session_id=<?=$session_id?>&amp;page=<?=$i?>&amp;orderby=<?=$orderby?>&amp;edit=<?=$edit?>&amp;kick=<?=$kick?>&amp;ban=<?=$ban?>"><b><?=$i?></b></a>
<?
    }
  }
?>
<?
}
?>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6" width="100%">
    <TR valign="center">
      <TD class="hforeground" align="left">
        <A href="main.php?session_id=<?=$session_id?>&orderby=us.login ASC&include=<?=$include?>&edit=<?=$edit?>&kick=<?=$kick?>&ban=<?=$ban?>&admin=<?=$admin?>"><?=$lng["username"]?></A>
      </TD>
      <TD class="hforeground" align="left">
        <B><?=$lng["status"]?></B>
      </TD>
      <TD class="hforeground">&nbsp;</TD>
      <TD class="hforeground" align="left">
        <B><?=$lng["realname"]?></B>
      </TD>
      <TD class="hforeground" align="left">
        <B><?=$lng["email"]?></B>
      </TD>
      <TD class="hforeground" align="left">
        <A href="main.php?session_id=<?=$session_id?>&orderby=us.joined ASC,us.login ASC&include=<?=$include?>&edit=<?=$edit?>&kick=<?=$kick?>&ban=<?=$ban?>&admin=<?=$admin?>"><?=$lng["joined"]?></A>
      </TD>
      <TD class="hforeground" align="left">
        <A href="main.php?session_id=<?=$session_id?>&orderby=us.last_login ASC,us.login ASC&include=<?=$include?>&edit=<?=$edit?>&kick=<?=$kick?>&ban=<?=$ban?>&admin=<?=$admin?>"><B>Last login</B></A>
      </TD>
    </TR>
<?
FOR($i=0;$i<$userlist_count;$i++){
  // Get user's session ID
  $session2=NEW session($session->getUsersSession($userlist[$i][id]));
  // IP address
  IF($show_ip){
    IF($session2->ip){
      $ip=" [<A href=\"\" class=\"links\" onClick=\"window.open('http://network-tools.com/default.asp?prog=trace&Netnic=whois.arin.net&host=".$session2->ip."', 'whois', 'width=800, height=600, resizable=yes, scrollbars=yes'); return false;\">".$session2->ip."</A>]";
    }ELSE{
      $ip="[?]";
    }
  }ELSE{
    $ip="";
  }
?>
    <TR>
      <TD class="hforeground" align="left">
        <FONT color="#<?=$userlist[$i][color]?>"><?=$userlist[$i][login]?></FONT>
      </TD>
<?
  IF($userlist[$i]['online']&&!$session2->kicked){
?>
      <TD class="hforeground" align="left">
        <B><?=$lng["online"]?></B> <?=$ip?>
      </TD>
<?
  }ELSE{
?>
      <TD class="hforeground">
        &nbsp;
      </TD>
<?
  }
  IF($edit){
?>
      <TD class="hforeground" align="center">
<?
    IF($session->user_id<>$userlist[$i]['id'] && $userlist[$i]['level']<131071){
?>
        <INPUT type="button" class="buttons" value="<?=$lng["edit"]?>" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=18&profile_user_id=<?=$userlist[$i][id]?>';">
        <INPUT type="button" class="buttons" value="<?=$lng["delete"]?>" onclick="if(confirm('<?=STR_REPLACE("'","\\'",STR_REPLACE("{USER}",$userlist[$i][login],$lng["confirmdeleteuser"]))?>')){window.location.href='main.php?session_id=<?=$session_id?>&include=18&profile_user_id=<?=$userlist[$i][id]?>&delete=1';}">
<?
    }ELSE{
?>
        &nbsp;
<?
    }
?>
      </TD>
<?
  }ELSEIF($kick&&$userlist[$i]['online'] && $userlist[$i]['id']<>$session->user_id && $userlist[$i]['level']<131071){
    IF(!$session2->kicked){
?>
      <TD class="hforeground" align="center">
        <INPUT type="button" class="buttons" value="<?=$lng["kick"]?>" onclick="if(confirm('<?=STR_REPLACE("'","\\'",STR_REPLACE("{USER}",$userlist[$i][login],$lng["confirmkickuser"]))?>')){window.location.href='main.php?session_id=<?=$session_id?>&include=19&profile_user_id=<?=$userlist[$i][id]?>';}">
        <BR>
        <INPUT type="button" class="buttons" value="<?=$lng["ban"]?>" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=20&profile_user_id=<?=$userlist[$i][id]?>';">
      </TD>
<?
    }ELSE{
?>
      <TD class="hforeground">&nbsp;</TD>
<?
    }
  }ELSEIF($ban && $userlist[$i]['id']<>$session->user_id && $userlist[$i]['level']<131071){
?>
      <TD class="hforeground" align="center">
        <INPUT type="button" class="buttons" value="<?=$lng["ban"]?>" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=20&profile_user_id=<?=$userlist[$i][id]?>';">
      </TD>
<?
  }ELSEIF(!$admin&&$userlist[$i][online]&&$session->getUsersRoom($userlist[$i][id])>0&&$session->room_id>0&&$session->room_id<>$session->getUsersRoom($userlist[$i][id])){
?>
      <TD class="hforeground" align="center">
        <A href="" onClick="window.open('main.php?session_id=<?=$session_id?>&include=12&user_id=<?=$userlist[$i][id]?>','invitation_<?=$userlist[$i][id]?>','width=300,height=200'); return false;"><?=$lng["invite"]?></A>
        <BR>
        <A href="" onClick="window.open('main.php?session_id=<?=$session_id?>&include=5&profile_user_id=<?=$userlist[$i][id]?>','pr<?=$userlist[$i][id]?>','width=500,height=500,top=1,resizable=yes,scrollbars=yes'); return false;"><?=$lng["profile"]?></A>
      </TD>
<?
  }ELSE{
?>
      <TD class="hforeground" align="center">
        <A href="" onClick="window.open('main.php?session_id=<?=$session_id?>&include=5&profile_user_id=<?=$userlist[$i][id]?>','pr<?=$userlist[$i][id]?>','width=500,height=500,top=1,resizable=yes,scrollbars=yes'); return false;"><?=$lng["profile"]?></A>
      </TD>
<?
  }
?>
      <TD class="hforeground" align="left">
        <?=$userlist[$i][name]?>
      </TD>
<?
  IF(!$userlist[$i][hide_email]||$edit&&$current_user->level&8){
?>
      <TD class="hforeground" align="left">
        <?=$userlist[$i][email]?>
      </TD>
<?
  }ELSE{
?>
      <TD class="hforeground">&nbsp;</TD>
<?
  }
?>
      <TD class="hforeground" align="left">
        <?=common::convertDateFromTimestamp($session,$userlist[$i][joined])?>
      </TD>
      <TD class="hforeground" align="left">
<?
  IF($userlist[$i][last_login]>'0000-00-00 00:00:00'){
    ECHO common::convertDateFromTimestamp($session,$userlist[$i][last_login]);
  }ELSE{
    ECHO '--';
  }
?>
      </TD>
    </TR>
<?
}
?>
  </TABLE>
</DIV>
<?
IF($total_pages>1){
  FOR($i=1; $i<=$total_pages; $i++){
    IF($i==$page){
      ECHO "&nbsp;&nbsp;<b>$i</b>";
    }ELSE{
?>
&nbsp;&nbsp;<a href="main.php?include=11&session_id=<?=$session_id?>&amp;page=<?=$i?>&amp;orderby=<?=$orderby?>&amp;edit=<?=$edit?>&amp;kick=<?=$kick?>&amp;ban=<?=$ban?>"><b><?=$i?></b></a>
<?
    }
  }
?>
<?
}
?>
</BODY></HTML>