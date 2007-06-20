<?php
/* WARNING: DON'T EDIT THIS FILE BEFORE YOU ARE KNOW WHAT YOU ARE DOING! */
/* This configuration file defines pathes */

/* Cookie lifetime, seconds */
DEFINE('COOKIE_LIFETIME', 2592000); // 2592000 seconds = 30 days

/* Turn debugging on. CHANGE THIS SETTING ONLY IF YOU KNOW WHAT ARE YOU DOING! */
DEFINE('DEBUG', FALSE);

/* PHP warnings and notices */
ERROR_REPORTING((DEBUG)?E_ALL:0);

/* Path to directory that contains classes */
DEFINE('CLASSPATH',OFFSET.'class');

/* Path to directory that contains includes */
DEFINE('INCLUDEPATH',OFFSET.'include');

/* Path to directory that contains templates */
DEFINE('TEMPLATEPATH',OFFSET.'template');

/* Path to directory that contains JavaScript scripts */
DEFINE('SCRIPTPATH',OFFSET.'script');

/* Path to directory that contains language files */
DEFINE('LANGUAGEPATH',OFFSET.'language');

/* Path to directory that contains images */
DEFINE('IMAGEPATH',OFFSET.'images');

/* Path to directory that contains sounds */
DEFINE('SOUNDPATH',OFFSET.'sounds');

/* Path to directory that contains log files */
DEFINE('LOGSPATH',OFFSET.'logs');

?>