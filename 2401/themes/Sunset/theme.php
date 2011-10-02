<?php

#########################################################
# Sunset theme for PHPNuke 5.0                          #
# Translation by Ivan Stojmirov [stojmir@linux.net.mk]  #
# Originaly made by Francisco                           #
#########################################################
# Modified for RavenNuke(tm)                            #
# Original concept from Simone at JerusalemPosts.com    #
# Standardization & Compliancy reached on               #
#########################################################

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$thename = 'Sunset';
$lnkcolor = '#035D8A';
$bgcolor1 = '#FFFFE6';
$bgcolor2 = '#FFFFF4';
$bgcolor3 = '#FFFFE6';
$bgcolor4 = '#FFC53A';
$textcolor1 = '#FFFFFF';
$textcolor2 = '#000000';
$hr = 1; # 1 to have horizonal rule in comments instead of table bgcolor


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

function themeheader() {
	global $slogan, $sitename, $banners, $nukeurl, $thename, $nukeNAV;
	echo
	'<body bgcolor="#ffc53a" text="#000000" link="#035d8a" vlink="#035d8a">
		<br />
		<table border="0" width="100%" cellpadding="3" cellspacing="0">
			<tr>
				<td>'."\n\n"
					.'<a href="'.$nukeurl.'"><img src="themes/'.$thename.'/images/logo.gif" alt="'._WELCOMETO. $sitename.'" border="0" /></a>'."\n"
				.'</td>'."\n";
	if ($banners) {
		echo	 '<td>';
			echo ads(0);
		echo  '</td>';
	}
		echo
				'<td align="right">'."\n"
					.'<form action="modules.php?name=Search" method="post">
						<font size="2" color="#000000">'."\n"
							.'<input type="submit" value="'._SEARCH.'" /> '."\n"
							.'<input type="text" name="query" />'."\n"
						.'</font>
					</form>'."\n"
				.'</td>
			</tr>'."\n";
	echo '<tr><td colspan="3">' . $nukeNAV . '</td></tr></table>'."\n";
		$public_msg = public_message();
		echo
		$public_msg.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" width="140">'."\n";
					blocks('l');
		echo '</td>
				<td>
					&nbsp;
				</td>
				<td valign="top" width="100%">'."\n\n\n";
}

function themefooter() {
	if (defined('INDEX_FILE') && INDEX_FILE===true) {
		echo
				'</td>
				<td>
					&nbsp;
				</td>
				<td valign="top" width="200">'."\n";
					blocks('r');
	}
	echo		'</td>
			</tr>
	</table>';
	echo
	'<div align="center">';
		footmsg();
		echo
	'</div>';
}


function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	global $anonymous, $tipath, $thename;
//	$ThemeSel = get_theme();
	if (file_exists("themes/$thename/images/topics/$topicimage")) {
		$t_image = "themes/$thename/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	if (!empty($notes)) {
		$notes = '<br /><strong>'._NOTE.'</strong> '.$notes;
	} else {
		$notes = '';
	}
	echo
	'<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#035d8a">
		<tr>
			<td>'."\n"
				.'<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#ffffff">
					<tr>
						<td>'."\n"
							.'<a href="modules.php?name=News&amp;new_topic=$topic"><img src="'.$t_image.'" alt="'.$topictext.'" border="0" align="right" /></a>'."\n"
							.'<img src="themes/'.$thename.'/images/bullet.gif" border="0" hspace="3" alt="" />
							<font size="3"><strong>'
								.$title.'</strong>
							</font><br />'."\n"
							.'<font size="1" color="#035d8a">'._POSTEDBY.' ';
								formatAidHeader($aid);
								echo ' '._ON." $time ($counter "._READS.')
								<br /><br />
							</font>'."\n";
						if ("$aid" == "$informant") {
							echo
							'<div>'
									.$thetext.' '.$notes
							.'</div><br /><br />'."\n";
						} else {
							if (!empty($informant)) {
								$boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
							} else {
								$boxstuff = "$anonymous ";
							}
							$boxstuff .= "<em>"._WRITES."</em> <div>$thetext $notes</div>\n";
							echo
							$boxstuff.'<br /><br />'."\n";
						}
							echo
							'<font size="2">'.$morelink.'</font>
							<br />
							<img src="themes/'.$thename.'/images/line.gif" border="0" vspace="4" alt="" />'."\n"
						.'</td>
					</tr>
				</table>'."\n"
			.'</td>
		</tr>
	</table>'."\n"
	."<br />\n\n\n";
}

