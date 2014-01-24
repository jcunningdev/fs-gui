<?php

$action = isset($_REQUEST['zoa__action']) ? $_REQUEST['zoa__action'] : NULL; 

if ($action == NULL || $action == "") {
	die("No Action Specified");
} else if ($action == "listfiles") {
	include("listfiles.php");
} else if ($action == "deletefiles") {
	include("deletefiles.php");
} else if ($action == "uploadfiles") {
	include("uploadfiles.php");
} else if ($action == "changedirectory") {
	include("changedirectory.php");
} else if ($action == "createdirectory") {
	include("createdirectory.php");
} 


?>
