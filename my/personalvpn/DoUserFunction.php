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
          </font></font><a href="/my/personalvpn/UserFunction.php" class="a5">����/�ر��û�����</a> 
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
if ( (!isset($HTTP_SESSION_VARS['UserID'])) ){
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


$result=mysql_query("select A.UserFunc as UserFunc,A.UserFuncStatus as UserFuncStatus , A.AutoID as UserAutoID ,B.UserAccount as UserAccount from User_TB as A, UserAccount_TB as B  where A.ID='{$HTTP_SESSION_VARS['UserID']}' and A.AutoID=B.UserAutoID");

if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
�����µ�¼<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
}
else{
	
$i=0;
if  (isset($_REQUEST['PersonalVPN']) ) {
	$i+=1;
}
if  (isset($_REQUEST['BackPersonalVPN']) ) {
	$i+=1;
}
if  (isset($_REQUEST['PersonalHourVPN']) ) {
	$i+=1;
}
if  (isset($_REQUEST['BackPersonalHourVPN']) ) {
	$i+=1;
}

if ($i>1) {
?>
�������¡�������ʱ���ع����ºͻع���ʱ����ֱͨ����������ֻ��ͬʱѡ��һ�֣�
<?
} else {
$strFunc=$row['UserFunc'];
$strFuncStatus=$row['UserFuncStatus'];
$UserAutoID=$row['UserAutoID'];
$UserAccount=floatval($row['UserAccount']);
$query=array();
$query[]="begin";

$haveOpen=false;
if  (!isset($_REQUEST['PersonalVPN']) ){
	$strFunc=str_replace('PersonalVPN','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$_REQUEST['UserID']}'";
	$query[]="delete from PersonalVPN_UserChargeTime_TB where UserAutoID={$UserAutoID} and FeeType='PerMonth'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �ر��� {$_SESSION['UserID']} �ĸ���VPN�������·���', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
} else {
	$haveOpen=strstr($strFunc,"PersonalVPN");
	$strFunc.=",PersonalVPN";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
	$today = getdate();
	if (!$haveOpen){
		$query[]="replace into PersonalVPN_UserChargeTime_TB(UserAutoID,FeeType,UserChargeTime) values({$UserAutoID},'PerMonth','1999-01-01')";
	}
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ���� {$_SESSION['UserID']} �ĸ���VPN�������·���', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query("rollback");
		break;
	}
}
if ($success) {
if (isset($HTTP_POST_VARS['PersonalVPN']) ) {
?>
	���ĳ���ֱͨ�����°������ã�<br>
<?
include 'Include/MonthFee.php';
} else {
?>
	���ĳ���ֱͨ�����°湦���ѹرա�<br>
<?
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	�����û����ܿ���/�ر�ҳ��<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
}

$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['PersonalHourVPN']) ){
	$strFunc=str_replace('PersonalHourVPN','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �ر��� {$_SESSION['UserID']} �ĸ���VPN������ʱ����', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
} else {
	$strFunc.=",PersonalHourVPN";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
/*	$query[]="Insert into UserAccountLog_TB values (null,{$row[2]},now(),0,0,{$row[3]},'��ʼ���ɸ��˼�ʱVPNʹ�÷�')"; */
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ���� {$_SESSION['UserID']} �ĸ���VPN������ʱ����', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query("rollback");
		break;
	}
}
if ($success) {
if (isset($HTTP_POST_VARS['PersonalHourVPN'])) {
?>
	���ĳ���ֱͨ����ʱ�������ã�<br>
<?
} else {
?>
	���ĳ���ֱͨ����ʱ�湦���ѹرա�<br>
<?
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	�����û����ܿ���/�ر�ҳ��<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
}

$query=array();
$query[]="begin";

$haveOpen=false;
if  (!isset($_REQUEST['BackPersonalVPN']) ){
	$strFunc=str_replace('BackVPNPersonal','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$_REQUEST['UserID']}'";
	$query[]="delete from PersonalVPN_UserChargeTime_TB where UserAutoID={$UserAutoID} and FeeType='BackPerMonth'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �ر��� {$_SESSION['UserID']} �ĸ���VPN�ع����·���', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
} else {
	$haveOpen=strstr($strFunc,"BackVPNPersonal");
	$strFunc.=",BackVPNPersonal";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
	$today = getdate();
	if (!$haveOpen){
		$query[]="replace into PersonalVPN_UserChargeTime_TB(UserAutoID,FeeType,UserChargeTime) values({$UserAutoID},'BackPerMonth','1999-01-01')";
	}
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ���� {$_SESSION['UserID']} �ĸ���VPN�ع����·���', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query("rollback");
		break;
	}
}
if ($success) {
if (isset($HTTP_POST_VARS['BackPersonalVPN']) ) {
?>
	���Ļع�ֱͨ�����°������ã�<br>
<?
include 'Include/BackMonthFee.php';
} else {
?>
	���Ļع�ֱͨ�����°湦���ѹرա�<br>
<?
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	�����û����ܿ���/�ر�ҳ��<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
}

$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['BackPersonalHourVPN']) ){
	$strFunc=str_replace('BackHourVPNPersonal','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �ر��� {$_SESSION['UserID']} �ĸ���VPN�ع���ʱ����', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
} else {
	$strFunc.=",BackHourVPNPersonal";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ���� {$_SESSION['UserID']} �ĸ��˻ع�VPN��ʱ����', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query("rollback");
		break;
	}
}
if ($success) {
if (isset($HTTP_POST_VARS['BackPersonalHourVPN'])) {
?>
	���Ļع�ֱͨ����ʱ�������ã�<br>
<?
} else {
?>
	���Ļع�ֱͨ����ʱ�湦���ѹرա�<br>
<?
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	�����û����ܿ���/�ر�ҳ��<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
}


$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['PersonalProxy']) ){
	$strFunc=str_replace('PersonalProxy','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �ر��� {$_SESSION['UserID']} �ĸ���VPN�������', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
}
} else {

	$haveOpen=strstr($strFunc,"PersonalProxy");
	$strFunc.=",PersonalProxy";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
	$today = getdate();
	if (!$haveOpen){
		$query[]="replace into PersonalVPN_UserChargeTime_TB(UserAutoID,FeeType,UserChargeTime) values({$UserAutoID},'ProxyPerMonth','1999-01-01')";
	}
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ���� {$_SESSION['UserID']} �ĸ���VPN�������', '{$_SERVER['REMOTE_ADDR']}','UserAccount',  NOW()) ";
}
}
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query("rollback");
		break;
	}
}
if ($success) {
if (isset($HTTP_POST_VARS['PersonalProxy'])) {
?>
	����ֱͨ������������ã�<br>
<?
include 'Include/ProxyMonthFee.php';
} else {
?>
	����ֱͨ��������ѹرա�<br>
<?
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	�����û����ܿ���/�ر�ҳ��<br>
<br>
<input type="button" value="����" onclick="history.back()">
<br>
<?
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
require_once( "footer.inc.php" );
?>
