<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML>
<HEAD>
<?=$css?>
<SCRIPT>
  window.opener.parent.smiliesOpened=true;
  var closedByOpener=false;
  var smilieTexts=Array();

  function closeThisWindow(){
    if(!closedByOpener){
      window.opener.parent.document.smiliesOpened=false;
      window.close();
    }
  }

  function closeByOpener(){
    closedByOpener=true;
    window.close();
  }

  function resizeWindow(){
    var tableWidth=0;
    var tableHeight=0;
    for(var i=0;i<<?=$rows_count?>;i++){
      var currentWidth=0;
      var currentHeight=0;
      for(var ii=0;ii<<?=$session->config->smiliesInRow?>;ii++){
        var imgID=i*<?=$session->config->smiliesInRow?>+ii;
        eval("var imgWidth=document.img_"+imgID+".width;");
        eval("var imgHeight=document.img_"+imgID+".height;");
        if(imgHeight>currentHeight){
          currentHeight=imgHeight;
        }
        currentWidth+=imgWidth;
      }
      tableHeight+=currentHeight;
      if(tableWidth<currentWidth){
        tableWidth=currentWidth;
      }
    }
    correct=<?=$cellspacing*($rows_count+2)+$cellpadding*($rows_count+1)*2+ROUND(($cellspacing*($rows_count+2)+$cellpadding*($rows_count+1)*2)/10)?>;
    window.resizeTo(tableWidth+100+correct,tableHeight+120+correct);
  }

</SCRIPT>
</HEAD>
<BODY onLoad="resizeWindow();" onUnload="closeThisWindow();">
<DIV align="center">
  <TABLE width="100%" border="0" cellspacing="<?=$cellspacing?>" cellpadding="<?=$cellpadding?>">
<?
FOR($i=0;$i<$rows_count;$i++){
?>
    <TR valign="center">
<?
  FOR($ii=0;$ii<$session->config->smiliesInRow;$ii++){
?>
      <TD align="center">
        <A href="" onclick="window.opener.parent.insertSmilieText(<?=$smilies_array[$i][$ii][id]?>); return false;"><IMG src="<?=$smilies_array[$i][$ii][image]?>" name="img_<?=$smilies_array[$i][$ii][nr]?>" border="0" alt=""></A>
      </TD>
<?
  }
?>
    </TR>
<?
}
?>
    <TR>
      <TD colspan="<?=$session->config->smiliesInRow?>">&nbsp;</TD>
    </TR>
    <TR>
      <TD align="center" colspan="<?=$session->config->smiliesInRow?>">
        <A href="" onclick="closeThisWindow(); return false;"><?=$lng["closewindow"]?></A>
      </TD>
    </TR>
  </TABLE>
</DIV>
</BODY></HTML>