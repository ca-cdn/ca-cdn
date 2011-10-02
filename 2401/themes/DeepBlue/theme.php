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
$bgcolor2 = '#9cbee6';
$bgcolor3 = '#d3e2ea';
$bgcolor4 = '#0E3259';
$textcolor1 = '#000000';
$textcolor2 = '#000000';

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
/************************************************************/

function themeheader() {
	global $module_name, $banners, $admin, $user, $name, $sitename, $index, $admin_file, $nukeurl, $slogan, $nukeNAV;
	 echo '<body bgcolor="#0E3259" text="#000000" link="#0000ff"><br />';
	 if ($banners) {
		  echo ads(0);
		  echo '<br />';
	 }
	echo '<div style="float: left; position: relative; left: 50%;"><div style="position:relative;left:-50%;">'.$nukeNAV.'</div></div><br /><br />'.chr(10);

// the first table below is simply to "wrap the whole page so it centers; it is closed at the
// bottom of themefooter ... tried align=center but that causes problems with IE.
	 echo
		  '<table align="center" border="0" cellpadding="0" cellspacing="0" width="860">
		  <tr><td>
		  <table border="0" cellpadding="0" cellspacing="0" width="860">'."\n"
				.'<tr>
					 <td width="100%" align="left">'."\n"
						  .'<table border="0" cellpadding="0" cellspacing="0" width="860">'."\n"
								.'<tr>
									 <td width="100%" align="left">'."\n"
										  .'<table border="0" cellpadding="0" cellspacing="0" width="860">'."\n"
												.'<tr>
													 <td width="100%" height="88" bgcolor="#FFFFFF"><a href="index.php"><img src="themes/DeepBlue/images/logo.gif" border="0" alt="Welcome to '.$sitename.'" /></a>
													 </td>'."\n"
												.'</tr>
										  </table>
									 </td>
								</tr>
								<tr>
									 <td width="860" bgcolor="#0482c4" height="19" align="center" valign="bottom">'."\n".'<img src="themes/DeepBlue/images/menul.gif" width="10" height="18" alt="" /><a href="index.php"><img border="0" src="themes/DeepBlue/images/home.gif" width="140" height="18" alt="home" /></a><a href="modules.php?name=Your_Account"><img border="0" src="themes/DeepBlue/images/account.gif" width="140" height="18" alt="Your Account" /></a><a href="modules.php?name=Downloads"><img border="0" src="themes/DeepBlue/images/downloads.gif" width="140" height="18" alt="Downloads" /></a><a href="modules.php?name=Submit_News"><img border="0" src="themes/DeepBlue/images/submit.gif" width="140" height="18" alt="Submit News" /></a><a href="modules.php?name=Topics"><img border="0" src="themes/DeepBlue/images/topics.gif" width="140" height="18" alt="Topics" /></a><a href="modules.php?name=Top"><img border="0" src="themes/DeepBlue/images/top10.gif" width="140" height="18" alt="Top" /></a><img src="themes/DeepBlue/images/menur.gif" width="10" height="18" alt="" />'
									 .'</td>
								</tr>
								<tr>
									 <td width="100%" height="10" bgcolor="#d3e2ea">'."\n"
									 .'</td>
								</tr>
						  </table>'."\n"
					 .'</td>
				</tr>
				<tr>
					 <td width="100%" align="left">
						  <table width="100%" cellspacing="0" cellpadding="0" border="0">
								<tr>
									 <td bgcolor="#d3e2ea" align="left">'."\n";
									 $public_msg = public_message();
									 echo "$public_msg" . '<br />';
									 echo
								'</td>
						  </tr>
						  </table>
					 </td>
		  </tr>
		  </table>'
		  .'<table width="860" cellpadding="0" bgcolor="#d3e2ea" cellspacing="0" border="0">'."\n"
	 //row not closed
				.'<tr valign="top">'."\n"
					 .'<td><img src="themes/DeepBlue/images/pixel.gif" width="6" height="1" border="0" alt="" />
					 </td>'."\n"
					 .'<td width="150" bgcolor="#d3e2ea" valign="top" align="left">'."\n";
								blocks('l');
								echo
					 '</td>
					 <td><img src="themes/DeepBlue/images/pixel.gif" width="10" height="1" border="0" alt="" />
					 </td>';
// td not closed
echo            '<td width="100%">'."\n";
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
	 echo '<br />';
	 if (defined('INDEX_FILE') && INDEX_FILE===true) {
		  echo    '</td>
				<td><img src="themes/DeepBlue/images/pixel.gif" width="10" height="1" border="0" alt="" />
				</td>
				<td valign="top" width="150" bgcolor="#d3e2ea" align="left">'."\n";
						  blocks('r');
// blocks right inserts two whole tables from themesidebox
		  echo    '</td>';
		  echo    '<td><img src="themes/DeepBlue/images/pixel.gif" width="6" height="1" border="0" alt="" />
					 </td>';
		  }
	 else {
		  echo
					 '</td>
					 <td colspan="2"><img src="themes/DeepBlue/images/pixel.gif" width="10" height="1" border="0" alt="" />
					 </td>';
				}
echo            '</tr>
		  </table>'."\n";
		  echo '<br />';
		  footmsg();
		  echo '</td></tr></table>';
}

