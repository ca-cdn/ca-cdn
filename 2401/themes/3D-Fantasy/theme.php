<?php

/************************************************************/
/* 3D-Fantasy.com Theme                                     */
/* by Francisco Burzi                                       */
/*                                                          */
/* Based on my theme Kaput with more clean design and used  */
/* in my 3D Portal http://3d-fantasy.com                    */
/* Remember to change the logo. The default logo has been   */
/* left as a "reference only".                              */
/************************************************************/

/************************************************************/
/* IMPORTANT NOTE FOR THEMES DEVELOPERS!                    */
/*                                                          */
/* When you start coding your theme, if you want to         */
/* distribute it, please double check it to fit the XHTML   */
/* 1.0 Transitional Standard. You can use the W3 validator  */
/* located at http://validator.w3.org                       */
/************************************************************/

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

/************************************************************/
/* Theme Colors Definition                                  */
/*                                                          */
/* Define colors for your web site. $bgcolor2 is generaly   */
/* used for the tables border as you can see on OpenTable() */
/* function, $bgcolor1 is for the table background and the  */
/* other two bgcolor variables follows the same criteria.   */
/* $texcolor1 and 2 are for tables internal texts           */
/************************************************************/

$bgcolor1 = '#d5d5d5';
$bgcolor2 = '#7b91ac';
$bgcolor3 = '#ffffff';
$bgcolor4 = '#d5d5d5';
$textcolor1 = '#000000';
$textcolor2 = '#000000';
if(file_exists('themes/3D-Fantasy/tables.php')){
include_once('themes/3D-Fantasy/tables.php');
}
/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
	global $user, $banners, $sitename, $slogan, $cookie, $prefix, $anonymous, $db, $nukeNAV;
	$modifiedSitename = _WELCOMETO.' '.$sitename;
	$search = _SEARCH;
	if ($user != 'Anonymous' && $user !='') {
		cookiedecode($user);
		$username = $cookie[1];
	}
	if (!isset($username)) {
		$username = '';
	}
	if (empty($username)) {
		$username = $anonymous;
	}
	echo '<body bgcolor="#ffffff" text="#000000" link="#363636" vlink="#363636" alink="#d5ae83">'."\n";
	if (!empty($nukeNAV)) {
		echo '<div style="float: left; position: relative; left: 50%;; width: auto;"><div style="position: relative; left: -50%; width: auto;">'.$nukeNAV.'</div></div><br /><br /><br />';
	}
	if ($banners) {
		echo ads(0);
	}
	echo '<br />';
	global $new_topic;
	$topics_list  = '<select name="new_topic" onchange="submit()">'."\n";
	$topics_list .= '<option value="">All Topics</option>'."\n";
	$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		$topicid = intval($topicid);
		$sel = '';
		if ($topicid==$new_topic) { $sel = 'selected="selected "'; }
		$topics_list .= '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		$sel = '';
	}
	if ($username == $anonymous) {
		$theuser = '&nbsp;&nbsp;<a href="modules.php?name=Your_Account">Create an account';
	} else {
		$theuser = '&nbsp;&nbsp;Welcome '.addslashes($username).'!';
	}
	$public_msg = public_message();
	$tmpl_file = 'themes/3D-Fantasy/header.html';
	$thefile = implode('', file($tmpl_file));
	$thefile = addslashes($thefile);
	$thefile = "\$r_file=\"".$thefile."\";";
	eval($thefile);
	print $r_file;
	blocks('left');
	$tmpl_file = 'themes/3D-Fantasy/left_center.html';
	$thefile = implode('', file($tmpl_file));
	$thefile = addslashes($thefile);
	$thefile = "\$r_file=\"".$thefile."\";";
	eval($thefile);
	print $r_file;
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: blocks(right);       */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
	 global $foot1, $foot2, $foot3, $copyright, $footmsg, $echoit;
	 if (defined('INDEX_FILE') AND INDEX_FILE===true) {
		  $tmpl_file = 'themes/3D-Fantasy/center_right.html';
		  $thefile = implode('', file($tmpl_file));
		  $thefile = addslashes($thefile);
		  $thefile = "\$r_file=\"".$thefile."\";";
		  eval($thefile);
		  print $r_file;
		  blocks('right');
	 }
	 $echoit = false;
	 footmsg($echoit);
	 $tmpl_file = 'themes/3D-Fantasy/footer.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = "\$r_file=\"".$thefile."\";";
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	 global $anonymous, $tipath;
	 $content = '';
	 $thetext = '<div>'.$thetext.'</div>';
	 $ThemeSel = get_theme();
	 if (@file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
		  $t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
	 } else {
		  $t_image = $tipath.$topicimage;
	 }
	 if (!empty($notes)) {
		  $notes = '<br /><br /><b>'._NOTE.'</b> <div>'.$notes.'</div>'."\n";
	 } else {
		  $notes = '';
	 }
	 if ($aid == $informant) {
		  $content = $thetext.$notes."\n";
	 } else {
		  if(!empty($informant)) {
				$content .= '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
		  } else {
				$content .= $anonymous.' ';
		  }
		  $content .= '<i>'._WRITES.':</i>&nbsp;&nbsp;'.$thetext.$notes;
	 }
	 $posted = _POSTEDBY.' ';
	 $posted .= get_author($aid);
	 $posted .= ' '._ON.' '.$time.' ('.$counter.' '._READS.')';
	 $tmpl_file = 'themes/3D-Fantasy/story_home.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = "\$r_file=\"".$thefile."\";";
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	 global $admin, $sid, $tipath, $user;
	 $ThemeSel = get_theme();
	 if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
		  $t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
	 } else {
		  $t_image = $tipath.$topicimage;
	 }
	 $thetext = '<div>'.$thetext.'</div>';
	 $posted = _POSTEDON.' '.$datetime.' '._BY.' ';
	 $posted .= get_author($aid);
	 if (!empty($notes)) {
		  $notes = '<br /><b>'._NOTE.'</b> <div>'.$notes.'</div>';
	 } else {
		  $notes = '';
	 }
	 if ($aid == $informant) {
		  $content = $thetext.$notes;
	 } else {
		  if(!empty($informant)) {
				global $admin, $user;
				if (is_user($user)||is_admin($admin)) $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><i>'.$informant.'</i></a> ';
				else $content = $informant.' ';//Raven 10/16/2005
		  } else {
				$content = $anonymous.' ';
		  }
		  $content .= '<i>'._WRITES.'</i> <div>'.$thetext.'</div>'.$notes;
	 }
	 $tmpl_file = 'themes/3D-Fantasy/story_page.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = "\$r_file=\"".$thefile."\";";
	 eval($thefile);
	 print $r_file;
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
	 $tmpl_file = 'themes/3D-Fantasy/blocks.html';
	 $thefile = implode('', file($tmpl_file));
	 $thefile = addslashes($thefile);
	 $thefile = "\$r_file=\"".$thefile."\";";
	 eval($thefile);
	 print $r_file;
}

?>
