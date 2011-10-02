<?php

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$bgcolor1 = "#F4F6FB";
$bgcolor2 = "#BBCCDC";
$bgcolor3 = "#e6e6e6";
$bgcolor4 = "#660000";
$textcolor1 = "#FFFFFF";
$textcolor2 = "#000000";

function OpenTable() {
	 global $bgcolor1, $bgcolor2;
	 echo '<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor='."\"$bgcolor2\"".'><tr><td>'."\n";
	 echo '<table width="100%" border="0" cellspacing="1" cellpadding="8" bgcolor='."\"$bgcolor1\"".'><tr><td>'."\n";
}

function CloseTable() {
	 echo '</td></tr></table></td></tr></table>'."\n";
}

function OpenTable2() {
	 global $bgcolor1, $bgcolor2;
	 echo '<table border="0" cellspacing="1" cellpadding="0" bgcolor='."\"$bgcolor2\"".' align="center"><tr><td>'."\n";
	 echo '<table border="0" cellspacing="1" cellpadding="8" bgcolor='."\"$bgcolor1\"".'><tr><td>'."\n";
}

function CloseTable2() {
	 echo '</td></tr></table></td></tr></table>'."\n";
}


function FormatStory($thetext, $notes, $aid, $informant) {
	 global $anonymous;
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
	 return $content;
}

function themeheader() {
	 global $slogan, $sitename, $banners, $nukeurl, $nukeNAV;
	 echo '<body bgcolor="#DDDDDD" text="#222222" link="#660000" vlink="#222222">
	 <br />';
	 if ($banners) {
		  echo ads(0);
	 }
	 echo '<br />';
	 echo $nukeNAV;
	 echo '<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">'
		  .'<tr>'
				.'<td align="left">'
				._WELCOMETO." $sitename"
				.'</td>'
		  .'</tr>'
		  .'<tr>'
				.'<td align="right" width="100%">';  ?>
					 <form action="modules.php" method="post">
					 <input type="text" name="query" size="20" />
					 &nbsp;&nbsp;<input name="name" type="submit" value="<?PHP echo _SEARCH; ?>" />
					 </form>
					 </td>
		  </tr>
	 </table><br />
	 <?PHP echo '
	 <table cellpadding="0" cellspacing="1" border="0" width="100%" bgcolor="#660000">
		  <tr>
				<td>
					 <table cellpadding="5" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF">
						  <tr>
								<td>
									 <font class="content">'.$slogan.'</font>
								</td>
						  </tr>
					 </table>
				</td>
		  </tr>
	 </table>';
	 $public_msg = public_message();
	 echo "$public_msg". '<br />';
	 echo
// this table below spans the whole page and includes both sides plus the center block
	 '<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
		  <tr>
				<td valign="top">';
				blocks('l'); // left
	 echo
		  '</td>
		  <td>&nbsp;
		  </td>
		  <td valign="top" width="100%">';
// the td above determines how much space the center block gets and by inference how
// much is left to the left and right blocks.
// nahh ... i tried 70% above and it works great with themeindex but screws up
// themearticle   had to force side boxes to be 150 px would prefer they be a %
// leaving a table, a tr and a td open

}

function themefooter() {
	 if (defined('INDEX_FILE') && INDEX_FILE===true) {
		  echo '</td>';
		  echo '<td>&nbsp;</td><td valign="top">';
		  blocks('r');
		  echo '</td>';
	 }
	 else {
		  echo '</td>';
	 }

	 echo '</tr></table>';
	 echo '<br />';
	 echo    '<div align="center">';
	 footmsg();
	 echo '</div>';
}
// since I always confuse these, this function does the stories on the home page
function themeindex ($aid, $informant, $datetime, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	 global $anonymous, $tipath;
	 $ThemeSel = get_theme();
	 if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		  $t_image = "themes/$ThemeSel/images/topics/$topicimage";
	 } else {
		  $t_image = "$tipath$topicimage";
	 }
	 $boxstuff = FormatStory($thetext, $notes, $aid, $informant);

