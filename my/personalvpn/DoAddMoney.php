<?
require_once ("header.inc.php");
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
          </font><font color="#458DE4"><a href="/PersonalVPN/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
          </font><a href="/PersonalVPN/UserMenu.php" class="a5">用户菜单</a> <font color="#458DE4">&gt; 
          </font></font><a href="/PersonalVPN/AddMoney.php" class="a5">用户加钱</a> 
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
if ( (!isset($HTTP_SESSION_VARS['UserID'])) || (!isset($HTTP_POST_VARS['OperTime']))
	|| (!isset($HTTP_POST_VARS['Money'])) || (!isset($HTTP_POST_VARS['OperNumber'])) ){
?>
	<p>请首先<A HREF="index.php">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	IncludeHTML("../footer.html");
	die;
}

require_once ("db.inc.php");
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");
$result=mysql_query("select AutoID from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'");

if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新<A HREF="index.php">登录</a>
<?
}
else{
if (mysql_query("insert into UserAddMoney_TB(AutoID, UserAutoID, OperateTime, Money, OperateNumber, LogTime,Status) values (NULL, {$row['AutoID']}, '{$HTTP_POST_VARS['OperTime']}', {$HTTP_POST_VARS['Money']},'{$HTTP_POST_VARS['OperNumber']}',Now(),'Submitting')")) {
?>
	加钱信息已成功提交！<br>
	<A href="UserMenu.php">返回主菜单</a>
<?
} else {
?>
	数据库操作失败！请联络管理员。<br>
	返回<A href="AddMoney.php">加钱页面</a>
<?
}
}
?>
<BR>
</td></tr></table>

<?
require_once ("footer.inc.php");
?>
