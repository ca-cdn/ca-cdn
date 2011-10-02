<?php

// BEGIN: Added in v2.40.00 - Mantis Issue 0001043
//$index = 0;
//if (!defined('INDEX_FILE')) define('INDEX_FILE', true); // Set to FALSE to hide right blocks
//if (defined('INDEX_FILE') AND INDEX_FILE===true) {
// auto set right blocks for pre patch 3.1 compatibility
//	$index = 1;
//}
// END: Added in v2.40.00 - Mantis Issue 0001043

$bgcolor1 = '#FFFFFF';
$bgcolor2 = '#bbccdd';
$bgcolor3 = '#e6e6e6';
$bgcolor4 = '#e6e6e6';
$textcolor1 = '#FFFFFF';
$textcolor2 = '#000000';

function OpenTable() {
	 global $bgcolor1, $bgcolor2;
  echo '
  <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'">
	 <tr>
		  <td>'."\n";
					 echo '
					 <table width="100%" border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'">
						  <tr>
								<td>'."\n";
}

function CloseTable() {
		  echo '
								</td>
						  </tr>
					 </table>
				</td>
		  </tr>
	 </table>'."\n";
}

function OpenTable2() {
	 global $bgcolor1, $bgcolor2;
  echo '
  <table border="0" cellspacing="1" cellpadding="0" bgcolor="'.$bgcolor2.'" align="center">
	 <tr>
		  <td>'."\n";
					 echo '
					 <table border="0" cellspacing="1" cellpadding="8" bgcolor="'.$bgcolor1.'">
						  <tr>
								<td>'."\n";
}

function CloseTable2() {
				  echo '
					 </td>
				</tr>
			 </table>
			</td>
		  </tr>
	 </table>'."\n";
}

/* not used.
function FormatStory($thetext, $notes, $aid, $informant) {
	 global $anonymous;
	 if (!empty($notes)) {
		  $notes = '<b>'._NOTE.'</b> <i>'.$notes.'</i>'."\n";
	 }
	 else {
		  $notes = '';
	 }
	 if ("$aid" == "$informant") {
		  echo '<font class="content" color="#505050">'.$thetext.'<br />'.$notes.'</font>'."\n";
	 }
	 else {
		  if(!empty($informant)) {
				$boxstuff = '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a> ';
		  }
		  else {
				$boxstuff = "$anonymous ";
		  }
		  $boxstuff .= 'writes <i>'.$thetext.'</i> '."$notes\n";
		  echo '<font class="content" color="#505050">'.$boxstuff.'</font>'."\n";
	 }
}
*/

function themeheader() {
	 global  $banners, $sitename, $slogan, $nukeurl, $nukeNAV;
	 echo '<body bgcolor="#FFFFFF" text="#000000" link="#101070" vlink="#101070"><br />';
	 if ($banners) {
		 echo ads(0);
	 }
	 echo '
	 <br />
	 <center>
	 <form action="modules.php?name=Search" method="post">
		  <table cellpadding="0" cellspacing="0" border="0" width="99%" align="center">
				<tr>
					 <td align="left">
						  <a href="'.$nukeurl.'"><img src="themes/SlashOcean/images/logo.gif" alt="Welcome to '.$sitename.'" border="0" /></a>
					 </td>
				<td align="right">
					<center><input style="margin: 5px;" type="submit" value="'._SEARCH.'" />
					<font class="content">
						<br />
						<input type="text" name="query" size="20" maxlength="20" />
					</font></center>
					 </td>
				</tr>
		  </table>
		  <br />
	 </form>
	 </center>
	 <table cellpadding="0" cellspacing="0" border="0" width="99%" bgcolor="#101070">
		  <tr>
				<td>
					 <table cellpadding="5" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF">
						  <tr>
								<td>
									 <font class="content">'.$slogan.'</font>
								</td>
								<td>'.$nukeNAV.'</td>
						  </tr>
					 </table>
				</td>
		  </tr>
	 </table>';
	 $public_msg = public_message();
	 echo "$public_msg<br />";
	 echo '
	 <table width="99%" align="center" cellpadding="0" cellspacing="0" border="0">
		  <tr>
				<td valign="top" rowspan="15">';
					 blocks('left');
				echo '
				</td>
				<td>&nbsp;&nbsp;
				</td>
				<td valign="top" width="100%">';
}

function themefooter() {
	 echo '
				</td>';
	 if (defined('INDEX_FILE') && INDEX_FILE===true) {
		  echo '
				<td>&nbsp;&nbsp;
				</td>
				<td valign="top">';
				blocks('right');
			 echo '
			 </td>';
	 }
			 echo '
		  </tr>
	  </table>';
	 echo '<center>';
	 footmsg();
	 echo '</center>';
}

