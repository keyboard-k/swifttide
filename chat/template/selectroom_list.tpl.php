<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
<SCRIPT>
  function changeRoom(room_id){
<?
IF($admin_manage_rooms){
?>
    return false;
<?
}
?>
    document.changeroom.room_id.value=room_id;
    document.changeroom.submit();
  }

  function askConfirmation(roomID,confirmText){
    if(confirm(confirmText)){
      window.location.href="main.php?session_id=<?=$session_id?>&include=29&room_id="+roomID+"&delete=1&frame=main";
    }
  }
</SCRIPT>
</HEAD>
<BODY>
<DIV align="center">
  <FORM name="changeroom" action="main.php" mathod="post" target="_parent">
    <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
    <INPUT type="hidden" name="include" value="4">
    <INPUT type="hidden" name="room_id" value="">
  </FORM>
  <IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="1" height="20" border="0" alt="">
  <TABLE class="dforeground" cellspacing="1" cellpadding="6" width="90%">
    <TR valign="center">
      <TD class="hforeground" align="center" colspan="<?=$admin_manage_rooms+2?>">
        <B><?=$lng["mainrooms"]?></B>
      </TD>
    </TR>
<?
IF($main_rooms_count){
?>
    <TR valign="center">
<?
  IF($admin_manage_rooms){
?>
      <TD class="hforeground" width="20">&nbsp;</TD>
<?
  }
?>
      <TD class="hforeground" align="left">
        <B><?=$lng["roomname"]?></B>
      </TD>
      <TD class="hforeground" align="left" width="90">
        <B><?=$lng["usersonline"]?></B>
      </TD>
    </TR>
<?
  FOR($i=0;$i<$main_rooms_count;$i++){
    IF($main_rooms[$i][type]==2||$main_rooms[$i][type]==3){
      // Room is password-protected
      $image=IMAGEPATH."/locked.gif";
    }ELSE{
      $image=IMAGEPATH."/clearpixel.gif";
    }
?>
    <TR valign="center">
<?
  IF($admin_manage_rooms){
    IF($main_rooms_count>0){
?>
      <TD class="hforeground" width="1%" nowrap="nowrap">
<?
      IF($main_rooms_count>1){
?>
        <A href="" onclick="askConfirmation(<?=$main_rooms[$i][id]?>,'<?=STR_REPLACE("'","\\'",STR_REPLACE("{ROOM}",$main_rooms[$i][name],$lng["confirmdeleteroom"]))?>'); return false;"><IMG src="<?=IMAGEPATH?>/delete.gif" border="0" title="<?=$lng["delete"]?>"></A>
<?
      }
?>
        <A href="main.php?session_id=<?=$session_id?>&amp;include=32&amp;edit_room_id=<?=$main_rooms[$i]['id']?>"><IMG src="<?=IMAGEPATH?>/edit.gif" border="0" title="<?=$lng["edit"]?>"></A>
      </TD>
<?
    }ELSE{
?>
      <TD class="hforeground">&nbsp;</TD>
<?
    }
  }
?>
      <TD class="hforeground" align="left">
        <A href="" onclick="changeRoom(<?=$main_rooms[$i][id]?>); return false;"><IMG src="<?=$image?>" border="0" title="<?=$lng["password"]?>">&nbsp;<?=$main_rooms[$i][name]?></A>
      </TD>
      <TD class="hforeground" align="left">
        <?=$main_rooms[$i][userscount]?>
      </TD>
    </TR>
<?
  }
}ELSE{
?>
    <TR>
      <TD class="hforeground" colspan="<?=$admin_manage_rooms+2?>">&nbsp;</TD>
    </TR>
<?
}
IF($admin_manage_rooms){
?>
    <FORM action="main.php" method="post">
      <INPUT type="hidden" name="include" value="8">
      <INPUT type="hidden" name="frame" value="main">
      <INPUT type="hidden" name="admin_manage_rooms" value="1">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <TR valign="center">
        <TD class="hforeground" colspan="<?=$admin_manage_rooms+2?>" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["createroom"]?>">
        </TD>
      </TR>
    </FORM>
<?
}
?>
  </TABLE>
  <BR><BR>
  <TABLE class="dforeground" cellspacing="1" cellpadding="6" width="90%">
<?
IF($user_rooms_count&&$session->config->allow_userrooms){
?>
    <TR valign="center">
      <TD class="hforeground" align="center" colspan="<?=$admin_manage_rooms+2?>">
        <B><?=$lng["userrooms"]?></B>
      </TD>
    </TR>
    <TR valign="center">
<?
  IF($admin_manage_rooms){
?>
      <TD class="hforeground" width="20">&nbsp;</TD>
<?
  }
?>
      <TD class="hforeground" align="left">
        <B><?=$lng["roomname"]?></B>
      </TD>
      <TD class="hforeground" align="left" width="90">
        <B><?=$lng["usersonline"]?></B>
      </TD>
    </TR>
<?
  FOR($i=0;$i<$user_rooms_count;$i++){
    IF($user_rooms[$i][type]==2||$user_rooms[$i][type]==3){
      // Room is password-protected
      $image=IMAGEPATH."/locked.gif";
      $passworded=1;
    }ELSE{
      $image=IMAGEPATH."/clearpixel.gif";
      $passworded=0;
    }
?>
    <TR valign="center">
<?
  IF($admin_manage_rooms){
?>
      <TD class="hforeground" width="1%" nowrap="nowrap">
        <A href="" onclick="askConfirmation(<?=$user_rooms[$i][id]?>,'<?=STR_REPLACE("'","\\'",STR_REPLACE("{ROOM}",$user_rooms[$i][name],$lng["confirmdeleteroom"]))?>'); return false;"><IMG src="<?=IMAGEPATH?>/delete.gif" border="0" title="<?=$lng["delete"]?>"></A>
        <A href="main.php?session_id=<?=$session_id?>&amp;include=32&amp;edit_room_id=<?=$user_rooms[$i]['id']?>"><IMG src="<?=IMAGEPATH?>/edit.gif" border="0" title="<?=$lng["edit"]?>"></A>
      </TD>
<?
  }
?>
      <TD class="hforeground" align="left">
<?
  IF(!$admin_manage_rooms){
?>
        <A href="" onclick="changeRoom(<?=$user_rooms[$i][id]?>,<?=$passworded?>); return false;"><IMG src="<?=$image?>" border="0" title="<?=$lng["password"]?>"><?=$user_rooms[$i][name]?></A>
<?
  }ELSE{
?>
        <A href="" onclick="return false;"><IMG src="<?=$image?>" border="0" title="<?=$lng["password"]?>"><?=$user_rooms[$i][name]?> [<?=$user_rooms[$i]['creator']?>]</A>
<?
  }
?>
      </TD>
      <TD class="hforeground" align="left">
        <?=$user_rooms[$i][userscount]?>
      </TD>
    </TR>
<?
  }
}
IF(!$admin_manage_rooms&&$session->config->allow_userrooms){
?>
    <FORM action="main.php" method="post" target="_parent">
      <INPUT type="hidden" name="old_room_id" value="-3">
      <INPUT type="hidden" name="include" value="8">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <TR valign="center">
        <TD class="hforeground" colspan="<?=$admin_manage_rooms+2?>" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["createroom"]?>">
        </TD>
      </TR>
    </FORM>
<?
}
?>
  </TABLE>
</DIV>
</BODY></HTML>