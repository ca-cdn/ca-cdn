<?php

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$bgcolor1 = "#cccccc";
$bgcolor2 = "#999999";
$bgcolor3 = "#cccccc";
$textcolor1 = "#ffffff";
$textcolor2 = "#000000";

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

function themeheader() {
	global $banners, $nukeNAV, $sitename;
	echo '<body bgcolor="#ffffff" text="#000000" link="#000000" vlink="#000000">'
	.'<br />';
	if ($banners) {
		echo ads(0);
	}
	echo '<br />'
	.'<table border="0" cellspacing="0" cellpadding="3" width="100%" bgcolor="#ffffff">'
	.'<tr><td width="100%">'
		.'<a href="index.php"><img src="themes/Traditional/images/logo.gif" alt="'._WELCOMETO.' '.$sitename.'" border="0" /></a>'
		.'</td>
		<td align="right">'
			.'<form action="modules.php?name=Search" method="post">'
			.'<input type="text" name="query" size="15" />'
			.'<input type="submit" value="'._SEARCH.'" />'
			.'</form>
		</td>
	</tr>
	<tr><td>' . $nukeNAV . '</td></tr>
	</table>';
	$public_msg = public_message();
	echo $public_msg.'<br />';
	echo '<table border="0" width="100%" cellspacing="5"><tr><td valign="top">';
	blocks('l');
	echo '</td>';
	echo '<td>&nbsp;</td>';
	echo '<td valign="top" width="100%">'."\n\n\n";

}

function themefooter() {
	if (defined('INDEX_FILE') && INDEX_FILE===true) {
		echo '</td>';
		echo '<td>&nbsp;</td><td valign="top" width="200">';
		blocks('r');
	}
	echo '</td></tr></table>';
	echo '<center>';
	footmsg();
	echo '</center>';
}

function themesidebox($title, $content) {
	echo '<table border="0" cellspacing="0" cellpadding="0" width="200" bgcolor="#000000"><tr><td>'
		.'"<table width="100%" border="0" cellspacing="2" cellpadding="3"><tr><td bgcolor="#cccccc">'
		.'<img src="themes/Traditional/images/tic.gif" border="0" alt="" />'
		.$title.'</td></tr>'
		.'<tr><td bgcolor="#ffffff">'
		.$content
		 .'</td></tr></table></td></tr></table>'
		.'<br />';
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	if (!empty($notes)) {
		$notes = '<br /><b>'._NOTE.'</b>'.$notes;
	} else {
		$notes = '';
	}
	if ("$aid" == "$informant") {
		echo '<table border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr><td bgcolor="#cccccc">
		<font class="title">
		<b>'.$title.'</b><br /></font>
		</td></tr><tr><td bgcolor="#ffffff">
		<a href="modules.php?name=News&amp;new_topic='.$topic.'">
		<img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>
		<font class="tiny">'._POSTEDBY.' <b>';
		formatAidHeader($aid);
		echo '</b> '._ON.' '.$time.'<br />('.$counter.' '._READS.')</font><br /><br /><div class="content">'
		.$thetext.'<br />'.$notes.'<br /><br /></div>
		</td></tr><tr><td align="left">
		<font class="content">'.$morelink.'</font></td></tr></table><br />';
	}
	 else {
		if(!empty($informant))  {
			 $boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=$informant">'.$informant.'</a>';
		 }
		else {
			$boxstuff = $anonymous;
		}
		$boxstuff .= '<i> '._WRITES.'</i> '.$thetext.'<br />'.$notes;
		echo '<table border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr><td bgcolor="#cccccc">
		<font class="title">
		<b>'.$title.'</b><br /></font>
		</td></tr><tr><td bgcolor="#ffffff">
		<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'. $t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>
		<font class="tiny">'._POSTEDBY.' <b>';
		formatAidHeader($aid);
		echo '</b> '._ON.' '.$time.' <br />('.$counter.' '._READS.')<br /><br /></font><div class="content">';
		echo $boxstuff.'<br /><br /></div></td></tr><tr><td align="left">
		<font class="content">'.$morelink.'</font></td></tr></table><br />';
	} // end of aid ne informant
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $tipath, $admin_file;
	$ThemeSel = get_theme();
	if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		$t_image = "themes/$ThemeSel/images/topics/$topicimage";
	} else {
	$t_image = "$tipath$topicimage";
	}
	if (!empty($notes)) {
		$notes = '<br /><b>'._NOTE.'</b> '.$notes;
	} else {
		$notes = '';
	}
	if ("$aid" == "$informant") {
		echo '<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000" width="100%">
		<tr><td>
		<table border="0" cellpadding="3" cellspacing="1" width="100%">
		<tr><td bgcolor="#cccccc">
		<b>'.$title.'</b><br /> '._POSTEDON.' '. $datetime;
		if ($admin) {
			echo '&nbsp;&nbsp; [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.
			'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
		}
		echo '</td></tr><tr><td bgcolor="#ffffff">
		<a href="modules.php?name=News&amp;new_topic='.$topic.'><img src="'.$t_image.'" border="0" alt="'.topictext.'" align="right" hspace="10" vspace="10" /></a>
		<div>'.$thetext.'<br />'.$notes.'</div></td></tr></table></td></tr></table><br />';
		} else { // aid ne informant
			if(!empty($informant)) {
				$boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
			}
			else {
				$boxstuff = $anonymous;
			}
			$boxstuff .= '<i> '._WRITES.'</i> '. $thetext.'</i> '. $notes;
			echo
			'<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000" width="100%">
			<tr><td>
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
			<tr><td bgcolor="#cccccc">
			<b>'.$title.'</b><br />'._CONTRIBUTEDBY.' '. $informant.' '._ON.' '.$datetime;
			if ($admin) {
				echo '&nbsp;&nbsp;[ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.
				'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
				echo '</td></tr><tr><td bgcolor="#ffffff">
				<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'			" align="right" hspace="10" vspace="10" /></a>
				<div>'.$thetext.'<br />'.$notes.'</div></td></tr></table></td></tr></table><br />';
			}
		}
}
?>