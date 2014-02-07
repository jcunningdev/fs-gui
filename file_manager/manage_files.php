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

?><!DOCTYPE HTML>

<html>
<head>
	<title>HWAT</title>
	<meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1">
	<?php if (!ZOA__APP__DEBUG) { echo '<link rel="stylesheet" type="text/css" href="css/debug.css" type="text/css">'; } ?>
	<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.13.custom.css?fin=11"><!-- remove fin for production to allow caching -->
	<script src="js/jquery-1.5.1.min.js?fin=11" type="text/javascript"></script>
	<script src="js/jquery-ui-1.8.13.custom.min.js?fin=11" type="text/javascript"></script>
	<script src="js/lib.fm_core.js?fin=11" type="text/javascript"></script>
	<!-- modules here -->
	<script src="modules/htmleditor.mod/tiny_mce/tiny_mce.js?fin=11" type="text/javascript"></script>
	<!--<script src="modules/htmleditor.mod/editor.js?fin=11" type="text/javascript"></script> 
	<!-- modules done -->
	<link rel="stylesheet" type="text/css" href="css/interface.css" type="text/css">
	<style type="text/css">
	
	.file_item { 
		cursor: pointer; 
		color: red; 
	}
	.file_item:hover { 
		background-color: #e1f4ff;
	}	
	
	.file_item .ui-selecting { 
		background-color: #FECA40; 
	}
	.file_item .ui-selected { 
		background-color: #F39814; color: white; 
	}
	.directory_item { 
		cursor: pointer; 
		color: black; 
	}	
	.directory_item:hover { 
		background-color: #e1f4ff;
	}	
	
	body {
		background-image:url('app-images/stripe.png');
		background-color: #555555;
		font-family: "Trebuchet MS";
		font-size: 10pt;
	}
	
	.file-style {
		padding: 10px;
	}
	
	</style>
	
</head>
<body>

