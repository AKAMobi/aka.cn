<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

function isParamAllExist(){
	Global $AdminID,$AdminName,$Note,$NewPassword;
	if (!isset($_REQUEST['AdminID'])) return false;
	if (!isset($_REQUEST['AdminName'])) return false;
	$AdminName=preg_replace("/,/","，",$_REQUEST['AdminName']);
	$AdminName=htmlspecialchars($AdminName);
	if (!isset($_REQUEST['NewPassword1'])) return false;
	if (!isset($_REQUEST['Note'])) return false;
	$Note=preg_replace("/,/","，",$_REQUEST['Note']);
	$Note=htmlspecialchars($Note);
	return true;
}

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
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

if (($row=mysql_fetch_array($result))){//此管理员已存在
?>
此管理员已存在！<BR>
<?
} else{
$passwd=crypt($_REQUEST['NewPassword1']);
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
$privileges=join(',',$privilege);
if (mysql_query("Insert into AdminUser_TB(ID,Password,FullName,Information,Privilege) values ( '{$_REQUEST['AdminID']}','{$passwd}','{$AdminName}','{$Note}','{$privileges}') ")) {
	$temp=join("、",$privilege);
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 建立了新管理员 {$_REQUEST['AdminID']} 的账号，其权限为{$temp}', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	管理员账号  <? echo $_REQUEST['AdminID']; ?>  添加成功！<br>
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

