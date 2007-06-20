<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><BODY>
<HEAD>
<?=$css?>
</HEAD>
<DIV align="center">
  <B><?=$lng["rooms"]?> :: <?=$lng["edit"]?></B>
  <BR>
  &quot;<b><?=HTMLENTITIES($room->name)?></b>&quot;
  <BR><BR>
  <FORM action="main.php" method="post" enctype="multipart/form-data">
    <INPUT type="hidden" name="session_id" value="<?=$session_id?>" />
    <INPUT type="hidden" name="include" value="<?=$include?>" />
    <INPUT type="hidden" name="edit_room_id" value="<?=$edit_room_id?>" />
    <INPUT type="hidden" name="save_room" value="1" />
    <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6">
<?php
IF(!EMPTY($errortext)){
?>
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <B><?=IMPLODE('<BR>', $errortext)?></B>
        </TD>
      </TR>
<?php
}
?>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["roomname"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="roomname" value="<?=HTMLENTITIES($roomname)?>" size="32" maxlength="255" />
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["backgroundimage"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
<?
IF(!EMPTY($room->bgimg)){
?>
          <A href="" onclick="showRoomImage(); return false;"><IMG src="<?=IMAGEPATH?>/rooms/<?=$room->bgimg?>" width="100" alt="" border="0" /></A>
          <INPUT type="submit" name="delete_image" value="<?=$lng['delete']?>" />
          <BR>
<?
}
?>
          <INPUT type="file" name="bgimg">
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="left">
          <B><?=$lng["protectwithpass"]?></B>
        </TD>
        <TD class="hforeground" align="left">
<?php
IF($room->type&2){
?>
          <input type="radio" onclick="showPassBtn(true)" name="protectwithpass" value="1" checked="checked" /> <?=$lng['yes']?>
          <input type="button" id="changepassbtn" class="buttons" value="<?=$lng['changepass']?>" onclick="showPassBox(true)" />
          <span id="new_pass_span" style="visibility:hidden"><?=$lng['newpass']?> <input type="text" class="textinputs" name="new_password" value="" /></span>
          <BR>
          <input type="radio" onclick="showPassBtn(false)" name="protectwithpass" value="0" /> <?=$lng['no']?>
<?
}ELSE{
?>
          <input type="radio" onclick="showPassBtn(true)" name="protectwithpass" value="1" /> <?=$lng['yes']?>
          <input type="button" id="changepassbtn" class="buttons" value="<?=$lng['changepass']?>" onclick="showPassBox(true)" />
          <span id="new_pass_span" style="visibility:hidden"><?=$lng['newpass']?> <input type="text" class="textinputs" name="new_password" value="" /></span>
          <BR>
          <input type="radio" onclick="showPassBtn(false)" name="protectwithpass" value="0" checked="checked" /> <?=$lng['no']?>
<?
}
?>
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <INPUT type="radio" name="room_type" value="0" <?=($room->type&1)? '' : 'checked="checked"'?> /> <?=$lng['mainrooms']?>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <INPUT type="radio" name="room_type" value="1" <?=($room->type&1)? 'checked="checked"' : ''?> /> <?=$lng['userrooms']?>
        </TD>
      </TR>
      <TR valign="center">
        <TD class="hforeground" align="center" colspan="2">
          <INPUT type="submit" class="buttons" value="<?=$lng['savechanges']?>" />
        </TD>
      </TR>
    </TABLE>
  </FORM>
  <SCRIPT>
    function showRoomImage(){
      var rih=window.open('about:blank', 'room_image_window', 'width=320,height=240,resizable=yes');
      rih.document.open();
      rih.document.write('<html><body style="margin:0;padding:0;text-align:center;"><img id="room_image_id" src="<?=IMAGEPATH?>/rooms/<?=$room->bgimg?>" border="0" alt="" /></body></html>');
      rih.document.close();
      var ih=rih.document.getElementById('room_image_id');
      rih.resizeTo(ih.width+30, ih.height+50);
    }
    function showPassBox(state){
      if(state){
        document.getElementById('new_pass_span').style.visibility='visible';
      }else{
        document.getElementById('new_pass_span').style.visibility='hidden';
      }
    }
    function showPassBtn(state){
      if(state){
        document.getElementById('changepassbtn').style.visibility='visible';
      }else{
        document.getElementById('changepassbtn').style.visibility='hidden';
      }
    }
  </SCRIPT>
</DIV>
</BODY>
</HTML>
