<?PHP
  $badword=NEW badword();
  $badwords=$badword->listbadWords($session);
?>

  /* Bad words */
  var badWords_word=Array();
  var badWords_replacement=Array();
<?
FOR($i=0;$i<COUNT($badwords);$i++){
?>
  badWords_word[<?=$i?>]=new RegExp("<?=$badwords[$i]['word']?>","gi");
  badWords_replacement[<?=$i?>]="<?=$badwords[$i]['replacement']?>";
<?
}
?>


  /**************************************************************************
  FUNCTION replaceBadWords
  ---------------------------------------------------------------------------
  Task:
    Replace bad words
  ---------------------------------------------------------------------------
  Parameters:
    message       string        Message body
  ---------------------------------------------------------------------------
  Return:
    Message string
  **************************************************************************/
  function replaceBadWords(message){
    try{
      var badWordsCount=badWords_word.length;
      for(var i=0;i<badWordsCount;i++){
        message=message.replace(badWords_word[i], badWords_replacement[i])
      }
    }catch(e){}
    return message;
  }

