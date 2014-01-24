<?php

require(".hdef.php"); 

IRON__initRuntime();
IRON__cleanRequest();
IRON__initSession();

//echo $_SERVER['SCRIPT_FILENAME']; //debug

	//part of the ZOA FILE MANAGEMENT PI
// src/listfiles.php

//defaults
$nofilesattached	= "<div value=\"NONE\" >--No Files--</div>";
$previousdirectory	= "<div ondblclick=\"previousDirectory(); return false;\"><I>< back</I></div>";
//$listbutton			= "<input type=\"submit\" name=\"zoa__action\" id=\"remove\" value=\"deletefiles\" title=\"Remove Selected Images\" class=\"button\">";
$listbutton			= "";

$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) && ($currentFilePath != "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }


//PI values


if (true) {

	$qid = "qid";
	$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
	echo $currentFilePath; 
	if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }

	echo $currentFilePath . "<br>";

	$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

	$xcore_directory = $chroot_directory . $currentFilePath . "/"; //set this to location of files uploaded. Tie it into the session
	echo $xcore_directory; //debug
	$fileList = listFiles($xcore_directory); //Get a list of all the files in that directory
	
	$options = "";	
	if ($currentFilePath != "/") { $options .= $previousdirectory; }


	if ($fileList[0]) { 
		//$finfo	= finfo_open(FILEINFO_MIME_TYPE); //open magic mime types
		foreach ($fileList as $filename) {
			if (is_file($xcore_directory . $filename)) {
				
				//$type	= finfo_file($finfo, $xcore_directory . $filename);
				//if (strpos($type, "image") !== FALSE) { $fs_itype = "image"; } else { $fs_itype = "text"; } //be sure to differentiate between zero and FALSE
				$options .= "<div class=\"file_item\" 	"
							. "fs_loc=\"{$filename}\"	"
							. "fs_itype=\"{$fs_itype}\"	"
							. ">"
							. "<img src=\"app-images/mini_icons/page.gif\">" 
							. $filename
							. "</div>";
			} else if (is_dir($xcore_directory . $filename)) {
				$options .= "<div ondblclick=\"changeDirectory('" . $filename . "');\" "
							. "fs_loc=\"" . $filename . "\""
							. "class=\"directory_item\" value=\"" . $filename . "\">"
							. "<img src=\"app-images/mini_icons/folder.gif\">"
							. $filename 
							. "</div>";
			} // is_link?
			
		}

	} else { 

		$options .= $nofilesattached;
	}

	$filelistSelector_html = 
			"<div 	 id=\"zoa_uploaded_file_list\" 
					 name=\"zoa_uploaded_file_list[]\" size=\"20\" 
					 style=\"background-color: #ffffff; width: 780px; border-style: groove; border-width: 2px; border-color: grey;\"
					 class=\"sel\">\n" . 
			$options . 
			"\n</div>";
			
	$filelistSelector_html .= "<br><br>";
	$filelistSelector_html .= $listbutton;
	
}




?><?php

$response = <<< EOT

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Website Request Response</title>
	<script type="text/javascript" language="javascript">
		function runTaskList() {
			new_file_path = readContent("currentFilePath");
			setParentFormInputValue("zoa_file_current_directory_path", new_file_path);
			copyContentToParent("writableContent", "listfiles");
			parent.initFSGui();
		}


		function setParentFormInputValue(input_id, new_value) {
			form_input 		= parent.document.getElementById(input_id);
			form_input.value	= new_value;
		}
		function copyContentToParent(from_id, to_parent_id) {
		
			//do what needs be done
			
			ParentElement = parent.document.getElementById(to_parent_id);
			newContent = document.getElementById(from_id).innerHTML;
			ParentElement.innerHTML = newContent;
		}
		function readContent(from_id) {
			content = document.getElementById(from_id).innerHTML;
			return content;
		}
	</script>

</head>

<body onload="runTaskList();">
	<div id="writableContent">{$filelistSelector_html}</div>
	<div id="currentFilePath">{$currentFilePath}</div>
</body>
</html>
EOT;

//for now:

echo $response;

?><?php

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
