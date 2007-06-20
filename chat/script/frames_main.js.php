<SCRIPT type="text/javascript">
<!--

  /**************** Global variables ****************/
  window.chatFrameset=this;

  /* Input text field width, pixel. Will be defined in function 'firstRun'. */
  var inputFieldWidth=0;

  /* Session ID */
  var session_id="<?=$session_id?>";

  /* This room ID */
  var this_room_id=<?=$session->room_id?>;

  /* This user ID */
  var this_user_id=<?=$session->user_id?>;

  /* Userlist
  *  Type: array
  */
  var user=new Array();

  /* Roomlist
  *  Type: array
  */
  var room=new Array();

  /* Control frame refresh
  *  Type: 
  */
  var controlRefreshID;

  /* Handle for private message window
  *  Type: array
  */
  var pmwin=new Array;

  /* Boolean private window status array
  *  Type: array
  */
  var pmOpened=new Array;

  /* Minimum time period between two posts
  *  Type: int
  */
  var postDelay=<?=$session->config->post_delay?>;

  /* last message
  *  Type: string
  */
  var lastMessage="";

  /* Roomlist frame template
  *  Type: string
  */
  var roomlist_html="<?=$roomlist_html?>";

  /* Userlist frame template
  *  Type: string
  */
  var userlist_html="<?=$userlist_html?>";
  
  /* System messages templates
  *  Type: array
  */
  var systemMessages=Array;
