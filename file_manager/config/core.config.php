<?php

define("ZOA__APP__DEBUG", FALSE);
//define("ZOA__APP__DEBUG", TRUE);
error_reporting(E_ALL);
//config: generic upload file manager


define("ZOA__APP__PROG_DIR", "/thedirectory of the program/");
define("ZOA__APP__CHROOT_FILE_DIR", "/the directory of the files you want to manage/files"); //no trailing slash: chroot takes care of it

define("ZOA__APP__START_FILE_DIR", "/"); //relative to CHROOT_DIR; this is where the file manager is initially opened to
define("ZOA__LIB__CORE", ZOA__APP__PROG_DIR . "lib.core.php");





define("ZOA__APP__FILE_MAX_UPLOAD_SIZE", 52428800);
define("ZOA__DEBUG__MODE", false);


define("IRON__SESSION_NAME", "ZOA_C");
define("IRON__SESSION_LIFETIME", 0);
define("IRON__SESSION_PATH", '/');
define("IRON__SESSION_DOMAIN", 'digitalreticula.com'); //set the correct domain here
define("IRON__SESSION_SECURE", false);

define("IRON__SYS_PRELOGIN_URL", "");
define("IRON__SYS_POSTLOGIN_URL", "");


?>