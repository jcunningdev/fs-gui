<?php

	require(".hdef.php"); 

	IRON__initRuntime();
	IRON__cleanRequest();
	IRON__initSession();


?><?php //app logic

//registering session values:
$_REQUEST['zoa_file_currentdirectory'] = isset($_REQUEST['zoa_file_currentdirectory']) ? $_REQUEST['zoa_file_currentdirectory'] : NULL;

//PI

$currentdir = $_REQUEST['zoa_file_currentdirectory'];

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
	<title></title>
	<meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1">
	<?php if (!ZOA__APP__DEBUG) { echo '<link rel="stylesheet" type="text/css" href="css/debug.css" type="text/css">'; } ?>

	
	<!--
	<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.13.custom.css?fin=11">

	<script src="js/jquery-1.5.1.min.js?fin=11" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.13.custom.min.js?fin=11" type="text/javascript"></script>
	<script src="js/lib.fm_core.js?fin=11" type="text/javascript"></script>
	-->
	<!-- modules here -->
	<script src="modules/htmleditor.mod/tiny_mce/tiny_mce.js?fin=11" type="text/javascript"></script>
	<script src="modules/htmleditor.mod/editor.js?fin=11" type="text/javascript"></script>
	<!-- modules done -->
	<link rel="stylesheet" type="text/css" href="css/styles.css" type="text/css">
	
	<!--
	<script type="text/javascript" language="javascript">
		var uploadstatuswindow = '';
		var ptr_uploadstatuswindow;
		
		var fetch_ready;
		
		$(function() { //init

			//CreateDir
			//note the focusSelector option only exists because I patched it into my copy of the source. see #4731
			//for portability I'm going to use a delay in the click option
			$( "#fs_MakeDirDialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				focusSelector: '#fs_MakeDirInput'
			});
			$( "#fs_MakeDirButton" ).click(function() {
				$( "#fs_MakeDirDialog" ).dialog( "open" );
				//$( "#fs_MakeDirInput" ).focus(); //se opening remarks
				setTimeout(function() { $( "#fs_MakeDirInput" ).focus(); }, 1000); //500 seems to work
				return false;
			});
			$( "#fs_MakeDirInput" ).keypress(function(e){
				if(e.which == 13){
					$( "#fs_MakeDirConfirm" ).click();
				}
			});
			$( "#fs_MakeDirConfirm" ).click(function() {
				var dir = $( "#fs_MakeDirInput" ).val();
				createDirectory(dir);
				$( "#fs_MakeDirInput" ).val('');
				$( "#fs_MakeDirDialog" ).dialog( "close" );
				return false;
			});
			

			//CreateTxt
			$( "#fs_MakeTxtDialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				width: 720,
				focusSelector: '#fs_MakeTxtInput'
			});		
			$( "#fs_MakeTxtButton" ).click(function() {
				$( "#fs_MakeTxtDialog" ).dialog( "open" );
				//$( "#fs_MakeTxtInput" ).focus(); //se opening remarks
				setTimeout(function() { $( "#fs_MakeTxtInput" ).focus(); }, 1000); //500 seems to work
				return false;
			});
			$( "#fs_MakeTxtConfirm" ).click(function() {
				var Name	= $( "#fs_MakeTxtInput" ).val();
				var Txt		= $( "#fs_MakeTxtContent" ).val();
				createTxt(Name, Txt);
				$( "#fs_MakeTxtInput" ).val('');
				$( "#fs_MakeTxtContent" ).val('');
				$( "#fs_MakeTxtDialog" ).dialog( "close" );
				return false;
			});
					
			
			//MakeHtm
			$( "#fs_MakeHtmDialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				width: 720,
				focusSelector: '#fs_MakeHtmInput'
			});		
			$( "#fs_MakeHtmButton" ).click(function() {
				$( "#fs_MakeHtmDialog" ).dialog( "open" );
				//$( "#fs_MakeHtmInput" ).focus(); //se opening remarks
				setTimeout(function() { $( "#fs_MakeHtmInput" ).focus(); }, 1000); //500 seems to work
				return false;
			});
			$( "#fs_MakeHtmConfirm" ).click(function() {
				var Name	= $( "#fs_MakeHtmInput" ).val();
				var Htm		= $( "#fs_MakeHtmContent" ).val();
				createHtm(Name, Htm);
				$( "#fs_MakeHtmInput" ).val('');
				$( "#fs_MakeHtmContent" ).val('');
				$( "#fs_MakeHtmDialog" ).dialog( "close" );
				return false;
			});
			
	
			//Help
			$( "#fs_HelpDialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				width: 720
			});						
			$( "#fs_HelpButton" ).click(function() {
				$( "#fs_HelpDialog" ).dialog( "open" );
				return false;
			});
			
			//Info
			$( "#fs_InfoDialog" ).dialog({
				autoOpen: false,
				show: "blind",
				hide: "explode",
				width: 720
			});			
			$( "#fs_InfoButton" ).click(function() {
				$( "#fs_InfoDialog" ).dialog( "open" );
				return false;
			});
			
		}); //end of init
		
		
	</script>
	-->
	<style type="text/css">

	</style>
	
</head>
<body>

<div align="center" class="bg"><div style="width: 800px;">
	<div>
		TESTING NEW TECH
		<hr>
		<textarea id="fs_MakeHtmContent" name="fs_MakeHtmContent" cols="80" rows="20"></textarea>
	</div>
</div>

</body>
</html>