<?
$i=0;
IF(IS_ARRAY($sysMsg)){
  RESET($sysMsg);
  WHILE($sysMsg[$i]){
?>
  systemMessages[<?=$i?>]="<?=$sysMsg[$i]?>";
<?
    $i++;
  }
}
?>

  /* Path to images
  *  Type: string
  */
  var imagePath="<?=IMAGEPATH?>";

  /* Wether Private Messages allowed or not
  *  Type: bool
  */
  var allowPM=<?=$session->config->allow_pm?>;

  /* This flag tells private message window that it was opened by user.
  *  Type: bool
  */
  PM_openedByUser=false;


  /**************************************************************************
  FUNCTION c
  ---------------------------------------------------------------------------
  Task:
    Parse control lines sent from the server and executes included commands.
    Command records are separated by the character "'".
    Control line format:
      command>parameters['command>parameters]...['command>parameters]
    Commands are separated with their parameters by the character ">".
    There are following STANDARD commands:
             A :  Show advertisement
             C :  Change room
             c :  Clear room messages
             d :  Delete room
             G :  Show global message
             I :  Invite user
             i :  Show invitation response
             K :  Kick user
             L :  User left this room
             M :  Show a normal message
             N :  Insert new user
             n :  Insert new room
             P :  Show private message
             R :  Reload main frameset
             S :  Show 'said' message
             U :  Update user info
             u :  Update room info
             W :  Show whispered to you message
             w :  Show whispered by you message
    All other commands will call a custom function with the same name.
    Custom command example:
      "myFunction>myParameters" will call: myFunction("myParameters");
    IMPORTANT: In order to avoid conflicts with future PCPIN Chat versions
               please use custom command names contained at least two letters.
    NOTE: Whitespaces between command records or between command and
          it's parameters are NOT ALLOWED.
    NOTE: All commands are CASE SENSITIVE.
  ---------------------------------------------------------------------------
  Parameters:
    ctrl            string          Control string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function c(ctrl){
    try{
      if(ctrl.length){
        // Sound event variables
        var playEventSounds=new Array();
        playEventSounds['enter']=false;
        playEventSounds['normal']=false;
        playEventSounds['private']=false;
        playEventSounds['system']=false;
        var commands=ctrl.split("'");
        /* Commands count */
        var commands_count=commands.length;
        /* Parsing each command */
        for(var i=0;i<commands_count;i++){
          /* Command names */
          var cmd_parts=commands[i].split(">");
          /* Command name */
          var cmd_name=cmd_parts[0];
          /* Command parameters */
          var cmd_param=cmd_parts[1];
          /* Which command? */
          switch(cmd_name){
            case  "A" :   /* Show advertisement */
                          advertisement(cmd_param);
                          break;
            case  "C" :   /* Change room */
                          goAnotherRoom(cmd_param);
                          break;
            case  "c" :   /* Clear room messages */
                          initMsgFrame();
                          break;
            case  "d" :   /* Delete room */
                          deleteRoom(cmd_param);
                          break;
            case  "E" :   /* User entered this room */
                          playEventSounds['system']=true;
                          userEnter(cmd_param);
                          break;
            case  "G" :   /* Global message */
                          playEventSounds['normal']=true;
                          globalMessage(cmd_param);
                          break;
            case  "I" :   /* Show invitation */
                          invite(cmd_param);
                          break;
            case  "i" :   /* Show invitation response */
                          invitationResponse(cmd_param);
                          break;
            case  "K" :   /* Kick user */
                          kickUser(cmd_param);
                          break;
            case  "L" :   /* User left this room */
                          userLeftRoom(cmd_param);
                          break;
            case  "l" :   /* User left chat */
                          userLeftChat(cmd_param);
                          break;
            case  "M" :   /* Show a normal message */
                          playEventSounds['normal']=true;
                          showNormalMessage(cmd_param);
                          break;
            case  "n" :   /* New room has been created*/
                          roomCreate(cmd_param);
                          break;
            case  "P" :   /* Show private message */
                          playEventSounds['private']=true;
                          showPrivateMessage(cmd_param);
                          break;
            case  "R" :   /* Reload main frameset */
                          mainReload();
                          break;
            case  "S" :   /* Show 'said' message */
                          playEventSounds['private']=true;
                          showSaid(cmd_param);
                          break;
            case  "U" :   /* Update user info */
                          updateUser(cmd_param);
                          break;
            case  "u" :   /* Update room info */
                          updateRoom(cmd_param);
                          break;
            case  "W" :   /* Show whispered to you message */
                          playEventSounds['private']=true;
                          showWhispered(1,cmd_param);
                          break;
            case  "w" :   /* Show whispered by you message */
                          showWhispered(2,cmd_param);
                          break;
            default   :   /* Custom command */
                          /* Will be executed only if function with the same
                             name exists. */
                          eval("if(typeof("+cmd_name+")==\"function\"){"+cmd_name+"(\""+cmd_param+"\")}");
                          break;
          }
        }
        // Play sounds
        if(playEventSounds['enter']){
          playSound(1);
        }
        if(playEventSounds['normal']){
          playSound(3);
        }
        if(playEventSounds['private']){
          playSound(4);
        }
        if(playEventSounds['system']){
          playSound(5);
        }
      }
    }catch(e){}
    prepareControlFrame();
  }

  /**************************************************************************
  FUNCTION userRecord
  ---------------------------------------------------------------------------
  Task:
    Constructor for user data.
  ---------------------------------------------------------------------------
  Parameters:
    id              int           User ID
    name            string        User nickname
    level           int           User level
    sex             string        User sex
    color           string        User color
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function userRecord(id,name,level,sex,color){
    this.ID=id;
    this.Name=name;
    this.Level=level;
    this.Sex=sex;
    this.Color=color;
    this.Muted=false;
  }

  /**************************************************************************
  FUNCTION findUserByID
  ---------------------------------------------------------------------------
  Task:
    Find user in array
  ---------------------------------------------------------------------------
  Parameters:
    id              int           User ID
  ---------------------------------------------------------------------------
  Return:
                    int           Number of array entry contained userdata,
                                  or -1 if user was not found
  **************************************************************************/
  function findUserByID(user_id){
    try{
      /* Count users */
      var users_count=user.length;
      /* Checking each user */
      for(var i=0;i<users_count;i++){
        if(user[i].ID==user_id){
          /* User found */
          return i;
        }
      }
    }catch(e){}
    /* User not found */
    return -1;
  }

  /**************************************************************************
  FUNCTION findUserByName
  ---------------------------------------------------------------------------
  Task:
    Find user in array
  ---------------------------------------------------------------------------
  Parameters:
    name            string            User name
    ignore_case     int               Wether to use case-insensitive search
  ---------------------------------------------------------------------------
  Return:
                    int           Number of array entry contained userdata,
                                  or -1 if user was not found
  **************************************************************************/
  function findUserByName(username, ignore_case){
    try{
      /* Count users */
      var users_count=user.length;
      /* Checking each user */
      for(var i=0;i<users_count;i++){
        if(typeof(ignore_case)!="undefined" && ignore_case){
          // Case-insensitive search
          if(user[i].Name.toLowerCase()==username.toLowerCase()){
            /* User found */
            return i;
          }
        }else{
          // Case-sensitive search
          if(user[i].Name==username){
            /* User found */
            return i;
          }
        }
      }
    }catch(e){}
    /* User not found */
    return -1;
  }

  /**************************************************************************
  FUNCTION roomRecord
  ---------------------------------------------------------------------------
  Task:
    Constructor for room data.
  ---------------------------------------------------------------------------
  Parameters:
    id              int           Room ID
    name            string        Room name
    type            int           Room type
    userscount      int           Users count
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function roomRecord(id,name,type,userscount){
    this.ID=id;
    this.Name=name;
    this.Type=type;
    this.UsersCount=userscount;
  }
  
  /**************************************************************************
  FUNCTION sortByName
  ---------------------------------------------------------------------------
  Task:
    Sort records by name.
  ---------------------------------------------------------------------------
  Parameters:
    record_a            Object            First record
    record_b            Object            Second record
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function sortByName(record_a,record_b){
    try{
      var x=record_a.Name.toLowerCase();
      var y=record_b.Name.toLowerCase();
      return ((x < y) ? -1 : (( x > y) ? 1 : 0));
    }catch(e){}
    return 0;
  }

  /**************************************************************************
  FUNCTION sortByUsersCount
  ---------------------------------------------------------------------------
  Task:
    Sort rooms by users count.
  ---------------------------------------------------------------------------
  Parameters:
    record_a            Object            First record
    record_b            Object            Second record
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function sortByUsersCount(record_a,record_b){
    try{
      return record_b.UsersCount-record_a.UsersCount;
    }catch(e){}
    return 0;
  }

  /**************************************************************************
  FUNCTION showUserList
  ---------------------------------------------------------------------------
  Task:
    Displays contents of userlist frame.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showUserList(){
    try{
      /* Sorting users by name */
      user.sort(sortByName);
      /* Opening document */
      userlist.document.open();
      userlist.document.write("<?=$userlist_headers?>");
      var users_count=user.length;
      var users="";
      var muted_link="";
      var info_link="";
      var pm_link="";
      /* Writing userlist */
      for(var i=0;i<users_count;i++){
        // Mute/Unmute/Superuser symbol
        if(user[i].Level>0){
          muted_link="<IMG src='"+imagePath+"/privileged.gif' border='0' title='<?=$lng["admin"]?>'>";
        }else if(user[i].ID==this_user_id){
          muted_link="<IMG src='"+imagePath+"/clearpixel.gif' border='0' title=''>";
        }else if(user[i].Muted){
          muted_link="<A href='' onclick='parent.mute("+user[i].ID+"); parent.focusInput(); return false;'><IMG src='"+imagePath+"/unmute.gif' border='0' title='<?=$lng["unmute"]?>'></A>";
        }else{
          muted_link="<A href='' onclick='parent.mute("+user[i].ID+"); parent.focusInput(); return false;'><IMG src='"+imagePath+"/mute.gif' border='0' title='<?=$lng["mute"]?>'></A>";
        }
        // 'Profile' button
        info_link="<A href='' onclick='parent.openProfileWindow("+user[i].ID+"); parent.focusInput(); return false;'><IMG src='"+imagePath+"/info.gif' border='0' title='<?=$lng["profile"]?>'></A>";
        // 'Whisper' button
        if(user[i].ID!=this_user_id){
          whisper_link="<A href='' onclick='parent.insertWhisper("+user[i].ID+"); parent.focusInput(); return false;'><IMG src='"+imagePath+"/whisper.gif' border='0' title='<?=ADDSLASHES($lng["whisper"])?>'></A>";
        }else{
          whisper_link="";
        }
        // 'Private message' button
        if(allowPM && user[i].ID!=this_user_id){
          pm_link="<A href='' onclick='parent.openPMWindow("+user[i].ID+",0); parent.focusInput(); return false;'><IMG src='"+imagePath+"/private_message.gif' border='0' title='<?=ADDSLASHES($lng["privatemessage"])?>'></A>";
        }else{
          pm_link="";
        }
        // Show user
        users+="<TR valign='bottom'>";
        users+="<TD align='right'>"+muted_link+info_link+whisper_link+pm_link+"</TD>";
        users+="<TD align='left'>";
        // Gender icon
        if (user[i].Sex!=null && user[i].Sex!='') {
          users+='<img src="images/sex_'+user[i].Sex+'.gif" border="0" alt="" />';
        }
        users+="<A href='#' onclick='parent.insertTalkTo("+user[i].ID+",0); parent.focusInput(); return false;' style='color:"+user[i].Color+"; font-weight:bold;'>"+user[i].Name+"</A>";
        users+="</TD>";
        users+="</TR>";
      }
      /* Writing userlist */
      var new_userlist_html=userlist_html.split("{USERS}").join(users);
      userlist.document.write(new_userlist_html);
      /* Closing document */
      userlist.document.close();
    }catch(e){}
  }


  /**************************************************************************
  FUNCTION mute
  ---------------------------------------------------------------------------
  Task:
    Mute/unmute user
  ---------------------------------------------------------------------------
  Parameters:
    user_id               int               User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function mute(user_id){
    try{
      var arrayNr=findUserByID(user_id);
      user[arrayNr].Muted=!user[arrayNr].Muted;
      if(user[arrayNr].Muted){
        showSystemMessage(systemMessages[7].split("{USER}").join("<FONT color=\""+user[arrayNr].Color+"\"><B>"+user[arrayNr].Name)+"</B></FONT>");
      }else{
        showSystemMessage(systemMessages[8].split("{USER}").join("<FONT color=\""+user[arrayNr].Color+"\"><B>"+user[arrayNr].Name)+"</B></FONT>");
      }
      showUserList();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION openProfileWindow
  ---------------------------------------------------------------------------
  Task:
    Open userprofile popup window.
  ---------------------------------------------------------------------------
  Parameters:
    user_id               int               User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function openProfileWindow(user_id){
    try{
     openPopUp("main.php?include=5&session_id="+session_id+"&profile_user_id="+user_id,user_id,1);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION openPMWindow
  ---------------------------------------------------------------------------
  Task:
    Open private message popup window.
  ---------------------------------------------------------------------------
  Parameters:
    user_id               int               User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function openPMWindow(user_id,message_id){
    try{
      if(user_id != this_user_id){
        // Don't talk private to yourself :)
        PM_openedByUser=true;
        openPopUp("main.php?include=7&session_id="+session_id+"&target_user_id="+user_id+"&message_id="+message_id,user_id,2);
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION openPopUp
  ---------------------------------------------------------------------------
  Task:
    Open popup window. Parameter 'win_type' describes content type to display
    in new window. There are following types:
        1 : User profile
        2 : Private message
        3 : Memberlist
        4 : Admin / Moderator panel
        5 : Global message
        6 : Invitation / response
  ---------------------------------------------------------------------------
  Parameters:
    win_href              string            Address of the document to open
    target_user           int               Target user ID
    win_type              int               Type of the new window
    set_focus             bool              (Private messages window only)
                                            Set focus to new window? Default: true
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function openPopUp(win_href,target_user,win_type,set_focus){
    try{
      if(typeof(set_focus)=='undefined'){
        var set_focus=false;
      }
      switch(win_type){
        case  1   :         /* User profile */
                            win_width=500;
                            win_height=screen.height-100;
                            /* Vertical position of the new window */
                            var top_pos=Math.round((screen.height-win_height)/2);
                            /* Horizontal position of the new window */
                            var left_pos=Math.round((screen.width-win_width)/2);
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="yes";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            var userProfileWindow=window.open(win_href,"pr"+target_user,"fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            break;
        case  2   :         /* Private message window */
                            win_width=350;
                            win_height=250;
                            /* Vertical position of the new window */
                            var top_pos=Math.round((screen.height-win_height)/2);
                            /* Horizontal position of the new window */
                            var left_pos=Math.round((screen.width-win_width)/2);
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="no";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            var pm_array_id=searchPMWindow(target_user);
                            if(pm_array_id<0){
                              // Window is not opened yet
                              pmwin[pmwin.length]=window.open(win_href,"pm"+target_user,"fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            }else if(set_focus){
                              // Window is already opened
                              pmwin[pm_array_id].window.disableInput(1);
                            }
                            break;
        case  3   :         /* Memberlist */
                            win_width=screen.width-100;
                            win_height=screen.height-160;
                            /* Vertical position of the new window */
                            var top_pos=Math.round((screen.height-win_height)/2);
                            /* Horizontal position of the new window */
                            var left_pos=Math.round((screen.width-win_width)/2);
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="yes";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            window.open(win_href,"chat_users","fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            break;
        case  4   :         /* Admin/Moderator panel */
                            win_width=screen.width;
                            win_height=screen.height-100;
                            /* Vertical position of the new window */
                            var top_pos=0;
                            /* Horizontal position of the new window */
                            var left_pos=0;
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="yes";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            window.open(win_href,"admin_moderator","fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            break;
        case  5   :         /* Global message Pop-Up */
                            win_width=Math.round(screen.width/2);
                            win_height=Math.round(screen.height/2);
                            /* Vertical position of the new window */
                            var top_pos=Math.round((screen.height-win_height)/2);
                            /* Horizontal position of the new window */
                            var left_pos=Math.round((screen.width-win_width)/2);
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="yes";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            window.open(win_href,"global_msg"+target_user,"fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            break;
        case  6   :         /* Invitation / response */
                            win_width=300;
                            win_height=200;
                            /* Vertical position of the new window */
                            var top_pos=Math.round((screen.height-win_height)/2);
                            /* Horizontal position of the new window */
                            var left_pos=Math.round((screen.width-win_width)/2);
                            /* Additional window parameters */
                            var win_fullscreen="no";
                            var win_toolbar="no";
                            var win_status="no";
                            var win_menubar="no";
                            var win_scrollbars="no";
                            var win_resizable="yes";
                            var win_directories="no";
                            var win_location="no";
                            /* Opening a new window */
                            window.open(win_href,"invitation_"+target_user,"fullscreen="+win_fullscreen+",toolbar="+win_toolbar+",status="+win_status+",menubar="+win_menubar+",scrollbars="+win_scrollbars+",resizable="+win_resizable+",directories="+win_directories+",location="+win_location+",width="+win_width+",height="+win_height+",left="+left_pos+",top="+top_pos);
                            break;
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showRoomList
  ---------------------------------------------------------------------------
  Task:
    Displays contents of roomlist frame.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showRoomList(){
    try{
      /* Sorting rooms by name */
      room.sort(sortByName);
      /* Sorting rooms by users count */
      room.sort(sortByUsersCount);
      /* Opening document */
      roomlist.document.open();
      var rooms_count=room.length;
      var options="";
      /* Writing roomlist */
      var pass_mark="";
      for(var i=0;i<rooms_count;i++){
        if(room[i].Type==2||room[i].Type==3){
          // Room is password-protected
          pass_mark="* ";
        }else{
          pass_mark="";
        }
        if(this_room_id==room[i].ID){
          options+="<OPTION value='"+room[i].ID+"' selected>"+pass_mark+room[i].Name+" ("+room[i].UsersCount+")</OPTION>";
        }else{
          options+="<OPTION value='"+room[i].ID+"'>"+pass_mark+room[i].Name+" ("+room[i].UsersCount+")</OPTION>";
        }
      }
      /* Writing HTML */
      var new_roomlist=roomlist_html.split("{OPTIONS}").join(options);
      roomlist.document.write(new_roomlist);
      /* Closing document */
      roomlist.document.close();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION newUser
  ---------------------------------------------------------------------------
  Task:
    Insert new user into userlist.
  ---------------------------------------------------------------------------
  Parameters:
    id                  int           User ID
    name                string        User nickname
    level               int           User level
    sex                 string        User sex
    color               string        User color
  ---------------------------------------------------------------------------
  Return:
    TRUE if user was successfully created
    FALSE if user already exists
  **************************************************************************/
  function newUser(id,name,level,sex,color){
    try{
      /* Checking userlist */
      if(findUserByID(id)<0){
        /* User does not exists. Inserting. */
        user[user.length++]=new userRecord(id,name,level,sex,color);
        return true;
      }else{
        return false;
      }
    }catch(e){}
    return false;
  }
  
  /**************************************************************************
  FUNCTION userEnter
  ---------------------------------------------------------------------------
  Task:
    Insert new user into current room.
    Update current room.
    Display a system message about that.
    User data will be extracted from userdata string. Userdata string
    has following format:
      id<name<level<sex<color<time
    Fields are separated with the character '<'.
    Example:
      userEnter("3<Tester<0<m<EE00EE<1086257791")
        - Insert new user with id=3, name='Tester', level=0, sex='m' and
          nickname color='EE00EE'.
  ---------------------------------------------------------------------------
  Parameters:
    userdata            string        User data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function userEnter(userdata){
    try{
      var message_parts=userdata.split("<");
      /* Trying to insert new user */
      if(newUser(message_parts[0],message_parts[1],message_parts[2],message_parts[3],message_parts[4])){
        /* Displaying a system message */
        var sysMsg=systemMessages[1];
        sysMsg=sysMsg.split("{USER}").join("<FONT color='#"+user[user.length-1].Color+"'><B>"+user[user.length-1].Name+"</FONT></B>");
        showSystemMessage(sysMsg,message_parts[5]);
        /* Updating room */
        updateRoom(this_room_id+"<<<+");
        /* Displaying updated userlist */
        showUserList();
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION userLeftRoom
  ---------------------------------------------------------------------------
  Task:
    Remove user from this room and post a message about that.
    User data will be extracted from userdata string. Userdata string
    has following format:
      id<time
    Fields are separated with the character '<'.
    Example:
      userLeftRoom("3<1086257791")
  ---------------------------------------------------------------------------
  Parameters:
    userdata            string        User data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function userLeftRoom(userdata){
    try{
      var message_parts=userdata.split("<");
      /* Looking for user */
      var i=findUserByID(message_parts[0]);
      if(i>=0){
        /* Showing a system message */
        var sysMsg=systemMessages[0];
        sysMsg=sysMsg.split("{USER}").join("<FONT color='#"+user[i].Color+"'><B>"+user[i].Name+"</FONT></B>");
        showSystemMessage(sysMsg,message_parts[1]);
        /* Deleting user */
        deleteUser(message_parts[0]);
        /* Displaying updated userlist */
        showUserList();
        /* Updating room */
        updateRoom(this_room_id+"<<<-");
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION kickUser
  ---------------------------------------------------------------------------
  Task:
    Post a message about kicked user and delete him from userlist
    User data will be extracted from userdata string. Userdata string
    has following format:
      id<time
    Fields are separated with the character '<'.
    Example:
      kickUser("3<1086257791")
  ---------------------------------------------------------------------------
  Parameters:
    userdata            string        User data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function kickUser(userdata){
    try{
      var userfields=userdata.split("<");
      /* Looking for user */
      var i=findUserByID(userfields[0]);
      if(i>=0){
        /* Show system message */
        var sysMsg=systemMessages[2];
        sysMsg=sysMsg.split("{USER}").join("<FONT color='#"+user[i].Color+"'><B>"+user[i].Name+"</FONT></B>");
        showSystemMessage(sysMsg,userfields[1]);
        /* Deleting user */
        deleteUser(userfields[0]);
        /* Displaying updated userlist */
        showUserList();
        /* Updating room */
        updateRoom(this_room_id+"<<<-");
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION deleteUser
  ---------------------------------------------------------------------------
  Task:
    Delete user from userlist.
  ---------------------------------------------------------------------------
  Parameters:
    user_id         int           User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function deleteUser(user_id){
    try{
      /* Looking for user */
      var i=findUserByID(user_id);
      if(i>=0){
        /* Shifting the rest part of user array */
        /* Counting users in room */
        users_count=user.length;
        for(var ii=i+1;ii<users_count;ii++){
          user[ii-1]=user[ii];
        }
        /* Decreasing user array length */
        user.length--;
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION updateUser
  ---------------------------------------------------------------------------
  Task:
    Update user data.
    User data will be extracted from userdata string. Userdata string
    has following format:
      id<name<level<sex<color
    Fields are separated with the character '<'.
    The only one required field is 'id'. All other fields are optional. If
    field is empty then it's property will not be updated.
    Example:
      updateUser("3<<<<FE0DFE")
        - change color to 'FE0dFE' for user with ID '3'
      updateUser("10<<1<<050D05")
        - change level to '1' and color to '050D05' for user with ID '10'
  ---------------------------------------------------------------------------
  Parameters:
    userdata        string          User data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function updateUser(userdata){
    try{
      var userfields=userdata.split("<");
      /* Looking for user */
      var i=findUserByID(userfields[0]);
      if(i>=0){
        /* Updating user */
        if(userfields[1]){
          /* Name */
          user[i].Name=userfields[1];
        }
        if(userfields[2]){
          /* Level */
          user[i].Level=userfields[2];
        }
        if(userfields[3]){
          /* Sex */
          user[i].Sex=userfields[3];
        }
        if(userfields[4]){
          /* Color */
          user[i].Color=userfields[4];
        }
        /* Displaying updated userlist */
        showUserList();
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION newRoom
  ---------------------------------------------------------------------------
  Task:
    Insert new room into roomlist.
    Room data will be extracted from roomdata string. Roomdata string
    has following format:
      id<name<type<userscount
    Fields are separated with the character '<'.
    Example:
      newRoom("3<Test room<0<15")
        - Insert new room with id=3, name='Test room', type=0 and 15 online
          users.
  ---------------------------------------------------------------------------
  Parameters:
    roomdata      string        Room data string.
  ---------------------------------------------------------------------------
  Return:
    TRUE if room has been successfully created
    FALSE if room already exists
  **************************************************************************/
  function newRoom(id,name,type,userscount){
    try{
      /* Checking roomlist */
      var rooms_count=room.length;
      for(var i=0;i<rooms_count;i++){
        /* Does room already exists? */
        if(room[i].ID==id){
          /* Room already exists */
          return false;
        }
      }
      /* Room does not exists. Inserting. */
      room[room.length++]=new roomRecord(id,name,type,userscount);
      return true;
    }catch(e){}
    return false;
  }
  
  /**************************************************************************
  FUNCTION roomCreate
  ---------------------------------------------------------------------------
  Task:
    Insert new room into roomlist.
    Room data will be extracted from roomdata string. Roomdata string
    has following format:
      id<name<type<userscount
    Fields are separated with the character '<'.
    Example:
      roomCreate("7<Test room<0<15")
        - Insert new room with id=3, name='Test room', type=0 and 15 online
          users.
  ---------------------------------------------------------------------------
  Parameters:
    roomdata      string        Room data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function roomCreate(roomdata){
    try{
      var roomfields=roomdata.split("<");
      if(newRoom(roomfields[0],roomfields[1],roomfields[2],roomfields[3])){
        /* Displaying updated roomlist */
        showRoomList();
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION updateRoom
  ---------------------------------------------------------------------------
  Task:
    Update room data.
    Room data will be extracted from roomdata string. Roomdata string
    has following format:
      id<name<type<userscount
    Fields are separated with the character '<'.
    The only one required field is 'id'. All other fields are optional. If
    field is empty then it's property will not be updated.
    Example:
      updateRoom("3<<<20")
        - change count of online users to 20 for room with id '3'
      updateRoom("10<New name<<+")
        - change name to 'New name' and increase count of online users for
        room with id '10'
      updateRoom("3<<<-")
        - decrease count of online users for room with id '3'
  ---------------------------------------------------------------------------
  Parameters:
    roomdata        string          Roomdata string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function updateRoom(roomdata){
    try{
      var roomfields=roomdata.split("<");
      var rooms_count=room.length;
      var room_found=false;
      /* Looking for the room */
      for(var i=0;i<rooms_count&&!room_found;i++){
        if(room[i].ID==roomfields[0]){
          /* Room found */
          room_found=true;
          /* Updating room */
          if(roomfields[1]){
            /* Name */
            room[i].Name=roomfields[1];
          }
          if(roomfields[2]){
            /* Type */
            room[i].Type=roomfields[2];
          }
          if(roomfields[3]){
            /* Userscount */
            if(roomfields[3]=="-"&&room[i].UsersCount>0){
              /* Decrease users count */
              room[i].UsersCount--;
            }else if(roomfields[3]=="+"){
              /* Increase users count */
              room[i].UsersCount++;
            }else{
              /* Change users count */
              room[i].UsersCount=roomfields[3];
            }
          }
          /* Displaying updated roomlist */
          showRoomList();
        }
      }
    }catch(e){}
  }
  
  /**************************************************************************
  FUNCTION deleteRoom
  ---------------------------------------------------------------------------
  Task:
    Delete room from roomlist.
  ---------------------------------------------------------------------------
  Parameters:
    room_id         int           User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function deleteRoom(room_id){
    try{
      /* Counting current rooms */
      var rooms_count=room.length;
      var room_found=false;
      /* Looking for the room */
      for(var i=0;i<rooms_count&&!room_found;i++){
        if(room[i].ID==room_id){
          /* Room found */
          room_found=true;
          /* Shifting the rest part of room array */
          for(var ii=i+1;ii<rooms_count;ii++){
            room[ii-1]=room[ii];
          }
          /* Decreasing room array length */
          room.length--;
          /* Displaying updated roomlist */
          showRoomList();
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showNormalMessage
  ---------------------------------------------------------------------------
  Task:
    Show a normal message.
    Message data will be extracted from messagedata string.
    Messagedata string has following format:
      sender_id<message_body<flags<timestamp
    Fields are separated by the character "<".
    Example:
      showNormalMessage("3<Test message<1<1072915200")
        - will display formated message with body='Test message'
          posted by user with id='3'
  ---------------------------------------------------------------------------
  Parameters:
    messagedata         string        Message data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showNormalMessage(messagedata){
    try{
      var message_parts=messagedata.split("<");
      /* Looking for user */
      var i=findUserByID(message_parts[0]);
      /* If user found and not muted */
      if(i>=0&&!user[i].Muted){
        if(user[i].ID!=this_user_id||message_parts[3]<0||enableTimeStamp&&synchronize){
          /* Add smilies */
          message_parts[1]=addSmilies(message_parts[1]);
          /* Makeing links clickable */
          message_parts[1]=addLinks(message_parts[1]);
          /* Replacing bad words */
          message_parts[1]=replaceBadWords(message_parts[1]);
          /* Formating message */
          var bold_start="";
          var bold_end="";
          var italic_start="";
          var italic_end="";
          var underline_start="";
          var underline_end="";
          if(message_parts[2]&1){
            // Bold
            bold_start="<B>";
            bold_end="</B>";
          }
          if(message_parts[2]&2){
            // Italic
            italic_start="<I>";
            italic_end="</I>";
          }
          if(message_parts[2]&4){
            // Underline
            underline_start="<U>";
            underline_end="</U>";
          }
          var timeString="";
          if(enableTimeStamp){
            // Generate time stamp
            message_parts[3]=message_parts[3].split("-").join("");
            timeString=getHumanTime(message_parts[3]);
          }
          /* Displaying message */
          main.document.write(timeString+"<FONT color='"+user[i].Color+"'><B>"+user[i].Name+":</B> "+bold_start+italic_start+underline_start+message_parts[1]+underline_end+italic_end+bold_end+"</FONT><BR>");
          /* Scrolling down main window */
          main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showSystemMessage
  ---------------------------------------------------------------------------
  Task:
    Show system message.
  ---------------------------------------------------------------------------
  Parameters:
    message             string              Message
    time                int                 Message time
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showSystemMessage(message,time){
    try{
      if(typeof(time)=="undefined"){
        var time=unixTimeStamp();
      }
      var timeString="";
      if(enableTimeStamp){
        // Generate time stamp
        timeString=getHumanTime(time);
      }
      /* Displaying message */
      main.document.write(timeString+message+"<BR>");
      /* Play sound */
      playSound(5);
      /* Scrolling down main window */
      main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION post
  ---------------------------------------------------------------------------
  Task:
    Post a message
  ---------------------------------------------------------------------------
  Parameters:
    message           string            Message body
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function post(message){
    try{
      // Set global variable
      lastMessage=trimString(message);
      var to=0;
      // Disallow empty posts
      if(lastMessage!=''){
        // Execute IRC commands
        lastMessage=execIRC(lastMessage, true, this_user_id, user[findUserByID(this_user_id)].Name);
        if(lastMessage!=''){
          // Disabling input field
          disableInput(0);
          // Look for 'whisper to' command
          var whispered_to=checkWhispered();
          if(whispered_to){
            to=whispered_to;
          }else{
            // Look for 'say to' command
            var said_to=checkSaid();
            if(said_to){
              to=said_to*-1;
            }
          }
          // Sending a message to server
          dummyform.document.dummy.m.value=lastMessage;
          dummyform.document.dummy.u.value=to;
          dummyform.document.dummy.t.value=1;
          dummyform.document.dummy.x.value=flags;
          dummyform.document.dummy.submit();
          if(!enableTimeStamp||!synchronize){
            // There are no time synchronization needed or timestamps disabled
            // Convert HTML characters
            lastMessage=convertCharacters(lastMessage);
            // Displaying a message
            // Whispered?
            if(whispered_to){
              // Whispered
              showWhispered(2,whispered_to+"<"+lastMessage+"<"+flags+"<-"+unixTimeStamp());
            }else if(said_to){
              // 'said'
              showSaid(this_user_id+"<"+lastMessage+"<"+flags+"<-"+unixTimeStamp()+"<"+said_to);
            }else{
              // Normal message
              showNormalMessage(this_user_id+"<"+lastMessage+"<"+flags+"<-"+unixTimeStamp());
            }
          }
        }
        /* Enabling input field */
        setTimeout("disableInput(1)", postDelay*1000);
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
  FUNCTION showPrivateMessage
  ---------------------------------------------------------------------------
  Task:
    Show private message.
    Message data will be extracted from messagedata string.
    Messagedata string has following format:
      sender_id<message_body<message_id<flags<time
    Fields are separated by the character "<".
    Example:
      showPrivateMessage("3<Test message<35<0<107364173")
        - will display formated message with body='Test message'
          posted by user with id='3'
  ---------------------------------------------------------------------------
  Parameters:
    messagedata         string        Message data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showPrivateMessage(messagedata){
    try{
      var message_parts=messagedata.split("<");
      /* Looking for message sender in userlist */
      /* Looking for user */
      var i=findUserByID(message_parts[0]);
      if(i>=0&&!user[i].Muted){
        /* Add smilies */
        message_parts[1]=addSmilies(message_parts[1]);
        /* Makeing links clickable */
        message_parts[1]=addLinks(message_parts[1]);
        /* Is PM window open? */
        var pm_window_array_id=searchPMWindow(message_parts[0]);
        if(pm_window_array_id<0){
          // Window is not opened
          openPopUp("main.php?include=7&session_id="+session_id+"&target_user_id="+message_parts[0]+"&message_id="+message_parts[2],message_parts[0],2);
        }else{
          // Window is opened
          // Display message
          pmwin[pm_window_array_id].showMessage(user[i].ID,message_parts[1],message_parts[3],message_parts[4]);
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION prepareControlFrame
  ---------------------------------------------------------------------------
  Task:
    Write template into control frame
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function prepareControlFrame(){
    try{
      control.document.open();
      control.document.write("<HTML><HEAD><?=STR_REPLACE("\"","'",$css)?></HEAD><BODY class='inputframe'></BODY></HTML>");
      control.document.close();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION startControl
  ---------------------------------------------------------------------------
  Task:
    (Re)start chat refresh.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function startControl(){
    /* Refresh period */
    if(controlRefreshID){
      try{
        control.document.location.href="main.php?include=<?=$include?>&session_id="+session_id+"&frame=c";
        clearInterval(controlRefreshID);
      }catch(e){}
    }
    try{
      controlRefreshID=setInterval("control.document.location.href='main.php?include=<?=$include?>&session_id="+session_id+"&frame=c';",<?=$session->config->main_refresh?>000);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION trimString
  ---------------------------------------------------------------------------
  Task:
    Delete all whitespaces at the beginning and the end of the string.
    Collapse all double whitespaces within the string.
  ---------------------------------------------------------------------------
  Parameters:
    inputSstring        string            String posted by local user
  ---------------------------------------------------------------------------
  Return:
                        string            Trimmed string
  **************************************************************************/
  function trimString(inputString){
    try{
      /* Only strings will be processed */
      if(typeof(inputString)=="string"){
        var retValue=inputString;
        /* Reading first character */
        var oneChar=retValue.substring(0,1);
        while(oneChar==" "){
          /* Deleting all whitespaces at the beginning of the string */
          retValue=retValue.substring(1,retValue.length);
          oneChar=retValue.substring(0,1);
        }
        /* Reading last character */
        oneChar=retValue.substring(retValue.length-1,retValue.length);
        while(oneChar==" "){
          /* Deleting all whitespaces at the end of the string */
          retValue=retValue.substring(0,retValue.length-1);
          oneChar=retValue.substring(retValue.length-1,retValue.length);
        }
        while(retValue.indexOf("  ")>0){
          /* Deleting all double whitespaces within the string */
          retValue=retValue.substring(0,retValue.indexOf("  "))+retValue.substring(retValue.indexOf("  ")+1,retValue.length);
        }
      }
      return retValue;
    }catch(e){}
    return inputString;
  }

  /**************************************************************************
  FUNCTION convertCharacters
  ---------------------------------------------------------------------------
  Task:
    Replace all characters in string with their HTML eqivalents
  ---------------------------------------------------------------------------
  Parameters:
    inputSstring        string            Input string
  ---------------------------------------------------------------------------
  Return:
                        string            Parsed string
  **************************************************************************/
  function convertCharacters(inputString){
    try{
      /* Only strings will be processed */
      if(typeof(inputString)=="string"){
        inputString=inputString.split("<").join("&lt;");
        inputString=inputString.split(">").join("&gt;");
      }
    }catch(e){}
    return inputString;
  }

  /**************************************************************************
  FUNCTION goAnotherRoom
  ---------------------------------------------------------------------------
  Task:
    Change room
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function goAnotherRoom(newRoomId){
    try{
      if(newRoomId!=this_room_id){
        if(newRoomId<0){
          // Redirect user to room seletion page
          dummyform.document.dummy.include.value=3;
          dummyform.document.dummy.target="_parent";
          dummyform.document.dummy.x.value="-";
          dummyform.document.dummy.submit();
        }else if(newRoomId>0){
          // Looking for the room in roomlist
          var rooms_count=room.length;
          var room_found=false;
          for(var i=0;i<rooms_count&&!room_found;i++){
            if(room[i].ID==newRoomId){
              room_found=true;
              dummyform.document.dummy.include.value=4;
              dummyform.document.dummy.m.value=room[i].ID;
              dummyform.document.dummy.u.value=this_room_id;
              dummyform.document.dummy.x.value=4;
              dummyform.document.dummy.frame.value="";
              dummyform.document.dummy.target="_parent";
              dummyform.document.dummy.submit();
            }
          }
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION globalMessage
  ---------------------------------------------------------------------------
  Task:
    Show global message
    Message data will be extracted from messagedata string.
    Messagedata string has following format:
      message_type<sender_name<sender_namecolor<message_body
    Fields are separated by the character "<".
    Example:
      globalMessage("0<admin<00DD00<Test message")
        - will display normal formated message with body='Test message'
          posted by admin
  ---------------------------------------------------------------------------
  Parameters:
    messagedata         string        Message data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function globalMessage(messagedata){
    try{
      var message_parts=messagedata.split("<");
      // Message type
      switch(message_parts[0]){
        case  "0" :   // Displaying normal message
                      main.document.write("<FONT color='#"+message_parts[2]+"'><B>"+message_parts[1]+":</B></FONT> "+message_parts[3]+"<BR>");
                      // Scrolling down main window
                      main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
                      break;
        case  "1" :   // Pop-Up
                      openPopUp("main.php?session_id="+session_id+"&include=24&msg_id="+message_parts[3],message_parts[3],5);
                      break;
        case  "2" :   // Displaying welcome message
                      // Convert special chars
                      message_parts[1]=message_parts[1].split("|_/&lf;_|").join("\n");
                      message_parts[1]=message_parts[1].split("|_/&cr;_|").join("\r");
                      message_parts[1]=message_parts[1].split("|_/&lt;_|").join("<");
                      message_parts[1]=message_parts[1].split("|_/&gt;_|").join(">");
                      main.document.write(message_parts[1]+"<BR>");
                      // Scrolling down main window
                      main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
                      break;
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION advertisement
  ---------------------------------------------------------------------------
  Task:
    Show advertisement text
  ---------------------------------------------------------------------------
  Parameters:
    text            string        Advertisement text
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function advertisement(text){
    try{
      // Convert HTML characters
      text=text.split("*_/&lt;_*").join("<");
      text=text.split("*_/&gt;_*").join(">");
      text=text.split("*_/&quot;_*").join("'");
      text=text.split("*_/CR_*").join("\r");
      text=text.split("*_/LF_*").join("\n");
      // Show advertisement
      main.document.write(text+"<BR>");
      main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION firstRun
  ---------------------------------------------------------------------------
  Task:
    Execute all start procedures and initialize user environment.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function firstRun(){
    try{
      /* Set input text field width */
      inputFieldWidth=document.body.offsetWidth-<?=$session->config->userlist_width?>-220;
      // Initialize messages frame
      initMsgFrame();
      /* Setting up userlist and roomlist */
      <?=$command_line?>
      prepareControlFrame();
      showUserList();
      showRoomList();
      startControl();
      formatInput();
      input.document.i.m.select();
      input.document.i.m.focus();
      /* Show sound button */
      showSoundButton();
      /* Play sound */
      playSound(1);
      /* Show timestamp button */
      showTimestampButton();
      // Assign "onresize" event
      window.onresize=function(){ setTimeout('doOnResize()', 100); };
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION initMsgFrame
  ---------------------------------------------------------------------------
  Task:
    (Re)Initialize messages frame
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function initMsgFrame(){
    try{
      main.document.close();
    }catch(e){}
    main.document.open();
    main.document.write("<HTML><HEAD><META http-equiv=\"Content-Language\" content=\"<?=$ISO_639_LNG?>\"><META http-equiv=\"Content-Type\" content=\"text/html; charset=<?=$lng["charset"]?>\"><?=STR_REPLACE("\"","'",STR_REPLACE("\r","",STR_REPLACE("\n","",$css)))?></HEAD><BODY class=\"message\" <?=$background?>>");
  }

  /**************************************************************************
  FUNCTION mainReload
  ---------------------------------------------------------------------------
  Task:
    Reload main frameset.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function mainReload(){
    try{
      dummyform.document.open();
      dummyform.document.write("<HTML><BODY><FORM name='dummy' action='main.php' method='post' target='_parent'><INPUT type='hidden' name='session_id' value='"+session_id+"'><INPUT type='hidden' name='include' value='4'><INPUT type='hidden' name='room_id' value='<?=$session->room_id?>'></FORM></BODY></HTML>");
      dummyform.document.close();
      dummyform.document.dummy.submit();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION searchPMWindow
  ---------------------------------------------------------------------------
  Task:
    Search for opened private message window
  ---------------------------------------------------------------------------
  Parameters:
    pm_user_id          int           User ID to PM with
  ---------------------------------------------------------------------------
  Return:
    'pmwin' array ID or -1 if window not opened.
  **************************************************************************/
  function searchPMWindow(pm_user_id){
    try{
      var tmp_user_id;
      var pm_length=pmwin.length;
      // Each opened private messages window
      for(var i=0;i<pm_length;i++){
        // User id
        if(!pmwin[i].closed){
          tmp_user_id=pmwin[i].name.split("pm").join("");
          if(tmp_user_id==pm_user_id&&pmOpened[pm_user_id]){
            // Window is opened
            return i;
          }
        }
      }
    }catch(e){}
    // Window is not opened
    return -1;
  }

  /**************************************************************************
  FUNCTION closePMWindows
  ---------------------------------------------------------------------------
  Task:
    Close all private message windows
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function closePMWindows(){
    try{
      var pm_length=pmwin.length;
      // Each opened private messages window
      for(var i=0;i<pm_length;i++){
        // User id
        if(!pmwin[i].closed){
          pm_user_id=pmwin[i].name.split("pm").join("");
          if(pmOpened[pm_user_id]){
            pmwin[i].closeByOpener();
          }
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION invite
  ---------------------------------------------------------------------------
  Task:
    Show invitation pop-up
    Invitation data will be extracted from datastring.
    Datastring has following format:
      sender_id<room_id
    Fields are separated by the character "<".
    Example:
      invite("3<5")
        - will open a window with invitation to join room with ID #5
          from user with ID #3
  ---------------------------------------------------------------------------
  Parameters:
    datastring          string          Invitation data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function invite(datastring){
    try{
      var invitation_parts=datastring.split("<");
      openPopUp("main.php?include=12&session_id="+session_id+"&user_id="+invitation_parts[0]+"&room_id="+invitation_parts[1]+"&invited=1",invitation_parts[0],6);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION invitationResponse
  ---------------------------------------------------------------------------
  Task:
    Show invitation response pop-up
    Response data will be extracted from datastring.
    Datastring has following format:
      sender_id<status
    Fields are separated by the character "<".
    Example:
      invite("3<0")
        - Sender with ID #3 has rejected your invitation
      invite("5<1")
        - Sender with ID #5 has accepted your invitation
  ---------------------------------------------------------------------------
  Parameters:
    datastring          string          Invitation data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function invitationResponse(datastring){
    try{
      var response_parts=datastring.split("<");
      openPopUp("main.php?include=12&session_id="+session_id+"&user_id="+response_parts[0]+"&answer="+response_parts[1],response_parts[0],6);
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION insertWhisper
  ---------------------------------------------------------------------------
  Task:
    Insert 'whisper to' command into input field
  ---------------------------------------------------------------------------
  Parameters:
    user_id         int         User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function insertWhisper(user_id){
    try{
      var whisper="<?=ADDSLASHES($lng["whisperto"])?>";
      var arr_nr=findUserByID(user_id);
      if(arr_nr>=0){
        input.document.i.m.value="["+whisper.split("{USER}").join(user[arr_nr].Name)+"]: "+input.document.i.m.value;
      }
      focusInput();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION checkWhispered
  ---------------------------------------------------------------------------
  Task:
    Check wether message was whispered or not
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return:
    (int) User ID if message was whispered to user
  **************************************************************************/
  function checkWhispered(){
    try{
      var whisperCmd="[<?=ADDSLASHES($lng["whisperto"])?>]:";
      var whisperCmd_length=whisperCmd.length;
      var lastMessage_length=lastMessage.length;
      var users_count=user.length;
      var testString="";
      // Deleting whitespaces from line begin
      while(lastMessage_length&&lastMessage.substring(0,1)==" "){
        lastMessage=lastMessage.substring(0,lastMessage_length-1);
      }
      // Looking for 'whisper to' command: "[whisper to {USER}]:"
      if(lastMessage.charAt(0)!="["){
        return 0;
      }
      for(i=0;i<users_count;i++){
        testString=lastMessage.split(whisperCmd.split("{USER}").join(user[i].Name)).join("");
        if(testString!=lastMessage){
          // 'whisper to' command found
          lastMessage=testString;
          return user[i].ID;
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showWhispered
  ---------------------------------------------------------------------------
  Task:
    Show whispered message.
    Message data will be extracted from messagedata string.
    Messagedata string has following format:
      sender_id<message_body<flags<timestamp<target_user_id
    Fields are separated by the character "<".
  ---------------------------------------------------------------------------
  Parameters:
    type                int           Message type (1: Message to you, 2: Your message)
    messagedata         string        Message data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showWhispered(type,messagedata){
    try{
      var message_parts=messagedata.split("<");
      /* Looking for user */
      var i=findUserByID(message_parts[0]);
      /* If user found and not muted */
      if(i>=0&&!user[i].Muted){
        if(user[i].ID!=this_user_id||message_parts[3]<0||enableTimeStamp&&synchronize){
          /* Add smilies */
          message_parts[1]=addSmilies(message_parts[1]);
          /* Makeing links clickable */
          message_parts[1]=addLinks(message_parts[1]);
          /* Replacing bad words */
          message_parts[1]=replaceBadWords(message_parts[1]);
          /* Formating message */
          var bold_start="";
          var bold_end="";
          var italic_start="";
          var italic_end="";
          var underline_start="";
          var underline_end="";
          if(message_parts[2]&1){
            // Bold
            bold_start="<B>";
            bold_end="</B>";
          }
          if(message_parts[2]&2){
            // Italic
            italic_start="<I>";
            italic_end="</I>";
          }
          if(message_parts[2]&4){
            // Underline
            underline_start="<U>";
            underline_end="</U>";
          }
          var timeString="";
          if(enableTimeStamp){
            // Generate time stamp
            message_parts[3]=message_parts[3].split("-").join("");
            timeString=getHumanTime(message_parts[3]);
          }
          if(type==1){
            // Message to you
            var whisperTemplate="<?=ADDSLASHES($lng["whisperedtoyou"])?>";
            var showColor=user[i].Color;
          }else if(type==2){
            // Message from you
            var whisperTemplate="<?=ADDSLASHES($lng["youwhisperedto"])?>";
            var showColor=user[findUserByID(this_user_id)].Color;
          }
          whisperTemplate=whisperTemplate.split("{USER}").join(user[i].Name);
          /* Displaying message */
          main.document.write(timeString+"<FONT color='"+showColor+"'><B>"+whisperTemplate+": </B> "+bold_start+italic_start+underline_start+message_parts[1]+underline_end+italic_end+bold_end+"</FONT><BR>");
          /* Scrolling down main window */
          main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION focusInput
  ---------------------------------------------------------------------------
  Task:
    Set focus to input field
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function focusInput(){
    try{
      if(!input.document.i.m.disabled){
        input.document.i.m.focus();
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION insertTalkTo
  ---------------------------------------------------------------------------
  Task:
    Insert 'to' command into input field
  ---------------------------------------------------------------------------
  Parameters:
    user_id         int         User ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function insertTalkTo(user_id){
    try{
      if(user_id!=this_user_id){
        // Don't speak to yourself :)
        var say="<?=ADDSLASHES($lng["sayto"])?>";
        var arr_nr=findUserByID(user_id);
        if(arr_nr>=0){
          input.document.i.m.value="["+say.split("{USER}").join(user[arr_nr].Name)+"]: "+input.document.i.m.value;
        }
      }
      focusInput();
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION checkSaid
  ---------------------------------------------------------------------------
  Task:
    Check wether message was 'said' or not
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return:
    (int) User ID if message was 'said' to user
  **************************************************************************/
  function checkSaid(){
    try{
      var sayCmd="[<?=ADDSLASHES($lng["sayto"])?>]:";
      var sayCmd_length=sayCmd.length;
      var lastMessage_length=lastMessage.length;
      var users_count=user.length;
      var testString="";
      // Deleting whitespaces from line begin
      while(lastMessage_length&&lastMessage.substring(0,1)==" "){
        lastMessage=lastMessage.substring(0,lastMessage_length-1);
      }
      // Looking for 'say to' command: "[say to {USER}]:"
      if(lastMessage.charAt(0)!="["){
        // Not a command
        return 0;
      }
      for(i=0;i<users_count;i++){
        testString=lastMessage.split(sayCmd.split("{USER}").join(user[i].Name)).join("");
        if(testString!=lastMessage){
          // 'say to' command found
          lastMessage=testString;
          return user[i].ID;
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION showSaid
  ---------------------------------------------------------------------------
  Task:
    Show showSaid message.
    Message data will be extracted from messagedata string.
    Messagedata string has following format:
      sender_id<message_body<flags<timestamp<target_user_id
    Fields are separated by the character "<".
  ---------------------------------------------------------------------------
  Parameters:
    messagedata         string        Message data string.
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function showSaid(messagedata){
    try{
      var message_parts=messagedata.split("<");
      /* Looking for user */
      var i=findUserByID(message_parts[0]);
      /* If user found and not muted */
      if(i>=0&&!user[i].Muted){
        if(user[i].ID!=this_user_id||message_parts[3]<0||enableTimeStamp&&synchronize){
          /* Add smilies */
          message_parts[1]=addSmilies(message_parts[1]);
          /* Makeing links clickable */
          message_parts[1]=addLinks(message_parts[1]);
          /* Replacing bad words */
          message_parts[1]=replaceBadWords(message_parts[1]);
          /* Formating message */
          var bold_start="";
          var bold_end="";
          var italic_start="";
          var italic_end="";
          var underline_start="";
          var underline_end="";
          if(message_parts[2]&1){
            // Bold
            bold_start="<B>";
            bold_end="</B>";
          }
          if(message_parts[2]&2){
            // Italic
            italic_start="<I>";
            italic_end="</I>";
          }
          if(message_parts[2]&4){
            // Underline
            underline_start="<U>";
            underline_end="</U>";
          }
          var timeString="";
          if(enableTimeStamp){
            // Generate time stamp
            message_parts[3]=message_parts[3].split("-").join("");
            timeString=getHumanTime(message_parts[3]);
          }
          // Prepare template
          var sayTemplate="<?=ADDSLASHES($lng["usersaidtouser"])?>";
          sayTemplate=sayTemplate.split("{USER1}").join(user[i].Name);
          sayTemplate=sayTemplate.split("{USER2}").join(user[findUserByID(message_parts[4])].Name);
          /* Displaying message */
          main.document.write(timeString+"<FONT color='"+user[i].Color+"'><B>"+sayTemplate+": </B> "+bold_start+italic_start+underline_start+message_parts[1]+underline_end+italic_end+bold_end+"</FONT><BR>");
          /* Scrolling down main window */
          main.window.scrollBy(0,4000000); main.window.scrollBy(0,4000000);
        }
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION logout
  ---------------------------------------------------------------------------
  Task:
    Log user out
  ---------------------------------------------------------------------------
  Parameters:
    user_id           int             User ID (security reason)
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function logout(user_id){
    try{
      if(user_id==this_user_id){
        document.location.href="main.php?include=9&session_id="+session_id;
      }
    }catch(e){}
  }

  /**************************************************************************
  FUNCTION doOnResize
  ---------------------------------------------------------------------------
  Task:
    "onresize" event handler
  ---------------------------------------------------------------------------
  Parameters:
    --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  function doOnResize(){
    try{
      inputFieldWidth=document.body.offsetWidth-<?=$session->config->userlist_width?>-220;
      formatInput();
    }catch(e){}
  }


<?
REQUIRE_ONCE(SCRIPTPATH."/smilies.js.php");
REQUIRE_ONCE(SCRIPTPATH."/strings.js.php");
REQUIRE_ONCE(SCRIPTPATH."/links.js.php");
REQUIRE_ONCE(SCRIPTPATH."/badwords.js.php");
REQUIRE_ONCE(SCRIPTPATH."/flags.js.php");
REQUIRE_ONCE(SCRIPTPATH."/sounds.js.php");
REQUIRE_ONCE(SCRIPTPATH."/time.js.php");
REQUIRE_ONCE(SCRIPTPATH."/irc.js.php");
?>

//-->
</SCRIPT>