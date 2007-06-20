<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML>
<HEAD>
<?=$css?>
</HEAD>
<BODY>
<DIV align="center">
  <TABLE class="dforeground" border="0" cellspacing="1" cellpadding="6" width="90%">
    <FORM name="config" action="main.php" method="post">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="settings_submitted" value="1">
      <TR>
        <TD class="hforeground" colspan="3" align="center">
          <B><?=$lng["settings"]?></B>
        </TD>
      </TR>
<?
FOR($i=0;$i<$config_count;$i++){
?>
      <TR valign="top">
        <TD class="hforeground" align="center">
          <B><?=$i+1?></B>
        </TD>
        <TD class="hforeground" align="left" width="50%">
          <?=$config[$i]["description"]?>
        </TD>
<?
  IF($config[$i]["choices"]){
    IF($config[$i]["choices"]=="<color>"){
?>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="configuration[<?=$config[$i]["name"]?>]" value="<?=$config[$i]["value"]?>" size="6" maxlength="7">
        </TD>
<?
    }ELSEIF($config[$i]["choices"]=="<text>"){
?>
        <TD class="hforeground" align="left">
          <TEXTAREA rows="8" cols="36" class="textinputs" name="configuration[<?=$config[$i]["name"]?>]"><?=$config[$i]["value"]?></TEXTAREA>
        </TD>
<?
    }ELSEIF($config[$i]["choices"]=="<lng>"){
?>
        <TD class="hforeground" align="left">
          <SELECT name="configuration[<?=$config[$i]["name"]?>]" class="selects">
            <OPTION value=""></OPTION>
<?
      FOR($ii=0;$ii<COUNT($lng_array);$ii++){
        IF($config[$i]["value"]==$lng_array[$ii]){
          $selected="selected";
        }ELSE{
          $selected="";
        }
?>
            <OPTION value="<?=$lng_array[$ii]?>" <?=$selected?>><?=UCFIRST($lng_array[$ii])?></OPTION>
<?
      }
?>
          </SELECT>
        </TD>
<?
    }ELSEIF($config[$i]["choices"]=="<rooms>"){
      $room=NEW room();
      $room->listRooms($session, 0, '', 0);
?>
        <TD class="hforeground" align="left">
          <SELECT name="configuration[<?=$config[$i]["name"]?>]" class="selects">
            <OPTION value=""></OPTION>
<?
      FOR($ii=0;$ii<COUNT($room->roomlist);$ii++){
        IF($config[$i]["value"]==$room->roomlist[$ii]['id']){
          $selected="selected";
        }ELSE{
          $selected="";
        }
?>
            <OPTION value="<?=$room->roomlist[$ii]['id']?>" <?=$selected?>><?=$room->roomlist[$ii]['name']?></OPTION>
<?
      }
?>
          </SELECT>
        </TD>
<?
    }ELSE{
      $choices=EXPLODE("|",$config[$i]["choices"]);
?>
        <TD class="hforeground" align="left">
          <SELECT name="configuration[<?=$config[$i]["name"]?>]" class="selects">
<?
      FOR($ii=0;$ii<COUNT($choices);$ii++){
        $one_choice=EXPLODE("=",$choices[$ii]);
        IF($config[$i]["value"]==$one_choice[0]){
          $selected="selected";
        }ELSE{
          $selected="";
        }
?>
            <OPTION value="<?=$one_choice[0]?>" <?=$selected?>><?=$one_choice[1]?></OPTION>
<?
      }
?>
          </SELECT>
        </TD>
<?
    }
  }ELSE{
?>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="configuration[<?=$config[$i]["name"]?>]" value="<?=$config[$i]["value"]?>" size="32" maxlength="64">
        </TD>
<?
  }
?>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" colspan="3" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["savechanges"]?>">
          &nbsp;
          <INPUT type="reset" class="buttons" value="<?=$lng["resetform"]?>">
          &nbsp;
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY></HTML>