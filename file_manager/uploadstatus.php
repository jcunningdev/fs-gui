<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title></title>
<script language="JavaScript" type="text/javascript">
function checkopenner(){
	if(window.opener.done != null){
		window.opener.focus();
		self.close();
	}
}
self.setInterval('checkopenner()', 500);
</script>
<style type="text/css">
.text{
	font : Bold 14px/19px Verdana, Geneva, Arial, Helvetica, sans-serif;
	color: #1b3e99;
}
</style>
</head>

<body onBlur="self.focus();">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="100%" height="100%" align="center" valign="middle">
	<span class="text">Please wait, your file is uploading...</span><br><br>
	<img src="app-images/fileupload.gif" width="30" height="32" alt="" border="0">
	</td>
</tr>
</table>

</body>
</html>