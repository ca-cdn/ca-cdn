<?php
/**************************************************************************/
/* nukeSEO DH: Dynamic HEAD Tags
/* =======================================================================*/
/*
/* Copyright (c) 2009, Kevin Guske  http://nukeseo.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* Mantis 1671
 include_once 'includes/jquery/jquery.php';
 */
addJSToHead('includes/jquery/jquery.colorbox-min.js','file');
addCSSToHead('includes/jquery/css/colorbox.css','file');
$inlineJS = '<script type="text/javascript">
	$(document).ready(function(){
		$(".colorbox").colorbox({opacity:0.65, current:"{current} of {total}"});
		$(".colorboxSEO").colorbox({opacity:0.50, width:"750", height:"300", iframe:true});
	});
</script>'."\n";
addJSToHead($inlineJS,'inline');

?>