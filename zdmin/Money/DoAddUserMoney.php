<? session_start(); ?>
<? 
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Money/AddUserMoney.php" class="a5">���û���Ǯ</a>
				<br>
                <br>
                <span class="newstitle">���û���Ǯ</span></p>
              <p>�������û���Ǯ</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))   ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��¼</a>��
<?
}else {

if ( (!isset($_SESSION['MoneyAdmin'])) ) {
?>
��û�и������û���Ǯ��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {

if ((!isset($_REQUEST['UserID'])) || (!isset($_REQUEST['Amount'])) || (!isset($_REQUEST['Reason'])) ){
?>
���������ȫ�������������롣
<INPUT type="button" value="����" onclick="history.back();">
<?
}else {

require "{$ADMINROOT}/Include/InitDB.php"; 

mysql_query("begin");
$result=mysql_query("select A.AutoID as UserAutoID ,B.UserAccount as UserAccount,  A.ID as UserID from User_TB as A, UserAccount_TB as B where A.ID='{$_REQUEST['UserID']}' and A.AutoID=B.UserAutoID and A.Status='Normal' ");

if ( !($row=mysql_fetch_array($result)) ){ //�޴��û�
mysql_query("rollback");
?>
	�޴��û�����û�δͨ��ע�ᡣ����������û�ID�Ƿ���ȷ��
	<input type="button" value="����" onclick="history.back();">
<?
} else {


$reason=preg_replace("/,/","��",$_REQUEST['Reason']);
$query=array();
$NewAccount=floatval($row['UserAccount'])+floatval($_REQUEST['Amount']);
$query[]="Update UserAccount_TB Set UserAccount={$NewAccount} where UserAutoID='{$row['UserAutoID']}'";
$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason) values (NULL,{$row['UserAutoID']},now(),{$_REQUEST['Amount']},0,$NewAccount,'��Ϊ {$reason} ������ {$_REQUEST['Amount']} Ԫ','Bonus')";
$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �� {$row['UserID']}  �ĸ����˻��ϼ�Ǯ {$_REQUEST['Amount']} Ԫ�������ǣ�{$reason}', '{$_SERVER['REMOTE_ADDR']}','Money', NOW()) ";
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
	��Ǯ�����ɹ���<br>
<?
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
<?
}
}

mysql_close($conn);
}
}
}
?>
</td>
</tr>
</table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
