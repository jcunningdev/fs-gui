<?php

$system_info = new system_info();
$system_info->enable_debugging(); //this is enabled by default so the developer can help troublshoot

#Configurable Zone: Alter these values to override the defaults
$conf['PROG_DIR'] = ""; //the directory the filemanager application is in. leave blank to enable auto-detect
$conf['FILE_DIR'] = ""; //the file directory you want to manage. If you leave this blank, it uses PROG_DIR . "/files"
$conf['SITE_URL'] = ""; //the base url of the website, for setting cookies. If blank, application tries to guess.

define("ZOA__APP__FILE_MAX_UPLOAD_SIZE", 52428800);
define("ZOA__DEBUG__MODE", false); //refactor these out
define("ZOA__APP__START_FILE_DIR", "/"); //relative to CHROOT_DIR; this is where the file manager is initially opened to


define("IRON__SESSION_NAME", "ZOA_C");
define("IRON__SESSION_LIFETIME", 0);
define("IRON__SESSION_PATH", '/');
define("IRON__SESSION_SECURE", false);

#Advanced Configuration - you shouldn't need to alter these directives, but they're available to you.
define("ZOA__APP__PROG_DIR", 		!empty($conf['PROG_DIR']) ? $conf['PROG_DIR'] : $system_info->autodetect_application_root()); //If the application root is not set, try to autodetect it
define("ZOA__APP__CHROOT_FILE_DIR", !empty($conf['FILE_DIR']) ? $conf['FILE_DIR'] : ZOA__APP__PROG_DIR . "/files" ); //If the directory for the files you want to manage is not set, use the default
define("ZOA__LIB__CORE", ZOA__APP__PROG_DIR . "hypatiacore/lib.core.php");
define("IRON__SESSION_DOMAIN", !empty($conf['SITE_URL']) ? $conf['SITE_URL'] : $system_info->autodetect_application_site() ); //If the directory for the files you want to manage is not set, use the default

define("ZOA__APP__DEBUG", FALSE); #these should be factored out of the code
//define("ZOA__APP__DEBUG", TRUE); 


/**	
*	A short helper class for configuration.
*	
*/
class system_info { 

	public function autodetect_application_root() { #attempts to autodetect the application root
		$config_file_location = dirname(__FILE__);
		$config_file_relative = "config"; //you shouldn't need to change this
		return substr($config_file_location, 0, strlen($config_file_location) - strlen($config_file_relative));
	}
	
	public function autodetect_application_site() { #attempts to autodetect the application root
		return $_SERVER['HTTP_HOST']; //this is pretty straightforward.
	}
	
	public function enable_debugging() {
	
		ini_set('display_errors',1);
		ini_set('display_startup_errors',1);
		error_reporting(-1);
	
	}

}


#these aren't used - I stripped the login options
define("IRON__SYS_PRELOGIN_URL", "");
define("IRON__SYS_POSTLOGIN_URL", "");


?>