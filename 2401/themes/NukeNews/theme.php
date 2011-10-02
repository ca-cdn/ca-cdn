<?php

/************************************************************/
/* IMPORTANT NOTE FOR THEMES DEVELOPERS!                    */
/*                                                          */
/* When you start coding your theme, if you want to         */
/* distribute it, please double check it to fit the HTML    */
/* 4.01 Transitional Standard. You can use the W3 validator */
/* located at http://validator.w3.org                       */
/* If you don't know where to start with your theme, just   */
/* start modifying this theme, it's validate and is cool ;) */
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

$bgcolor1 = '#efefef';
$bgcolor2 = '#cfcfbb';
$bgcolor3 = '#efefef';
$bgcolor4 = '#cfcfbb';
$textcolor1 = '#000000';
$textcolor2 = '#000000';

include_once('themes/NukeNews/tables.php');

/************************************************************/
/* Function themeheader()                                   */
/*                                                          */
/* Control the header for your site. You need to define the */
/* BODY tag and in some part of the code call the blocks    */
/* function for left side with: blocks(left);               */
/************************************************************/

function themeheader() {
	 global $user, $banners, $sitename, $slogan, $cookie, $prefix, $db, $anonymous, $nukeNAV;
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
	 echo '<body bgcolor="#505050" text="#000000" link="#363636" vlink="#363636" alink="#d5ae83">';
	 if ($banners) {
		echo ads(0);
	 }
	 global $new_topic;
	 $topics_list = '<select name="new_topic" onchange="submit()">'."\n";
	 $topics_list .= '<option value="">All Topics</option>'."\n";
	 $toplist = $db->sql_query('select topicid, topictext from '."$prefix".'_topics order by topictext');
	 while(list($topicid, $topics) = $db->sql_fetchrow($toplist)) {
		$topicid = intval($topicid);
		$sel = '';
		if ($topicid==$new_topic) { $sel = 'selected="selected "'; }
		$topics_list .= '<option '.$sel.' value="'.$topicid.'">'.$topics.'</option>'."\n";
		$sel = '';
	}
	 if ($username == $anonymous) {
	 $theuser = '&nbsp;&nbsp;<a href="modules.php?name=Your_Account&amp;op=new_user">Create an account</a>';
	 } else {
	 $theuser = '&nbsp;&nbsp;Welcome '.$username.'!';
	 }
	 $public_msg = public_message();
	 if (empty($nukeNAV)) $nukeNAV = '<font class="content"><b>&nbsp;&middot;&nbsp;
<a href="index.php">Home</a>
<a href="modules.php?name=Topics">Topics</a>
&nbsp;&middot;&nbsp;
<a href="modules.php?name=Downloads">Downloads</a>
&nbsp;&middot;&nbsp;
<a href="modules.php?name=Your_Account">Your Account</a>
&nbsp;&middot;&nbsp;
<a href="modules.php?name=Submit_News">Submit News</a>
&nbsp;&middot;&nbsp;
<a href="modules.php?name=Top">Top 10</a>
</b></font>';
	 ?>
	 <br />
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#ffffff">
<tr>
<td bgcolor="#ffffff">
<img style="height:16px;" alt="" hspace="0" src="themes/NukeNews/images/corner-top-left.gif" width="17" align="left" />
<a href="/"><img src="themes/NukeNews/images/logo.gif" align="left" alt="<?php echo _WELCOMETO . $sitename;?> />" border="0" hspace="10" /></a></td>
<td bgcolor="#999999"><img src="themes/NukeNews/images/pixel.gif" width="1" style="height:1px;" alt="" border="0" hspace="0" /></td>
<td bgcolor="#cfcfbb" align="center">
<center><form action="modules.php?name=Search" method="post"><font class="content" color="#000000"><b><?php echo _SEARCH; ?></b>
<input type="text" name="query" size="14" /></font></form></center></td>
<td bgcolor="#cfcfbb" align="center">
<center><form action="modules.php?name=News" method="post"><font class="content"><b><?php echo _TOPICS . '</b> '. $topics_list;?>
</select></font></form></center></td>
<td bgcolor="#cfcfbb" valign="top"><img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-top-right.gif" width="17" align="right" /></td>
</tr></table>
<table cellpadding="0" cellspacing="0" width="100%" border="0" align="center" bgcolor="#fefefe">
<tr>
<td bgcolor="#000000" colspan="4"><img src="themes/NukeNews/images/pixel.gif" width="1" style="height:1px;" alt="" border="0" hspace="0" /></td>
</tr>
<tr valign="middle" bgcolor="#dedebb">
<td nowrap="nowrap"><font class="content" color="#363636">
<b><?php echo $theuser;?></b></font>&nbsp;</td>
<td nowrap="nowrap" align="center" style="height:20px;"><?php	echo $nukeNAV; ?></td>
<td nowrap="nowrap" align="right">&nbsp;<font class="content"><b>
<script type="text/javascript">
<!--   // Array of Month Names
var monthNames = new Array( "January","February","March","April","May","June","July","August","September","October","November","December");
var now = new Date();
var thisYear = now.getYear();
if(thisYear < 1900) {thisYear += 1900; } // corrections if Y2K display problem
document.write(monthNames[now.getMonth()] + " " + now.getDate() + ", " + thisYear);
// -->
</script></b></font></td>
<td>&nbsp;</td>
</tr>
<tr>
<td bgcolor="#000000" colspan="4"><img src="themes/NukeNews/images/pixel.gif" width="1" style="height:1px;" alt="" border="0" hspace="0" /></td>
</tr>
</table>
<!-- FIN DEL TITULO -->
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center"><tr valign="top">
<td bgcolor="#ffffff"><?php echo $public_msg;?><img src="themes/NukeNews/images/pixel.gif" width="1" style="height:20px;" border="0" alt="" /></td></tr></table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center"><tr valign="top">
<td bgcolor="#ffffff"><img src="themes/NukeNews/images/pixel.gif" width="10" style="height:1px;" border="0" alt="" /></td>
<td bgcolor="#ffffff" width="150" valign="top">
<?php
	 blocks("l");
	 ?>
</td><td><img src="themes/NukeNews/images/pixel.gif" width="15" style="height:1px;" border="0" alt="" /></td><td valign="top" width="100%">
<?php
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
	 if (defined('INDEX_FILE') && INDEX_FILE===true) {
		echo
		'</td><td><img src="themes/NukeNews/images/pixel.gif" width="15" style="height:1px;" border="0" alt="" /></td><td valign="top" width="150">';
	 blocks("right");
	 }
	 $echoit = false;
	  footmsg($echoit);
	  echo
'</td><td bgcolor="#ffffff"><img src="themes/NukeNews/images/pixel.gif" width="10" style="height:1px;" border="0" alt="" />
</td></tr></table>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center"><tr valign="top">
<td align="center" style="height:17px;">
<img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-bottom-left.gif" width="17" align="left" />
<img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-bottom-right.gif" width="17" align="right" />
</td></tr></table>
<br />
<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center"><tr valign="top">
<td><img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-top-left.gif" width="17" align="left" /></td>
<td width="100%">&nbsp;</td>
<td><img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-top-right.gif" width="17" align="right" /></td>
</tr><tr align="center">
<td width="100%" colspan="3">'
. $footmsg.
'</td>
</tr><tr>
<td><img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-bottom-left.gif" width="17" align="left" /></td>
<td width="100%">&nbsp;</td>
<td><img style="height:17px;" alt="" hspace="0" src="themes/NukeNews/images/corner-bottom-right.gif" width="17" align="right" /></td>
</tr></table>';

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
	 $posted = ""._POSTEDBY." ";
	 $posted .= get_author($aid);
	 $posted .= " "._ON." $time ($counter "._READS.")";
	 echo
'<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>
<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="100%"><tr><td>
<table border="0" cellpadding="3" cellspacing="0" bgcolor="#cfcfbb" width="100%"><tr><td align="left">
<font class="option" color="#363636"><b>'.$title.'</b></font>
</td></tr></table></td></tr></table>
<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>
'.$content.'
</td></tr></table>
<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="100%"><tr><td>
<table border="0" cellpadding="3" cellspacing="0" bgcolor="#efefef" width="100%"><tr><td align="center">
<font class="content">'.$posted.'</font><br />
<font class="content">'.$morelink.'</font>
</td></tr></table></td></tr></table>
<br /><br /><br />';
}

