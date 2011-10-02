<?php

/************************************************************/
/* Ported Theme Name: Anagram (v1.0)                        */
/* Original Theme Name: Vision (v1.0)                       */
/* Copyright (c) 2001 Somara Sem (http://www.somara.com)    */
/* Last Updated: 09/19/2001 by dezina.com                   */
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

$bgcolor1 = '#dad8d8';
$bgcolor2 = '#eeeeee';
$bgcolor3 = '#efefef';
$bgcolor4 = '#ffffff';
$textcolor1 = '#000000';
$textcolor2 = '#000000';

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* Define the tables look&feel for you whole site. For this */
/* we have two options: OpenTable and OpenTable2 functions. */
/* Then we have CloseTable and CloseTable2 function to      */
/* properly close our tables. The difference is that        */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

function OpenTable() {
	global $bgcolor1, $bgcolor2;
	echo '<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'"><tr><td>';
	echo '<table width="100%" border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'"><tr><td>';
}

function CloseTable() {
	echo '</td></tr></table></td></tr></table>';
}

function OpenTable2() {
	global $bgcolor1, $bgcolor2;
	echo '<table border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'" align="center"><tr><td>';
	echo '<table border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'"><tr><td>';
}

function CloseTable2() {
	echo '</td></tr></table></td></tr></table>';
}

/************************************************************/
/* FormatStory                                              */
/*                                                          */
/* Here we'll format the look of the stories in our site.   */
/* If you dig a little on the function you will notice that */
/* we set different stuff for anonymous, admin and users    */
/* when displaying the story.                               */
/************************************************************/

function FormatStory($thetext, $notes, $aid, $informant) {
	global $anonymous;
	$content = '';
	$thetext = '<div>'.$thetext.'</div>';
	if (!empty($notes)) {
		$notes = '<br /><b>'._NOTE.'</b>&nbsp;<div>'.$notes.'</div>';
	} else {
		$notes = '';
	}
	if ($aid == $informant) {
		$content = $thetext.$notes;
	}
	else {
		if(!empty($informant)) {
			global $admin, $user;
			if (is_user($user)||is_admin($admin)) $content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><i>'.$informant.'</i></a> ';
			else $content = $informant.' ';//Raven 10/16/2005
			} else {
				$content = $anonymous.' ';
			}
			$content .= '<i>'._WRITES.':</i>&nbsp;&nbsp;'.$thetext.$notes;
		}
	echo $content;
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
	cookiedecode($user);
	if (isset($cookie[1])) {
		$username = $cookie[1];
	}
	if (empty($username)) {
		$username = $anonymous;
	}
	echo '<body>';
	if (!empty($nukeNAV)) $nukeNAV = '<td bgcolor="#eeeeee" align="center" style="cursor: pointer;"><div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div></td>';
	else $nukeNAV = '<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'index.php\'"><a href="index.php">Home</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=Your_Account\'"><a href="modules.php?name=Your_Account">Your Account</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=FAQ\'"><a href="modules.php?name=FAQ">FAQ</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=Topics\'"><a href="modules.php?name=Topics">Topics</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=Content\'"><a href="modules.php?name=Content">Content</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=Submit_News\'"><a href="modules.php?name=Submit_News">Submit News</a></td>'
		.'<td width="14%" bgcolor="#eeeeee" align="center" style="cursor: pointer; " onmouseover="this.style.background=\'#dad8d8\'" onmouseout="this.style.background=\'#eeeeee\'" onclick="window.location.href=\'modules.php?name=Top\'"><a href="modules.php?name=Top">Top 10</a></td>';
	if ($banners == 1) {
		echo ads(0);
	}
	global $new_topic;
	echo '<br />'
		.'<table cellpadding="0" cellspacing="10" width="780" border="0" align="center" bgcolor="#eeeeee">'
		.'<tr>'
		.'<td bgcolor="#eeeeee">'
		.'<a href="index.php"><img src="themes/Anagram/images/logo.gif" align="left" alt="'._WELCOMETO.' '.$sitename.'" border="0" /></a></td>'
		.'<td bgcolor="#EEEEEE" align="right">'
		.'<form action="modules.php?name=Search" method="post"><font class="content" color="#000000"><b>'._SEARCH.':&nbsp;&nbsp;</b>'
		.'<input type="text" name="query" size="14" /></font></form></td>'
		.'<td bgcolor="#eeeeee" align="right">'
		.'<form action="modules.php?name=News" method="post"><font class="content"><b>'._TOPICS.':&nbsp;&nbsp;</b>';
		$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
	echo '<select name="new_topic" onchange="submit()">'
		.'<option value="">'._ALLTOPICS.'</option>';
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$sel = '';
			if ($topicid==$new_topic) { $sel = 'selected="selected"'; }
			echo '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>';
			$sel = '';
		}
	echo '</select></font></form></td>'
		.'</tr></table>'
		.'<table cellpadding="1" cellspacing="2" width="780" border="0" align="center" bgcolor="#DAD8D8">'
		.'<tr>' . $nukeNAV
		.'</tr>'
		.'</table>'
		.'<table cellpadding="0" cellspacing="0" width="780" border="0" align="center" bgcolor="#fefefe">'
		.'<tr>'
		.'<td bgcolor="#dad8d8" colspan="4"><img src="themes/Anagram/images/pixel.gif" width="1" style="height:1px;" alt="" border="0" hspace="0" /></td>'
		.'</tr>'
		.'<tr valign="middle" bgcolor="#dad8d8">'
		.'<td width="20%" nowrap="nowrap"><font class="content">';
	if ($username == "Anonymous") {
		echo '&nbsp;&nbsp;<a href="modules.php?name=Your_Account">'._LOGIN.'</a>';
	}
	else {
		echo '&nbsp;&nbsp;'._HELLO.' '.$username.'!';
	}
	echo '</font></td>'
		.'<td align="center" style="height:20px;" width="60%">'
		.'&nbsp;'
		.'</td>'
		.'<td align="right" width="20%"><font class="content">'
		."<script type=\"text/javascript\">\n\n"
		."<!--   // Array of Month Names\n"
		."var monthNames = new Array( \""._JANUARY."\",\""._FEBRUARY."\",\""._MARCH."\",\""._APRIL."\",\""._MAY."\",\""._JUNE."\",\""._JULY."\",\""._AUGUST."\",\""._SEPTEMBER."\",\""._OCTOBER."\",\""._NOVEMBER."\",\""._DECEMBER."\");\n"
		."var now = new Date();\n"
		."var thisYear = now.getYear();\n"
		."if(thisYear < 1900) {thisYear += 1900; } // corrections if Y2K display problem\n"
		."document.write(monthNames[now.getMonth()] + \" \" + now.getDate() + \", \" + thisYear);\n"
		."// -->\n\n"
		."</script></font></td>\n"
		.'<td>&nbsp;</td>'
		.'</tr>'
		.'<tr>'
		.'<td bgcolor="#dad8d8" colspan="4"><img src="themes/Anagram/images/pixel.gif" width="1" style="height:1px;" alt="" border="0" hspace="0" /></td>'
		.'</tr>'
		.'</table>'
