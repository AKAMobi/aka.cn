<? 
session_set_cookie_params( time()+60*60*24*365, "/", "aka.com.cn" );
session_start();
if ((!isset($HTTP_POST_VARS['Name'])) || (!isset($HTTP_POST_VARS['Password'])) ){
require_once( "header.inc.php" );
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<p>请正常<A HREF="/my/" class=a5>登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	exit(0);
}

require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select * from User_TB where ID='{$HTTP_POST_VARS['Name']}'");

if (!($row=mysql_fetch_array($result))){//无此用户
require_once( "header.inc.php" );
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<br>
	<br>
	<br>
	<br>
	<br>
无此用户账号！<BR>
请重新<A HREF="index.php" class=a5>登录</a>
	<br>
	<br>
<?
}
else{
if (strcmp($HTTP_POST_VARS['Password'],$row["Password"])){//密码错误
require_once( "header.inc.php" );
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<br>
	<br>
	<br>
	<br>
	<br>
密码错误！<br>
请重新<A href="/my/" onclick="history.back();" class=a5>登录</a>
	<br>
	<br>
<?
}
else{//正常登录


mysql_free_result($result);
$AutoID=$row['AutoID'];
/*
$result=mysql_query("select DATE_FORMAT(C.LastActiveTime,'%Y-%c-%e %T') as LastActiveTime from UserActive_TB where UserAutoID={$AutoID}");
if( !($row=mysql_fetch_array($result)) ){
	$HTTP_SESSION_VARS['LastActiveTime'] = '未曾登陆';
}else{
	$HTTP_SESSION_VARS['LastActiveTime'] = $row['LastActiveTime'];
}
*/
mysql_query("Update UserActive_TB set LastActiveTime=Now() where UserAutoID={$AutoID}");
// Closing connection
mysql_close($conn);

if ( !strcmp($row['Status'],"Normal")) {
$HTTP_SESSION_VARS['UserID']=$HTTP_POST_VARS['Name'];
header("Refresh: 0;URL=main.php");
exit();
}
if ( !strcmp($row['Status'],"RegisterFailed")) {
$HTTP_SESSION_VARS['ModifyRegister']=$HTTP_POST_VARS['Name'];
//echo "<h1>" . $HTTP_POST_VARS['Name'] . "</h1>";
header("Refresh: 0;URL=ModifyProfile.php");
exit();
}
if ( !strcmp($row['Status'],"StopService")) {
require_once( "header.inc.php" );
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<br>
	<br>
	<br>
	<br>
	<br>
	您的账户已被停用。<br>
	请直接与管理员联系以了解详细情况。
	<br>
<input type="button" value="返回" onclick="history.back();">
	<br>
<?
} else {
if ( !strcmp($row['Status'],"ProfileNotProved")) {
require_once( "header.inc.php" );
	?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<br>
	<br>
	<br>
	<br>
	<br>
	您的注册单尚未被处理<br>
	请耐心等待。
	<br>
<input type="button" value="返回" onclick="history.back();">
	<br>
<?
} else {


}
}
}
}
?>

</td></tr></table>
<br>
<br>
<br>
<br>
<br>
<?
require_once( "footer.inc.php" );
?>
