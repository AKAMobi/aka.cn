<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><font color="#458DE4"><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font></font><a href="/my/money/MoneyTransfer.php" class="a5">�û���ת��</a> 
          <br>
          <br>
        <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
  <br>
  <br>
  <br>
  <br>
<?
if ( (!isset($HTTP_SESSION_VARS['UserID'])) || (!isset($HTTP_POST_VARS['TransferTarget']))
	|| (!isset($HTTP_POST_VARS['TransferTargetName']))
	|| (!isset($HTTP_POST_VARS['Money'])) 
	|| (!isset($_REQUEST['Currency'])) ){
?>
	<p>������<A HREF="index.php">��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
} 
if (!strcmp($HTTP_SESSION_VARS['UserID'],$HTTP_POST_VARS['TransferTarget'])){
?>
	<p>����ת�˸��Լ���</p>
	<p>��������ת�˶����Ƿ���������</p>
<BR>
</td></tr></table>
<?
} else {
$accountType="UserAccount";
$currencyType="RMB";
if ($_REQUEST['Currency']=="USD"){
	$accountType="UserAccountUSD";
	$currencyType="USD";
}


$result=mysql_query("select A.AutoID as OriginUserAutoID ,B.{$accountType} as OriginUserAccount ,C.AutoID as TargetUserAutoID, D.{$accountType} as TargetUserAccount, C.UserName as TargetUserName ,A.ID as OriginUserID, C.ID as TargetUserID from User_TB as A, UserAccount_TB as B, User_TB as C, UserAccount_TB as D where A.ID='{$HTTP_SESSION_VARS['UserID']}' and A.AutoID=B.UserAutoID and C.ID='{$HTTP_POST_VARS['TransferTarget']}' and C.Status='Normal' and C.AutoID=D.UserAutoID ");
if ((!($row=mysql_fetch_array($result))) || (floatval($HTTP_POST_VARS['Money'])<0) ){//�޴��û�
?>
�����������Ŀ���û�δ���ã�<BR>
�������������Ƿ���ȷ<BR>
<br>
<input type="button" value="����" onclick="history.back();">
<br>
<?
}
else{

if ($row['TargetUserName']!=$HTTP_POST_VARS['TransferTargetName']){
?>
	�û���ʵ���ƴ����������������Ƿ���ȷ<br>
<br>
<input type="button" value="����" onclick="history.back();">
<br>
<?
} else {
if (floatval($row['OriginUserAccount'])<floatval($HTTP_POST_VARS['Money'])){
?>
���˻��ϵ����㣡<BR>
�������������Ƿ���ȷ<BR>
<br>
<input type="button" value="����" onclick="history.back();">
<br>
<?
} else {
$query=array();
$query[]="begin";
$NewAccount=floatval($row['OriginUserAccount'])-floatval($HTTP_POST_VARS['Money']);
$query[]="Update UserAccount_TB Set {$accountType}={$NewAccount} where UserAutoID='{$row['OriginUserAutoID']}'";
$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason,Currency) values (NULL,{$row['OriginUserAutoID']},now(),0,{$HTTP_POST_VARS['Money']},$NewAccount,'��ת�� {$row['TargetUserID']} �� {$HTTP_POST_VARS['Money']} Ԫ ','InternalTransferOut','{$currencyType}')";
$NewAccount=floatval($row['TargetUserAccount'])+floatval($HTTP_POST_VARS['Money']);
$query[]="Update UserAccount_TB Set {$accountType}={$NewAccount},AccountEnable='Y' where UserAutoID='{$row['TargetUserAutoID']}'";
$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason,Currency) values (NULL,{$row['TargetUserAutoID']},now(),{$HTTP_POST_VARS['Money']},0,$NewAccount,' {$row['OriginUserID']} ת���� {$HTTP_POST_VARS['Money']} Ԫ','InternalTransferIn','{$currencyType}')";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �� {$row['OriginUserID']}  �ĸ����˻��ϻ��� {$HTTP_POST_VARS['Money']} {$currencyType} ת�� {$row['TargetUserID']}', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query('rollback');
		break;
	}
}
if ($success) {
?>
	���������ѳɹ�����<br>
<?
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
<?
}
}
}
}
?>
<BR>
</td></tr></table>


    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
<?
readfile( "tips.html" );
?>
</td>
  </tr>
</table>

<?
}
require_once( "footer.inc.php" );
?>
