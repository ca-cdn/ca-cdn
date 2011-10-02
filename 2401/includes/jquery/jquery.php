<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2009, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if(!isset($_GET['op']))  $_GET['op'] = '';
if(!isset($name))  $name = '';
addJSToHead('includes/jquery/jquery.js', 'file');
// Get your account configuration to prevent overriding $ya_config used in other places
get_lang('Your_Account');
require_once('modules/Your_Account/includes/constants.php');
include_once('modules/Your_Account/includes/functions.php');
$ya_config = ya_get_configs();
if ($name=='Your_Account' and $_GET['op']=='new_user') {
  // need to get the languages - G
//  global $lang;
//  include_once('modules/Your_Account/language/lang-'.$lang.'.php');
//	get_lang('Your_Account');
//	require_once('modules/Your_Account/includes/constants.php');
//	include_once('modules/Your_Account/includes/functions.php');

	addCSSToHead('includes/jquery/css/screen.css', 'file');
	addCSSToHead('includes/jquery/css/jquery.css', 'file');
	addJSToHead('includes/jquery/jquery.validate.js', 'file');
	addJSToHead('includes/jquery/jquery.password.js', 'file');
	global $ya_CustomFields;
	$ya_CustomFields = ya_GetCustomRegFields();
	addJSToHead('includes/jquery/cmxforms.js', 'file');
	$JStoHeadHTML = '
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	// validate signup form on keyup and submit
	var validator = $("#newUser").validate({
		rules: {
			ya_username: {
				required: true,
				minlength: '.$ya_config['nick_min'].',
        remote: "rnxhr.php?name=Your_Account&file=public/userAvailability"
			},';
	if ($ya_config['userealname']==3) $JStoHeadHTML .= 'ya_realname: "required",';
		$JStoHeadHTML .= 'ya_user_email: {
				required: true,
				email: true,
				remote: "rnxhr.php?name=Your_Account&file=public/emailAvailability"
				},';
	if ($ya_config['doublecheckemail']==1)
		$JStoHeadHTML .= 'ya_user_email2: {
				required: true,
				email: true,
				equalTo: "#ya_user_email"
				},';
	$JStoHeadHTML .= $ya_CustomFields['rules'].'
			user_password: {
				minlength: '.$ya_config['pass_min'].'
			},
			user_password2: {
				minlength: '.$ya_config['pass_min'].',
				equalTo: "#user_password"
			}
		},
		messages: {
			ya_username: {
				required: "'._YA_MSG_ENTERUSERNAME.'",
				minLength: "'._YA_MSG_USERNAMELENGTH.' '.$ya_config['nick_min'].' '._YA_MSG_CHARACTERS.'",
				remote: jQuery.format("{0} '._YA_MSG_USERNAME_ERROR.'")
			},';
	if ($ya_config['userealname']==3) $JStoHeadHTML .= 'ya_realname: "'._YA_MSG_ENTERREALNAME.'",';
		$JStoHeadHTML .= 'ya_user_email: {
				required: "'._YA_MSG_ENTERVALIDEMAIL.'",
				email: "'._YA_MSG_ENTERVALIDEMAIL.'",
				remote: jQuery.format("{0} '._YA_MSG_EMAIL_ERROR.'")
			},';
	if ($ya_config['doublecheckemail']==1)
		$JStoHeadHTML .= 'ya_user_email2: {
				required: "'._YA_MSG_ENTERVALIDEMAIL.'",
				email: "'._YA_MSG_ENTERVALIDEMAIL.'",
				equalTo: "'._YA_MSG_EMAIL2_MISMATCH.'"
			},';
	$JStoHeadHTML .=  $ya_CustomFields['messages'].'
			user_password: {
				minLength: "'._YA_MSG_PASSWORDLENGTH.' '.$ya_config['pass_min'].' '._YA_MSG_CHARACTERS.'"
			},
			user_password2: {
				minLength: "'._YA_MSG_PASSWORDLENGTH.' '.$ya_config['pass_min'].' '._YA_MSG_CHARACTERS.'",
				equalTo: "'._YA_MSG_PASSWORD2_MISMATCH.'"
			}
		}
	});
});
// ]]>
</script>
';
	addJSToHead($JStoHeadHTML, 'inline');
}
?>