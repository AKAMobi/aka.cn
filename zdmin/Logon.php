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
	<p>������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>��</p>
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
	($_REQUEST['Name']==$SYSOPID) ) {  //�ж��˺�'zixia'�Ƿ��һ��ʹ��
	$isSYSOPFirstTime=true;
}  else {
	$isSYSOPFirstTime=false;
}

if ((!$isSYSOPFirstTime) && (!$row) ){//�޴��û�
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
�޴˹���Ա�˺ţ�<BR>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>
	<br>
	<br>
<?
}
else{
if  ( (!$isSYSOPFirstTime) &&
		(crypt($_REQUEST['Password'],$row["Password"])!=$row["Password"]) ){//�������
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
�������<br>
������<A href="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>
	<br>
	<br>
<?
}
else{//������¼


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

mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_REQUEST['Name']}','{$_REQUEST['Name']} ������¼' , '{$_SERVER['REMOTE_ADDR']}', 'LogOn', NOW()) ");


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
