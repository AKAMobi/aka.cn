<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="/my/" class="a5">我的阿卡</a> <font color="#458DE4">&gt; 
                </font><a href="/my/money/ShowAccount.php" class="a5">察看账户信息</a>
                <br>
				<br>
                <span class="newstitle">账户信息</span><br>
				<br>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($HTTP_SESSION_VARS['UserID'])) ){
?>
您尚未登陆。<br>
请首先<A HREF="/my/">登陆</a>。
<?
}else {

$result=mysql_query("select A.UserAccount as UserAccount, A.UserAccountUSD from UserAccount_TB as A, User_TB as B where A.UserAutoID=B.AutoID and B.ID='{$HTTP_SESSION_VARS['UserID']}'");
if (!($row=mysql_fetch_array($result)) ){
?>
	数据库操作失败。请与管理员联系。
<?
} else {
?>
用户<? echo $HTTP_SESSION_VARS['UserID'] ?>的账户余额为：<br>
人民币：<? echo "￥" . (intval($row['UserAccount'])==-1?0.00:$row['UserAccount']); ?><br>
美元：<? echo "$" . (intval($row['UserAccountUSD'])==-1?0.00:$row['UserAccountUSD']); ?><br>
<br>
<div align="Center">
<strong><font size="+1">最近两个月内账户资金流动情况</font></strong><br>
<br> 
</div>
<table id="oTable" width="500">
<thead>
<tr>
<th id="oTime" width="90">时间</th>
<th id="oIncoming" width="55">流入金额</th>
<th id="oOutcoming" width="55">流出金额</th>
<th id="oBalance" width="50">余额</th>
<th id="oNotes">事由</th>
</tr>
</thead>
</table>
<iframe src="ShowAccountInside.php" style="width:540;height:300;">
	您的浏览器版本太低，请使用5.5以上版本的IE访问本站
</iframe>

<br>
<br>
<?
}
}
?>
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
require_once( "footer.inc.php" )
?>
