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
          </font></font><a href="/my/personalvpn/UserFunction.php" class="a5">定义用户功能</a> 
          <br>
          <br>
        <p>请选择关闭/打开需要的功能。<p>
	<p>请注意根据您的需求选择正确的出国/回国类型。<!-- by zixia: 太不友好啦 由于您自身选择错误造成的损失本公司不负任何责任--></p>
	<p>注：如取消包月功能，系统并不会返回包月费用，请注意。</p>
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
if ( (!isset($HTTP_SESSION_VARS['UserID']))  ){
?>
	<p>请首先<A HREF="/my/" class=a5>登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
}

#require 'Include/InitDB.php'; 
$result=mysql_query("select A.UserFunc as UserFunc,A.UserFuncStatus as UserFuncStatus , A.AutoID as UserAutoID ,B.UserAccount as UserAccount from User_TB as A, UserAccount_TB as B  where A.ID='{$HTTP_SESSION_VARS['UserID']}' and A.AutoID=B.UserAutoID", $conn);
if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新<A HREF="/my/" class=a5>登录</a>
<?
}
else{
$UserAutoID=$row['UserAutoID'];
$UserAccount=floatval($row['UserAccount']);
$functions=explode(",",$row['UserFunc']);
$functionStatus=explode(",",$row['UserFuncStatus']);
?>
<!--//
<?

if ( ( in_array("PersonalProxy",$functions) ) && (!in_array("PersonalProxy",$functionStatus)) ){
include 'Include/ProxyMonthFee.php';

}

if( ( in_array("PersonalVPN",$functions) ) && (!in_array("PersonalVPN",$functionStatus)) ){
include 'Include/MonthFee.php';
}

if( ( in_array("BackVPNPersonal",$functions) ) && (!in_array("BackVPNPersonal",$functionStatus)) ){
include 'Include/BackMonthFee.php';
}
?>
//-->
<?
$result=mysql_query("select UserFunc,UserFuncStatus from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'", $conn);

if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新<A HREF="/my/" class=a5>登录</a>
<?
}
else{
$functions=explode(",",$row['UserFunc']);

$functionStatus=explode(",",$row['UserFuncStatus']);
?>
	<div align="center">
	<form name="mainForm" method="post" action="DoUserFunction.php">
	<table>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalVPN" name="PersonalVPN" <? echo in_array("PersonalVPN",$functions)?'checked':''; ?> onclick="oPersonalHourVPN.checked=false;oBackPersonalVPN.checked=false;oBackPersonalHourVPN.checked=false;">

	</td>
	<td>
<? if( in_array("PersonalVPN",$functions) ){

	echo in_array("PersonalVPN",$functionStatus)?'<font color=green>正常</font> ':'<font color=red>费用不足，失效中...</font>'; 
   }
?>

阿卡出国直通车(包月版) 28.8RMB/月</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalHourVPN" name="PersonalHourVPN" <? echo in_array("PersonalHourVPN",$functions)?'checked':''; ?> onclick="oPersonalVPN.checked=false;oBackPersonalHourVPN.checked=false;oBackPersonalVPN.checked=false;">
	</td>
	<td>阿卡出国直通车(计时版) 0.04RMB/分钟，至2003年8月六折</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oBackPersonalVPN" name="BackPersonalVPN" <? echo in_array("BackVPNPersonal",$functions)?'checked':''; ?> 
onclick="oBackPersonalHourVPN.checked=false;oPersonalVPN.checked=false;oPersonalHourVPN.checked=false;">

	</td>
	<td>
<? if( in_array("BackVPNPersonal",$functions) ){

	echo in_array("BackVPNPersonal",$functionStatus)?'<font color=green>正常</font> ':'<font color=red>费用不足，失效中...</font>'; 
   }
?>

阿卡回国直通车(包月版) 88RMB/月，至2003年8月六折</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oBackPersonalHourVPN" name="BackPersonalHourVPN" <? echo in_array("BackHourVPNPersonal",$functions)?'checked':''; ?> onclick="oBackPersonalVPN.checked=false;oPersonalHourVPN.checked=false;oPersonalVPN.checked=false;">
	</td>
	<td>阿卡回国直通车(计时版) 0.04RMB/分钟，至2003年8月六折</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalProxy" name="PersonalProxy" <? echo in_array("PersonalProxy",$functions)?'checked':''; ?> >
	</td>
	<td>
<? if( in_array("PersonalProxy",$functions) ){

 	echo in_array("PersonalProxy",$functionStatus)?'<font color=green>正常</font> ':'<font color=red>费用不足，失效中...</font>'; 
   }
?>
阿卡直通车(Proxy版) 55RMB/月，至2003年8月六折</td>
	</tr>
	</table>
	<br>
	<input type="submit" value="提交">
	<br>
	</form>
	</div>
<?
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
