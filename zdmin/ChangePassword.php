<? session_start(); ?>
<?

require_once("zdmin.inc.php");

require("{$ADMINROOT}/Include/IncludeFile.php");

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> 
                <font color="#458DE4">&gt;</font><a href="<? echo $ADMINURLROOT; ?>/ChangePassword.php" class="a5">更换密码</a>
				<br>
                <br>
                <span class="newstitle">更换密码</span></p>
              <p>这里是更换密码服务页面。请首先输入您账号的旧密码，再输入欲更换的新密码。按“更换密码”键确认更换。</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID']) ) ) {
?>
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
<?
}else {
?>
<script language="javascript">
<!--
function ChangePassword(){
	if (document.all.oPassword.value=="") {
		alert("请输入您的密码");
		document.all.oPassword.focus();
		return ;
	}
	if (document.all.oNewPassword1.value=="") {
		alert("请输入您的新密码");
		document.all.oNewPassword1.focus();
		return ;
	}
	if (document.all.oNewPassword2.value!=document.all.oNewPassword1.value) {
		alert("两次输入的新密码不一致");
		document.all.oNewPassword2.focus();
		return ;
	}

	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_Password(){
	if ( IsEnter() ) {
		document.all.oNewPassword1.focus();
	}
}
function testKey_NewPassword1(){
	if ( IsEnter() ) {
		document.all.oNewPassword2.focus();
	}
}
function testKey_NewPassword2(){

	if ( IsEnter() ) {
		document.all.oChangePassword.click();
	}
}
-->
</script>
<form id="mainForm" method="POST" action="DoChangePassword.php">
                      <br>
  <div align="center"><table border="0" >
    <tr>
      <td>管理员帐号：</td>
      <td><? echo $_SESSION['AdminID']; ?></td>
    </tr>
    <tr>
      <td>旧密码：</td>
      <td><input type="password" id="oPassword" name="Password" size="20" onkeypress="testKey_Password();" ></td>
    </tr>
    <tr>
      <td>新密码：</td>
      <td><input type="password" id="oNewPassword1" name="NewPassword1" size="20" onkeypress="testKey_NewPassword1();" ></td>
    </tr>
    <tr>
      <td>再次输入新密码：</td>
      <td><input type="password" id="oNewPassword2" name="NewPassword2" size="20" onkeypress="testKey_NewPassword2();" ></td>
    </tr>

</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oChangePassword" value="更换密码" onclick="ChangePassword();"> 
   </p>
</form>

<?
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");

IncludeHTML("{$AKAROOT}/footer.html");
?>