function themeindex ($aid, $informant, $datetime, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	 global $user, $admin,$anonymous, $tipath;
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
	 if ("$aid" == "$informant") { ?>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				<tr valign="top" bgcolor="#101070">
					 <td>
						  <img src="themes/SlashOcean/images/cl.gif" width="7" height="10" alt="" />
						  <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="2" cellspacing="0">
								<tr>
									 <td>
										  <font class="storytitle"><b><?php echo "$title"; ?></b></font>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td align="right">
						  <img src="themes/SlashOcean/images/cr.gif" width="7" height="10" alt="" />
						  <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />
					 </td>
				</tr>
		  </table>
		  <table border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#e6e6e6">
					 <td style="background-image:url(themes/SlashOcean/images/gl.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
							<td>
									 <?php echo _POSTEDBY ;?>
									 <?php formatAidHeader($aid); echo ' '. _ON;?>
									 <?php echo"$datetime "; ?> (<?php echo $counter.' '._READS; ?>)
									 </td>
								</tr>
						  </table>
					 </td>
					 <td style="background-image:url(themes/SlashOcean/images/gr.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#101070">
					 <td colspan="3">
						  <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#ffffff">
					 <td style="background-image:url(themes/SlashOcean/images/wl.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td>
										  <a href="modules.php?name=News&amp;new_topic=<?php echo "$topic"; ?>&amp;author=">
												<img src="<?php echo $t_image; ?>" border="0" alt="<?php echo "$topictext"; ?>" align="right" hspace="10" vspace="10" />
										  </a>
										  <?php echo '<div>'.$thetext.$notes; ?></div>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td style="background-image:url(themes/SlashOcean/images/wr.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
				</tr>
				<tr bgcolor="#101070">
					 <td colspan="3">
						  <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
					 </td>
				</tr>
		  </table>
		  <table border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#ffffff">
					 <td style="background-image:url(themes/SlashOcean/images/wl_cccccc.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td bgcolor="#cccccc">
									 <font class="content"><?php echo "$morelink"; ?></font>
								</td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/wr_cccccc.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
	 <br /><br />
<?php
	 } else {
		  if(!empty($informant)) $boxstuff = '<font class="content"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a></font> ';
		  else $boxstuff = "$anonymous ";
		  $boxstuff .= '<i>'._WRITES.'</i> <div>'.$thetext.$notes.'</div>';
?>
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		  <tr valign="top" bgcolor="#101070">
				<td>
					 <img src="themes/SlashOcean/images/cl.gif" width="7" height="10" alt="" />
					 <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="2" cellspacing="0">
						  <tr>
								<td>
									 <font class="storytitle"><b><?php echo "$title"; ?></b></font>
								</td>
						  </tr>
					 </table>
				</td>
				<td align="right">
					 <img src="themes/SlashOcean/images/cr.gif" width="7" height="10" alt="" />
					 <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />

				</td>
		  </tr>
	 </table>
	 <table border="0" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#e6e6e6">
				<td style="background-image:url(themes/SlashOcean/images/gl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
						<td>
									 <?php echo _POSTEDBY ;?>
									 <?php formatAidHeader($aid); echo ' '. _ON;?>
									 <?php echo"$datetime "; ?> (<?php echo $counter.' '._READS; ?>)</font>
									 </td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/gr.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#ffffff">
				<td style="background-image:url(themes/SlashOcean/images/wl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td>
									 <a href="modules.php?name=News&amp;new_topic=<?php echo "$topic"; ?>&amp;author="><img src="<?php echo "$t_image"; ?>" border="0" alt="<?php echo "$topictext"; ?>" align="right" hspace="10" vspace="10" /></a>
									 <?php echo "$boxstuff"; ?>
								</td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/wr.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
	 <table border="0" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#ffffff">
				<td style="background-image:url(themes/SlashOcean/images/wl_cccccc.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td bgcolor="#cccccc">
									 <font class="content"><?php echo "$morelink"; ?></font>
								</td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/wr_cccccc.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3"><img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
	 <br /><br />
<?php   }
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	 global $admin, $sid, $tipath, $admin_file, $user;
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
	 if ("$aid" == "$informant") { ?>
		  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
				<tr valign="top" bgcolor="#101070">
					 <td>
						  <img src="themes/SlashOcean/images/cl.gif" width="7" height="10" alt="" />
						  <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="2" cellspacing="0">
								<tr>
									 <td>
										  <font class="articleoption"><b><?php echo "$title"; ?></b></font>
									 </td>
								</tr>
						  </table>
					 </td>
					 <td align="right">
						  <img src="themes/SlashOcean/images/cr.gif" width="7" height="10" alt="" />
						  <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />

					 </td>
		</tr>
	 </table>
		  <table border="0" cellpadding="0" cellspacing="0">
				<tr bgcolor="#e6e6e6">
					 <td style="background-image:url(themes/SlashOcean/images/gl.gif);">
						  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
					 </td>
					 <td width="100%">
						  <table width="100%" border="0" cellpadding="5" cellspacing="0">
								<tr>
									 <td>
											<?php echo _POSTEDBY.' ';    if (is_user($user)||is_admin($admin)) echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$aid.'">'.$aid.'</a>';
	 else echo $aid .' '._ON .' '.$datetime; ?>
										  <?php
										  if ($admin) {
										  echo '&nbsp;&nbsp; <font class="content"> [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</font>';
										  }
										  ?>
									 </td>
								</tr>
						  </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/gr.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#ffffff">
				<td style="background-image:url(themes/SlashOcean/images/wl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td>
									 <?php echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>'; ?>
									 <?php echo '<div>'.$thetext.$notes; ?></div>
				</td>
			 </tr>
		  </table>
		</td>
		<td style="background-image:url(themes/SlashOcean/images/wr.gif);">
		  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
		</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
<?php
	 } else {
				if(!empty($informant)) $boxstuff = '<font class="content"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a></font> ';
				else $boxstuff = "$anonymous ";
				$boxstuff .= '<i>'._WRITES.'</i> <div>'.$thetext.$notes.'</div>';
?>
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		  <tr valign="top" bgcolor="#101070">
				<td>
					 <img src="themes/SlashOcean/images/cl.gif" width="7" height="10" alt="" />
					 <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="2" cellspacing="0">
						  <tr>
								<td>
									 <font class="articleoption"><b><?php echo "$title"; ?></b></font>
								</td>
						  </tr>
					 </table>
				</td>
				<td align="right">
					 <img src="themes/SlashOcean/images/cr.gif" width="7" height="10" alt="" />
					 <img src="themes/SlashOcean/images/pix.gif" width="4" height="4" alt="" />

				</td>
	 </tr>
  </table>
	 <table border="0" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#e6e6e6">
				<td style="background-image:url(themes/SlashOcean/images/gl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td>
									 <?php echo _POSTEDBY.' ';    if (is_user($user)||is_admin($admin)) echo '<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$aid.'">'.$aid.'</a>';
	 else echo $aid .' '. _ON .' '.$datetime; ?>
									 <?php
									 if ($admin) {
									 echo '&nbsp;&nbsp; <font class="content"> [ <a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a> ]</font>';
									 }
									 ?>
									 <br />
									 <?php echo _CONTRIBUTEDBY.' <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$informant.'">'.$informant.'</a>'; ?>
								</td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/gr.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#ffffff">
				<td style="background-image:url(themes/SlashOcean/images/wl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td>
									 <?php   echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>';?>
									 <?php echo '<div>'.$thetext.$notes; ?></div>
				</td>
			 </tr>
		  </table>
		</td>
		<td style="background-image:url(themes/SlashOcean/images/wr.gif);">
		  <img src="themes/SlashOcean/images/pix.gif" width="11" height="11" alt="" />
		</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
<?php
	 }
}

