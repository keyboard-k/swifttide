  var enableSounsd=<?=$session->config->allow_sounds?>;
  browserSupportsSounds=true;
  

  /**************************************************************************
  FUNCTION playSound
  ---------------------------------------------------------------------------
  Task:
    Play sound
  ---------------------------------------------------------------------------
  Parameters:
    soundType           int               Sound type
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function playSound(soundType){
    try{
      if(enableSounsd && browserSupportsSounds && <?=$session->config->allow_sounds?>){
        var snd_name='';
        switch(soundType){
          case  1 :   // User enter room
                      snd_name='enter.mid';
                      break;
          case  3 :   // Normal message
                      snd_name='normal.mid';
                      break;
          case  4 :   // Private message
                      snd_name='private.mid';
                      break;
          case  5 :   // System message
                      snd_name='system.mid';
                      break;
        }
        if(snd_name!=''){
          sounds_frame.document.open();
          sounds_frame.document.write("<HTML><HEAD><META http-equiv=\"Content-Language\" content=\"<?=$ISO_639_LNG?>\"><META http-equiv=\"Content-Type\" content=\"text/html; charset=<?=$lng["charset"]?>\"><?=STR_REPLACE("\"","'",STR_REPLACE("\r","",STR_REPLACE("\n","",$css)))?></HEAD><BODY class=\"message\">");
          sounds_frame.document.write('<EMBED src="<?=SOUNDPATH?>/'+snd_name+'" width="0" height="0" autostart="true" loop="false"volume="100" hidden="true" mastersound>');
          sounds_frame.document.write('</BODY></HTML>');
          sounds_frame.document.close();
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION triggerSound
  ---------------------------------------------------------------------------
  Task:
    Turn on/off sound effects
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function triggerSound(){
    try{
      enableSounsd=!enableSounsd;
      if(enableSounsd){
        showSystemMessage(systemMessages[5]);
      }else{
        showSystemMessage(systemMessages[6]);
      }
      showSoundButton();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showSoundButton
  ---------------------------------------------------------------------------
  Task:
    Show sound button
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showSoundButton(){
    try{
      if(<?=$session->config->allow_sounds?> && browserSupportsSounds){
        if(enableSounsd){
          input.document.soundbutton.src="<?=IMAGEPATH?>/sound.gif";
        }else{
          input.document.soundbutton.src="<?=IMAGEPATH?>/nosound.gif";
        }
      }
    }catch(e){}
  }

