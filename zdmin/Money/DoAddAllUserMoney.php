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
                </font><a href="<? echo $ADMINURLROOT ;?>/Money/AddAllUserMoney.php" class="a5">�������û���Ǯ</a>
				<br>
                <br>
                <span class="newstitle">�������û���Ǯ</span></p>
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

if ((!isset($_REQUEST['AddAll'])) || (!isset($_REQUEST['Amount'])) || (!isset($_REQUEST['Reason'])) 
	|| (!isset($_REQUEST['Currency'])) ){
?>
���������ȫ�������������롣
<INPUT type="button" value="����" onclick="history.back();">
<?
}else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$accountType="UserAccount";
$currencyType="RMB";
if ($_REQUEST['Currency']=="USD"){
	$accountType="UserAccountUSD";
	$currencyType="USD";
}

$result=mysql_query("select A.AutoID as UserAutoID ,B.{$accountType} as UserAccount,  A.ID as UserID from User_TB as A, UserAccount_TB as B where A.Status='Normal' and  A.AutoID=B.UserAutoID ");

while($row=mysql_fetch_array($result)) { //��ÿ���û�ѭ��

$reason=preg_replace("/,/","��",$_REQUEST['Reason']);
$query=array();
$query[]="begin";
$NewAccount=floatval($row['UserAccount'])+floatval($_REQUEST['Amount']);
$query[]="Update UserAccount_TB Set {$accountType}={$NewAccount} where UserAutoID='{$row['UserAutoID']}'";
$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason,Currency) values (NULL,{$row['UserAutoID']},now(),{$_REQUEST['Amount']},0,$NewAccount,'��Ϊ {$reason} ������ {$_REQUEST['Amount']} Ԫ','Bonus','{$currencyType}')";
$query[]="commit";

for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		mysql_query('rollback');
		break;
	}
}
}

mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �������û��ĸ����˻��ϼ�Ǯ {$_REQUEST['Amount']} Ԫ {$currencyType}�������ǣ�{$reason}', '{$_SERVER['REMOTE_ADDR']}','Money', NOW()) ");

mysql_close($conn);
?>

�������û���Ǯ�ɹ���

<?
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
