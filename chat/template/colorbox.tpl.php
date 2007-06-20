<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML>
<HEAD>
<SCRIPT type="text/javascript">
<!--
  function pickColor(color){
    opener.document.<?=$formname?>.elements[<?=$element?>].value="#"+color;
  }
-->
</SCRIPT>
<?=$css?>
</HEAD>
<BODY>
<MAP name="pcpin_colors">
  <!--- Row 1 --->
  <AREA coords="2,2,18,18" href="javascript:pickColor('330000')">   
  <AREA coords="18,2,34,18" href="javascript:pickColor('333300')">   
  <AREA coords="34,2,50,18" href="javascript:pickColor('336600')">   
  <AREA coords="50,2,66,18" href="javascript:pickColor('339900')">   
  <AREA coords="66,2,82,18" href="javascript:pickColor('33CC00')">   
  <AREA coords="82,2,98,18" href="javascript:pickColor('33FF00')">   
  <AREA coords="98,2,114,18" href="javascript:pickColor('66FF00')">   
  <AREA coords="114,2,130,18" href="javascript:pickColor('66CC00')">   
  <AREA coords="130,2,146,18" href="javascript:pickColor('669900')">   
  <AREA coords="146,2,162,18" href="javascript:pickColor('666600')">   
  <AREA coords="162,2,178,18" href="javascript:pickColor('663300')">   
  <AREA coords="178,2,194,18" href="javascript:pickColor('660000')">   
  <AREA coords="194,2,210,18" href="javascript:pickColor('FF0000')">   
  <AREA coords="210,2,226,18" href="javascript:pickColor('FF3300')">   
  <AREA coords="226,2,242,18" href="javascript:pickColor('FF6600')">   
  <AREA coords="242,2,258,18" href="javascript:pickColor('FF9900')">   
  <AREA coords="258,2,274,18" href="javascript:pickColor('FFCC00')">   
  <AREA coords="274,2,290,18" href="javascript:pickColor('FFFF00')"> 
  <!--- Row 2 --->
  <AREA coords="2,18,18,34" href="javascript:pickColor('330033')">   
  <AREA coords="18,18,34,34" href="javascript:pickColor('333333')">   
  <AREA coords="34,18,50,34" href="javascript:pickColor('336633')">   
  <AREA coords="50,18,66,34" href="javascript:pickColor('339933')">   
  <AREA coords="66,18,82,34" href="javascript:pickColor('33CC33')">   
  <AREA coords="82,18,98,34" href="javascript:pickColor('33FF33')">   
  <AREA coords="98,18,114,34" href="javascript:pickColor('66FF33')">   
  <AREA coords="114,18,130,34" href="javascript:pickColor('66CC33')">   
  <AREA coords="130,18,146,34" href="javascript:pickColor('669933')">   
  <AREA coords="146,18,162,34" href="javascript:pickColor('666633')">   
  <AREA coords="162,18,178,34" href="javascript:pickColor('663333')">   
  <AREA coords="178,18,194,34" href="javascript:pickColor('660033')">   
  <AREA coords="194,18,210,34" href="javascript:pickColor('FF0033')">   
  <AREA coords="210,18,226,34" href="javascript:pickColor('FF3333')">   
  <AREA coords="226,18,242,34" href="javascript:pickColor('FF6633')">   
  <AREA coords="242,18,258,34" href="javascript:pickColor('FF9933')">   
  <AREA coords="258,18,274,34" href="javascript:pickColor('FFCC33')">   
  <AREA coords="274,18,290,34" href="javascript:pickColor('FFFF33')"> 
  <!--- Row 3 --->
  <AREA coords="2,34,18,50" href="javascript:pickColor('330066')">
  <AREA coords="18,34,34,50" href="javascript:pickColor('333366')"> 
  <AREA coords="34,34,50,50" href="javascript:pickColor('336666')"> 
  <AREA coords="50,34,66,50" href="javascript:pickColor('339966')"> 
  <AREA coords="66,34,82,50" href="javascript:pickColor('33CC66')"> 
  <AREA coords="82,34,98,50" href="javascript:pickColor('33FF66')"> 
  <AREA coords="98,34,114,50" href="javascript:pickColor('66FF66')"> 
  <AREA coords="114,34,130,50" href="javascript:pickColor('66CC66')"> 
  <AREA coords="130,34,146,50" href="javascript:pickColor('669966')"> 
  <AREA coords="146,34,162,50" href="javascript:pickColor('666666')"> 
  <AREA coords="162,34,178,50" href="javascript:pickColor('663366')"> 
  <AREA coords="178,34,194,50" href="javascript:pickColor('660066')"> 
  <AREA coords="194,34,210,50" href="javascript:pickColor('FF0066')"> 
  <AREA coords="210,34,226,50" href="javascript:pickColor('FF3366')"> 
  <AREA coords="226,34,242,50" href="javascript:pickColor('FF6666')"> 
  <AREA coords="242,34,258,50" href="javascript:pickColor('FF9966')"> 
  <AREA coords="258,34,274,50" href="javascript:pickColor('FFCC66')"> 
  <AREA coords="274,34,290,50" href="javascript:pickColor('FFFF66')"> 
  <!--- Row 4 --->
  <AREA coords="2,50,18,66" href="javascript:pickColor('330099')"> 
  <AREA coords="18,50,34,66" href="javascript:pickColor('333399')"> 
  <AREA coords="34,50,50,66" href="javascript:pickColor('336699')"> 
  <AREA coords="50,50,66,66" href="javascript:pickColor('339999')"> 
  <AREA coords="66,50,82,66" href="javascript:pickColor('33CC99')"> 
  <AREA coords="82,50,98,66" href="javascript:pickColor('33FF99')"> 
  <AREA coords="98,50,114,66" href="javascript:pickColor('66FF99')"> 
  <AREA coords="114,50,130,66" href="javascript:pickColor('66CC99')"> 
  <AREA coords="130,50,146,66" href="javascript:pickColor('669999')"> 
  <AREA coords="146,50,162,66" href="javascript:pickColor('666699')"> 
  <AREA coords="162,50,178,66" href="javascript:pickColor('663399')">
  <AREA coords="178,50,194,66" href="javascript:pickColor('660099')"> 
  <AREA coords="194,50,210,66" href="javascript:pickColor('FF0099')"> 
  <AREA coords="210,50,226,66" href="javascript:pickColor('FF3399')"> 
  <AREA coords="226,50,242,66" href="javascript:pickColor('FF6699')"> 
  <AREA coords="242,50,258,66" href="javascript:pickColor('FF9999')"> 
  <AREA coords="258,50,274,66" href="javascript:pickColor('FFCC99')"> 
  <AREA coords="274,50,290,66" href="javascript:pickColor('FFFF99')"> 
  <!--- Row 5 --->
  <AREA coords="2,66,18,82" href="javascript:pickColor('3300CC')"> 
  <AREA coords="18,66,34,82" href="javascript:pickColor('3333CC')"> 
  <AREA coords="34,66,50,82" href="javascript:pickColor('3366CC')"> 
  <AREA coords="50,66,66,82" href="javascript:pickColor('3399CC')"> 
  <AREA coords="66,66,82,82" href="javascript:pickColor('33CCCC')"> 
  <AREA coords="82,66,98,82" href="javascript:pickColor('33FFCC')"> 
  <AREA coords="98,66,114,82" href="javascript:pickColor('66FFCC')"> 
  <AREA coords="114,66,130,82" href="javascript:pickColor('66CCCC')"> 
  <AREA coords="130,66,146,82" href="javascript:pickColor('6699CC')"> 
  <AREA coords="146,66,162,82" href="javascript:pickColor('6666CC')"> 
  <AREA coords="162,66,178,82" href="javascript:pickColor('6633CC')"> 
  <AREA coords="178,66,194,82" href="javascript:pickColor('6600CC')"> 
  <AREA coords="194,66,210,82" href="javascript:pickColor('FF00CC')"> 
  <AREA coords="210,66,226,82" href="javascript:pickColor('FF33CC')"> 
  <AREA coords="226,66,242,82" href="javascript:pickColor('FF66CC')"> 
  <AREA coords="242,66,258,82" href="javascript:pickColor('FF99CC')"> 
  <AREA coords="258,66,274,82" href="javascript:pickColor('FFCCCC')"> 
  <AREA coords="274,66,290,82" href="javascript:pickColor('FFFFCC')"> 
  <!--- Row 6 --->
  <AREA coords="2,82,18,98" href="javascript:pickColor('3300FF')"> 
  <AREA coords="18,82,34,98" href="javascript:pickColor('3333FF')"> 
  <AREA coords="34,82,50,98" href="javascript:pickColor('3366FF')"> 
  <AREA coords="50,82,66,98" href="javascript:pickColor('3399FF')"> 
  <AREA coords="66,82,82,98" href="javascript:pickColor('33CCFF')"> 
  <AREA coords="82,82,98,98" href="javascript:pickColor('33FFFF')"> 
  <AREA coords="98,82,114,98" href="javascript:pickColor('66FFFF')"> 
  <AREA coords="114,82,130,98" href="javascript:pickColor('66CCFF')"> 
  <AREA coords="130,82,146,98" href="javascript:pickColor('6699FF')"> 
  <AREA coords="146,82,162,98" href="javascript:pickColor('6666FF')"> 
  <AREA coords="162,82,178,98" href="javascript:pickColor('6633FF')"> 
  <AREA coords="178,82,194,98" href="javascript:pickColor('6600FF')"> 
  <AREA coords="194,82,210,98" href="javascript:pickColor('FF00FF')"> 
  <AREA coords="210,82,226,98" href="javascript:pickColor('FF33FF')"> 
  <AREA coords="226,82,242,98" href="javascript:pickColor('FF66FF')"> 
  <AREA coords="242,82,258,98" href="javascript:pickColor('FF99FF')"> 
  <AREA coords="258,82,274,98" href="javascript:pickColor('FFCCFF')"> 
  <AREA coords="274,82,290,98" href="javascript:pickColor('FFFFFF')"> 
  <!--- Row 7 --->
  <AREA coords="2,98,18,114" href="javascript:pickColor('0000FF')"> 
  <AREA coords="18,98,34,114" href="javascript:pickColor('0033FF')"> 
  <AREA coords="34,98,50,114" href="javascript:pickColor('0066FF')"> 
  <AREA coords="50,98,66,114" href="javascript:pickColor('0099FF')"> 
  <AREA coords="66,98,82,114" href="javascript:pickColor('00CCFF')"> 
  <AREA coords="82,98,98,114" href="javascript:pickColor('00FFFF')"> 
  <AREA coords="98,98,114,114" href="javascript:pickColor('99FFFF')"> 
  <AREA coords="114,98,130,114" href="javascript:pickColor('99CCFF')"> 
  <AREA coords="130,98,146,114" href="javascript:pickColor('9999FF')"> 
  <AREA coords="146,98,162,114" href="javascript:pickColor('9966FF')"> 
  <AREA coords="162,98,178,114" href="javascript:pickColor('9933FF')"> 
  <AREA coords="178,98,194,114" href="javascript:pickColor('9900FF')"> 
  <AREA coords="194,98,210,114" href="javascript:pickColor('CC00FF')"> 
  <AREA coords="210,98,226,114" href="javascript:pickColor('CC33FF')"> 
  <AREA coords="226,98,242,114" href="javascript:pickColor('CC66FF')"> 
  <AREA coords="242,98,258,114" href="javascript:pickColor('CC99FF')"> 
  <AREA coords="258,98,274,114" href="javascript:pickColor('CCCCFF')"> 
  <AREA coords="274,98,290,114" href="javascript:pickColor('CCFFFF')"> 
  <!--- Row 8 --->
  <AREA coords="2,114,18,130" href="javascript:pickColor('0000CC')"> 
  <AREA coords="18,114,34,130" href="javascript:pickColor('0033CC')"> 
  <AREA coords="34,114,50,130" href="javascript:pickColor('0066CC')"> 
  <AREA coords="50,114,66,130" href="javascript:pickColor('0099CC')"> 
  <AREA coords="66,114,82,130" href="javascript:pickColor('00CCCC')"> 
  <AREA coords="82,114,98,130" href="javascript:pickColor('00FFCC')"> 
  <AREA coords="98,114,114,130" href="javascript:pickColor('99FFCC')"> 
  <AREA coords="114,114,130,130" href="javascript:pickColor('99CCCC')"> 
  <AREA coords="130,114,146,130" href="javascript:pickColor('9999CC')"> 
  <AREA coords="146,114,162,130" href="javascript:pickColor('9966CC')"> 
  <AREA coords="162,114,178,130" href="javascript:pickColor('9933CC')"> 
  <AREA coords="178,114,194,130" href="javascript:pickColor('9900CC')"> 
  <AREA coords="194,114,210,130" href="javascript:pickColor('CC00CC')"> 
  <AREA coords="210,114,226,130" href="javascript:pickColor('CC33CC')"> 
  <AREA coords="226,114,242,130" href="javascript:pickColor('CC66CC')"> 
  <AREA coords="242,114,258,130" href="javascript:pickColor('CC99CC')"> 
  <AREA coords="258,114,274,130" href="javascript:pickColor('CCCCCC')"> 
  <AREA coords="274,114,290,130" href="javascript:pickColor('CCFFCC')"> 
  <!--- Row 9 --->
  <AREA coords="2,130,18,146" href="javascript:pickColor('000099')"> 
  <AREA coords="18,130,34,146" href="javascript:pickColor('003399')"> 
  <AREA coords="34,130,50,146" href="javascript:pickColor('006699')"> 
  <AREA coords="50,130,66,146" href="javascript:pickColor('009999')"> 
  <AREA coords="66,130,82,146" href="javascript:pickColor('00CC99')"> 
  <AREA coords="82,130,98,146" href="javascript:pickColor('00FF99')"> 
  <AREA coords="98,130,114,146" href="javascript:pickColor('99FF99')"> 
  <AREA coords="114,130,130,146" href="javascript:pickColor('99CC99')"> 
  <AREA coords="130,130,146,146" href="javascript:pickColor('999999')"> 
  <AREA coords="146,130,162,146" href="javascript:pickColor('996699')"> 
  <AREA coords="162,130,178,146" href="javascript:pickColor('993399')"> 
  <AREA coords="178,130,194,146" href="javascript:pickColor('990099')"> 
  <AREA coords="194,130,210,146" href="javascript:pickColor('CC0099')"> 
  <AREA coords="210,130,226,146" href="javascript:pickColor('CC3399')"> 
  <AREA coords="226,130,242,146" href="javascript:pickColor('CC6699')"> 
  <AREA coords="242,130,258,146" href="javascript:pickColor('CC9999')"> 
  <AREA coords="258,130,274,146" href="javascript:pickColor('CCCC99')"> 
  <AREA coords="274,130,290,146" href="javascript:pickColor('CCFF99')"> 
  <!--- Row 10 --->
  <AREA coords="2,146,18,162" href="javascript:pickColor('000066')"> 
  <AREA coords="18,146,34,162" href="javascript:pickColor('003366')"> 
  <AREA coords="34,146,50,162" href="javascript:pickColor('006666')"> 
  <AREA coords="50,146,66,162" href="javascript:pickColor('009966')"> 
  <AREA coords="66,146,82,162" href="javascript:pickColor('00CC66')"> 
  <AREA coords="82,146,98,162" href="javascript:pickColor('00FF66')"> 
  <AREA coords="98,146,114,162" href="javascript:pickColor('99FF66')"> 
  <AREA coords="114,146,130,162" href="javascript:pickColor('99CC66')"> 
  <AREA coords="130,146,146,162" href="javascript:pickColor('999966')"> 
  <AREA coords="146,146,162,162" href="javascript:pickColor('996666')"> 
  <AREA coords="162,146,178,162" href="javascript:pickColor('993366')"> 
  <AREA coords="178,146,194,162" href="javascript:pickColor('990066')"> 
  <AREA coords="194,146,210,162" href="javascript:pickColor('CC0066')"> 
  <AREA coords="210,146,226,162" href="javascript:pickColor('CC3366')"> 
  <AREA coords="226,146,242,162" href="javascript:pickColor('CC6666')"> 
  <AREA coords="242,146,258,162" href="javascript:pickColor('CC9966')"> 
  <AREA coords="258,146,274,162" href="javascript:pickColor('CCCC66')"> 
  <AREA coords="274,146,290,162" href="javascript:pickColor('CCFF66')"> 
  <!--- Row 11 --->
  <AREA coords="2,162,18,178" href="javascript:pickColor('000033')"> 
  <AREA coords="18,162,34,178" href="javascript:pickColor('003333')"> 
  <AREA coords="34,162,50,178" href="javascript:pickColor('006633')"> 
  <AREA coords="50,162,66,178" href="javascript:pickColor('009933')"> 
  <AREA coords="66,162,82,178" href="javascript:pickColor('00CC33')"> 
  <AREA coords="82,162,98,178" href="javascript:pickColor('00FF33')"> 
  <AREA coords="98,162,114,178" href="javascript:pickColor('99FF33')"> 
  <AREA coords="114,162,130,178" href="javascript:pickColor('99CC33')"> 
  <AREA coords="130,162,146,178" href="javascript:pickColor('999933')"> 
  <AREA coords="146,162,162,178" href="javascript:pickColor('996633')"> 
  <AREA coords="162,162,178,178" href="javascript:pickColor('993333')"> 
  <AREA coords="178,162,194,178" href="javascript:pickColor('990033')"> 
  <AREA coords="194,162,210,178" href="javascript:pickColor('CC0033')"> 
  <AREA coords="210,162,226,178" href="javascript:pickColor('CC3333')"> 
  <AREA coords="226,162,242,178" href="javascript:pickColor('CC6633')"> 
  <AREA coords="242,162,258,178" href="javascript:pickColor('CC9933')"> 
  <AREA coords="258,162,274,178" href="javascript:pickColor('CCCC33')"> 
  <AREA coords="274,162,290,178" href="javascript:pickColor('CCFF33')"> 
  <!--- Row 12 --->
  <AREA coords="2,178,18,194" href="javascript:pickColor('000000')"> 
  <AREA coords="18,178,34,194" href="javascript:pickColor('003300')"> 
  <AREA coords="34,178,50,194" href="javascript:pickColor('006600')"> 
  <AREA coords="50,178,66,194" href="javascript:pickColor('009900')"> 
  <AREA coords="66,178,82,194" href="javascript:pickColor('00CC00')"> 
  <AREA coords="82,178,98,194" href="javascript:pickColor('00FF00')"> 
  <AREA coords="98,178,114,194" href="javascript:pickColor('99FF00')"> 
  <AREA coords="114,178,130,194" href="javascript:pickColor('99CC00')"> 
  <AREA coords="130,178,146,194" href="javascript:pickColor('999900')"> 
  <AREA coords="146,178,162,194" href="javascript:pickColor('996600')"> 
  <AREA coords="162,178,178,194" href="javascript:pickColor('993300')"> 
  <AREA coords="178,178,194,194" href="javascript:pickColor('990000')"> 
  <AREA coords="194,178,210,194" href="javascript:pickColor('CC0000')"> 
  <AREA coords="210,178,226,194" href="javascript:pickColor('CC3300')"> 
  <AREA coords="226,178,242,194" href="javascript:pickColor('CC6600')"> 
  <AREA coords="242,178,258,194" href="javascript:pickColor('CC9900')"> 
  <AREA coords="258,178,274,194" href="javascript:pickColor('CCCC00')"> 
  <AREA coords="274,178,290,194" href="javascript:pickColor('CCFF00')"> 
</MAP>
<A href="#"><IMG src="<?=IMAGEPATH?>/colors.gif" width="292" height="196" border="0" alt="" usemap="#pcpin_colors" ismap></A>
<DIV align="center">
  <A href="#" onclick="window.close();"><?=$lng["closewindow"]?></A>
</DIV>
</BODY>
</HTML>
