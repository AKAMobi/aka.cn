<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

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

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//�˹���Ա������
?>
�˹���Ա�����ڣ�<BR>
<?
} else{
if (mysql_query("delete from  AdminUser_TB where ID='{$_REQUEST['AdminID']}'")) {
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ɾ���� {$_REQUEST['AdminID']} ���˺�', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	����Ա�˺�ɾ���ɹ���<br>
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
?>
</div>

