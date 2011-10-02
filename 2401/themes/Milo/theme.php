<?php

/************************************************************/
/* Ported Theme Name: Milo (v1.0)                           */
/* Original Theme Name: FungKu (v1.0)                       */
/* Copyright (c) 2001 Somara Sem (http://www.somara.com)    */
/* Last Updated: 09/21/2001 by dezina.com                   */
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

$bgcolor1 = "#efefef";
$bgcolor2 = "#808080";
$bgcolor3 = "#efefef";
$bgcolor4 = "#808080";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

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
		echo '<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'"><tr><td>'."\n";
		echo '<table width="100%" border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'"><tr><td>'."\n";
}

function CloseTable() {
		echo '</td></tr></table></td></tr></table>'."\n";
}

function OpenTable2() {
		global $bgcolor1, $bgcolor2;
		echo '<table border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'" align="center"><tr><td>'."\n";
		echo '<table border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'"><tr><td>'."\n";
}

function CloseTable2() {
		echo '</td></tr></table></td></tr></table>'."\n";
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
	} else {
		if(!empty($informant)) {
			global $admin, $user;
			if (is_user($user)||is_admin($admin)) {
				$content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><i>'.$informant.'</i></a> ';
			}
			else {
				$content = $informant.' ';//Raven 10/16/2005
			}
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
	global $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $anonymous, $nukeurl, $module_name, $admin, $name, $index, $admin_file, $nukeNAV;
	if ($user != '') {
		cookiedecode($user);
		$username = $cookie[1];
	}
	if (!isset($username)) {
		$username = '';
	}
	if (empty($username)) {
		$username = "$anonymous";
	}
		echo '<body bgcolor="#ffffff" text="#000000" link="#363636" vlink="#363636" alink="#d5ae83">'."\n"
		.'<br />'."\n";
		if ($banners) {
			echo ads(0);
		}
		echo '<br />'."\n";
		echo '<table cellpadding="0" cellspacing="0" width="756" border="0" align="center" bgcolor="#ffffff">'."\n";
		if (!empty($nukeNAV)) echo '<tr><td><div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div></td></tr>';
		echo '<tr>'."\n"
		.'<td bgcolor="#ffffff" width="306">'."\n"
		.'<a href="index.php"><img src="themes/Milo/images/logo.gif" align="left" alt="'._WELCOMETO.' '.$sitename.'" border="0" /></a></td>'."\n"
		.'</tr>'."\n"
		.'</table><br />'."\n"
		.'<table cellpadding="0" cellspacing="0" width="750" border="0" align="center" bgcolor="#ffffff">'."\n"
		.'<tr>'."\n"
		.'<td bgcolor="#808080">'."\n"
		.'<img src="themes/Milo/images/tophighlight.gif" alt="" /></td>'."\n"
		.'</tr>'."\n"
		.'</table>'."\n"
		.'<table cellpadding="6" cellspacing="0" width="750" border="0" align="center" bgcolor="#ffffff">'."\n"
		.'<tr valign="middle">'."\n"
		.'<td width="400" bgcolor="#c0c0c0" align="left">'."\n"
		.'&nbsp;</td>'."\n"
		.'<td bgcolor="#c0c0c0" align="center">'."\n"
		.'<form action="modules.php?name=Search" method="post"><font class="content" color="#000000"><b>'._SEARCH.':&nbsp;&nbsp;</b>'
		.'<input type="text" name="query" size="14" /></font></form></td>'
		.'<td bgcolor="#c0c0c0" align="center">'."\n"
		.'<form action="modules.php?name=News" method="post"><font class="content"><b>'._TOPICS.':&nbsp;&nbsp;</b>';
		$toplist = $db->sql_query('select topicid, topictext from '.$prefix.'_topics order by topictext');
		echo '<select name="new_topic" onchange="submit()">'."\n"
		.'<option value="">'._ALLTOPICS.'</option>'."\n";
		global $new_topic;
		while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
			$topicid = intval($topicid);
			$sel = '';
			if ($topicid==$new_topic) { $sel = 'selected="selected "'; }
			echo '<option ' . $sel . ' value="' . $topicid . '">' . $topics . '</option>' . "\n";
			$sel = '';
		}
		echo '</select></font></form></td>'."\n"
		.'</tr></table>'."\n"
		.'<table cellpadding="0" cellspacing="0" width="750" border="0" align="center" bgcolor="#fefefe">'."\n"
		.'<tr>'."\n"
		.'<td bgcolor="#000000" colspan="4"><img src="themes/Milo/images/pixel.gif" width="1" style="height: 1px;;" alt="" border="0" hspace="0" /></td>'."\n"
		.'</tr>'."\n"
		.'<tr valign="middle" bgcolor="#808080">'."\n"
		.'<td width="15%" nowrap="nowrap"><font class="content" color="#363636">'."\n";
		if ($username == "Anonymous") {
echo '&nbsp;&nbsp;<font color="#363636"><a href="modules.php?name=Your_Account">Create</a></font> an account'."\n";
		} else {
		echo '&nbsp;&nbsp;'._HELLO.' '.$username.'! &nbsp;&nbsp;[ <a href="modules.php?name=Your_Account&amp;op=logout">Logout</a> ]';
		}
		echo '</font></td>'."\n"
		.'<td align="center" style="height: 20px;" width="60%">'."\n"
		.'&nbsp;'."\n"
		.'</td>'."\n"
		.'<td align="right" width="25%"><font class="content">'."\n"
		.'<script type="text/javascript">'."\n\n"
		."<!--   // Array of Month Names\n"
		.'var monthNames = new Array( \''._JANUARY.'\', \''._FEBRUARY.'\', \''._MARCH.'\', \''._APRIL.'\', \''._MAY.'\', \''._JUNE.'\', \''._JULY.'\', \''._AUGUST.'\', \''._SEPTEMBER.'\', \''._OCTOBER.'\', \''._NOVEMBER.'\', \''._DECEMBER.'\');'."\n"
		."var now = new Date();\n"
		."var thisYear = now.getYear();\n"
		."if(thisYear < 1900) {thisYear += 1900; } // corrections if Y2K display problem\n"
		.'document.write(monthNames[now.getMonth()] + \' \' + now.getDate() + \', \' + thisYear);'."\n"
		."// -->\n\n"
		.'</script></font></td>'."\n"
		.'<td>&nbsp;</td>'."\n"
		.'</tr>'."\n"
		.'<tr>'."\n"
		.'<td bgcolor="#000000" colspan="4"><img src="themes/Milo/images/pixel.gif" width="1" style="height: 1px" alt="" border="0" hspace="0" /></td>'."\n"
		.'</tr>'."\n"
		.'</table>'."\n"
		.'<!-- FIN DEL TITULO -->'."\n"
		.'<table width="750" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center">'."\n"
		.'<tr valign="top">'."\n"
		.'<td bgcolor="#C0C0C0"><img src="themes/Milo/images/pixel.gif" width="1" style="height: 3px" border="0" alt="" /></td>'."\n"
		.'</tr>'."\n"
		.'<tr valign="top">'."\n"
		.'<td bgcolor="#ffffff"><img src="themes/Milo/images/pixel.gif" width="1" style="height: 5px" border="0" alt="" /></td>'."\n"
		.'</tr>'."\n"
		.'</table>'."\n"
;
		$public_msg = public_message();
			echo "$public_msg<br />";
		echo '<table width="750" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center"><tr valign="top">'."\n"
		.'<td bgcolor="#eeeeee" width="150" valign="top">'."\n";
		blocks("l");
		echo '</td><td><img src="themes/Milo/images/pixel.gif" width="15" style="height: 1px" border="0" alt="" /></td><td width="100%">'."\n";
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
	if (defined('INDEX_FILE') && INDEX_FILE===true) {
		echo '</td><td><img src="themes/Milo/images/pixel.gif" width="15" style="height: 1px" border="0" alt="" /></td><td valign="top" width="150" bgcolor="#eeeeee">'."\n";
		blocks("r");
		}
		echo '</td>'."\n"
		.'</tr></table>'."\n"
		.'<table bgcolor="#000000" width="750" cellpadding="0" cellspacing="0" border="0" align="center">'."\n"
		.'<tr>'."\n"
		.'<td width="750" style="height: 5px"><img src="themes/Milo/images/bottombar.gif" width="750" style="height: 5px;" border="0" alt="" /></td>'."\n"
		.'</tr>'."\n"
		.'<tr>'."\n"
		.'<td width="100%"><img src="themes/Milo/images/pixel.gif" width="1" style="height: 1px" border="0" alt="" /></td>'."\n"
		.'</tr>'."\n"
		.'</table>'."\n"
		.'<br />'."\n"
		.'<br />'."\n"
		.'<table width="750" cellpadding="0" cellspacing="0" border="0" align="center">'."\n"
		.'<tr align="center">'."\n"
		.'<td width="100%" colspan="3">'."\n";
		footmsg();
		echo '</td>'."\n"
		.'</tr>'."\n"
		.'</table>'."\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the Homepage         */
/************************************************************/

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	echo '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>'."\n"
		.'<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="100%"><tr><td>'."\n"
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#C0C0C0" width="100%"><tr><td align="left">'."\n"
		.'<font class="option" color="#363636"><b>'.$title.'</b></font>'."\n"
		.'</td></tr></table></td></tr></table>'."\n"
		.'<font color="#999999"><b><a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a></b></font>'."\n";
		FormatStory($thetext, $notes, $aid, $informant);
		echo '</td></tr></table><br />'."\n"
		.'<table border="0" cellpadding="1" cellspacing="0" bgcolor="#eeeeee" width="100%"><tr><td>'."\n"
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td align="center">'."\n"
		.'<font color="#999999" size="1">'._POSTEDBY.' ';
		formatAidHeader($aid);
		echo ' '._ON.' '.$time.' ('.$counter.' '._READS.')<br /></font>'."\n"
		.'<font class="content">'.$morelink.'</font>'."\n"
		.'</td></tr></table></td></tr></table>'."\n"
		.'<br />'."\n"."\n"."\n";
}

