<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();

	//$error =  $_SERVER['SCRIPT_FILENAME']; //debug
  // loc1 is the path on the computer to the base directory that may be moved		return $state;


	//part of the Za FILE MANAGEMENT PI
	$state = '';
	$error = '';

//PI values
	
$qid = "qid";
$currentFilePath = IRON__getMSHSession($qid, "current_directory_path");
if ( (!isset($currentFilePath)) || ($currentFilePath == "") ) { $currentFilePath = ZOA__APP__START_FILE_DIR; }


$chroot_directory = ZOA__APP__CHROOT_FILE_DIR;

$xcore_directory = $chroot_directory . $currentFilePath . ""; //set this to location of files uploaded. Tie it into the session
//$error =  $xcore_directory; //debug


//controller backend
if ( (!isset($_REQUEST['fsgui_action'])) || ($_REQUEST['fsgui_action'] == "") ) { 
	$error =  '<font color="red">No action specified!</font>';
} else { //action specified
	$action = $_REQUEST['fsgui_action'];
	
	if ( (!isset($_REQUEST['fsgui_vararg1'])) || ($_REQUEST['fsgui_vararg1'] == "") ) { //error
	} else { $vararg1 = $_REQUEST['fsgui_vararg1']; }
	
	if ( (!isset($_REQUEST['fsgui_vararg2'])) || ($_REQUEST['fsgui_vararg1'] == "") ) { //error
	} else { $vararg2 = $_REQUEST['fsgui_vararg2']; }
	
	if ( (!isset($_REQUEST['fsgui_vararg3'])) || ($_REQUEST['fsgui_vararg3'] == "") ) { //error
	} else { $vararg3 = $_REQUEST['fsgui_vararg3']; }	
	
	if ( (!isset($_REQUEST['fsgui_content'])) || ($_REQUEST['fsgui_content'] == "") ) { //error
	} else { $varcontent = $_REQUEST['fsgui_content']; }	
	
	switch ($action) {

	
		case "move":
			$state =  "Moving a file...<br>";
			$dirHandle = new FileManipulator($xcore_directory);
			$state .= $dirHandle->fs_moveFiles($vararg1, $vararg2); //move files

		break;
	
		case "makedir":
			$state =  "Creating a directory...<br>";
			$dirHandle = new FileManipulator($xcore_directory);
			$state .= $dirHandle->fs_createDir($vararg1); //move files
	
		break;
		
		case "maketxt":
			$state =  "Creating a new file...<br>";
			$fileHandle = new FileManipulator($xcore_directory);
			$state .= $fileHandle->fs_createFile($vararg1, $varcontent); //move files
		break;
		
		default:
			 $error =  '<font color="red">Action Unknown.</font>';
		break;
	}
}

//lib
class FileManipulator {
    //todo: permissions
		//todo: security
		//todo: vararg checker
		//todo: graceful fail
		//todo: fail logging
		//todo: windows sleep() in case of stuck open handles
		//todo: handling nonchmodable file errors
		//todo: confirmation to overwrite dialog
	
	// property declaration
    public $cwd = ZOA__APP__CHROOT_FILE_DIR;

	public function __construct($currentWorkingDirectory) {
		$this->cwd = $currentWorkingDirectory;
	
	}
	
	public function fs_moveFiles($vararg1, $vararg2) {
		
		$src_file		=  $this->cwd . $vararg1; 
		$dest_file		=  $this->cwd . $vararg2 . "/" . $vararg1;
		$state			= "";

		if (is_dir($src_file)) { 
			$state =  $src_file . " directory was moved to: <br>" . $dest_file . "<br>";
			dirmv($src_file, $dest_file);
		} else if (is_file($src_file)) {
			$state =  $src_file . " file was moved to: <br>" . $dest_file . "<br>";
			rename($src_file, $dest_file);
		}
		
		return $state;
	}
	
	public function fs_createDir($vararg1) {
		
		$new_dir		=  $this->cwd . $vararg1; 
		$state			= "";
		
		//check if dir exists already! TODO
		$t = mkdir($new_dir);
		if ($t) { $state = " successfully made directory<br>"; } else { $state = " direcotry not made successfully<br>"; }
		
		return $state;
	}
	
	public function fs_createFile($vararg1, $varcontent) {
		
		//hackfix TODO: system failing to address files without extensions properly. So:
		if (!strpos($vararg1, ".")) { 
			echo "TODO: adding .txt to extension";
			$vararg1 =  $vararg1 . ".txt"; 
		}
		
		$filename		=  $this->cwd . $vararg1; 
		$filecontent	=  $varcontent;
		$state			= "";

		$fh				= fopen($filename, "w+");
		
		fwrite($fh, $varcontent);
		fclose($fh);

		return $state;
	}
	

}




/* usage: 
	* $source = directory you wish to move. do not supply trailing slash
	* $dest = new directory that will be made. do not supply trailing slash
	* $overwrite = whether to overwrite existing files.
	* $DS = a recursive directive containing the current relative dir. Supply no such argument on first call
*/
function dirmv($source, $dest, $overwrite = false, $DS = NULL){ //did it! 30 - 05 - 2011


	//recursion
	$DS 		= $DS 		. "/";
	$i_source 	= $source	. $DS;
	$i_dest		= $dest		. $DS;

	if(!is_dir( $i_dest)) {
		mkdir( $i_dest); // make subdirectory before subdirectory is copied
	}

	if($handle = opendir( $i_source)){ //open source directory

		while(false !== ($file = readdir($handle))){ //get next item in source directory
			if($file != '.' && $file != '..'){ //ignore unix backlinks

				$path  = $i_source .  $file;
				$path2 = $i_dest .  $file;
				echo "we found a file: <br> {$path} <br>to<br> {$path2}";
				if(is_file($path)){ //if it is a file
					if(!is_file( $path2)){ //if it doesn't exist
						if(!rename( $path,  $path2)){
							echo '<font color="red">File ('.$path.') could not be moved, likely a permissions problem.</font>';
						}
					} else if($overwrite){
						if(!unlink( $path2)){
							echo  'Unable to overwrite file ("'.$path2.'"), likely to be a permissions problem.';
						}
					} else {
						if(!rename( $path,  $path2)){
							echo '<font color="red">File ('.$path.') could not be moved while overwritting, likely a permissions problem.</font>';
						}
					}
				} else if(is_dir($path)) { //if it is a directory
					dirmv($i_source, $i_dest, $overwrite, $file); //recurse!
					rmdir($path);
				}
			}
		}
		closedir($handle);
		rmdir($source); //finally, remove the base directory
	}
} // end of dirmv()

	



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
		echo "";
		echo $error;
	?>

</body>
</html>