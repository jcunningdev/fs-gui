<?php 
session_start();

include("../config/config.php");

//part of the ZOA FILE MANAGEMENT PI




//PI values
$subdir              = $_REQUEST['zoa_file_subdirectory'];
$fileupload_name     = $_FILES['zoa_file_upload']['name'];
$fileupload_tmp_name = $_FILES['zoa_file_upload']['tmp_name'];
$fileupload_size     = $_FILES['zoa_file_upload']['size'];
$fileupload_type     = $_FILES['zoa_file_upload']['type'];




//sanitize input:
$fileupload_name      = sanitizeFilename($fileupload_name);
$subdir               = sanitizeFilename($subdir);



$original_image_dir = ZOA__APP__FILE_DIR . ZOA__APP__ORIGINAL_DIR_NAME . "/";
$directory = $original_image_dir . $subdir . "/";

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
		} 
		else {
			if ($fileupload_type == "notallowed/type") {
				$error = "This file type is not allowed";
				unlink($fileupload_tmp_name);
				// assign error message, remove uploaded file, redisplay form.
			} 
			else {

				//File has passed all validation, copy it to the final destination and remove the temporary file:
				if (!copy($fileupload_tmp_name, $directory . $fileupload_name)) {
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
	</script

</head>

<body onload="runTaskList();">

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