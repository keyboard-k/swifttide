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
      inputString=inputString.split("<").join("&#060;");
      inputString=inputString.split(">").join("&#062;");
      inputString=inputString.split("\\").join("&#092;");
    }catch(e){}
    return inputString;
  }

