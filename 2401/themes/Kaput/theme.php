<?php

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
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: block(left);                */
/************************************************************/

$bgcolor1 = "#d5d5d5";
$bgcolor2 = "#7b91ac";
$bgcolor3 = "#efefef";
$bgcolor4 = "#d5d5d5";
$textcolor1 = "#000000";
$textcolor2 = "#000000";

function OpenTable() {
	echo '<table summary="text" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
	<td width="15" height="15"><img src="themes/Kaput/images/up-left2.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/up2.gif)" align="center" width="100%" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/up-right2.gif" width="15" height="15" alt="" border="0" /></td></tr>
	<tr>
	<td style="background-image:url(themes/Kaput/images/left2.gif)" width="15">&nbsp;</td>
	<td bgcolor="#ffffff" width="100%">';
}

function OpenTable2() {
	echo '<table summary="text" border="0" cellspacing="0" cellpadding="0" align="center"><tr>
	<td width="15" height="15"><img src="themes/Kaput/images/up-left2.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/up2.gif)" align="center" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/up-right2.gif" width="15" height="15" alt="" border="0" /></td></tr>
	<tr>
	<td style="background-image:url(themes/Kaput/images/left2.gif)" width="15">&nbsp;</td>
	<td bgcolor="#ffffff">';
}

function CloseTable() {
		echo '</td>
	<td style="background-image:url(themes/Kaput/images/right2.gif)">&nbsp;</td></tr>
	<tr>
	<td width="15" height="15"><img src="themes/Kaput/images/down-left2.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/down2.gif)" align="center" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/down-right2.gif" width="15" height="15" alt="" border="0" /></td></tr>';
	echo '</table><br />';
}

function CloseTable2() {
		echo '</td>
	<td style="background-image:url(themes/Kaput/images/right2.gif)">&nbsp;</td></tr>
	<tr>
	<td width="15" height="15"><img src="themes/Kaput/images/down-left2.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/down2.gif)" align="center" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/down-right2.gif" width="15" height="15" alt="" border="0" /></td></tr>';
	echo '</table><br />';

}

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
/* function for left side with: block(left);                */
/************************************************************/

function themeheader() {
	global $user, $sitename, $cookie, $banners, $nukeurl, $module_name, $admin, $name, $index, $admin_file, $slogan, $nukeNAV;
	if ($user != '' ) {
		cookiedecode($user);
		$username = $cookie[1];
	}
	 if (!isset($username)) {
		$username = '';
	 }
	 if (empty($username)) {
		$username = "Anonymous";
	}
	echo '<body bgcolor="#ffffff" text="#000000" link="#363636" vlink="#363636" alink="#d5ae83">'."\n"
	.'<br />'."\n";
	if ($banners) {
		echo ads(0);
	}
	if (!empty($nukeNAV)) echo '<div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div>';
	$TitleNav = '<font class="content"><b>'
				.'<a href="'.$nukeurl.'">Home</a>&nbsp;&middot;&nbsp;<a href="modules.php?name=Topics">Topics</a>&nbsp;&middot;&nbsp;'
				.'<a href="modules.php?name=Downloads">Downloads</a>&nbsp;&middot;&nbsp;<a href="modules.php?name=Your_Account">Your Account</a>'
				.'&nbsp;&middot;&nbsp;<a href="modules.php?name=Forums">Forums</a>&nbsp;&middot;&nbsp;<a href="modules.php?name=Top">Top 10</a>'
				.'</b></font>';
	OpenTable();
	echo '<table summary="text" border="0">
		<tr>
		<td rowspan="2">'
			.'<a href="index.php"><img src="themes/Kaput/images/logo.gif" border="0" alt="'._WELCOMETO.' '.$sitename.'" align="left" /></a>
		</td>'
		.'<td align="right" width="100%">'
			.'<form action="modules.php?name=Search" method="post">'
			.'<font class="content" color="#000000"><b>'._SEARCH.' </b>'
			.'<input type="text" name="query" size="14" /></font></form>'
			.'</td>
			</tr>
			<tr>'
			.'<td align="right" valign="bottom" width="100%">'.$TitleNav.'
				</td>
			</tr>
		</table>'."\n";
	CloseTable();
	$public_msg = public_message();
	echo "$public_msg<br />";
	echo '<table summary="text" cellpadding="0" cellspacing="0" width="99%" border="0" align="center" bgcolor="#ffffff">'."\n"
	.'<tr><td bgcolor="#ffffff" valign="top" width="180">'."\n";
	blocks('l');
	echo '</td><td><img src="themes/Kaput/images/pixel.gif" width="15" style="height: 1px" border="0" alt="" /></td><td valign="top">'."\n";
}

