<?
require_once( "header.inc.php" );

if ( (!isset($HTTP_POST_VARS['ID'])) || 
	(!isset($HTTP_POST_VARS['Password'])) ||
	(!isset($HTTP_POST_VARS['UserName'])) ||
	(!isset($HTTP_POST_VARS['IdNum'])) ||
	(!isset($HTTP_POST_VARS['Company'])) ||
	(!isset($HTTP_POST_VARS['Tel'])) ||
	(!isset($HTTP_POST_VARS['Mobile'])) ||
	(!isset($HTTP_POST_VARS['EMail'])) ||
	(!isset($HTTP_POST_VARS['Address'])) ||
	(!isset($HTTP_POST_VARS['ZipCode'])) ||
	(!isset($HTTP_POST_VARS['SuperiorUser'])) ){
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<p>用户注册请访问<A HREF="UserRegister.shtml">用户注册页面</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	exit(0);
}
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
                </font><a href="/my" class="a5">我的阿卡</a>
				<font color="#458DE4">&gt; </font><a href="/my/UserRegister.shtml" class="a5">用户注册</a><br>
                <br>
            </td>
        </tr>
      </table>
<?

$result=mysql_query("select * from User_TB where ID='{$HTTP_POST_VARS['ID']}'");

if (($row=mysql_fetch_array($result))){//此ID已存在

?>
	<br>
	<br>
	<br>
	<br>
	<br>
此ID已存在！<BR>
请换一个ID重新注册<br>
<input type="button" value="返回" onclick="history.back();">
	<br>
	<br>
<?
}
else{
$SuperUserID="NULL";
$SuperUserRight=true;
if ($HTTP_POST_VARS['SuperiorUser']!="") {
	$result=mysql_query("select AutoID from User_TB where ID='{$HTTP_POST_VARS['SuperiorUser']}'");
	if ( ! ($row=mysql_fetch_array($result))) 
	  $SuperUserRight=false;
	else 
	  $SuperUserID=$row['AutoID'];
}
if ( !$SuperUserRight ) { //联系人ID有错误
?>
	<br>
	<br>
	<br>
	<br>
	<br>
您填写的介绍人ID有错误！<BR>
请重新填写注册单<br>
<input type="button" value="返回" onclick="history.back();">
	<br>
	<br>
<?
} else {
$enPassword=$HTTP_POST_VARS['Password'];
$query=array();
$query[]="begin";
$query[]="insert into User_TB(AutoID,ID,Password,UserName,IdentifierNum,Company,TelephoneNumber,MobilePhone,EMail,Address,ZipCode,Status,UserFunc,UserFuncStatus,SuperiorUserAutoID) Values (NULL,'{$HTTP_POST_VARS['ID']}','$enPassword','{$HTTP_POST_VARS['UserName']}'," .
 "'{$HTTP_POST_VARS['IdNum']}','{$HTTP_POST_VARS['Company']}','{$HTTP_POST_VARS['Tel']}','{$HTTP_POST_VARS['Mobile']}'," .
 "'{$HTTP_POST_VARS['EMail']}','{$HTTP_POST_VARS['Address']}','{$HTTP_POST_VARS['ZipCode']}','ProfileNotProved','','',{$SuperUserID})";

$ContinueUse=($HTTP_POST_VARS['Question1']=="Yes")?"Yes":"No";
$LikeMonthFeeType=(isset($HTTP_POST_VARS['MonthFee']))?"Yes":"No";
$LikeMinFeeType=(isset($HTTP_POST_VARS['MinFee']))?"Yes":"No";
$OtherFeeType=(isset($HTTP_POST_VARS['OtherFeeDetail']))?$HTTP_POST_VARS['OtherFeeDetail']:"";
$MaxMonthFee=(isset($HTTP_POST_VARS['MaxMonthFeeDetail']))?$HTTP_POST_VARS['MaxMonthFeeDetail']:0;
$MaxMinFee=(isset($HTTP_POST_VARS['MaxHourFeeDetail']))?$HTTP_POST_VARS['MaxHourFeeDetail']:0;
$MaxOtherFee=(isset($HTTP_POST_VARS['MaxOtherFeeDetail']))?$HTTP_POST_VARS['MaxOtherFeeDetail']:0;
$FavoriteMonthFee=(isset($HTTP_POST_VARS['FavoriteMonthFeeDetail']))?$HTTP_POST_VARS['FavoriteMonthFeeDetail']:0;
$FavoriteMinFee=(isset($HTTP_POST_VARS['FavoriteHourFeeDetail']))?$HTTP_POST_VARS['FavoriteHourFeeDetail']:0;
$FavoriteOtherFee=(isset($HTTP_POST_VARS['FavoriteOtherFeeDetail']))?$HTTP_POST_VARS['FavoriteOtherFeeDetail']:0;
$Known=($HTTP_POST_VARS['Question5']=="Yes")?"Yes":"No";
$Will=($HTTP_POST_VARS['Question6']=="Yes")?"Yes":"No";

$query[]="insert into PersonalVPN_Investigate(AutoID, UserID, ContinueUse, LikeMonthFeeType, LikeMinFeeType, OtherFeeType , MaxMonthFee, MaxMinFee, MaxOtherFee, FavoriteMonthFee, FavoriteMinFee, FavoriteOtherFee, Known, Will) Values(NULL,'{$HTTP_POST_VARS['ID']}', '{$ContinueUse}', '$LikeMonthFeeType', '$LikeMinFeeType', '$OtherFeeType', $MaxMonthFee, $MaxMinFee, $MaxOtherFee, $FavoriteMonthFee,  $FavoriteMinFee, $FavoriteOtherFee, '$Known', '$Will' )";
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query('rollback');
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
您的注册单提交失败。<BR>
请返回重新尝试提交。
如果问题依旧，请直接与我们联系。<br>
<input type="button" value="返回" onclick="history.back();">
	<br>
	<br>
<?
} else {
?>
	<br>
	<br>
	<br>
	<br>
	<br>
您的注册单已成功提交。<BR>
<!--我们将在两个工作日内与您联系。请您耐心等待:)--><br>
请您仔细阅读<a href="usage.shtml" class="a5">使用说明</a>，然后<p>
<font size=+1 color=red>
	<ol>	
		<li>等待注册通过</li>
		<li>登录进入系统</li>
		<li>提交加钱信息</li>
		<li>察看自己帐户，等待正是划账</li>
		<li>在“功能开启“菜单中打开个人VPN功能</li>
	<ol>
</font>
    <br>
	<br>
<?
}
}
}
?>
</center>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
      <table width="210" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="120">&nbsp;</td>
        </tr>
        <tr> 
          <td>
            <table width="210" cellspacing="8" cellpadding="3">
              <tr> 
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">相关链接</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../serv_prod/index.shtml" class="a6">产品与服务</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">客户服务</a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" ) ;
?>
