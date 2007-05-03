<?
include_once "configuration.php";
//-----------------------------
//Define mail constants
//-----------------------------
// define("SMTP_SERVER", "213.153.32.136");  //ip address of smtp server
// define("SMTP_USER", "username");   //username to login to server
// define("SMTP_PASSWORD", "password");   //password for account
// define("SMTP_SMS_ADMIN_EMAIL", "h.leinfellner@sbg.at");  //mail will come from this account
// define("SMTP_FOLIO_ADMIN_EMAIL", "h.leinfellner@sbg.at");  //not sure, make it same as above
// define("SMTP_SMS_ADMIN_NAME", "Administrator der Schule");  //messages say they are from this entry

//-------------------------------
//the number of custom fields to display on various pages
//added by Joshua
//-------------------------------
define("CUSTOM_FIELDS_STUDENT", 20);
define("CUSTOM_FIELDS_DISCIPLINE", 3);
define("CUSTOM_FIELDS_ATTENDANCE", 3);
define("CUSTOM_FIELDS_GRADE", 3);

//------------------------------
//Program Constants
define("VERSION", "1.5.03");
//------------------------------

//-------------------------------
// Obtain specific URL Parameter from URL string
//-------------------------------
function get_param($param_name)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;

  $param_value = "";
  if(isset($HTTP_POST_VARS[$param_name])) {
    $param_value = $HTTP_POST_VARS[$param_name];
  } else if(isset($HTTP_GET_VARS[$param_name])) {
    $param_value = $HTTP_GET_VARS[$param_name];
  }
  return $param_value;
}
//-------------------------------
// Convert value for use with SQL statament
//-------------------------------
function tosql($value, $type)
{
  if(!strlen($value))
    return "NULL";
  else
    if($type == "Number")
      return str_replace (",", ".", doubleval($value));
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }

      return "'" . $value . "'";
    }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

class email

{
    
	function valida($str)
	{
        if (ereg("^[a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$", $str))
		{
           return 1;
        }
        else 
		{
           return 0;
		}
    }
}

function set_session($param_name, $param_value)
{
  global ${$param_name};
  if(session_is_registered($param_name)) 
    session_unregister($param_name);
  ${$param_name} = $param_value;
  session_register($param_name);
}

//for fixing the dates that the datepicker generates to something the db likes
function fix_date($date) {
	$tc = 0;
	$tok = strtok($date, "/");
	while ($tok) {
		$td[$tc] = $tok;
		$tc++;   			
  	$tok = strtok("/");
  }
  return ($td[2]."-".$td[0]."-".$td[1]);
}

function break_date($date) {
	$tc = 0;
	$tok = strtok($date, "-");
	while ($tok) {
		$td[$tc] = $tok;
		$tc++;   			
  	$tok = strtok("-");
  }
  return ($td[1]."/".$td[2]."/".$td[0]);
}

?>
