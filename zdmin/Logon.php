<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require("{$ADMINROOT}/Include/IncludeFile.php");

if ((!isset($_REQUEST['Name'])) || (!isset($_REQUEST['Password'])) ){
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<p>请正常<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	IncludeHTML("{$AKAROOT}/footer.html");
	exit(0);
}

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID,Password,Privilege from AdminUser_TB where ID='{$_REQUEST['Name']}'");


if ( (!($row=mysql_fetch_array($result))) &&
	($_REQUEST['Name']==$SYSOPID) ) {  //判断账号'zixia'是否第一次使用
	$isSYSOPFirstTime=true;
}  else {
	$isSYSOPFirstTime=false;
}

if ((!$isSYSOPFirstTime) && (!$row) ){//无此用户
IncludeHTML("{$AKAROOT}/header.html");
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
无此管理员账号！<BR>
请重新<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>
	<br>
	<br>
<?
}
else{
if  ( (!$isSYSOPFirstTime) &&
		(crypt($_REQUEST['Password'],$row["Password"])!=$row["Password"]) ){//密码错误
IncludeHTML("{$AKAROOT}/header.html");
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
请重新<A href="<? echo $ADMINURLROOT; ?>/index.php">登录</a>
	<br>
	<br>
<?
}
else{//正常登录


$_SESSION['AdminID']=$_REQUEST['Name'];

if ($_REQUEST['Name']==$SYSOPID) {
	$_SESSION['NewsAdmin']=true;
	$_SESSION['PersonalVPNAdmin']=true;
	$_SESSION['UserAccountAdmin']=true;
	$_SESSION['LogAdmin']=true;
	$_SESSION['AdminAdmin']=true;
	$_SESSION['MoneyAdmin']=true;
	$_SESSION['SMSLogAdmin']=true;
	$_SESSION['SMSChildAdmin']=true;

} else {
$privileges=explode(",",$row['Privilege']);
foreach ($privileges as $privilege){
	$_SESSION[$privilege.'Admin']=true;
}
}

mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_REQUEST['Name']}','{$_REQUEST['Name']} 正常登录' , '{$_SERVER['REMOTE_ADDR']}', 'LogOn', NOW()) ");


mysql_free_result($result);

// Closing connection
mysql_close($conn);

if ($isSYSOPFirstTime){
header("Refresh: 0;URL={$ADMINURLROOT}/AdminUser/SYSOPFirstTime.php");
} else {
header("Refresh: 0;URL=AdminMenu.php");
}
exit();
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
IncludeHTML("{$AKAROOT}/footer.html");
?>
