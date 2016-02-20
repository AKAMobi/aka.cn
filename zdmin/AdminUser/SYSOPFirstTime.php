<? session_start(); ?>
<? 

require_once("zdmin.inc.php");

require("{$ADMINROOT}/Include/IncludeFile.php");

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
              <p>这是您第一次登陆本系统。请设定您的密码:</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))  ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINROOT; ?>/index.php">登录</a>。
<?
}else {

if ($_SESSION['AdminID']!=$SYSOPID){
?>
您不是最高管理员。请重新<A HREF="<? echo $ADMINROOT; ?>/index.php">登录</a>。
<?
} else {
?>
<script language="javascript">
<!--
function ChangePassword(){
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
<FORM id="mainForm" action="DoSYSOPFirstTime.php" method="post">
  <div align="center">
  <table border="0">
    <tr>
      <td>最高管理员帐号：</td>
      <td><? echo $_SESSION['AdminID']; ?></td>
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
    <input type="button" id="oChangePassword" value="更换密码" onclick="ChangePassword();"> 
  </div>
</form>

<?
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
