<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

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

if (!isset($_REQUEST['NewPassword1'])) {
?>
您未正确输入新密码!
<?
}else {
require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//此管理员已存在
?>
此管理员不存在！<BR>
<?
} else{
$passwd=crypt($_REQUEST['NewPassword1']);
if (mysql_query("Update AdminUser_TB set Password='{$passwd}' where ID='{$_REQUEST['AdminID']}'")) {
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 更换了管理员 {$_REQUEST['AdminID']} 的密码', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	管理员 <? echo $_REQUEST['AdminID']; ?> 密码修改成功！<br>
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