function themearticle($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	global $admin, $sid, $tipath, $admin_file, $thename;
//	$ThemeSel = get_theme();
	 if (file_exists("themes/$thename/images/topics/$topicimage")) {
	 $t_image = "themes/$thename/images/topics/$topicimage";
	} else {
		$t_image = "$tipath$topicimage";
	}
	if (!empty($notes)) {
		$notes = '<br /><strong>'._NOTE.'</strong> '.$notes;
	} else {
		$notes = '';
	}
	echo
	'<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#035d8a">
		<tr>
			<td>'."\n"
				.'<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#ffffff">
					<tr>
						<td>'."\n"
							.'<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" alt="'.$topictext.'" border="0" align="right" /></a>'."\n"
							.'<img src="themes/'.$thename.'/images/bullet.gif" border="0" hspace="3" alt="" />
							<font size="2"><strong>'.$title.'</strong></font>'."\n";
							if ($admin) {
								echo '&nbsp;&nbsp; [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]<br />'."\n";
							} else {
								echo "<br />\n";
							}
							echo
							'<font size="1" color="#035D8A">'
								._POSTEDBY.' ';
								formatAidHeader($aid);
								echo ' '._ON.' '.$datetime.'<br />'."\n";
								if (!empty($informant)) {
									echo _CONTRIBUTEDBY
									.' </font>
									<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">
									<font size="1" color="#035D8A">'
										.$informant
									.'</font>
									</a><br /><br />'."\n";
							} else {
								echo
								'<font size="1" color="#035D8A">'._CONTRIBUTEDBY.' '
									.$anonymous
								.'</font><br /><br />'."\n";
							}
							echo
							'<font size="2" color="#000000">'
								.$thetext
							.'</font><br /><br />'."\n"
						.'</td>
					</tr>
				</table>'."\n"
			.'</td>
		</tr>
	</table>'."\n\n";
}



function themesidebox($title, $content) {
	global $thename;
	mt_srand((double)microtime() * 1000000);
	$rcolor = mt_rand(1, 4);
	if ($rcolor == 1) {
		$tcolor = '#941C31';
	} elseif ($rcolor == 2) {
		$tcolor = '#941C31';
	} elseif ($rcolor == 3) {
		$tcolor = '#941C31';
	} elseif ($rcolor == 4) {
		$tcolor = '#941C31';
	}
	echo '<table width="165" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>' . "\n"
				. '<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td>' . "\n" . '<img src="themes/' . $thename . '/images/left' . $rcolor . '.gif" alt="" border="0" width="5" height="19" /></td>' . "\n"
						. '<td bgcolor="' . $tcolor . '" width="100%"><font size="2" color="#FFFFFF"><strong>' . $title . '</strong></font></td>' . "\n"
						. '<td align="right"><img src="themes/' . $thename . '/images/right' . $rcolor . '.gif" alt="" border="0" width="5" height="19" /></td>
					</tr>
				</table>' . "\n"
			. '</td>
		</tr>
		<tr>
			<td align="center" valign="top">'."\n"
				. '<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="' . $tcolor . '">
					<tr>
						<td width="100%">' . "\n"
							. '<table width="100%" border="0" cellspacing="0" cellpadding="4" bgcolor="' . $tcolor . '">
								<tr>
									<td width="100%" valign="top" bgcolor="#FFFFE6">' . "\n" . $content . "\n" 
										. '<table width="100%" cellspacing="0" cellpadding="0" border="0">
											<tr>
												<td>' . "\n" . '<img src="themes/' . $thename . '/images/pixel.gif" width="1" height="4" alt="" border="0" /></td>
											</tr>
										</table>' . "\n"
									. '</td>
								</tr>
							</table>' . "\n"
						. '</td>
					</tr>
				</table>' . "\n"
			. '</td>
		</tr>
		<tr>' . "\n"
			. '<td align="center" valign="bottom">' . "\n" . '<img width="100%" height="5" src="themes/' . $thename . '/images/bottom' . $rcolor . '.gif" vspace="0" border="0" alt="" /></td>
		</tr>
	</table>' . "\n"
	. '<br />' . "\n\n\n";
}

?>