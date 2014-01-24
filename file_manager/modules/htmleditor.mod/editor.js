tinyMCE.init({
			
	mode : "none", 
	theme: "advanced",
	theme_advanced_toolbar_location: "top", 
	
	//HTML 4.01 Transitional is easier to migrate to html5 than from xhtml strict, since many ideas presented in xhtml were abandoned 
			doctype : '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
			element_format : "html",
		
		//Integration Settings:
			mode : "exact",
			elements : "dhtml_editor_text",
			plugin_preview_pageurl : "<?php echo ZOA_EDITOR_SITE_BASE_URL; ?>self_editable_page.php",
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
