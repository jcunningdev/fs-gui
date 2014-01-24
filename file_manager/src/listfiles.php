<?php
session_start(); //session is begining
include("../config/config.php");

//part of the ZOA FILE MANAGEMENT PI
// src/listfiles.php

//defaults
$nofilesattached = "<option value=\"NONE\" selected=\"selected\">--No Files--</option>";
$listbutton      = "<input type=\"submit\" name=\"remove\" id=\"remove\" value=\"Remove\" title=\"Remove Selected Images\" class=\"button\">";

//PI values
$subdir = $_REQUEST['zoa_file_subdirectory'];
$subdir  = sanitizeFilename($subdir);
echo $subdir;
if ($subdir == "") {
	die(); //can't find those files; no base dir access here. Maybe just spit out a notice that you have to pick a subdir.
}


if (true) {

	$original_image_dir = ZOA__APP__FILE_DIR . ZOA__APP__ORIGINAL_DIR_NAME . "/";

	$directory = $original_image_dir . $subdir . "/"; //set this to location of files uploaded. Tie it into the session
	echo $directory; //debug
	$fileList = listFiles($directory);
	
	

	if ($fileList[0]) { 
		$options = "";
	
		foreach ($fileList as $filename) {
			$options .= "<option value=\"" . $filename . "\">" . $filename . "</option>";
		}

	} else { 
		$options = $nofilesattached;
	}

	$output = 
			"<select style=\"width: 250px;\" id=\"zoa_uploaded_file_list\" name=\"zoa_uploaded_file_list[]\" size=\"19\" multiple class=\"sel\">" . 
			$options . 
			"</select>";
			
	$output .= "<br><br>";
	$output .= $listbutton;
	
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Website Request Response</title>
	<script type="text/javascript" language="javascript">
		function writeContent() {
		
			//do what needs be done
			
			fileList = parent.document.getElementById("listfiles");
			newContent = document.getElementById("writableContent").innerHTML;
			fileList.innerHTML = newContent;
		}
	</script>

</head>

<body onload="writeContent();">

	<div id="writableContent">

		<?php echo $output; ?>

	</div>

</body>
</html>

<?php

function listFiles($directory) {

    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {

        // if $file isn't this directory or its parent, 
        // add it to the results array
        if ($file != '.' && $file != '..')
            $results[] = $file;
    }

    // tidy up: close the handler
    closedir($handler);

    // done!
    return $results;

}



?>