<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<?=$css?>
</HEAD>
<BODY>
<DIV align="center">
  <TABLE border="0" cellspacing="0" cellpadding="0" width="100%">
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD width="20">&nbsp;</TD>
      <TD align="center">
        <INPUT type="button" class="buttons" value="<?=$lng["closewindow"]?>" onclick="parent.window.close();">
<?php
if(!empty($session->direct_login)){
?>
        <br /><br />
        <INPUT type="button" class="buttons" value="<?=$lng["logout"]?>" onclick="parent.window.document.location.href='main.php?include=9&session_id=<?=$session_id?>'">
<?php
}
?>
      </TD>
    </TR>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
<?
IF($user->level&1 || $user->level&4){
  // Chat
?>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["chat"]?></B></LI>
      </TD>
    </TR>
<?
  IF($user->level&1){
    // Chat statistics
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=15"><?=$lng["statistics"]?></A>
      </TD>
    </TR>
<?
  }
  IF($user->level&4){
    // Chat settings
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=17"><?=$lng["settings"]?></A>
      </TD>
    </TR>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
<?
  }
}
IF($user->level&2){
  // Chat design
?>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["design"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=16"><?=$lng["edit"]?></A>
      </TD>
    </TR>
<?
  IF(EMPTY($cssurl->cssurl)){
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="_blank" href="main.php?session_id=<?=$session_id?>&include=31">Export</A>
      </TD>
    </TR>
<?
  }
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
<?
}
IF($user->level&8 || $user->level&16 || $user->level&32){
  // Users
?>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["users"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=11&admin=1"><?=$lng["memberlist"]?></A>
      </TD>
    </TR>
<?
  IF($user->level&8){
    // Edit users
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=11&edit=1"><?=$lng["edit"]?></A>
      </TD>
    </TR>
<?
  }
  IF($user->level&16){
    // Kick users
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=11&kick=1"><?=$lng["kick"]?></A>
      </TD>
    </TR>
<?
  }
  IF($user->level&32){
    // Ban users
?>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=11&ban=1"><?=$lng["ban"]?></A>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?include=20&list=1&session_id=<?=$session_id?>"><?=$lng["banlist"]?></A>
      </TD>
    </TR>
<?
  }
}  
IF($user->level&64){
  // Global messages
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["globalmessages"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=23"><?=$lng["post"]?></A>
      </TD>
  </TR>
<?
}
IF($user->level&128){
  // Manage advertisement
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["advertisement"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=25&add=1"><?=$lng["add"]?></A>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=25&edit=1"><?=$lng["edit"]?></A>
      </TD>
    </TR>
<?
}
IF($user->level&256){
  // Manage smilies
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["smilies"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=26&add=1"><?=$lng["add"]?></A>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=26&edit=1"><?=$lng["edit"]?></A>
      </TD>
    </TR>
<?
}
IF($user->level&512){
  // Manage bad worsd
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["badwords"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=28&add=1"><?=$lng["add"]?></A>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=28&edit=1"><?=$lng["edit"]?></A>
      </TD>
    </TR>
<?
}
IF($user->level&2048){
  // Manage rooms
?>
    <TR>
      <TD colspan="2">&nbsp;</TD>
    </TR>
    <TR>
      <TD colspan="2">
        <LI><B><?=$lng["rooms"]?></B></LI>
      </TD>
    </TR>
    <TR>
      <TD>&nbsp;</TD>
      <TD align="left">
        <A target="main" href="main.php?session_id=<?=$session_id?>&include=29&frame=main"><?=$lng["manage"]?></A>
      </TD>
    </TR>
<?
}
?>
  </TABLE>
</DIV>
</BODY></HTML>