<div align="center" class="bg"><div style="width: 800px;">
	<div><!-- FS GUI START -->
	
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="25" width="800">
			<div align="center">
				<div>
					<div class="rcornrsfg">
						<span style="font-size: 11pt; font-weight: bold; color: #ffffff;">FS Gui</span>
						<br>
						<span style="font-size: 17pt; font-weight: bold; color: #ffffff;">FILE MANAGER<br><br></span>
					</div>
				</div>
			</div>
		</td>
	</tr>
	</table>

	<!-- Menu Interface -->

	<div align="left" style="margin-top: -25px; padding: 10px; background-color: #E6E6E6;">
		<!-- Menu Bar Contents -->
	
		<!-- menu bar -->
		<div>
			
			<div align="right">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
				<td align="left">
					<FORM enctype="multipart/form-data" action="sys/uploadfiles.php" method="POST" target="h_form_upload_file">
					<input type="file" NAME="zoa_file_upload" id="zoa_file_upload">	
					<input type="submit" NAME="uploadfile" id="uploadfile" value="Upload File" onclick="uploadFile();">
					</FORM>
				</td>
				<!-- menu buttons -->
				<td><input type="image" src="app-images/mono/folder32.png" id="fs_MakeDirButton" title="New Folder"></td>
				<td><input type="image" src="app-images/mono/linedpaperplus32.png" id="fs_MakeTxtButton" title="New Text file"></td>
				<td><input type="image" src="app-images/mono/paperplus32.png" id="fs_MakeHtmButton" title="New web page"></td>
				<td><input type="image" src="app-images/mono/paperminus32.png" id="fs_DeleteFileButton" title="Delete Selected File"></td>
				<td><input type="image" src="app-images/mono/questionbook32.png" id="fs_HelpButton" title="Help"></td>
				<td><input type="image" src="app-images/mono/lightbulb32.png" id="fs_InfoButton" title="Info"></td>
				</tr>
			</table>
			</div>
			<br>
			<!-- dialogs -->
			<div id="fs_MakeDirDialog" title="Create New Folder">
					New directory name:<br>
					<input type="text" size="16" id="fs_MakeDirInput">   
					<input type="button" id="fs_MakeDirConfirm" name="login" value="Create!"> 
			</div>
			<div id="fs_MakeTxtDialog" title="New Text File">
					<input type="text" size="16" id="fs_MakeTxtInput">
					<textarea id="fs_MakeTxtContent" cols="80" rows="20"></textarea>
					<br>
					<div align="right" style="width: 100%"><input type="button" id="fs_MakeTxtConfirm" value="Save"></div>
			</div>
			<div id="fs_MakeHtmDialog" title="New Web Page">
					<input type="text" size="16" id="fs_MakeTxtInput"> (.html)
					<textarea id="fs_MakeHtmContent" name="fs_MakeHtmContent" cols="80" rows="20"></textarea>
					<br>
					<div align="right" style="width: 100%"><input type="button" id="fs_MakeHtmConfirm" value="Save"></div>
			</div>
			<div id="fs_HelpDialog" title="New Web Page">
				Just some words
			</div>
			<div id="fs_InfoDialog" title="New Web Page">
				Just some words
			</div>
		</div>
		
		<!-- file path -->
		<div>
			<div>
			<FORM action="sys/changedirectory.php" id="zoa_file_form_change_directory" method="POST" 
				  target="h_form_change_directory" enctype="multipart/form-data"
				  style="display: inline;">
				<INPUT type="text" NAME="zoa_file_current_directory_path"
					 id="zoa_file_current_directory_path"
					 style="width:720px;"
					 value="<?php echo ZOA__APP__START_FILE_DIR ?>">
					 
				<div style="float: right;"><INPUT type="SUBMIT" NAME="zoa_change_directory" value="Go"></div>
			</FORM>
			</div>
		</div>

	<!-- End of Menu Interface -->
	</div>
	

	<div align="left" style="background-color: #E6E6E6; border: 0px; border-style: solid;">
		<div class="file-style">
			<FORM action="sys/zoa__action_processor.php" method="post" target="h_form_delete_file">
				<INPUT type="hidden" NAME="zoa_file_current_directory_path" value="<?php echo $currentdir; ?>">
				<div id="listfiles">
					
				</div>
			</FORM>
			<br>
			<div align="right" style="margin-top: -18px;"><input type="button" onclick="closeSelf();" value="Close"></div>
		</div>
	</div>
	

	<div class="dev-feature">
			<div>actions</div>
			<FORM	enctype="multipart/form-data" action="sys/fsgui_actions.php" 
					method="POST" target="h_fsgui_generic"
					id="za_fsgui_actions_form">
				<input name="fsgui_action" id="fsgui_action" value="">
				<input name="fsgui_vararg1" id="fsgui_vararg1" value="">
				<input name="fsgui_vararg2" id="fsgui_vararg2" value="">
				<input name="fsgui_vararg3" id="fsgui_vararg3" value="">
				<textarea name="fsgui_content"	id="fsgui_content" rows="2" cols="20"></textarea>
			</FORM>
	</div>
	<!-- why multichannel? So we can perform multiple operations simultaneously... especially ones that might be time consuming -->
	

	<br>

	<!-- FS GUI END -->
	</div>
</div></div>

<div>
	<h2>Developer Debugging</h2>
	<!-- why multichannel? So we can perform multiple operations simultaneously... especially ones that might be time consuming -->
	
	<iframe NAME="h_form_change_directory" 	src="about:blank"> height="0" width="0" frameborder="no"</iframe>
	<iframe NAME="h_form_upload_file" 		src="about:blank"> height="0" width="0" frameborder="no"</iframe>
	<iframe NAME="h_form_delete_file" 		src="about:blank"> height="0" width="0" frameborder="0"></iframe>
	<iframe NAME="h_fsgui_fetch" 			src="about:blank"> height="0" width="0" frameborder="0"></iframe>
	<iframe NAME="h_fsgui_generic" 			src="about:blank"> height="0" width="0" frameborder="0"></iframe>
	<iframe NAME="h_form_listfiles" 		src="sys/listfiles.php?zoa_file_currentdirectory=<?php echo $currentdir; ?>"> height="0" width="0"  frameborder="0"></iframe>
</div>

