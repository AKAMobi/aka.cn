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
          </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/SYSOPFirstTime.php" class="a5">设定最高管理员密码</a><br>
          <br>
          <span class="newstitle">设定最高管理员密码</span></p>
              <p>这是您第一次登陆本系统。</p>
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
if ( (!isset($_SESSION['AdminID'])) || (!isset($_REQUEST['NewPassword1'])) ){
?>
	<p>请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>！</p>
	<br>
	<br>
	<br>
	<br>
<?
} else {

if ($_SESSION['AdminID']!=$SYSOPID){
?>
您不是最高管理员。请重新<A HREF="<? echo $ADMINROOT; ?>/index.php">登录</a>。
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$passwd=crypt($_REQUEST['NewPassword1']);
if (mysql_query("Insert into AdminUser_TB(ID,Password,FullName,Information,Privilege) values ( '{$SYSOPID}','{$passwd}','系统管理员','系统最高管理员','') ")) {
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}',' 最高管理员 {$_SESSION['AdminID']} 的账号建立成功', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	最高管理员账号 <? echo $SYSOPID; ?> 密码设定成功！<br>
	<A href="<? echo $ADMINURLROOT; ?>/AdminMenu.php">进入主菜单</a>
<?
} else {
?>
	数据库操作失败或本管理员已存在！请联络系统维护管理员。<br>
	<A href="<? echo $ADMINURLROOT; ?>/SYSOPFirstTime.php">返回修改密码页面</a>
<?
}

}
}
?>
<BR>
<BR>

</td></tr></table>

<?
// Closing connection
mysql_close($conn);

require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
