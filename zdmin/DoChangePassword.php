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
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><font color="#458DE4"><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt; 
          </font></font><a href="<? echo $ADMINURLROOT; ?>/ChangePassword.php" class="a5">修改密码</a> 
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
if ( (!isset($_SESSION['AdminID'])) || (!isset($_REQUEST['Password']))
	|| (!isset($_REQUEST['NewPassword1'])) ){
?>
	<p>请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
	IncludeHTML("{$AKAROOT}/footer.html");
	die;
}

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select Password from AdminUser_TB where ID='{$_SESSION['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//无此用户
?>
无此用户！<BR>
请重新<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>
<?
}
else{
if (crypt($_REQUEST['Password'],$row["Password"])!=$row["Password"]){//密码错误
?>
密码错误！<br>
请<A href="<? echo $ADMINURLROOT; ?>/ChangePassword.php">返回</a>重新输入密码
<?
}
else{//正常登录
$passwd=crypt($_REQUEST['NewPassword1']);
if (mysql_query("Update AdminUser_TB Set Password='{$passwd}' where ID='{$_SESSION['AdminID']}'")) {
?>
	密码修改成功！<br>
	<A href="<? echo $ADMINURLROOT; ?>/AdminMenu.php">返回主菜单</a>
<?
} else {
?>
	数据库操作失败！请联络管理员。<br>
	<A href="<? echo $ADMINURLROOT; ?>/ChangePassword.php">返回修改密码页面</a>
<?
}
}
}
?>
<BR>
</td></tr></table>

<?
mysql_free_result($result);

// Closing connection
mysql_close($conn);

require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