/************************************************************/
/* Function themefooter()                                   */
/*                                                          */
/* Control the footer for your site. You don't need to      */
/* close BODY and HTML tags at the end. In some part call   */
/* the function for right blocks with: block(right);        */
/* Also, $index variable need to be global and is used to   */
/* determine if the page your're viewing is the Homepage or */
/* and internal one.                                        */
/************************************************************/

function themefooter() {
	if (defined('INDEX_FILE') && INDEX_FILE===true) {
		$ThemeSel = get_theme();
		echo '</td><td><img src="themes/Kaput/images/pixel.gif" width="15" height="1" border="0" alt="" /></td><td valign="top" width="180">'."\n";
		blocks('r');
	}
	echo '</td></tr></table>'."\n";
	echo '<br />';
	OpenTable();
	echo '<center>';
	footmsg();
	echo '</center>';
	CloseTable();
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	echo '<table summary="text" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
	<td width="15" height="15"><img src="themes/Kaput/images/up-left2.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/up2.gif)" align="center" width="100%" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/up-right2.gif" width="15" height="15" alt="" border="0" /></td></tr>
	<tr>
	<td style="background-image:url(themes/Kaput/images/left2.gif)" width="15">&nbsp;</td>
	<td bgcolor="#ffffff" width="100%">
	<font color="#999999"><b><a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a></b></font>
	<b>'.$title.'</b><br /><br />';
	FormatStory($thetext, $notes, $aid, $informant);
	echo '</td>
	<td style="background-image:url(themes/Kaput/images/right2.gif)">&nbsp;</td></tr>
	<tr>
	<td width="15" height="15"><img src="themes/Kaput/images/middle-left.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/middle.gif)" align="center" height="15">&nbsp;</td>
	<td><img src="themes/Kaput/images/middle-right.gif" width="15" height="15" alt="" border="0" /></td></tr>
	<tr>
	<td style="background-image:url(themes/Kaput/images/left3.gif)" width="15">&nbsp;</td>
	<td align="center">
	<font color="#999999" size="1">'._POSTEDBY.' ';
	formatAidHeader($aid);
	echo ' '._ON.' '.$time.' ('.$counter.' '._READS.')<br /></font>
	<font class="content">'.$morelink.'</font></td>
	<td style="background-image:url(themes/Kaput/images/right3.gif)" width="15">&nbsp;</td></tr>
	<tr>
	<td width="15" height="11" valign="top"><img src="themes/Kaput/images/down-left3.gif" alt="" border="0" /></td>
	<td style="background-image:url(themes/Kaput/images/down3.gif)" align="center" height="11" width="100%"></td>
	<td><img src="themes/Kaput/images/down-right3.gif" width="15" height="11" alt="" border="0" />
	</td></tr></table>
	<br />';
}


function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $tipath, $admin_file;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	Opentable();
	echo '<font class="option" color="#363636"><b>'.$title.'</b></font><br />'."\n"
			.'<font class="content">'._POSTEDON.' '.$datetime.' '._BY.' </font>';
	formatAidHeader($aid);
	if (is_admin($admin)) {
		echo '<br />[ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]'."\n";
	}
	echo '<br /><br />';
	echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>'."\n";
	FormatStory($thetext, $notes, $aid, $informant);
	echo "<br />\n\n\n";
	CloseTable();
}


function themesidebox($title, $content) {
echo '<table summary="text" border="0" cellspacing="0" cellpadding="0" width="100%"><tr>'
.'<td width="17" height="17"><img src="themes/Kaput/images/up-left.gif" alt="" border="0" /></td>'
	.'<td style="background-image:url(themes/Kaput/images/up.gif)" align="center" width="100%" height="17">&nbsp;</td>'
	.'<td><img src="themes/Kaput/images/up-right.gif" width="17" height="17" alt="" border="0" /></td></tr>'
	.'<tr>'
	.'<td style="background-image:url(themes/Kaput/images/left.gif)" width="17">&nbsp;</td>'
	.'<td style="background-image:url(themes/Kaput/images/backdot.gif)" width="126"><center><font class="content"><b>'.$title.'</b></font></center><br />'.$content.'</td>'
	.'<td style="background-image:url(themes/Kaput/images/right.gif)">&nbsp;</td></tr>'
	.'<tr>'
	.'<td width="17" height="17"><img src="themes/Kaput/images/down-left.gif" alt="" border="0" /></td>'
	.'<td style="background-image:url(themes/Kaput/images/down.gif)" align="center" width="100%" height="17">&nbsp;</td>'
	.'<td><img src="themes/Kaput/images/down-right.gif" width="17" height="17" alt="" border="0" /></td></tr>'
	.'</table>'
	.'<br />';
}
?>
