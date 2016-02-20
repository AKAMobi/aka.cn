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
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><font color="#458DE4"><a href="/my/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
          </font></font><a href="/my/personalvpn/UserFunction.php" class="a5">开启/关闭用户功能</a> 
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
	<p>请首先<A HREF="index.php">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
}


$result=mysql_query("select A.UserFunc as UserFunc,A.UserFuncStatus as UserFuncStatus , A.AutoID as UserAutoID ,B.UserAccount as UserAccount from User_TB as A, UserAccount_TB as B  where A.ID='{$HTTP_SESSION_VARS['UserID']}' and A.AutoID=B.UserAutoID");

if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新登录<br>
<br>
<input type="button" value="返回" onclick="history.back()">
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
出国包月、出国计时、回国包月和回国计时四种直通车功能中您只能同时选择一种！
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
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 关闭了 {$_SESSION['UserID']} 的个人VPN出国包月服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
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
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 打开了 {$_SESSION['UserID']} 的个人VPN出国包月服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
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
	您的出国直通车包月版已启用！<br>
<?
include 'Include/MonthFee.php';
} else {
?>
	您的出国直通车包月版功能已关闭。<br>
<?
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回用户功能开启/关闭页面<br>
<br>
<input type="button" value="返回" onclick="history.back()">
<br>
<?
}

$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['PersonalHourVPN']) ){
	$strFunc=str_replace('PersonalHourVPN','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 关闭了 {$_SESSION['UserID']} 的个人VPN出国计时服务', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
} else {
	$strFunc.=",PersonalHourVPN";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
/*	$query[]="Insert into UserAccountLog_TB values (null,{$row[2]},now(),0,0,{$row[3]},'开始缴纳个人计时VPN使用费')"; */
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 打开了 {$_SESSION['UserID']} 的个人VPN出国计时服务', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
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
	您的出国直通车计时版已启用！<br>
<?
} else {
?>
	您的出国直通车计时版功能已关闭。<br>
<?
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回用户功能开启/关闭页面<br>
<br>
<input type="button" value="返回" onclick="history.back()">
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
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 关闭了 {$_SESSION['UserID']} 的个人VPN回国包月服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
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
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 打开了 {$_SESSION['UserID']} 的个人VPN回国包月服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
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
	您的回国直通车包月版已启用！<br>
<?
include 'Include/BackMonthFee.php';
} else {
?>
	您的回国直通车包月版功能已关闭。<br>
<?
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回用户功能开启/关闭页面<br>
<br>
<input type="button" value="返回" onclick="history.back()">
<br>
<?
}

$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['BackPersonalHourVPN']) ){
	$strFunc=str_replace('BackHourVPNPersonal','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 关闭了 {$_SESSION['UserID']} 的个人VPN回国计时服务', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
}
} else {
	$strFunc.=",BackHourVPNPersonal";
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 打开了 {$_SESSION['UserID']} 的个人回国VPN计时服务', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ";
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
	您的回国直通车计时版已启用！<br>
<?
} else {
?>
	您的回国直通车计时版功能已关闭。<br>
<?
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回用户功能开启/关闭页面<br>
<br>
<input type="button" value="返回" onclick="history.back()">
<br>
<?
}


$query=array();
$query[]="begin";
if  (!isset($HTTP_POST_VARS['PersonalProxy']) ){
	$strFunc=str_replace('PersonalProxy','',$strFunc);
	$query[]="Update User_TB Set UserFunc='$strFunc' where ID='{$HTTP_SESSION_VARS['UserID']}'";
if ((isset($_SESSION['AdminID'])) ){
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 关闭了 {$_SESSION['UserID']} 的个人VPN代理服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ";
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
	$query[]="insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 打开了 {$_SESSION['UserID']} 的个人VPN代理服务', '{$_SERVER['REMOTE_ADDR']}','UserAccount',  NOW()) ";
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
	您的直通车代理版已启用！<br>
<?
include 'Include/ProxyMonthFee.php';
} else {
?>
	您的直通车代理版已关闭。<br>
<?
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回用户功能开启/关闭页面<br>
<br>
<input type="button" value="返回" onclick="history.back()">
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
