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

if ( (!isset($HTTP_SESSION_VARS['ModifyRegister']))  ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="index.php">登录</a>。
<?
}else {
require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select * from User_TB where ID='{$HTTP_SESSION_VARS['ModifyRegister']}'"); 
$HTTP_SESSION_VARS['DoModifyRegister']=$HTTP_SESSION_VARS['ModifyRegister'];
unset($HTTP_SESSION_VARS['ModifyRegister']);
if ( !($row=mysql_fetch_array($result)) ){ //无此用户
?>
	无此用户。请尝试重新登陆。
	<input type="button" onclick="history.back();" value="返回">
<?
} else {
?>
<script language="JScript">
<!--
function register(){
	if (document.all.oUserName.value=="") {
		alert("请输入您的姓名");
		document.all.oUserName.focus();
		return ;
	}
	if (document.all.oIdNum.value=="") {
		alert("请输入您的身份证号码");
		document.all.oIdNum.focus();
		return ;
	}
	if (document.all.oCompany.value=="") {
		alert("请输入您的单位名称");
		document.all.oCompany.focus();
		return ;
	}
	if (document.all.oEMail.value=="") {
		alert("请输入您的电子邮箱");
		document.all.oEMail.focus();
		return ;
	}
	if (document.all.oAddress.value=="") {
		alert("请输入您的地址");
		document.all.oAddress.focus();
		return ;
	}
	if (document.all.oZipCode.value=="") {
		alert("请输入您的邮编");
		document.all.oZipCode.focus();
		return ;
	}	
	RegisterForm.submit();						
}
-->
</script>
<div align="center">
<form name="RegisterForm" method="post" action="DoModifyProfile.php">
    <table width="75%" >
      <tr> 
        <td width="17%">ID</td>
        <td width="83%"><? echo $row[1] ?></td>
      </tr>
      <tr> 
        <td>姓名</td>
        <td><input type="text" id="oUserName" name="UserName"  value="<? echo $row['UserName'] ?>"> * </td>
      </tr>
      <tr> 
        <td>身份证号</td>
        <td><input type="text" id="oIdNum" name="IdNum" value="<? echo $row['IdentifierNum'] ?>"></td>
      </tr>
      <tr> 
        <td>单位名称</td>
        <td><input type="text" id="oCompany" name="Company" value="<? echo $row[5] ?>"> * </td>
      </tr>
      <tr> 
        <td>联系电话</td>
        <td><input type="text" id="oTel" name="Tel" value="<? echo $row[6] ?>"></td>
      </tr>
      <tr> 
        <td>手机</td>
        <td><input type="text" id="oMobile" name="Mobile" value="<? echo $row[7] ?>"></td>
      </tr>
      <tr> 
        <td>电子邮箱</td>
        <td><input type="text" id="oEMail" name="EMail" value="<? echo $row[8] ?>"></td>
      </tr>
  <tr>
    <td>地址</td>
    <td>
 <input id=oAddress type=text name=Address value="<? echo $row[9] ?>"> * </td></tr>
  <tr>
    <td>邮编</td>
    <td>
 <input id=oZipCode type=text name=ZipCode value="<? echo $row[10] ?>"></td></tr>
    </table>
    <p>
      说明：本公司用户注册采用电话确认方式，请您如实填写以上各项资料。我们将在资料提交后两个工作日内用电话与您联系，以确认您的注册资料正确无误。谢谢您的合作！
    </p>
<p>
      <input type="button" name="Submit" value="提交" onclick="register();"> 
</p>
  </form>

</div>
<?
}
}
?>
</td>
</tr>
</table>
<br>
<?
require_once("footer.inc.php");
?>
