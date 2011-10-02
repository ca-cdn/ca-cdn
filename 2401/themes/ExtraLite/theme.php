<?php

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$bgcolor1 = '#ffffff';
$bgcolor2 = '#cccccc';
$bgcolor3 = '#ffffff';
$bgcolor4 = '#eeeeee';
$textcolor1 = '#ffffff';
$textcolor2 = '#000000';

function OpenTable() {
	global $bgcolor1, $bgcolor2;
	echo
	'<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'">
		<tr>
			<td>'."\n";
	echo
				'<table width="100%" border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'">
					<tr>
						<td>'."\n";
}

function OpenTable2() {
	global $bgcolor1, $bgcolor2;
	echo
	'<table border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'" align="center">
		<tr>
			<td>'."\n";
	echo
				'<table border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'">
					<tr>
						<td>'."\n";
}

function CloseTable() {
	echo
						'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>'."\n";
}

function CloseTable2() {
	echo
						'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>'."\n";
}

function FormatStory($thetext, $notes, $aid, $informant) {
	global $anonymous;
	$content = '';
	$thetext = '<div>'.$thetext.'</div>';
	if (!empty($notes)) {
		$notes = '<br /><b>'._NOTE.'</b>&nbsp;<div>'.$notes.'</div>';
		}
		else {
			$notes = '';
			}
		if ($aid == $informant) {
			$content = $thetext.$notes;
			} else {
				if(!empty($informant)) {
					global $admin, $user;
						if (is_user($user)||is_admin($admin)) {
							$content = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'"><i>'.$informant.'</i></a> ';}
							else {
								$content = $informant.' ';}//Raven 10/16/2005
								}
								else {
								$content = $anonymous.' ';
								}
								$content .= '<i>'._WRITES.':</i>&nbsp;&nbsp;'.$thetext.$notes;
								}
								echo $content;
}

function themeheader() {
	global $prefix, $db, $user, $cookie, $bgcolor1, $bgcolor2, $bgcolor3, $banners, $sitename, $anonymous, $user, $module_name, $admin, $name, $index, $admin_file, $nukeurl, $slogan, $nukeNAV;
	echo '<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#0000ff">'
	.'<br />';
	if ($banners) {
		echo ads(0);
	}
	echo '<br />';
	echo '<div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div>';
	echo
	'<table border="0" cellspacing="0" cellpadding="3" width="100%" bgcolor="#ffffff">
		<tr>
			<td>'
				.'<a href="index.php"><img src="themes/ExtraLite/images/logo.gif" alt="'._WELCOMETO.' '.$sitename.'" title="'._WELCOMETO.' '.$sitename.'" border="0" /></a>'
			.'</td>
			<td align="right">'
			.'<form action="modules.php?name=Search" method="post">'
			.'<font class="content">'._SEARCH.'&nbsp;&nbsp;</font>'
			.'<input type="text" name="query" />'
			.'</form>'
			.'</td>
		</tr>
	</table>';
			$public_msg = public_message();
			echo $public_msg.'<br />';
	echo
	'<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td valign="top" width="150" bgcolor="#ffffff">';
				blocks('l');
	echo
				'<img src="images/pix.gif" border="0" width="150" height="1" alt="" />
				</td>
				<td>&nbsp;&nbsp;
				</td>
				<td width="100%" valign="top">';
}

function themefooter() {
	if (defined('INDEX_FILE') && INDEX_FILE===true) {
		echo
						'</td>
						<td>&nbsp;&nbsp;
						</td>
						<td valign="top" bgcolor="#ffffff" width="150">';
				blocks('r');
				echo
						'</td>';
	}
		else {
			echo '</td>'; }
		echo
			'</tr>
		</table>
		<div align="center">';
	footmsg();
	echo '</div>';
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous;
	echo
	'<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000" width="100%">
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="1" width="100%">
					<tr>
						<td bgcolor="#ffffff">
							<b>'.$title.'</b><br />
							<font class="tiny">'
							.""._POSTEDBY.' <b>';
					formatAidHeader($aid);
						echo '</b> '._ON.' '.$time.' ('.$counter.' '._READS.')<br />'
						.'<b>'._TOPIC.':</b> <a href="modules.php?name=News&amp;new_topic='.$topic.'">'.$topictext.'</a><br />'
						.'</font>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff">';
						FormatStory($thetext, $notes, $aid, $informant);
						echo '<br /><br />'
						.'</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff">'
						.'<font class="content">'.$morelink.'</font>'
						.'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
<br />';
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $admin_file;
	if ("$aid" == "$informant") {
		echo
		'<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="3" cellspacing="1" width="100%">
						<tr>
							<td bgcolor="#FFFFFF">
							<b>'.$title.'</b><br /><font class="tiny">'._POSTEDON.' '.$datetime;
						if ($admin) {
						echo '&nbsp;&nbsp; [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
						}
						echo
						'<br />'._TOPIC.': <a href="modules.php?name=News&amp;new_topic='.$topic.'">'.$topictext.'</a></font>
							</td>
						</tr>
					<tr>
						<td bgcolor="#ffffff">';
						FormatStory($thetext, $notes, $aid, $informant);
						echo
						'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br />';
	} else {
		echo
	'<table border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#000000" width="100%">
		<tr>
			<td>
				<table border="0" cellpadding="3" cellspacing="1" width="100%">
					<tr>
						<td bgcolor="#FFFFFF">
							<b>'.$title.'</b><br /><font class="content">'._CONTRIBUTEDBY.' '.$informant.' '._ON.' '.$datetime.'</font>';
							if ($admin) {
								echo '&nbsp;&nbsp; <font class="content">[ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</font>';
							}
							echo
							'<br />'._TOPIC.': <a href="modules.php?name=News&amp;new_topic='.$topic.'">'.$topictext.'</a>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff">';
						FormatStory($thetext, $notes, $aid, $informant);
		echo
						'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br />';
	}
}

function themesidebox($title, $content) {
	echo
	'<table border="0" cellspacing="0" cellpadding="0" width="150" bgcolor="#000000">
		<tr>
			<td>'
				.'<table width="100%" border="0" cellspacing="1" cellpadding="3">
					<tr>
						<td bgcolor="#ffffff" align="center">'
							.$title.
						'</td>
					</tr>
				</table>
				<table width="100%" border="1" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="1">
								<tr>
									<td bgcolor="#ffffff">'
									.$content
									.'</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><br />';
}

?>
