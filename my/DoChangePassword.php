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
          </font><font color="#458DE4"><a href="<? echo dirname($_SERVER['PHP_SELF']); ?>" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
          </font></font><font class="a5"><a href="<? echo dirname($_SERVER['PHP_SELF']); ?>/ChangePassword.php" class="a5">修改密码</a></font> 
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
if ( (!isset($HTTP_SESSION_VARS['UserID'])) || (!isset($HTTP_POST_VARS['Password']))
	|| (!isset($HTTP_POST_VARS['NewPassword1'])) ){
?>
	<p>请首先<A HREF="<? echo dirname($_SERVER['PHP_SELF']); ?>">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
}

//require 'Include/InitDB.php';
$result=mysql_query("select * from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'");

if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新<A HREF="index.php">登录</a>
<?
}
else{
if (strcmp($HTTP_POST_VARS['Password'],$row["Password"])){//密码错误
?>
密码错误！<br>
请<A href="ChangePassword.php" class=a5>返回</a>重新输入密码
<?
}
else{//正常登录
$enNewPasswd=$HTTP_POST_VARS['NewPassword1'];
if (mysql_query("Update User_TB Set Password='{$enNewPasswd}' where ID='{$HTTP_SESSION_VARS['UserID']}'")) {
?>
	密码修改成功！<br>
	<A href="<? echo dirname($_SERVER['PHP_SELF']); ?>" class=a5>返回主菜单</a>
<?
if ((isset($_SESSION['AdminID'])) ){
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 修改了 {$_SESSION['UserID']} 的密码', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ", $conn);
}
} else {
?>
	数据库操作失败！请联络管理员。<br>
	<A href="ChangePassword.php" class=a5>返回修改密码页面</a>
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
</td></tr></table>

<?
require_once( "footer.inc.php" );
?>