/************************************************************/
/* Function themearticle()                                  */
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
	 $posted = ""._POSTEDON." $datetime "._BY." ";
	 $posted .= get_author($aid);
	 $thetext = '<div>'.$thetext.'</div>';
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
	 echo '
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td>
<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="100%"><tr><td>
<table border="0" cellpadding="3" cellspacing="0" bgcolor="#cfcfbb" width="100%"><tr><td align="left">
<font class="option" color="#363636"><b>'.$title.'</b></font><br />
<font class="content">'.$posted.'</font>
</td></tr></table></td></tr></table><br />
<a href="modules.php?name=News&amp;new_topic='.$topic.'"><img src="'.$t_image.'" border="0" alt="'.$topictext.'" title="'.$topictext.'" align="right" hspace="10" vspace="10" /></a>
'.$content.'
</td></tr></table><br />';
}

/************************************************************/
/* Function themesidebox()                                  */
/*                                                          */
/* Control look of your blocks. Just simple.                */
/************************************************************/

function themesidebox($title, $content) {
	echo '
	<table border="0" cellpadding="1" cellspacing="0" bgcolor="#000000" width="150"><tr><td>
<table border="0" cellpadding="3" cellspacing="0" bgcolor="#dedebb" width="100%"><tr><td align="left">
<font class="content" color="#363636"><b>'.$title.'</b></font>
</td></tr></table></td></tr></table>
<table border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" width="150">
<tr valign="top"><td bgcolor="#ffffff">'.
$content.
'</td></tr></table>
<br />';
}

?>