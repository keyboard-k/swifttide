<?PHP
  $smilie=NEW smilie();
  $smilies=$smilie->listSmilies($session);
?>

  /* Smilies */
  var smilies_text=Array();
  var smilies_image=Array();
  var smilies_id=Array();
<?
FOR($i=0;$i<COUNT($smilies);$i++){
?>
  smilies_text[<?=$i?>]="<?=$smilies[$i][text]?>";
  smilies_image[<?=$i?>]="<?=$smilies[$i][image]?>";
  smilies_id[<?=$i?>]="<?=$smilies[$i][id]?>";
<?
}
?>

  /* Boolean status variable */
  var smiliesOpened;

  /* Smilies window object handle */
  var smiliesWindow;

  /**************************************************************************
  FUNCTION addSmilies
  ---------------------------------------------------------------------------
  Task:
    Add smilies to message
  ---------------------------------------------------------------------------
  Parameters:
    message       string        Message body
  ---------------------------------------------------------------------------
  Return:
    Message string with smilies
  **************************************************************************/
  function addSmilies(message){
    try{
      var smiliesCount=smilies_text.length;
      // Splitting message into chunks
      var messageParts=message.split(" ");
      var messagePartsLength=messageParts.length;
      // Check each chunk
      var convertedSmilie;
      for(var m=0;m<messagePartsLength;m++){
        var found=false;
        for(var i=0;!found&&i<smiliesCount;i++){
          if(messageParts[m]==smilies_text[i]){
            // Inserting smilie
            messageParts[m]=messageParts[m].split(smilies_text[i]).join("<IMG src=\""+imagePath+"/smilies/"+smilies_image[i]+"\" border=\"0\" alt=\"\">");
            found=true;
          }
        }
      }
      return messageParts.join(" ");
    }catch(e){}
    return message;
  }

  /**************************************************************************
  FUNCTION closeSmiliesWindow
  ---------------------------------------------------------------------------
  Task:
    Close smilies pop-up window
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function closeSmiliesWindow(){
    try{
      if(smiliesOpened&&!smiliesWindow.closed){
        smiliesWindow.closeByOpener();
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION insertSmilieText
  ---------------------------------------------------------------------------
  Task:
    Insert smilie text equivalent into input field
  ---------------------------------------------------------------------------
  Parameters:
    smilie_id         int           Real smilie ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function insertSmilieText(smilie_id){
    try{
      // Smilie ID must be set
      if(smilie_id){
        var found=false;
        // Looking for smilie in array
        var smiliesCount=smilies_id.length;
        for(var i=0;!found&&i<smiliesCount;i++){
          if(smilies_id[i]==smilie_id){
            // Smilie found. Add smilie text equivalent into input field
            input.document.i.m.value=input.document.i.m.value+" "+smilies_text[i]+" ";
            found=true;
          }
        }
      }
    }catch(e){}
  }

