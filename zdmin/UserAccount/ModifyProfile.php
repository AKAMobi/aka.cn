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
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ModifyProfile.php" class="a5">修改用户信息</a><br>
          <br>
          <span class="newstitle">修改用户信息</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?



if ( (!isset($_SESSION['AdminID']))  || (!isset($_REQUEST['ID']))   ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登录</a>。
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
你没有修改用户信息的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {

require_once("{$ADMINROOT}/Include/InitDB.php"); 

$result=mysql_query("select * from User_TB where ID='{$_REQUEST['ID']}'"); 
if ( !($row=mysql_fetch_array($result)) ){ //无此用户
?>
	无此用户。请重试。
	<input type="button" onclick="history.back();" value="返回">
<?
} else {
?>
<script language="JScript">
<!--
function register(){
	if (document.all.oUserName.value=="") {
		alert("请输入用户的姓名");
		document.all.oUserName.focus();
		return ;
	}
	if (document.all.oPassword.value!=document.all.oPassword1.value) {
		alert("两次输入密码不一致");
		document.all.oPassword1.focus();
		return ;
	}
	if (document.all.oIdNum.value=="") {
		alert("请输入用户的身份证号码");
		document.all.oIdNum.focus();
		return ;
	}
	if (document.all.oCompany.value=="") {
		alert("请输入用户的单位名称");
		document.all.oCompany.focus();
		return ;
	}
	if (document.all.oEMail.value=="") {
		alert("请输入用户的电子邮箱");
		document.all.oEMail.focus();
		return ;
	}
	if (document.all.oAddress.value=="") {
		alert("请输入用户的地址");
		document.all.oAddress.focus();
		return ;
	}
	if (document.all.oZipCode.value=="") {
		alert("请输入用户的邮编");
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
        <td width="83%"><? echo $row['ID'] ?><input type="hidden" id="oID" name="ID"  value="<? echo $row['ID'] ?>"></td>
      </tr>
      <tr> 
        <td>姓名</td>
        <td><input type="text" id="oUserName" name="UserName"  value="<? echo $row['UserName'] ?>"> * </td>
      </tr>
      <tr> 
        <td>密码</td>
        <td><input type="password" id="oPassword" name="Password" ></td>
      </tr>
      <tr> 
        <td>验证密码</td>
        <td><input type="password" id="oPassword1" name="Password1" ></td>
      </tr>
      <tr> 
        <td>身份证号</td>
        <td><input type="text" id="oIdNum" name="IdNum" value="<? echo $row['IdentifierNum'] ?>"></td>
      </tr>
      <tr> 
        <td>单位名称</td>
        <td><input type="text" id="oCompany" name="Company" value="<? echo $row['Company']?>"> * </td>
      </tr>
      <tr> 
        <td>联系电话</td>
        <td><input type="text" id="oTel" name="Tel" value="<? echo $row['TelephoneNumber']?>"></td>
      </tr>
      <tr> 
        <td>手机</td>
        <td><input type="text" id="oMobile" name="Mobile" value="<? echo $row['MobilePhone']?>"></td>
      </tr>
      <tr> 
        <td>电子邮箱</td>
        <td><input type="text" id="oEMail" name="EMail" value="<? echo $row['EMail']?>"></td>
      </tr>
  <tr>
    <td>地址</td>
    <td>
 <input id=oAddress type=text name=Address value="<? echo $row['Address']?>"> * </td></tr>
  <tr>
    <td>邮编</td>
    <td>
 <input id=oZipCode type=text name=ZipCode value="<? echo $row['ZipCode']?>"></td></tr>
    </table>

<p>
      <input type="button" name="Submit" value="提交" onclick="register();"> 
</p>
  </form>

</div>
<?
}
}
}
?>
</td>
</tr>
</table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
