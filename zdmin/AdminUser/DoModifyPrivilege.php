<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

function isParamAllExist(){
	Global $AdminName;
	if (!isset($_REQUEST['AdminName'])) return false;
	$AdminName=preg_replace("/,/","，",$_REQUEST['AdminName']);
	$AdminName=htmlspecialchars($AdminName);
	return true;
}

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
你没有管理其他管理员的权限<br>
<?
} else {

if (!isParamAllExist()){
?>
错误！缺少必要的参数以执行此操作。请确认您的输入。
<?
} else {
require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//此管理员已存在
?>
此管理员不存在！<BR>
<?
} else{
$privilege=array();
if (isset($_REQUEST['UserAccount']) ){
	$privilege[]="UserAccount";
}
if (isset($_REQUEST['News'])){
	$privilege[]="News";
}
if (isset($_REQUEST['PersonalVPN'])){
	$privilege[]="PersonalVPN";
}
if (isset($_REQUEST['Money'])){
	$privilege[]="Money";
}
if (isset($_REQUEST['Log'])){
	$privilege[]="Log";
}
if (isset($_REQUEST['Admin'])){
	$privilege[]="Admin";
}
if (isset($_REQUEST['SMSLog'])){
	$privilege[]="SMSLog";
}
if (isset($_REQUEST['SMSChild'])){
	$privilege[]="SMSChild";
}
$privileges=join(',',$privilege);
if (mysql_query("Update AdminUser_TB set Privilege='{$privileges}', FullName='{$AdminName}' where ID='{$_REQUEST['AdminID']}'")) {
	$temp=join("、",$privilege);
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 将管理员 {$_REQUEST['AdminID']} 的权限修改为{$temp}', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	管理员 <? echo $_REQUEST['AdminID']; ?> 的权限修改成功！ <br>
<?
} else {
?>
	数据库操作失败！请联络管理员。<br>
<?
}

mysql_free_result($result);

}
// Closing connection
mysql_close($conn);

}
}
}
?>
</div>

