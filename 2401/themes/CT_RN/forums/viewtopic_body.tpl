<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
<td class="nav" valign="top"><a class="maintitle" href="{U_VIEW_TOPIC}" title="{TOPIC_TITLE}">{TOPIC_TITLE}</a><br />
{PAGINATION}</td>
<td class="gensmall" align="right" valign="bottom"><a href="{U_VIEW_NEWER_TOPIC}">{L_VIEW_NEXT_TOPIC}</a><br />
<a href="{U_VIEW_OLDER_TOPIC}">{L_VIEW_PREVIOUS_TOPIC}</a><br />
<strong>{S_WATCH_TOPIC}</strong></td>
</tr>
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}"  /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}"  /></a></td>
<td class="nav" width="100%">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a>
&raquo; <a href="{U_VIEW_FORUM}" title="{FORUM_NAME}">{FORUM_NAME}</a></td>
</tr>
</table>
{POLL_DISPLAY}

<table class="forumline" width="100%" cellspacing="1" cellpadding="3" border="0">
<tr>

<th width="100%">{L_MESSAGE}</th>
<th align="center" width="100%">{L_AUTHOR}</th>
</tr>
<!-- BEGIN postrow -->
<tr>
<td class="{postrow.ROW_CLASS}" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="100%" class="postdetails"><a href="{postrow.U_MINI_POST}"><img src="{postrow.MINI_POST_IMG}" width="12" height="9" alt="{postrow.L_MINI_POST_ALT}" title="{postrow.L_MINI_POST_ALT}" border="0" /></a>{L_POSTED}:
{postrow.POST_DATE}</td>
<td nowrap="nowrap" valign="top">&nbsp;</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top" class="postbody">
<hr />
{postrow.MESSAGE}</td>
</tr>
<tr>
<td height="40" valign="bottom" class="genmed">{postrow.SIGNATURE}{postrow.ATTACHMENTS}<span class="gensmall">{postrow.EDITED_MESSAGE}&nbsp;</span></td>
</tr>
</table>
</td>
<td class="{postrow.ROW_CLASS}" valign="top">
<span class="name"><a name="{postrow.U_POST_ID}"></a><strong>{postrow.POSTER_NAME}</strong></span><br />
<p align="center">
{postrow.POSTER_AVATAR}</p>
<span class="postdetails"><br />
{postrow.POSTER_RANK}<br />
{postrow.RANK_IMAGE}<br />
{postrow.POSTER_JOINED}<br />
{postrow.POSTER_POSTS}<br />
{postrow.POSTER_FROM}</span>
<img src="themes/CT_RN/forums/images/spacer.gif" alt="" width="150" height="1" />
</td>
</tr>
<tr>
<td colspan="2" class="{postrow.ROW_CLASS}">

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>{postrow.PROFILE_IMG}
{postrow.PM_IMG} {postrow.EMAIL_IMG} {postrow.WWW_IMG} {postrow.AIM_IMG} {postrow.YIM_IMG}
{postrow.MSN_IMG} {postrow.ICQ_IMG}</td>
    <td align="right">{postrow.QUOTE_IMG} {postrow.EDIT_IMG} {postrow.DELETE_IMG} {postrow.IP_IMG}</td>
  </tr>
</table>

  </td>
</tr>
<tr>
<td colspan="2" height="8">
  </td>
</tr>
<!-- END postrow -->
</table>
<table width="100%" cellspacing="2" cellpadding="2" border="0">
<tr>
<td class="cat" colspan="2" height="28">
<form method="post" action="{S_POST_DAYS_ACTION}">
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
<td class="gensmall">{L_DISPLAY_POSTS}:&nbsp;&nbsp;</td>
<td>{S_SELECT_POST_DAYS}&nbsp;</td>
<td>{S_SELECT_POST_ORDER}&nbsp;&nbsp;</td>
<td><input type="submit" value="{L_GO}" class="catbutton" name="submit" /></td>
</tr>
</table>
</form>
</td>
</tr>
<tr>
<td nowrap="nowrap" colspan="2">&nbsp;</td>
</tr>
<tr>
<td nowrap="nowrap"><a href="{U_POST_NEW_TOPIC}"><img src="{POST_IMG}" border="0" alt="{L_POST_NEW_TOPIC}" title="{L_POST_NEW_TOPIC}"  /></a>&nbsp;&nbsp;&nbsp;<a href="{U_POST_REPLY_TOPIC}"><img src="{REPLY_IMG}" border="0" alt="{L_POST_REPLY_TOPIC}" title="{L_POST_REPLY_TOPIC}"  /></a></td>
<td width="100%" class="nav">&nbsp;<a href="{U_INDEX}">{L_INDEX}</a> &raquo; <a href="{U_VIEW_FORUM}">{FORUM_NAME}</a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>

<td class="nav" valign="top">{PAGINATION}<br />
<br />
{JUMPBOX}<br />
<br />
{S_TOPIC_ADMIN}</td>
<td class="gensmall" align="right" valign="top"><strong>{S_WATCH_TOPIC}</strong><br />
<a href="{U_VIEW_NEWER_TOPIC}">{L_VIEW_NEXT_TOPIC}</a><br />
<a href="{U_VIEW_OLDER_TOPIC}">{L_VIEW_PREVIOUS_TOPIC}</a><br />
{S_AUTH_LIST}</td>
</tr>
</table>

   <br />
<!-- BEGIN similar -->
<table width="85%" cellspacing="1" cellpadding="4" border="0" align="center" class="forumline">
 <tr>
  <td class="catHead" colspan="6"><span class="genmed"><b>{similar.L_SIMILAR}</b></span></td>
 </tr>
 <tr>
  <th colspan="2">{similar.L_TOPIC}</th>
  <th>{similar.L_AUTHOR}</th>
  <th>{similar.L_FORUM}</th>
  <th>{similar.L_REPLIES}</th>
  <th>{similar.L_LAST_POST}</th>
 </tr>
 <!-- BEGIN topics -->
 <tr>
  <td class="row1" align="center"><span class="genmed"><img src="{similar.topics.FOLDER}" border="0" alt="{similar.topics.ALT}" title="{similar.topics.ALT}" /></span></td>
  <td class="row1" width="30%">{similar.topics.NEWEST}<span class="gensmall">{similar.topics.TYPE}</span> <span class="topictitle">{similar.topics.TOPICS}</span></td>
  <td class="row1" width="10%"><span class="genmed">{similar.topics.AUTHOR}</span></td>
  <td class="row1"><span class="genmed">{similar.topics.FORUM}</span></td>
  <td class="row1" width="15%" align="center"><span class="genmed">{similar.topics.REPLIES}</span></td>
  <td class="row1"><span class="genmed">{similar.topics.POST_TIME} {similar.topics.POST_URL}</span></td>
 </tr>
 <!-- END topics -->
</table>
<!-- END similar -->
