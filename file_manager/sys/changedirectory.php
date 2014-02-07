<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();

	debug::log("script fired: " . substr($_SERVER['SCRIPT_FILENAME'], strlen(ZOA__APP__PROG_DIR))); //debug
	
	
	//input is: zoa_file_current_directory_path
	$directory_path  = isset($_REQUEST['zoa_file_current_directory_path']) ? $_REQUEST['zoa_file_current_directory_path'] : ZOA__APP__START_FILE_DIR;
	debug::log("directory_path set to: {$directory_path}");
	
	$qid = "qid";
	IRON__setMSHSessionVar($qid, "current_directory_path", $directory_path);
	debug::log("user directory path saved as: " . IRON__getMSHSession($qid, "current_directory_path"));
	
	$error = "";
	$state = "";

?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title></title>
	<script type="text/javascript" language="javascript">
		function runTaskList() {
			//task list
			reloadHiddenFrame('h_form_listfiles');
		}
		function reloadHiddenFrame(framename) {
			
			parent.frames[framename].location.reload();
		
		}
	</script>

</head>

<body onload="runTaskList();">
	<?php 
		echo $state;
		echo "<br>";
		echo $error;
	?>

</body>
</html>
