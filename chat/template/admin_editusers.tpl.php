<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML>
<HEAD>
<SCRIPT type="text/javascript">
<!--
  /**************************************************************************
  FUNCTION popColor
  ---------------------------------------------------------------------------
  Task:
    Open color selection window
  ---------------------------------------------------------------------------
  Parameters:
    name                  string            Name for the new window.
    width                 int               Window width in pixels.
    height                int               Window height in pixels.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function popColor(fieldName){
    var width=307;
    var height=250;
    /* Vertical position of the new window */
    var top_pos=Math.round((screen.height-height)/2);
    /* Horizontal position of the new window */
    var left_pos=Math.round((screen.width-width)/2);
    /* Get element name */
    var elements_count=document.profileform.elements.length;
    var found=false;
    for(var i=0;!found&&i<elements_count;i++){
      if(document.profileform.elements[i].name==fieldName){
        found=true;
        /* Opening a new window */
        window.open("main.php?include=6&session_id=<?=$session_id?>&formname=profileform&element="+i, "colorbox", "fullscreen=no,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=yes,directories=no,location=no,width="+width+",height="+height+",left="+left_pos+",top="+top_pos);
      }
    }
  }
-->
</SCRIPT>
<?=$css?>
</HEAD>
<BODY onload="window.focus();">
<DIV align="center">
  <TABLE class="dforeground" border="0" width="90%" cellspacing="1" cellpadding="6">
    <FORM name="profileform" action="main.php" method="post">
      <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
      <INPUT type="hidden" name="include" value="<?=$include?>">
      <INPUT type="hidden" name="profile_user_id" value="<?=$profile_user_id?>">
      <INPUT type="hidden" name="update_profile" value="1">
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <B><?=STR_REPLACE("{USER}","<FONT color=\"#".$user->color."\">".$user->login."</FONT>",$lng["edituserprofile"])?></B>
        </TD>
      </TR>
<?
IF($errortext){
?>
      <TR>
        <TD class="error" colspan="2" align="center">
          <B><?=$errortext?></B>
        </TD>
      </TR>
<?
}
IF($session->config->enable_userphotos){
?>
      <TR valign="center">
        <TD class="hforeground" align="center">
          <A href="#" onclick="window.open('<?=IMAGEPATH?>/userphotos/<?=$user->photo?>','<?=$user->login?>');"><IMG src="<?=IMAGEPATH?>/userphotos/<?=$user->photo?>" title="<?=$user->login?>" height="160" border="0"></A>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="button" class="buttons" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=22&back=<?=$include?>&profile_user_id=<?=$profile_user_id?>';" value="<?=$lng["change"]?>">
<?
  IF($user->photo<>"nophoto.jpg"){
?>
          &nbsp;
          <INPUT type="button" class="buttons" onclick="window.location.href='main.php?session_id=<?=$session_id?>&include=<?=$include?>&delete_photo=1&profile_user_id=<?=$profile_user_id?>';" value="<?=$lng["delete"]?>">
<?
  }
?>
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["nicknamecolor"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="color" value="#<?=$user->color?>" maxlength="7">
          <INPUT type="button" class="buttons" value="<?=$lng["color"]?>" onClick="popColor('color');">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["realname"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="name" value="<?=$user->name?>" size="20" maxlength="64">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["sex"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <SELECT name="sex" class="selects">
            <OPTION value="m" <?=$selected_sex_m?>><?=$lng["male"]?>
            <OPTION value="f" <?=$selected_sex_f?>><?=$lng["female"]?>
          </SELECT>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["email"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="email" value="<?=$user->email?>" size="20" maxlength="64">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["hideemail"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <SELECT name="hide_email" class="selects">
            <OPTION value="0" <?=$selected_hide_email_0?>><?=$lng["no"]?>
            <OPTION value="1" <?=$selected_hide_email_1?>><?=$lng["yes"]?>
          </SELECT>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["age"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="age" value="<?=$user->age?>" size="20" maxlength="3">
        </TD>
      </TR>
        <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["location"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="location" value="<?=$user->location?>" size="20" maxlength="64">
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["about"]?>:</B>
        </TD>
          <TD class="hforeground" align="left">
            <TEXTAREA name="about" class="textinputs" cols="20" rows="5"><?=$user->about?></TEXTAREA>
        </TD>
      </TR>
<?
IF($current_user->level&1024){
?>
      <TR>
        <TD class="hforeground" align="left">
          <B><?=$lng["privileges"]?>:</B>
        </TD>
        <TD class="hforeground" align="left">
          <TABLE class="dforeground" border="0" width="100%" cellspacing="1" cellpadding="6">
<?
  $tr=0;
  FOR($i=0;$i<COUNT($privileges);$i++){
    IF(!$tr){
?>
            <TR>
<?
    }
    IF($privileges[$i]){
?>
              <TD align="left">
                <INPUT type="checkbox" name="set_rights[<?=$privileges[$i][value]?>]" value="1" <?=$privileges[$i][checked]?>>
                &nbsp;<?=$privileges[$i][name]?>
              </TD>
<?
    }ELSE{
?>
              <TD>&nbsp;</TD>
<?
    }
    IF($tr){
      $tr=0;
?>
            </TR>
<?
    }ELSE{
      $tr=1;
    }
  }
?>
          </TABLE>
        </TD>
      </TR>
<?
}
?>
      <TR>
        <TD class="hforeground" colspan="2">
          &nbsp;
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" colspan="2" align="center">
          <INPUT type="submit" class="buttons" value="<?=$lng["savechanges"]?>">
        </TD>
      </TR>
    </FORM>
  </TABLE>
</DIV>
</BODY>
</HTML>
