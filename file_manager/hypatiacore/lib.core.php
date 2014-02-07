<?php

class debug {

	public static function log($statement, $optionalvar=null) {
	
		#define your preferred debug method here.
		echo nl2br($statement . "\n");
		if( isset($optionalvar)) { var_dump($optionalvar); }
	}

}

function IRON__initSession() {
	/* sessions are superset of multihased accounts and magic variables. 
	* WHAT IT DOES:
	* 1) This function starts the session
	* 2) This function also checks for session affixing and corrects the session id if it has been preset
	* 3) This function will also take steps to ensure the session is only conveyed through SSL if that option has been set.
	* 4) This function tracks the name and id of the cookie
	* WHAT IT DOESN'T DO
	* 1) check the user IP, browser agent or otherwise;
	* 2) Adjust any of the non-voodoo variables; it is idempotent and safe
	* 3) Close the session
	*/

	session_name(IRON__SESSION_NAME);
	session_set_cookie_params(IRON__SESSION_LIFETIME,  IRON__SESSION_PATH, IRON__SESSION_DOMAIN,  IRON__SESSION_SECURE);
	session_start();
	
	/* PHP - red headed stepchild */

	#two-phase client authentication:
	
	
	
	#Register input for phase one
	$_SESSION['IRON__session_cookie_options_set'] 	= isset($_SESSION['IRON__session_cookie_options_set']) ? $_SESSION['IRON__session_cookie_options_set'] : NULL;
	$_SESSION['IRON__session_affix'] 				= isset($_SESSION['IRON__session_affix']) ? $_SESSION['IRON__session_affix'] : NULL;


	
	#phase one start
	if ($_SESSION['IRON__session_cookie_options_set'] != 1 
	||  $_SESSION['IRON__session_affix'] != 1) {
		if ( isset($_COOKIE[session_name()]) ) {
    			setcookie(session_name(), '', time()-42000, '/');
		}
		session_destroy(); 
		session_set_cookie_params(IRON__SESSION_LIFETIME,  IRON__SESSION_PATH, IRON__SESSION_DOMAIN,  IRON__SESSION_SECURE);
		session_start();
		$_SESSION['IRON__session_cookie_options_set'] = 1;
		$_SESSION['IRON__session_affix'] = 1;
	}
	#phase one finish
	

	
	
	#phase two start
	#Register input for phase two
	$_SESSION['IRON__session_counter']				= isset($_SESSION['IRON__session_counter']) ? $_SESSION['IRON__session_counter'] : NULL;
	
	$_SESSION['IRON__session_counter'] = $_SESSION['IRON__session_counter'] + 1; //debug
	$_SESSION['IRON__session_name'] = session_name(); // should we need it.
	$_SESSION['IRON__session_id'] = session_id(); // should we need it.
	#phase two finish
	 
	 
	
	# session.cookie_lifetime		IRON__SESSION_LIFETIME	int
	# session.cookie_domain		IRON__SESSION_DOMAIN		string
		# session.cookie_path	IRON__SESSION_PATH	 	string
	# session.cookie_secure		IRON__SESSION_SECURE		bool
	# session.cookie_httponly 		IRON__SESSION_HTTPONLY	bool
	
	
	
}

function IRON__initRuntime() {

	header("Content-Type: text/html; charset=ISO-8859-1");

}

function IRON__cleanRequest() { 
	/** IRON__cleanRequest cleans the entire $_REQUEST variable 
	* - no param, returns nothing, operates directly on $_REQUEST
	* 1) sets the magqic quotes for the runtime to 0.
	* 2) recursively! walks the entire array and strips slashes if magic quotes is enabled in any way
	*/

	if ( phpversion() < '5.3.0' ) { set_magic_quotes_runtime(0); }
	if ((get_magic_quotes_gpc() == 1) || (get_magic_quotes_runtime() == 1)) {

		function array_clean(&$value) {
			if (is_array($value)) {
				array_walk($value, 'array_clean');
				return;
			} else {
				$value = stripslashes($value);
			}
		}

		array_walk($_REQUEST, 'array_clean');
	
	}

	return;

}


function IRON__sanitizeString($x_string, $x_stringtype, $x_replacement_string='') {

	$sanitized_string = "";

	if (!isset($x_stringtype) || $x_stringtype == "") {
		
		//must specify a string type
		
	} else if ($x_stringtype == "filename") {
		$sanitized_string = preg_replace('/[^A-Za-z0-9_-]\./', $x_replacement_string, $x_string); 	//sanitization function
		return $sanitized_string;
	} else if ($x_stringtype == "directoryname") { /* questionable */
		$sanitized_string = preg_replace('/[^A-Za-z0-9_-]/', $x_replacement_string, $x_string); 	//sanitization function
		return $sanitized_string;
	}
}

function IRON__setMSHSessionVar($qid, $key, $value) {
/** 
*	$qid is a unique user id, for purposes of maintaining separate user active states within a single session; it is the key of the subarray
*	$key is the key of the $_SESSSION var
*	$Value is the value to be set
*	The only reason this function exists is because there is a disconnect between active user sessions as a session; and users as an entity within the chat;
* 	So this function is a wrapper to $_SESSION[$qid] so that I can rework it later to modify both active state and entity state
*/

	$_SESSION[$qid][$key] = $value;
	return true;
}

function IRON__getMSHSession($qid, $key) {
/** 
*	$qid is a unique user id, for purposes of maintaining separate user active states within a single session; it is the key of the subarray
*	$key is the key of the $_SESSSION var that we want returned.
*	The only reason this function exists is because there is a disconnect between active user sessions as a session; and users as an entity within the chat;
* 	So this function is a wrapper to $_SESSION[$qid] so that I can rework it later to modify both active state and entity state
*/
	if (isset($_SESSION[$qid])) {
		$return_value = isset($_SESSION[$qid][$key]) ? $_SESSION[$qid][$key] : NULL;
		return $return_value;
	}
}

?>