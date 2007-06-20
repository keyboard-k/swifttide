  /* Wether to enable messages post time or not
  *  Type: int (0: No, 1: Yes)
  */
  var enableTimeStamp=<?=$session->config->timestamp_status?>;

  /* Wether to enable message post time synchronization between client and server or not
  *  Type: int (0: No, 1: Yes)
  */
  var synchronize=<?=$session->config->synchronize_time?>;


  /**************************************************************************
  FUNCTION unixTimeStamp
  ---------------------------------------------------------------------------
  Task:
    Generate unix timestamp
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return:
    (int) Unix timestamp
  **************************************************************************/
  function unixTimeStamp(){
    var now=new Date();
    return Math.round(now.getTime()/1000);
  }

  /**************************************************************************
  FUNCTION getHumanTime
  ---------------------------------------------------------------------------
  Task:
    Generate human readable time string from unix timestamp
  ---------------------------------------------------------------------------
  Parameters:
    (int) Unix timestamp
  ---------------------------------------------------------------------------
  Return:
    (string) Time string
  **************************************************************************/
  function getHumanTime(unixTimeStamp){
    var timeHandle=new Date(unixTimeStamp*1000);
    var dateFormat="<?=STR_REPLACE("\"","\\\"",$session->config->post_timestamp_format)?>";
    var hours=timeHandle.getHours();
    if(hours<10){
      hours="0"+hours;
    }
    var minutes=timeHandle.getMinutes();
    if(minutes<10){
      minutes="0"+minutes;
    }
    var seconds=timeHandle.getSeconds();
    if(seconds<10){
      seconds="0"+seconds;
    }
    var days=timeHandle.getDate();
    if(days<10){
      days="0"+days;
    }
    var months=timeHandle.getMonth()+1;
    if(months<10){
      months="0"+months;
    }
    years=timeHandle.getYear();
    if(years<1000){
      years+=1900;
    }
    dateFormat=dateFormat.split("{h}").join(hours);
    dateFormat=dateFormat.split("{m}").join(minutes);
    dateFormat=dateFormat.split("{s}").join(seconds);
    dateFormat=dateFormat.split("{D}").join(days);
    dateFormat=dateFormat.split("{M}").join(months);
    dateFormat=dateFormat.split("{Y}").join(years);
    return dateFormat;
  }

  /**************************************************************************
  FUNCTION showTimestampButton
  ---------------------------------------------------------------------------
  Task:
    Show timestamp button
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showTimestampButton(){
    try{
      if(enableTimeStamp){
        input.document.timestampbutton.src="<?=IMAGEPATH?>/timestamp_on.gif";
      }else{
        input.document.timestampbutton.src="<?=IMAGEPATH?>/timestamp_off.gif";
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION triggerTimeStamp
  ---------------------------------------------------------------------------
  Task:
    Trigger timestamp
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function triggerTimeStamp(){
    try{
      enableTimeStamp=!enableTimeStamp;
      if(enableTimeStamp){
        showSystemMessage(systemMessages[3]);
      }else{
        showSystemMessage(systemMessages[4]);
      }
      showTimestampButton();
    }catch(e){}
  }


