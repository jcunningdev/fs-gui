<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();

	
	header("Location: manage_files.php");
	//echo $_SERVER['SCRIPT_FILENAME']; //debug

	

?>