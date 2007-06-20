<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<title><?=STR_REPLACE('{USER}',$user->login,$lng["viewuserprofile"])?></title>
<?=$css?>
</HEAD>
<BODY onload="focus()">
<DIV align="center">
  <TABLE class="dforeground" border="0" width="100%" cellspacing="1" cellpadding="6">
    <TR>
      <TD class="hforeground" align="center" colspan="2">
        <B><?=STR_REPLACE("{USER}","<FONT color=\"#".$user->color."\">".$user->login."</FONT>",$lng["viewuserprofile"])?></B>
      </TD>
    </TR>
<?
IF($session->config->enable_userphotos){
?>
    <TR valign="center">
      <TD class="hforeground" align="center" colspan="2">
        <A href="<?=IMAGEPATH."/userphotos/{$user->photo}"?>" target="<?=$user->login?>_photo"><IMG src="<?=IMAGEPATH."/userphotos/{$user->photo}"?>" title="<?=$user->login?>" height="160" border="0"></A>
      </TD>
    </TR>
<?
}
?>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["realname"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=$user->name?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["sex"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
<?
IF($user->sex){
?>
        <IMG src="<?=IMAGEPATH?>/sex_<?=$user->sex?>.gif" border="0" alt="">
<?
}ELSE{
?>
        <IMG src="<?=IMAGEPATH?>/clearpixel.gif" width="0" height="0" border="0" alt="">
<?
}
?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["email"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
<?
IF($user->hide_email){
?>
        &nbsp;
<?
}ELSE{
?>
        <?=$user->email?>
<?
}
?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["age"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=$user->age?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["location"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=$user->location?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" align="left">
        <B><?=$lng["about"]?>:</B>
      </TD>
      <TD class="hforeground" align="left">
        <?=NL2BR($user->about)?>
      </TD>
    </TR>
    <TR>
      <TD class="hforeground" colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD class="hforeground" colspan="2" align="center">
        <INPUT type="button" class="buttons" value="<?=$lng["closewindow"]?>" onclick="window.close();">
      </TD>
    </TR>
  </TABLE>
</DIV>
</BODY>
</HTML>