<script type="text/javascript" language="javascript">
	var currently_selected_files = new Array();
	var uploadstatuswindow = '';
	var ptr_uploadstatuswindow;
	
	var fetch_ready;
	
	
	//ui level scripting here
	$(function() { //init UI

		//DeleteFileOrDirectory
		$( "#fs_DeleteFileButton" ).click(function() {
			if (currently_selected_files.length != 0) { 
				var r=confirm("Are you sure you wish to delete \n" + currently_selected_files[0]); //later, iterate over and print out all file names
				if (r==true) {
					deleteFile(currently_selected_files[0]);
				} else {
					//do nothing
				} 
			} else {
				alert("What is the eraser without paper? Select a file to delete; you cannot delete the nothing.");
			}
			//$( "#fs_MakeDirInput" ).focus(); //se opening remarks
			setTimeout(function() { $( "#fs_MakeDirInput" ).focus(); }, 1000); //500 seems to work, since .focus() is lost if the animation is still playing
			return false;
		});
	
		//CreateDir
		//note the focusSelector option only exists because I patched it into my copy of the source. see #4731
			//...three years later, I don't even remember writing a bugfix for jquery, let alone submitting it. 
			//Ugh. I'll have to winmerge the source and find out what I did.
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
			setTimeout(function() { $( "#fs_MakeDirInput" ).focus(); }, 1000); //500 seems to work, since .focus() is lost if the animation is still playing
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
		//bind cleanup functions 
		$( "#fs_MakeTxtDialog" ).bind( "dialogbeforeclose", function(event, ui) {
			//reset Dialog to empty
			$( "#fs_MakeTxtInput" ).val('');
			$( "#fs_MakeTxtContent" ).val('');
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
			
			//reset Dialog to empty
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
		
		//if tinymce!~
		tinyMCE.init({
		
			mode : "none", 
			theme: "advanced",
			theme_advanced_toolbar_location: "top", 
		
			//HTML 4.01 Transitional is easier to migrate to html5 than from xhtml strict, since many ideas presented in xhtml were abandoned 
			doctype : '<!DOCTYPE HTML">',
			element_format : "html",
			
			//Integration Settings:
				mode : "exact",
				elements : "dhtml_editor_text",
				//plugin_preview_pageurl : "",
				plugin_preview_width : "900",
				plugin_preview_height : "400",		


				// Example content CSS (should be your site CSS)
				//content_css : "/css/styles.css?fin=11",

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js?fin=11",
				external_link_list_url : "lists/link_list.js?fin=11",
				external_image_list_url : "lists/image_list.js?fin=11",
				media_external_list_url : "lists/media_list.js?fin=11",

			//Sanity Settings - let us make sure we are not catching any program ideolog-eases
			
				//We want the source to be Pretty and Legible, so we will enable this option.
				//note that it was much more functional in the 2.x series; the api documentation even claims it is removed for some reason.
				//in 2.x it would actually apply tabs and everything. Future development may suggest going back into the 2.x branch and patching 3.x for it
				apply_source_formatting : true,
			
				//We're going to use linebreaks, not P tags, which exhibit many problems
				remove_linebreaks : false,		 //do not remove linebreaks
				forced_root_block : false,		// do not force the use of "p" tags
				force_p_newlines : false,
				force_br_newlines : true,
				remove_redundant_brs : false,	//don't remove brs that are redundant either, because that is not the place of the program to decide
			
				//We're going to leave newlines as newlines for now
				convert_newlines_to_brs : false, //do not convert newlines to brs
				preformatted : true,				// if there is whitespace somewhere, we put it there. Leave it for readability.
				//verify_html : false,				// if it becomes necessary, this will turn off the html modifications.

				
				//let's not be picky
				convert_fonts_to_spans : false,
				inline_styles : true, 			//we don't need to force styles to be inline

			
				//we desire to use absolute urls, as an unfortunate consequence
				relative_urls : false,

				//This is our element set:
				valid_elements : '@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur],b/strong,i/em,strike,u,-p[align],-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,-blockquote[cite],-table[border=0|cellspacing|cellpadding|width|frame|rules|height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],object[classid|width|height|codebase|*],param[name|value],embed[type|width|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value|tabindex|accesskey],kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],q[cite],samp,select[disabled|multiple|name|size],small,textarea[cols|rows|disabled|name|readonly],tt,var,big',

				//These are what never can be
				verify_css_classes : false,
				
				
				// The Graphic User Interface must work for the user

					theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,removeformat,",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,undo,redo,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,cleanup,code,",
					theme_advanced_buttons3 : "link,unlink,|,image,media,charmap,hr,|,insertdate,inserttime,anchor,nonbreaking,|,tablecontrols",

					theme_advanced_buttons4 : "fullscreen,save,print,preview,",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					
					//we only need sane elements
					theme_advanced_blockformats : "div,h1,h2,h3,h4,h5,h6,blockquote,code", 
					
					//sane source management
					theme_advanced_source_editor_wrap : true, 
				
			// General options
			plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",


			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}


});

		/*
		tinyMCE.settings = {
					theme : "advanced",
					mode : "none", 
					theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
					theme_advanced_buttons2 : "",
					theme_advanced_buttons3 : "",
					theme_advanced_toolbar_location : "top",								
					theme_advanced_toolbar_align : "left"
		};
		*/
		
		$( "#fs_MakeHtmDialog" ).bind( "dialogopen", function(event, ui) { 
				
			//tinyMCE.execCommand('mceAddControl', false, "fs_MakeHtmContent"); //again, the delay problem
		});
		$( "#fs_MakeHtmDialog" ).bind( "dialogbeforeclose", function(event, ui) {//this event set is fine
			tinyMCE.execCommand('mceFocus', false, "fs_MakeHtmContent");
			tinyMCE.execCommand('mceRemoveControl', false, "fs_MakeHtmContent");
		});
		//~if tinymce!
		
		//bind cleanup functions 
		$( "#fs_MakeHtmDialog" ).bind( "dialogbeforeclose", function(event, ui) {
			//reset Dialog to empty
			$( "#fs_MakeHtmInput" ).val('');
			$( "#fs_MakeHtmContent" ).val('');
		});
		
		$( "#fs_MakeHtmButton" ).click(function() {
			$( "#fs_MakeHtmDialog" ).dialog( "open" );
			//$( "#fs_MakeHtmInput" ).focus(); //se opening remarks
			setTimeout(function() { 
						$( "#fs_MakeHtmInput" ).focus(); 
						//~if tinymce>
						tinyMCE.execCommand('mceAddControl', false, "fs_MakeHtmContent");
						//~if tinymce!
					}
					, 1000); //500 seems to work
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
	
	
	function initFSGui() { //refresh the File System UI (i.e, clicking on files or directories as opposed to buttons or dialogs)
		currently_selected_files.length = 0; //if the file list has been refreshed, deselect everything 
		
		$( ".file_item" ).draggable({ revert: true, helper: "clone",  opacity: 0.7  });
		$( ".directory_item" ).draggable({ revert: true, helper: "clone",  opacity: 0.7 });
		$( ".directory_item" ).droppable({
			drop: function( event, ui ) {
				var file= ui.draggable.attr("fs_loc");
				var dir = $( this ).attr("fs_loc");
				moveFile(file, dir);
			}
		});
		$( ".file_item, .directory_item" ).click(function() {  //cause the item to be highlighted
			//todo: there will be bugs when dealing with files that have the same name as a directory, fix it then delete this comment
			var clicked_file = $(this).attr("fs_loc");
			if (true) { //that CTRL is not being held down. implement multiselect later
			
				//untoggle all previously selected items
				$( "#zoa_uploaded_file_list > .file_item, .directory_item" ).each(function() {
					$( this ).css("border", "none");
					$(this).css("padding-left", "0px");
				});
				
			}	
			
			//toggle the item selected on or off
			if ($(this).attr("fs_loc") != currently_selected_files[0]) {
				var file	= $(this).attr("fs_loc");
				$(this).css("border", "dashed 1px gray"); 	//going to leave it like this since rather than using add/removeClass
				$(this).css("padding-left", "10px");		//eventually I will make a better painter method that prevents the dashed border from stacking
				
		
				currently_selected_files.length = 0;	//truncate the list of selected files to zero
				currently_selected_files.push(file); 	//insert into collection of selected
			
			} else {
				//we're done, no need to select anything.
			}

		});		
		$( ".file_item" ).dblclick(function() { 
			fetch_ready = false; //global
			var file	= $(this).attr("fs_loc");
			var type 	= $(this).attr("fs_itype");
			if (type == "text") {
				//fetch content
				loadContent(file);
				setTimeout(function() { 
					if (fetch_ready == false) {
						return arguments.callee; //recurse -^
					} else if (fetch_ready == true) {
						var content	= readContent();
						$( "#fs_MakeTxtInput" ).val(file);
						
						//turn interface into an editor
						$( "#fs_MakeTxtInput" ).hide();
						$( "#fs_MakeTxtDialog" ).dialog('option', 'title', 'File Editor');
						$( "#fs_MakeTxtContent" ).val(content);
							
						//launch
						$( "#fs_MakeTxtButton" ).click();
					}
				}, 100);
			} else if (type == "image") {
				alert('todo: image code');
			}

		});
		//$( ".directory_item" ).selectable(); //drag and drop trash todo
		
	}
	
	
	function uploadFile() {
		
		displayuploadstatus('uploadstatus.php');
		
		return true;
	}
	function closeSelf() {
		window.opener = window;
		window.close(); 
	}

	//nongeneric application level scripting here
	function loadContent(file) {
		window.frames['h_fsgui_fetch'].location = "sys/get.php?filename=" + file;
	}
	function readContent() {
		return window.frames['h_fsgui_fetch'].document.getElementById('srv_readfile').innerHTML;
	}
		
	function createTxt(txtname, content) {
		var ActionType	= document.getElementById('fsgui_action');
		ActionType.value = "maketxt"; 
		document.getElementById('fsgui_vararg1').value	= txtname;
		document.getElementById('fsgui_vararg2').value 	= '';
		document.getElementById('fsgui_vararg3').value 	= ''; 
		document.getElementById('fsgui_content').value	= content;
		//all ready: send the request
		document.getElementById("za_fsgui_actions_form").submit();
	
	}
			
	function createDirectory(dir) { //can move files or folders - we can get this function more generic I'd say
		var ActionType	= document.getElementById('fsgui_action');
		ActionType.value = "makedir"; 
		document.getElementById('fsgui_vararg1').value	= dir;
		document.getElementById('fsgui_vararg2').value	= '';
		document.getElementById('fsgui_vararg3').value	= ''; 
		document.getElementById('fsgui_content').value	= '';
		
		//all ready: send the request
		document.getElementById("za_fsgui_actions_form").submit();
		
		
	}		
	
	function changeDirectory(directory) {
		var DirectoryPathInput	= document.getElementById('zoa_file_current_directory_path');
		DirectoryPathInput.value = DirectoryPathInput.value + directory + "/";
		//strangely we seem to be getting /dir/dir as a result
		document.getElementById("zoa_file_form_change_directory").submit();
	}
	
	function moveFile(file, dir) { //can move files or folders - we can get this function more generic I'd say
		var ActionType	= document.getElementById('fsgui_action');
		ActionType.value = "move"; 
		document.getElementById('fsgui_vararg1').value = file;
		document.getElementById('fsgui_vararg2').value = dir;
		document.getElementById('fsgui_vararg3').value = ''; 
		document.getElementById('fsgui_content').value		= '';
		
		//all ready: send the request
		document.getElementById("za_fsgui_actions_form").submit();
		
		
	}
	
	function deleteFile(file) {
	
		window.frames['h_form_delete_file'].location = "sys/deletefiles.php?zoa_uploaded_file_list=" + file;
	}
	function previousDirectory() {
		var DirectoryPathInput	= document.getElementById('zoa_file_current_directory_path');
		var CurrentPath         = DirectoryPathInput.value;
		var CurrentPathLength   = CurrentPath.length - 1;
		
		if (CurrentPath.charAt(CurrentPathLength) == '/') {
			CurrentPath = CurrentPath.slice(0, CurrentPath.length -2);
		}
		var PreviousPathLength = CurrentPath.lastIndexOf('/');
		var PreviousPath       = CurrentPath.slice(0, PreviousPathLength);
		DirectoryPathInput.value = PreviousPath;
		//DirectoryPathInput.value + directory + "/";
		document.getElementById("zoa_file_form_change_directory").submit();
	}
</script>

</body>

</html>