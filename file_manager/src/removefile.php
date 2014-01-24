<?php 
session_start(); //session is begining
include("../config/config.php");

//part of the ZOA FILE MANAGEMENT PI
// removefile.php


//PI values
$subdir = $_REQUEST['zoa_file_subdirectory'];
$unsanitizedfilenames = $_REQUEST['zoa_uploaded_file_list'];

$subdir = sanitizeFilename($subdir);


$original_image_dir = ZOA__APP__FILE_DIR . ZOA__APP__ORIGINAL_DIR_NAME . "/";
$directory = $original_image_dir . $subdir . "/"; 				//set this to location of files uploaded. Tie it into the session


echo "<br>" . $subdir . "<br>";
foreach ($unsanitizedfilenames as $filename) {
	
	$filename = sanitizeFilename($filename);
	echo $directory . $filename;
	echo "removed<br>";
	unlink($directory . $filename);
	
}
	

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
fgdh
	<?php 
		echo $state;
		echo "<br>";
		echo $error;
	?>

</body>
</html>
<?php

function sanitizeFilename($filename) {

	$filename = preg_replace('/[^A-Za-z0-9_-]\./', '', $filename); 	//sanitization function
	return $filename;
}
?>