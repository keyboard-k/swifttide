<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD>
<SCRIPT>
<!--
  /**************************************************************************
  FUNCTION popColor
  ---------------------------------------------------------------------------
  Task:
    Open color selection window
  ---------------------------------------------------------------------------
  Parameters:
    fieldName                 string            Name of the text field
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
    var elements_count=document.designform.elements.length;
    var found=false;
    for(var i=0;!found&&i<elements_count;i++){
      if(document.designform.elements[i].name==fieldName){
        found=true;
        /* Opening a new window */
        window.open("main.php?include=6&session_id=<?=$session_id?>&formname=designform&element="+i, "colorbox", "fullscreen=no,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=yes,directories=no,location=no,width="+width+",height="+height+",left="+left_pos+",top="+top_pos);
      }
    }
  }
  
  function updateFields(){
    for(var i=0; i<document.designform.elements.length; i++){
      if(   document.designform.elements[i].name!='include'
         && document.designform.elements[i].name!='session_id'
         && document.designform.elements[i].name!='submitted'
         && document.designform.elements[i].name!='css_url'
         && document.designform.elements[i].name!='css_source'
         && document.designform.elements[i].name!='submitbutton'
         && document.designform.elements[i].name!='resetbutton'
         ){
        document.designform.elements[i].disabled=document.designform.css_source[0].checked;
      }
    }
  }

-->
</SCRIPT>
<?=$css?>
</HEAD>
<BODY onload="updateFields()">
<DIV align="center">
  <FORM name="designform" name="designform" action="main.php" method="post">
    <INPUT type="hidden" name="include" value="<?=$include?>">
    <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
    <INPUT type="hidden" name="submitted" value="1">
    <TABLE class="dforeground" border="1" cellspacing="0" cellpadding="6" width="90%">
      <TR>
        <TD class="hforeground" align="center" colspan="2">
          <B><?=$lng["chatdesign"]?></B>
        </TD>
      </TR>
      <TR>
        <TD class="hforeground" align="left" colspan="2">
          <INPUT type="radio" name="css_source" value="0" <?=$css_source_0_checked?> onclick="updateFields()" onselect="updateFields()">
          Use external CSS from following URL:
          <INPUT type="text" class="textinputs" name="css_url" value="<?=$css_url?>" size="60" maxlength="255">
          <br /><br />
          - or -
          <br /><br />
          <INPUT type="radio" name="css_source" value="1" <?=$css_source_1_checked?> onclick="updateFields()" onselect="updateFields()">
          Use following settings:
        </TD>
      </TR>
<?
WHILE(LIST($class_id,$class_data)=EACH($css_structure)){
?>
      <TR>
        <TD class="dforeground" align="left" colspan="2">
          <B><?=$class_data[description]?></B> (<?=$class_data[name]?>)
        </TD>
      </TR>
<?
  WHILE(LIST($property_id,$property_data)=EACH($class_data[properties])){
?>
      <TR>
        <TD class="hforeground" align="left">
          <?=$property_data[description]?> (<?=$property_data[name]?>)
        </TD>
<?
    IF($property_data[choice]=="~text~"){
?>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="properties_<?=$class_id?>_<?=$property_id?>" value="<?=$property_data[value]?>">
        </TD>
<?
    }ELSEIF($property_data[choice]=="~color~"){
      IF($property_data[value]){
        $property_data[value]="#".$property_data[value];
      }
?>
        <TD class="hforeground" align="left">
          <INPUT type="text" class="textinputs" name="properties_<?=$class_id?>_<?=$property_id?>" value="<?=$property_data[value]?>" maxlength="7">
          <INPUT type="button" class="buttons" value="<?=$lng["color"]?>" onClick="popColor('properties_<?=$class_id?>_<?=$property_id?>')">
        </TD>
<?
    }ELSEIF(STRPOS($property_data[choice],"|")){
      $options=EXPLODE("|",$property_data[choice]);
?>
        <TD class="hforeground" align="left">
          <SELECT class="selects" name="properties_<?=$class_id?>_<?=$property_id?>">
<?
      FOR($i=0;$i<COUNT($options);$i++){
        IF($property_data[value]==$options[$i]){
          $selected="selected";
        }ELSE{
          $selected="";
        }
?>
            <OPTION value="<?=$options[$i]?>" <?=$selected?>><?=$options[$i]?></OPTION>
<?
      }
?>
          </SELECT>
        </TD>
<?
    }ELSE{
?>
        <TD class="hforeground">&nbsp;</TD>
<?
    }
?>
      </TR>
<?
  }
}
?>
      <TR>
        <TD class="hforeground" align="center" colspan="2">
          <INPUT type="submit" name="submitbutton" class="buttons" value="<?=$lng["savechanges"]?>">
          &nbsp;
          <INPUT type="reset" name="resetbutton" class="buttons" value="<?=$lng["resetform"]?>">
          &nbsp;
        </TD>
      </TR>
    </TABLE>
  </FORM>
</DIV>
</BODY></HTML>