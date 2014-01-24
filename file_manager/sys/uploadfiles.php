<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();


	//part of the ZOA FILE MANAGEMENT PI


$state = '';
$error = '';

//PI values

$fileupload_name     = isset($_FILES['zoa_file_upload']['name']) ? $_FILES['zoa_file_upload']['name'] : NULL;
$fileupload_tmp_name = isset($_FILES['zoa_file_upload']['tmp_name']) ? $_FILES['zoa_file_upload']['tmp_name'] : NULL;
$fileupload_size     = isset($_FILES['zoa_file_upload']['size']) ? $_FILES['zoa_file_upload']['size'] : NULL;
$fileupload_type     = isset($_FILES['zoa_file_upload']['type']) ? $_FILES['zoa_file_upload']['type'] : NULL;



$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }


$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

$xcore_directory = $chroot_directory . $currentFilePath . ""; //set this to location of files uploaded. Tie it into the session
echo $xcore_directory; //debug


//sanitize input:
$fileupload_name      = IRON__sanitizeString($fileupload_name, "filename", '_');




if (true) {

	if (!is_uploaded_file($fileupload_tmp_name)) {
		$error = "You did not upload a file!";
		unlink($fileupload_tmp_name);
    		// assign error message, remove uploaded file, redisplay form.
	} else {
    		//a file was uploaded

		if ($fileupload_size > ZOA__APP__FILE_MAX_UPLOAD_SIZE) {
			$error = "File is too large";
			unlink($fileupload_tmp_name);
			// assign error message, remove uploaded file, redisplay form.
		} else {
			if ($fileupload_type == "notallowed/type") {
				$error = "This file type is not allowed";
				unlink($fileupload_tmp_name);
				// assign error message, remove uploaded file, redisplay form.
			} else {

				//File has passed all validation, copy it to the final destination and remove the temporary file:
				if (!copy($fileupload_tmp_name, $xcore_directory . $fileupload_name)) {
					echo $directory . $fileupload_name;
					echo ("Copy failed<br>");
				}
				unlink($fileupload_tmp_name);
				$state = "File has been successfully uploaded!";
			}
		}
	}

	
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