/************************************************************/
/* Function themeindex()                                    */
/*                                                          */
/* This function format the stories on the story page, when */
/* you click on that "Read More..." link in the home        */
/************************************************************/

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
		global $admin, $sid, $tipath;
		$ThemeSel = get_theme();
		if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
		} else {
		$t_image = "$tipath$topicimage";
		}
		echo '<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>'."\n"
		.'<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="100%"><tr><td>'."\n"
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#808080" width="100%"><tr><td align="left">'."\n"
		.'<font class="option" color="#363636"><b>'.$title.'</b></font><br />'."\n"
		.'<font class="content">'._POSTEDON.' '.$datetime.' '._BY.' </font>';
		formatAidHeader($aid);
		echo '</td></tr></table></td></tr></table><br />';
		echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>'."\n";
		FormatStory($thetext, $notes, $aid, $informant);
		echo '</td></tr></table><br />'."\n"."\n"."\n";
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
		echo '<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="150"><tr><td>'."\n"
		.'<table border="0" cellpadding="3" cellspacing="0" bgcolor="#c0c0c0" width="100%"><tr><td align="left">'."\n"
		.'<font class="content" color="#363636"><b>'.$title.'</b></font>'."\n"
		.'</td></tr></table></td></tr></table>'."\n"
		.'<table border="0" cellpadding="3" cellspacing="0" width="150">'."\n"
		.'<tr valign="top"><td>'."\n"
		."$content\n"
		.'</td></tr></table>'."\n"
		."<br />\n\n\n";
}

?>
