<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

function isParamAllExist(){
	Global $AdminName;
	if (!isset($_REQUEST['AdminName'])) return false;
	$AdminName=preg_replace("/,/","��",$_REQUEST['AdminName']);
	$AdminName=htmlspecialchars($AdminName);
	return true;
}

if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
��û�й�����������Ա��Ȩ��<br>
<?
} else {

if (!isParamAllExist()){
?>
����ȱ�ٱ�Ҫ�Ĳ�����ִ�д˲�������ȷ���������롣
<?
} else {
require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//�˹���Ա�Ѵ���
?>
�˹���Ա�����ڣ�<BR>
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
$privileges=join(',',$privilege);
if (mysql_query("Update AdminUser_TB set Privilege='{$privileges}', FullName='{$AdminName}' where ID='{$_REQUEST['AdminID']}'")) {
	$temp=join("��",$privilege);
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ������Ա {$_REQUEST['AdminID']} ��Ȩ���޸�Ϊ{$temp}', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	����Ա <? echo $_REQUEST['AdminID']; ?> ��Ȩ���޸ĳɹ��� <br>
<?
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
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