?>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr valign="top" bgcolor="#660000">
					 <td>
					 <img src="themes/Slash/images/cl.gif" width="7" height="10" alt="" />
					 <img src="themes/Slash/images/pix.gif" width="4" height="4" alt="" />
					 </td>
					 <td align="left" width="100%">
						  <table width="100%" border="0" cellpadding="2" cellspacing="0">
								<tr bgcolor="#660000">
									 <td width="100%" align="left">
									 <span class="storytitle">
									 <?php echo"$title"; ?>
									 </span>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td align="right">
					 <img src="themes/Slash/images/cr.gif" width="7" height="10" alt="" />
					 <img src="themes/Slash/images/pix.gif" width="4" height="4" alt="" />

					 </td>
				</tr>
		  </table>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#e6e6e6">
					 <td class="newstdgl">
					 <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td><font class="tiny">
									 <?php echo _POSTEDBY ;?>
									 <?php formatAidHeader($aid); echo ' '. _ON;?>
									 <?php echo"$datetime "; ?> (<?php echo $counter.' '._READS; ?>)</font>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td class="newstdgr">
					 <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#ffffff">
					 <td class="newstdwl">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td>
										  <?php echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>'.$boxstuff .'<br />';
										  ?>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td class="newstdwr">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
		  </table>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#ffffff">
					 <td class="newstdwl_cccccc">
					 <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td bgcolor="#cccccc">
									 <font class="content">
									 <?php echo"$morelink"; ?>
									 </font>
								</td>
						  </tr>
					 </table>
				</td>
				<td class="newstdwr_cccccc">
					 <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  </table><br /><br />

<?php
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	 global $admin, $sid, $tipath, $admin_file   ;
//    if (!isset($notes)) {$notes = ''; }
	 $ThemeSel = get_theme();
	 if (file_exists("themes/$ThemeSel/images/topics/$topicimage")) {
		  $t_image = "themes/$ThemeSel/images/topics/$topicimage"; }
	 else {
		  $t_image = "$tipath$topicimage";
	 }
	 $boxstuff = FormatStory($thetext, $notes, $aid, $informant);
?>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#DDDDDD">
				<tr valign="top" bgcolor="#660000">
					 <td>
						  <img src="themes/Slash/images/cl.gif" width="7" height="10" alt="" />
						  <img src="themes/Slash/images/pix.gif" width="4" height="4" alt="" />
					 </td>
					 <td align="left" width="100%">
						  <table width="100%" border="0" cellpadding="2" cellspacing="0">
								<tr>
									 <td width="100%">
										  <span class="storytitle">
										  <?php echo"$title"; ?></span>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td align="right">
						  <img src="themes/Slash/images/pix.gif" width="4" height="4" alt="" />
						  <img src="themes/Slash/images/cr.gif" width="7" height="10" alt="" />
					 </td>
				</tr>
		  </table>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#e6e6e6">
					 <td class="newstdgl">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td width="100%">
										  <font class="tiny">
										  <?php echo _POSTEDBY ;?>
										  <?php formatAidHeader($aid);
										  echo ' ' ._ON.' ' .$datetime; ?>
										  </font>
										  <?php
										  if ($admin) {
												echo '&nbsp;&nbsp; [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]';
										  }
										  if ("$aid" == "$informant") {
												echo '<br />';
												echo _CONTRIBUTEDBY .' <a href="modules.php?name=Your_Account?op=userinfo&amp;username='.$informant.'">'.$informant.'</a>'; }
										  ?>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td class="newstdgr">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#006666">
					 <td colspan="3">
						  <img src="themes/Slash/images/pix.gif" width="1" height="1" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#ffffff">
					 <td class="newstdwl">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td width="100%">
										  <?php echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>'.$boxstuff; ?>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td class="newstdwr">
						  <img src="themes/Slash/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#660000">
					 <td colspan="3">
						  <img src="themes/Slash/images/pix.gif" width="1" height="1" alt="" />
					 </td>
				</tr>
		  </table>
<?php
}

function themesidebox($title, $content) {
?>
<!-- note that the first table here is a wrapper to make the contained tables be
identical widths ... this function gets called by mainfile render_blocks several times in a typical nuke run -->
	 <table width="150" border="0" cellpadding="0" cellspacing="0">
		  <tr valign="top" bgcolor="#F4F6FB">
		  <td width="100%">
	 <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr valign="top" bgcolor="#F4F6FB">
				<td align="center" width="100%">
					 <span class="title"><?php echo"$title"; ?></span>
				</td>
		  </tr>
	 </table>
	 <table width="100%" border="1" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#ffffff">
				<td width="100%">
					 <table width="100%" border="0" cellpadding="1" cellspacing="0">
						  <tr>
								<td width="100%">
									 <?php echo"$content"; ?>
								</td>
						  </tr>
					 </table>
				</td>
		  </tr>
	 </table>
	 </td>
	 </tr>
	 </table>
	 <br /><br />
<?php
}
?>