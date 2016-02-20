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
          </font><a href="/my/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
          </font><a href="/my/main.php" class="a5">用户菜单</a><br>
          <br>
          <span class="newstitle">修改注册信息</span></p>
              <p>您原先填写的注册单信息有误。请仔细检查并重新填写注册信息</p>
		<p>所有信息必须正确而详细的填写，加*号的请用中文填写，否则将无法通过注册审批，谢谢合作。</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select * from User_TB u left join tmp t on u.AutoID=t.UserAutoID where t.UserAutoID in( u.AutoID) limit 50" );
$HTTP_SESSION_VARS['DoModifyRegister']=$HTTP_SESSION_VARS['ModifyRegister'];
unset($HTTP_SESSION_VARS['ModifyRegister']);
$n = 0;
while ( $row=mysql_fetch_array($result) ){ 
?>
<div align="center">
<form name="RegisterForm" method="post" action="DoModifyProfile.php">
    <table width="75%" >
      <tr> 
        <td width="17%">ID <?= ++$n ?></td>
        <td width="83%"><? echo $row[1] ?></td>
      </tr>
      <tr> 
        <td>姓名</td>
        <td><? echo $row['UserName'] ?></td>
      </tr>
      <tr> 
        <td>身份证号</td>
        <td><? echo $row['IdentifierNum'] ?></td>
      </tr>
      <tr> 
        <td>单位名称</td>
        <td><? echo $row[5] ?></td>
      </tr>
      <tr> 
        <td>联系电话</td>
        <td><? echo $row[6] ?></td>
      </tr>
      <tr> 
        <td>手机</td>
        <td><? echo $row[7] ?></td>
      </tr>
      <tr> 
        <td>电子邮箱</td>
        <td><? echo $row[8] ?></td>
      </tr>
  <tr>
    <td>地址</td>
    <td>
 <? echo $row[9] ?>"</td></tr>
  <tr>
    <td>邮编</td>
    <td>
 <? echo $row[10] ?></td></tr>
    </table>
  </form>
<hr>

</div>
<?
}
?>
</td>
</tr>
</table>
<br>
<?
require_once("footer.inc.php");
?>