function themesidebox($title, $content) {
	 ?>
	 <table width="150" border="0" cellpadding="0" cellspacing="0">
		  <tr valign="top" bgcolor="#101070">
				<td bgcolor="#FFFFFF">
					 <img src="themes/SlashOcean/images/pix.gif" width="3" height="3" alt="" />
				</td>
				<td>
					 <img src="themes/SlashOcean/images/cl.gif" width="7" height="10" alt="" />
				</td>
				<td>
					 <font color="#FFFFFF"><b><?php echo "$title"; ?></b></font>
				</td>
				<td align="right">
					 <img src="themes/SlashOcean/images/cr.gif" width="7" height="10" alt="" />
				</td>
				<td bgcolor="#FFFFFF" align="right">
					 <img src="themes/SlashOcean/images/pix.gif" width="3" height="3" alt="" />
				</td>
		  </tr>
	 </table>
	 <table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#ffffff">
				<td style="background-image:url(themes/SlashOcean/images/sl.gif);">
					 <img src="themes/SlashOcean/images/pix.gif" width="3" height="3" alt="" />
				</td>
				<td width="100%">
					 <table width="100%" border="0" cellpadding="5" cellspacing="0">
						  <tr>
								<td>
									 <?php echo "$content"; ?>
								</td>
						  </tr>
					 </table>
				</td>
				<td style="background-image:url(themes/SlashOcean/images/sr.gif);" align="right">
					 <img src="themes/SlashOcean/images/pix.gif" width="3" height="3" alt="" />
				</td>
		  </tr>
		  <tr bgcolor="#101070">
				<td colspan="3">
					 <img src="themes/SlashOcean/images/pix.gif" width="1" height="1" alt="" />
				</td>
		  </tr>
	 </table>
	 <br /><br />
<?php
}
?>