function themeindex ($aid, $informant, $time, $title, $counter, $topic, $thetext, $notes, $morelink, $topicname, $topicimage, $topictext) {
	 global $anonymous, $tipath;
	 echo
		  '<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					 <td bgcolor="#000000">'."\n"
						  .'<table border="0" cellpadding="0" cellspacing="1" width="100%">
								<tr><td bgcolor="#FFFFFF">'."\n"
									 .'<table border="0" cellpadding="0" cellspacing="0" width="100%">
										  <tr>
												<td bgcolor="#FFFFFF">'."\n"
.'<img src="themes/DeepBlue/images/dot.gif" border="0" alt="" />
												</td>
												<td width="100%" bgcolor="#FFFFFF" align="left">
												<span class="option"><b>&nbsp;'.$title.'</b></span>
												</td>
										  </tr>'."\n"
										  .'<tr>
												<td colspan="2" bgcolor="#FFFFFF"><br />'."\n"
													 .'<table border="0" width="98%" align="center">
														  <tr>
																<td align="left">'."\n"
.'<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$tipath.$topicimage.'" alt="'.$topictext.'" border="0" align="right" /></a>';
	 FormatStory($thetext, $notes, $aid, $informant);
	 echo
																'</td>
														  </tr>
													 </table>'."\n"
												.'</td>
										  </tr>
									 </table><br />'."\n"
								.'</td>
						  </tr>
						  <tr>
								<td bgcolor="#FFFFFF" align="center">'."\n"
									 .'<font class="tiny">'._POSTEDBY.' ';
									 formatAidHeader($aid);
								echo ' '._ON.' '. $time .'('.$counter .' '._READS.')<br /></font>'."\n"
									 .'<font class="content">'.$morelink.'</font>'."\n"
	 .'<img src="themes/DeepBlue/images/pixel.gif" border="0" height="2" alt="" />'."\n"
								.'</td>
						  </tr></table>'."\n"
					 .'</td>
				</tr>
		  </table><br />'."\n";
}

function themearticle ($aid, $informant, $datetime, $title, $thetext, $topic, $topicname, $topicimage, $topictext, $notes) {
	 global $admin, $sid, $tipath;
	 echo
	 '<table border="0" cellpadding="0" cellspacing="0" width="100%">
		  <tr>
				<td bgcolor="#000000">'."\n"
					 .'<table border="0" cellpadding="0" cellspacing="1" width="100%">
						  <tr>
								<td bgcolor="#FFFFFF" align="left">'."\n"
									 .'<table border="0" cellpadding="0" cellspacing="0" width="100%">
										  <tr>
												<td bgcolor="#FFFFFF" align="left">'."\n"
	 .'<img src="themes/DeepBlue/images/dot.gif" border="0" alt="" />
												</td>
												<td width="100%" bgcolor="#FFFFFF"><span class="option"><b>&nbsp;'.$title.'</b></span>
												</td>
										  </tr>'."\n"
									 .'<tr>
										  <td colspan="2" bgcolor="#FFFFFF"><br />'."\n"
												.'<table border="0" width="98%" align="center">
													 <tr>
														  <td align="left">'."\n";
												echo '<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$tipath.$topicimage.'" alt="'.$topictext.'" border="0" align="right" /></a>';
														  FormatStory($thetext, $notes, $aid, $informant);
													 echo
														  '</td>
													 </tr>
												</table>'."\n"
										  .'</td>
									 </tr>
								</table><br />'."\n"
						  .'</td>
					 </tr>
				</table>'."\n"
		  .'</td>
	 </tr>
</table>
<br /><br />'."\n";
}

function themesidebox($title, $content) {
	 // note:  this gets called by the mainfile render blocks function when side is left or right
	 // thus the table that's in legacy themefooter when index file is set is extraneous
echo    '<table border="0" width="150" cellpadding="0" cellspacing="0">'
				.'<tr>
					 <td class="table_title" width="150" height="20">'
						  .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <span class="whitetitle">'.$title.'</span>'
					 .'</td>
				</tr>';
echo        '</table>
		  <table border="1" cellpadding="1" cellspacing="0" width="150">'
				.'<tr>
					 <td width="150" bgcolor="#ffffff">'
								.$content
					 .'</td>
				</tr>
		  </table>
		  <br />';
}

?>