<?
require_once( "header.inc.php" );

if ( (!isset($HTTP_SESSION_VARS['DoModifyRegister'])) || 
	(!isset($HTTP_POST_VARS['UserName'])) ||
	(!isset($HTTP_POST_VARS['IdNum'])) ||
	(!isset($HTTP_POST_VARS['Company'])) ||
	(!isset($HTTP_POST_VARS['Tel'])) ||
	(!isset($HTTP_POST_VARS['Mobile'])) ||
	(!isset($HTTP_POST_VARS['EMail'])) ||
	(!isset($HTTP_POST_VARS['Address'])) ||
	(!isset($HTTP_POST_VARS['ZipCode'])) ){

?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<p>该页面拒绝访问</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	exit(0);
}
$UserID=$HTTP_SESSION_VARS['DoModifyRegister'];
unset($HTTP_SESSION_VARS['DoModifyRegister']);
require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select * from User_TB where ID='{$UserID}'");

if (!($row=mysql_fetch_array($result))){//此ID不存在

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
此ID不存在！<BR>
请返回重试。
	<br>
	<br>
<?
} else{

$query=array();
$query[]="begin";
$query[]="Update User_TB Set UserName='{$HTTP_POST_VARS['UserName']}'," .
  "IdentifierNum='{$HTTP_POST_VARS['IdNum']}',Company='{$HTTP_POST_VARS['Company']}',".
  "TelephoneNumber='{$HTTP_POST_VARS['Tel']}',MobilePhone='{$HTTP_POST_VARS['Mobile']}'," .
  "EMail='{$HTTP_POST_VARS['EMail']}',Address='{$HTTP_POST_VARS['Address']}',ZipCode='{$HTTP_POST_VARS['ZipCode']}',".
  "Status='ProfileNotProved' where ID='{$UserID}'";
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		break;
	}
}
if (!$success){
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
您的注册单修改失败。<BR>
重新尝试提交。如果问题依旧，请直接与我们联系。<br>
	<br>
<input type="button" value="返回" onclick="history.back()">
	<br>
<?
} else {
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
您的注册单已成功修改。<BR>
我们将在两个工作日内与您联系。请您耐心等待:)<br>
    <br>
	<br>
<?
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
