<?
#require( "header.inc.php" );
?>

<script language="javascript">
<!--
function Login(){
	if (document.all.oName.value=="") {
		alert("请输入您的用户帐号");
		document.all.oName.focus();
		return ;
	}
	if (document.all.oPassword.value=="") {
		alert("请输入您的密码");
		document.all.oPassword.focus();
		return ;
	}
	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_Name(){
	if ( IsEnter() ) {
		document.all.oPassword.focus();
	}
}

function testKey_Password(){

	if ( IsEnter() ) {
		document.all.oLogOn.click();
	}
}
-->
</script>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="/PersonalVPN" class="a5">我的阿卡</a><br>
                <br>
                <span class="newstitle"> 我的阿卡</span></p>
              <p>这里我们为公司的客户提供VPN流量查询等服务。请使用我们提供给您的账号和密码登陆。</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
      <div align="left"> 
        <table width="500" cellspacing="0" cellpadding="0" align="center">
          <tr> 
            <td bgcolor="#006699" height="14"><b><font color="#FFFFFF">登录客户服务系统</font></b> 
              <table width="500" cellspacing="0" cellpadding="0" align="center">
                <tr> 
                  <td bgcolor="#FFFFFF" height="14">

                    <form id="mainForm" method="POST" action="Logon.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>用户帐号：</td>
      <td><input type="text" id="oName" name="Name" size="20" onkeypress="testKey_Name();" ></td>
    </tr>
    <tr>
      <td>用户密码：</td>
      <td><input type="password" id="oPassword" name="Password" size="20" onkeypress="testKey_Password();" ></td>
    </tr>
  </table>
  </div>
  <br>
                      <p align="center"> <img src="../customer/images/enter.gif" width="74" height="22" id="oLogOn" value="登陆" onclick="Login();"> 
		      <a href="UserAgreement.shtml"><img src="../customer/images/register.gif" width=74 height=22 border=0></a> 
                      </p>
</form>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        
      </div>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
      <table width="210" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="120">&nbsp;</td>
        </tr>
        <tr> 
          <td>
            <table width="210" cellspacing="8" cellpadding="3">
              <tr> 
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">相关链接</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="UserAgreement.shtml" class="a6">注册新用户</a></td>
              </tr>
              <tr> 
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="usage.shtml" class="a6" target="_blank">个人VPN使用说明</a></td>
              </tr>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?
#require( "footer.inc.php" );
?>
