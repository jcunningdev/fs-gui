<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();

	debug::log("script fired: " . substr($_SERVER['SCRIPT_FILENAME'], strlen(ZOA__APP__PROG_DIR))); //debug


	//part of the ZOA FILE MANAGEMENT PI


$state = '';
$error = '';

//PI values
	
$unsanitizedfilenames = isset($_REQUEST['zoa_uploaded_file_list']) ? $_REQUEST['zoa_uploaded_file_list'] : NULL;	


$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }


$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

$xcore_directory = $chroot_directory . $currentFilePath . ""; //set this to location of files uploaded. Tie it into the session
debug::log($xcore_directory); //debug
	
if (is_array($unsanitizedfilenames)) { 	
	foreach ($unsanitizedfilenames as $filename) {
		$filename = IRON__sanitizeString($filename, "filename", '_');
		echo $xcore_directory . $filename;
		echo "removed<br>";
		unlink($xcore_directory . $filename);
	}
} else if (is_string($unsanitizedfilenames)) {

	$filename = IRON__sanitizeString($unsanitizedfilenames, "filename", '_');
	echo $xcore_directory . $filename;
	echo "removed<br>";
	unlink($xcore_directory . $filename);

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