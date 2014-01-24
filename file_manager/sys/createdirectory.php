<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();


	//part of the ZOA FILE MANAGEMENT PI


	

$state = '';
$error = '';

//PI values

$newDirectory			= isset($_REQUEST['zoa_new_directory']) ? $_REQUEST['zoa_new_directory'] : NULL;
$newDirectoryOptions	= 0777;


$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }


$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

$xcore_directory = $chroot_directory . $currentFilePath . ""; //set this to location of files uploaded. Tie it into the session
echo $xcore_directory; //debug


//sanitize input:
$newDirectory      = IRON__sanitizeString($newDirectory, "directoryname", '_');


if (true) {

	$newDirectoryPath = $xcore_directory . $newDirectory;
	$op = mkdir($newDirectoryPath, $newDirectoryOptions);
	if (!$op) { echo "operation failed";  } 
	
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title></title>
	<script type="text/javascript" language="javascript">
		function runTaskList() {
			//task list
			reloadHiddenFrame('h_form_listfiles');
			parent.closeuploadstatus();
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

