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
	<p>��ҳ��ܾ�����</p>
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
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");

$result=mysql_query("select * from User_TB where ID='{$UserID}'");

if (!($row=mysql_fetch_array($result))){//��ID������

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
��ID�����ڣ�<BR>
�뷵�����ԡ�
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
����ע�ᵥ�޸�ʧ�ܡ�<BR>
���³����ύ������������ɣ���ֱ����������ϵ��<br>
	<br>
<input type="button" value="����" onclick="history.back()">
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
����ע�ᵥ�ѳɹ��޸ġ�<BR>
���ǽ���������������������ϵ���������ĵȴ�:)<br>
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
