<?PHP
/****************************************************************************
CLASS session
-----------------------------------------------------------------------------
Task:
  This class contains common used methods.
****************************************************************************/

CLASS common{

  /**************************************************************************
  common
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Creates common object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION common(){
  }

  /**************************************************************************
  dTrim
  ---------------------------------------------------------------------------
  Task:
    Collapse all double whitespaces within the string
  ---------------------------------------------------------------------------
  Parameters:
    $string         string          String to process
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION dTrim(&$string){
    WHILE(STRPOS($string,"  ")){
      $string=STR_REPLACE("  "," ",$string);
    }
  }

  /**************************************************************************
  doHtmlEntities
  ---------------------------------------------------------------------------
  Task:
    Replacing characters with their HTML values where possible
  ---------------------------------------------------------------------------
  Parameters:
    $string         string          String to process
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION doHtmlEntities(&$string){
    /* Replacing quotes */
    $string=STR_REPLACE("'","&#039;",STR_REPLACE("\"","&#034;",$string));
    /* Replacing '<' and '>' */
    $string=STR_REPLACE("<","&#060;",STR_REPLACE(">","&#062;",$string));
    /* Replacing '\' */
  }

  /**************************************************************************
  addCommand
  ---------------------------------------------------------------------------
  Task:
    Add command to the command string
  ---------------------------------------------------------------------------
  Parameters:
    command               string            Single command
    command_string        string            Command string
    separator             string            Separator between commands
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION addCommand($command="",&$command_string,$separator=""){
    IF($command_string){
      $command_string.=$separator;
    }
    $command_string.=$command;
  }

  /**
   * E-Mail address validator
   *
   * @param   string  $email  E-Mail address
   * @param   int     $level    Validation level
   *                              Value     Description
   *                                0         No validation
   *                                1         Well-formness check
   *                                2         Hostname (or DNS record, if Hostname failed) resolution
   *                                3         Recipient account availability check
   * @return  boolean TRUE if email address is valid or FALSE if not
   */
  function checkEmail($email='', $level=1){
    $valid=false;
    $email=trim($email);
    if($email<>''){
      $valid=true;
      if($level>=1){
        // Well-formness check
        $valid=(boolean)ereg('^([_a-zA-Z0-9-]+[\.])*([_a-zA-Z0-9-]+)@([a-zA-Z0-9-]+[\.])*([a-zA-Z0-9-]{2,}\.)+([a-zA-Z]{2,4})$', $email);
        if($valid && $level>=2){
          // Hostname (or DNS record, if Hostname failed) resolution
          $hostname=strtolower(substr($email, strpos($email, '@')+1));
          $host=gethostbyname($hostname);
          if($host==$hostname){
            $host='';
          }
          if($host==''){
            // Hostname resolutiion failed
            // Check DNS record
            $valid=_TCP::checkDNS_record($hostname);
          }else{
            $valid=true;
          }
          if($valid && $level>=3){
            // Recipient account availability check
            $valid=false;
            // Get MX records
            $ips=_TCP::getMXRecords($hostname);
            if(empty($ips)){
              // No MX records found. Using Hostname.
              $ips=gethostbynamel($hostname);
            }
            // Trying to open connection
            $conn=false;
            foreach($ips as $ip){
              if(_TCP::connectHost($conn=null, $errno=null, $errstr=null, $ip, 10)){
                // Connection opened
                break;
              }
            }
            $sender_host=(!empty($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']<>'')? $_SERVER['HTTP_HOST'] : 'UNKNOWN.HOST';
            if(!empty($conn)){
              // Gest SMTP server signature
              if(_TCP::readLastLineConn($conn, $line='')){
                if(220===_TCP::getStatus($line)){
                  // Send 'HELO' command
                  if(_TCP::writeDataConn($conn, "HELO $sender_host\r\n")){
                    // Get an answer
                    if(_TCP::readLastLineConn($conn, $line='')){
                      // Check response status
                      if(250===_TCP::getStatus($line)){
                        // Start email conversation
                        if(_TCP::writeDataConn($conn, "MAIL FROM: $sender_host\r\n")){
                          // Get an answer
                          if(_TCP::readLastLineConn($conn, $line='')){
                            // Check response status
                            if(250===_TCP::getStatus($line)){
                              // Specify recipient mailbox
                              if(_TCP::writeDataConn($conn, "RCPT TO: ".$email."\r\n")){
                                // Get an answer
                                if(_TCP::readLastLineConn($conn, $line='')){
                                  // Status 250: mailbox exists :)
                                  $valid=250===_TCP::getStatus($line);
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    return $valid;
  }

  /**************************************************************************
  checkDigits
  ---------------------------------------------------------------------------
  Task:
    Check string for containing digits only
  ---------------------------------------------------------------------------
  Parameters:
    digits            string            String to check
  ---------------------------------------------------------------------------
  Return:
    TRUE if string contains digits only
    FALSE if not
  **************************************************************************/
  FUNCTION checkDigits($digits=""){
    IF($digits){
      RETURN EREG_REPLACE("[^0-9]","",$digits)==$digits;
    }
  }

  /**************************************************************************
  convertTextToJavaScriptVar
  ---------------------------------------------------------------------------
  Task:
    Convert any text into a string that can be used as JavaScript string
    variable.
  ---------------------------------------------------------------------------
  Parameters:
    text            string            Text to convert
  ---------------------------------------------------------------------------
  Return:
    Converted text
  **************************************************************************/
  FUNCTION convertTextToJavaScriptVar($text=""){
    RETURN STR_REPLACE("\n","\\n",STR_REPLACE("\r","\\r",STR_REPLACE("\"","\\\"",$text)));
  }

  /**************************************************************************
  convertDateFromTimestamp
  ---------------------------------------------------------------------------
  Task:
    Convert Unix timestamp into human-readable date string depending on
    chat settings.
  ---------------------------------------------------------------------------
  Parameters:
    session               object              Session handle
    timestamp             int                 Unix timestamp
  ---------------------------------------------------------------------------
  Return:
    Date string
  **************************************************************************/
  FUNCTION convertDateFromTimestamp(&$session,$timestamp){
    RETURN DATE($session->config->date_format,$timestamp);
  }

  /**************************************************************************
  randomString
  ---------------------------------------------------------------------------
  Task:
    Generate random string of characters from range [A..Za..z0..9]
  ---------------------------------------------------------------------------
  Parameters:
    length                int                 Desired string length
  ---------------------------------------------------------------------------
  Return:
    Generated string
  **************************************************************************/
  FUNCTION randomString($length=0){
    $range="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $out='';
    FOR($i=0; $i<$length; $i++){
      SRAND((DOUBLE)MICROTIME()*1000000);
      $out.=SUBSTR($range, RAND(0,STRLEN($range)-1), 1);
    }
    RETURN $out;
  }


}
?>