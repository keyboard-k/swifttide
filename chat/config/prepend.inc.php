<?PHP
/* WARNING: DON'T EDIT THIS FILE BEFORE YOU ARE KNOW WHAT YOU ARE DOING! */

define('PCPIN_REQUIRESMYSQL', '4');
define('PCPIN_REQUIRESPHP', '4.3');

/**
 * Check PHP version
 */
$php_needed=explode('.', PCPIN_REQUIRESPHP);
$php_exists=explode('.', phpversion());
foreach($php_needed as $key=>$val){
  if(!isset($php_exists[$key])){
    // Installed PHP version is OK
    break;
  }else{
    if($val>$php_exists[$key]){
      // PHP version is too old
      die("<b>Fatal error</b>: Installed PHP version is <b>".phpversion()."</b> (minimum required PHP version is <b>".PCPIN_REQUIRESPHP."</b>)");
    }elseif($val<$php_exists[$key]){
      // Installed PHP version is OK
      break;
    }
  }
}

/**
 * Fix disabled "magic_quotes_gpc" setting in php.ini
 */
$magic_quotes_gpc=get_magic_quotes_gpc();

// Get request variables processing order
$variables_order=@ini_get('variables_order');
if(empty($variables_order)){
  // Default is Environment-Get-Post-Cookie-Session
  $variables_order='EGPCS';
}
$variables_order=strtolower($variables_order);
$vars_len=strlen($variables_order);
for($i=0; $i<$vars_len; $i++){
  switch($variables_order{$i}){
    case  'e' : // _ENV
                // PCPIN Chat does not neeeds _ENV vars
                break;
    case  'g' : // _GET
                if(!empty($_GET)){
                  if(!$magic_quotes_gpc){
                    $_GET=addSlashesRecursive($_GET);
                  }
                  extract($_GET);
                }elseif(!empty($HTTP_GET_VARS)){
                  if(!$magic_quotes_gpc){
                    $HTTP_GET_VARS=addSlashesRecursive($HTTP_GET_VARS);
                  }
                  extract($HTTP_GET_VARS);
                }
                break;
    case  'p' : // _POST
                if(!empty($_POST)){
                  if(!$magic_quotes_gpc){
                    $_POST=addSlashesRecursive($_POST);
                  }
                  extract($_POST);
                }elseif(!empty($HTTP_POST_VARS)){
                  if(!$magic_quotes_gpc){
                    $HTTP_POST_VARS=addSlashesRecursive($HTTP_POST_VARS);
                  }
                  extract($HTTP_POST_VARS);
                }
                // _FILES are here, too
                if(!empty($_FILES)){
                  extract($_FILES);
                }elseif(!empty($HTTP_POST_FILES)){
                  extract($HTTP_POST_FILES);
                }
                break;
    case  'c' : // _COOKIE
                if(!empty($_COOKIE)){
                  if(!$magic_quotes_gpc){
                    $_COOKIE=addSlashesRecursive($_COOKIE);
                  }
                  extract($_COOKIE);
                }elseif(!empty($HTTP_COOKIE_VARS)){
                  if(!$magic_quotes_gpc){
                    $HTTP_COOKIE_VARS=addSlashesRecursive($HTTP_COOKIE_VARS);
                  }
                  extract($HTTP_COOKIE_VARS);
                }
                break;
    case  's' : // _SESSION
                // PCPIN Chat does not uses _SESSION vars
                break;
    default   : // huh?
                break;
  }
}
// Free memory
unset($variables_order);
unset($_GET);
unset($HTTP_GET_VARS);
unset($_POST);
unset($HTTP_POST_VARS);
unset($_COOKIE);
unset($HTTP_COOKIE_VARS);
unset($_FILES);
unset($HTTP_POST_FILES);
unset($_SESSION);
unset($HTTP_SESSION_VARS);


/* Loading all classes */
$classes_array=ARRAY('common','tcp','dbaccess','configuration','session','user',
                     'room','usermessage','systemmessage','globalmessage',
                     'log','ban','advertisement','fk_advertisement','smilie',
                     'badword','roompass','fk_cssvalue','cssclass','email',
                     'cssurl','maxusers');
FOREACH($classes_array AS $class){
  REQUIRE(CLASSPATH.'/'.$class.'.class.php');
}

/* Get user's IP address */
DEFINE('IP', (!EMPTY($HTTP_SERVER_VARS['REMOTE_ADDR']))? $HTTP_SERVER_VARS['REMOTE_ADDR'] : (!EMPTY($HTTP_SERVER_VARS['REMOTE_ADDR']))? $HTTP_SERVER_VARS['REMOTE_ADDR'] : GETENV('REMOTE_ADDR'));

/* Seed the random number generator */
SRAND((DOUBLE)MICROTIME()*1000000);


/**
 * Adds slashes to all scalar array values recursively
 * @param   array     $target               Target array
 * @return  array     Array with stripped slashes
 */
function addSlashesRecursive($target){
  $target_new=array();
  if(!empty($target) && is_array($target)){
    foreach($target as $key=>$val){
      $key=addslashes($key);
      if(is_array($val)){
        // Value is an array. Start recursion.
        $target_new[$key]=addSlashesRecursive($val);
      }elseif(is_scalar($val)){
        // Add slashes to the scalar value
        $target_new[$key]=addslashes($val);
      }
    }
  }
  return $target_new;
}


?>