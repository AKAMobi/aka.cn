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
                </font><a href="/my/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
                </font><a href="ChangePassword.php" class="a5">更改密码</a>
				<br>
                <br>
                <span class="newstitle">更改密码</span></p>
              <p>这里是更改密码服务页面。请首先输入您账号的旧密码，再输入欲更改的新密码。按“更改密码”键确认更改。</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($HTTP_SESSION_VARS['UserID']) ) ) {
?>
您尚未登陆。<br>
请首先<A HREF="index.php" class=a5>登陆</a>。
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
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>帐号名：</td>
      <td><? echo $HTTP_SESSION_VARS['UserID']; ?></td>
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
  <input type="button" id="oChangePassword" value="更改密码" onclick="ChangePassword();"> 
   </p>
</form>

<?
}
?>
</td></tr></table>
<br>

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
