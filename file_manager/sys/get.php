<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();

	echo $_SERVER['SCRIPT_FILENAME']; //debug


	//part of the ZOA FILE MANAGEMENT PI


$state = '';
$error = '';

//PI values
	
$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }

$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

$xcore_directory = $chroot_directory . $currentFilePath . ""; //set this to location of files uploaded. Tie it into the session
	
	if ( (!isset($_REQUEST['filename'])) || ($_REQUEST['filename'] == "") ) { //error
	} else { $filename = $_REQUEST['filename']; }

	
	$file	= $xcore_directory . $filename;
	
	$content= file_get_contents($file);
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title></title>
	<script type="text/javascript" language="javascript">
		function runTaskList() {
			//task list
			parent.fetch_ready = true;
			
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
	<textarea id="srv_readfile"><?php echo $content; ?></textarea>
	
</body>
</html>