;

	$public_msg = public_message();
	echo $public_msg.'<br />';
	echo '<!-- Begin Main Content -->'
		.'<table width="780" cellpadding="0" cellspacing="0" border="0" align="center"><tr valign="top">'
		.'<td style="background-image:url(themes/Anagram/images/column-bg.gif);">';
	blocks('left');
	echo '</td>'
		.'<td><img src="themes/Anagram/images/pixel.gif" width="1" style="height:1px;" border="0" alt="" /></td>'
		.'<td><img src="themes/Anagram/images/pixel.gif" width="5" style="height:1px;" border="0" alt="" /></td>'
		.'<td width="100%">';
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
	if (defined('INDEX_FILE') AND INDEX_FILE===true) {
		echo '</td><td><img src="themes/Anagram/images/pixel.gif" width="5" style="height:1px;" border="0" alt="" /></td>'
		.'<td style="background-image:url(themes/Anagram/images/column-bg.gif);">';
		blocks('r');
	}
	echo '</td>'
		.'</tr></table>'
		.'<table width="780" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center">'
		.'<tr align="center">'
		.'<td width="100%" bgcolor="#dad8d8"><img src="themes/Anagram/images/pixel.gif" width="1" style="height:1px;" alt="" /></td>'
		.'</tr>'
		.'</table>'
		.'<table width="780" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee" align="center">'
		.'<tr align="center">'
		.'<td width="100%" colspan="3">';
	footmsg();
	echo '</td>'
		.'</tr>'
		.'</table>';
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
	$ThemeSel = get_theme();
	if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
		$t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
	} else {
		$t_image = $tipath.$topicimage;
	}
	echo '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>'
		.'<table border="0" cellpadding="1" cellspacing="0" bgcolor="#dad8d8" width="100%"><tr><td>'
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#eeeeee" width="100%"><tr><td align="left">'
		.'<font class="option" color="#363636"><b>'.$title.'</b></font>'
		.'</td></tr></table></td></tr></table>'
		.'<b><a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a></b>';
	FormatStory($thetext, $notes, $aid, $informant);
	echo '</td></tr></table>'
		.'<table style="background-image:url(themes/Anagram/images/column-bg.gif);" border="0" cellpadding="1" cellspacing="0" width="100%">'
		 .'<tr><td>'
		.'<table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td align="center">'
		.'<font class="tiny">'._POSTEDBY.' ';
	formatAidHeader($aid);
	echo ' '._ON.' '.$time.' ('.$counter.' '._READS.')<br /></font>'
		.'<font class="content">'.$morelink.'</font>'
		.'</td></tr></table></td></tr></table>'
		.'<br />';
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $tipath, $admin_file;
	$ThemeSel = get_theme();
	if (file_exists('themes/'.$ThemeSel.'/images/topics/'.$topicimage)) {
		$t_image = 'themes/'.$ThemeSel.'/images/topics/'.$topicimage;
	} else {
		$t_image = $tipath.$topicimage;
	}
	echo '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>'
		.'<table border="0" cellpadding="1" cellspacing="0" bgcolor="#dad8d8" width="100%"><tr><td>'
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#eeeeee" width="100%"><tr><td align="left">'
		.'<font class="option" color="#363636"><b>'.$title.'</b></font><br />'
		.'<font class="content">'._POSTEDON.' '.$datetime.' '._BY.' </font>';
	formatAidHeader($aid);
	if (is_admin($admin)) {
		echo '<br />[ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
	}
	echo '</td></tr></table></td></tr></table><br />';
	echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>';
	FormatStory($thetext, $notes, $aid, $informant);
	echo '</td></tr></table><br />';
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
	echo '<table border="0" cellpadding="1" cellspacing="0" width="150">'
		.'<tr>'
		.'<td>'
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#eeeeee" width="100%">'
		.'<tr>'
		.'<td align="left"><font class="content" color="#363636"><b>'.$title.'</b></font></td>'
		.'</tr>'
		.'</table>'
		.'</td>'
		.'</tr>'
		.'</table>'
		.'<table border="0" cellpadding="3" cellspacing="0" width="150">'
		.'<tr valign="top"><td>'
		.''.$content.''
		.'</td></tr></table>'
		.'<br />';
}
?>
