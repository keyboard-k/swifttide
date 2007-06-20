<SCRIPT>
<!--

  /* Input text field width, pixel */
  var inputFieldWidth=0;

  /* Wether Private Message window receives focus when new mesage arrived */
  var focusPM=<?=$session->config->pm_focus?>;

  /* User data */
  var target_user_id=<?=$target_user->id?>;
  var current_user_id=<?=$current_user->id?>;
  var this_user_id=<?=$current_user->id?>;

  window.opener.chatFrameset.pmOpened[target_user_id]=true;
  var closedByOpener=false;

  /* Session ID */
  var session_id="<?=$session_id?>";

  /* Path to images */
  var imagePath="<?=IMAGEPATH?>";

  /* Userdata */
  var names=Array();
  names[<?=$target_user->id?>]="<?=$target_user_name?>";
  names[<?=$current_user->id?>]="<?=$current_user_name?>";
  var colors=Array();
  colors[<?=$target_user->id?>]="<?=$target_user->color?>";
  colors[<?=$current_user->id?>]="<?=$current_user->color?>";

  /* Minimum time period between two posts
  *  Type: int
  */
  var postDelay=<?=$session->config->post_delay?>;



  /**************************************************************************
  FUNCTION firstRun
  ---------------------------------------------------------------------------
  Task:
    Prepare all frames in frameset
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function firstRun(){
    try{
      /* Set input text field width */
      inputFieldWidth=document.body.offsetWidth-10;
      main.document.open();
      main.document.write("<HTML><HEAD><META http-equiv=\"Content-Language\" content=\"<?=$ISO_639_LNG?>\"><META http-equiv=\"Content-Type\" content=\"text/html; charset=<?=$lng["charset"]?>\"><?=STR_REPLACE("\"","'",STR_REPLACE("\r","",STR_REPLACE("\n","",$css)))?></HEAD><BODY class='message'>");
<?
IF($usermessage->id){
?>
      showMessage(<?=$usermessage->user_id?>,"<?=$usermessage->body?>",<?=$usermessage->flags?>,<?=$usermessage->post_time?>);
<?
}
?>
      formatInput(<?=$session->config->input_pm_width?>);
      if(focusPM || window.opener.chatFrameset.PM_openedByUser){
        input.document.i.m.select();
        input.document.i.m.focus();
        window.opener.chatFrameset.PM_openedByUser=false;
      }else{
        window.opener.focusInput();
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION post
  ---------------------------------------------------------------------------
  Task:
    Post message
  ---------------------------------------------------------------------------
  Parameters:
    message         string          Message body
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function post(message){
    try{
      // Preparing message
      message=convertCharacters(message);
      message=trimString(message);
      // Disallow empty posts
      if(message.length>0){
        // Disabling input field
        disableInput(0);
        // Sending a message to server
        dummyform.document.dummy.m.value=message;
        dummyform.document.dummy.t.value=2;
        dummyform.document.dummy.u.value=target_user_id;
        dummyform.document.dummy.x.value=flags;
        dummyform.document.dummy.submit();
        if(!enableTimeStamp||!synchronize){
          /* There are no time synchronization needed or timestamps disabled */
          /* Displaying a message */
          showMessage(current_user_id,message,flags,unixTimeStamp());
        }
        // Enable input field
        setTimeout("disableInput(1)",postDelay*1000);
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION disableInput
  ---------------------------------------------------------------------------
  Task:
    Disable 
  ---------------------------------------------------------------------------
  Parameters:
    action        int         Action type (0: Disable, 1: Enable)
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function disableInput(action){
    try{
      if(action==0){
        input.document.i.m.disabled=true;
        input.document.i.s.disabled=true;
      }else if(action==1){
        input.document.i.m.disabled=false;
        input.document.i.s.disabled=false;
        input.document.i.m.focus();
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showMessage
  ---------------------------------------------------------------------------
  Task:
    Display message
  ---------------------------------------------------------------------------
  Parameters:
    user_id         int             User ID
    message         string          Message body
    flags           int             Message flags
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showMessage(user_id,message,flags,time){
    try{
      // Execute IRC commands
      message=execIRC(message,false,user_id,names[user_id]);
      // Adding smilies
      message=addSmilies(message);
      // Highlighting links
      message=addLinks(message);
      // Replacing bad words
      message=replaceBadWords(message);
      // Formating message
      var bold_start="";
      var bold_end="";
      var italic_start="";
      var italic_end="";
      var underline_start="";
      var underline_end="";
      if(flags&1){
        // Bold
        bold_start="<B>";
        bold_end="</B>";
      }
      if(flags&2){
        // Italic
        italic_start="<I>";
        italic_end="</I>";
      }
      if(flags&4){
        // Underline
        underline_start="<U>";
        underline_end="</U>";
      }
      // Time
      var timeString="";
      if(enableTimeStamp){
        // Generate time stamp
        timeString=getHumanTime(time);
      }
      // Displaying message
      message=timeString+"<FONT color=\"#"+colors[user_id]+"\"><B>"+names[user_id]+":</B></FONT> "+bold_start+italic_start+underline_start+message+underline_end+italic_end+bold_end+"<BR>";
      main.document.write(message);
      main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
      if(focusPM){
        disableInput(1);
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION closeThisWindow
  ---------------------------------------------------------------------------
  Task:
    Close this window
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function closeThisWindow(){
    try{
      if(!closedByOpener){
        window.opener.chatFrameset.pmOpened[target_user_id]=false;
        window.close();
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION closeByOpener
  ---------------------------------------------------------------------------
  Task:
    Close this window by opener
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function closeByOpener(){
    try{
      closedByOpener=true;
      window.close();
    }catch(e){}
  }



<?
REQUIRE_ONCE(SCRIPTPATH."/smilies.js.php");
REQUIRE_ONCE(SCRIPTPATH."/links.js.php");
REQUIRE_ONCE(SCRIPTPATH."/strings.js.php");
REQUIRE_ONCE(SCRIPTPATH."/badwords.js.php");
REQUIRE_ONCE(SCRIPTPATH."/flags.js.php");
REQUIRE_ONCE(SCRIPTPATH."/sounds.js.php");
REQUIRE_ONCE(SCRIPTPATH."/time.js.php");
REQUIRE_ONCE(SCRIPTPATH."/irc.js.php");
?>

//-->
</SCRIPT>