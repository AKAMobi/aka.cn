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
                </font><a href="/my" class="a5">我的阿卡</a>
				<font color="#458DE4">&gt; </font><a href="/my/UserRegister.shtml" class="a5">快速认证</a><br>
                <br>
            </td>
        </tr>
      </table>
	<br>
	<br>
<?
function validate(){

if (!isset($_SESSION['ValidateID'])) {
	echo "调用参数错误，请<a href='{$_SERVER['HTTP_REFERER']}' class='a6'>返回</a>";
	return -1;
}
$result=mysql_query("select AutoID,MobilePhone,EMail,Status from User_TB where ID='{$_SESSION['ValidateID']}'");


if (!($row=mysql_fetch_array($result))){//此ID不存在
	echo "用户 {$_SESSION['ValidateID']} 不存在";
	return -2;
}

if ($row['Status']!='ProfileNotProved') {
	echo "您不能进行快速身份验证<br>";
	return -5;
}

$UserAutoID=$row['AutoID'];
$MobilePhone=$row['MobilePhone'];
$EMail=$row['EMail'];

$result=mysql_query("select * from UserValidate_TB where UserAutoID='{$UserAutoID}'");

if (!($row=mysql_fetch_array($result))){ //不存在验证数据
        $validationCode=mt_rand();
        $sql="insert into UserValidate_TB(UserAutoID,ValidationCode,validated) values ('{$UserAutoID}','{$validationCode}','N');";
	if (!mysql_query($sql)) {
		echo "数据库操作失败，请联络管理员<br>";
		return -3;
	}
} else{
	if ($row['validated']=='Y') {
		echo "您已经验证通过了，请不要重复验证";
		return -4;	
	}
	$validationCode=$row['ValidationCode'];
}

if (isset($_REQUEST['Mobile'])){
	dl('libsms.so');
	if (sendsms("localhost","4000",$UserAutoID,$MobilePhone,"您的认证码: {$validationCode}")==0) {
		echo "手机认证短信已发送到您的手机 {$MobilePhone} ，请您注意查收！<br>";
	} else {
		echo "手机认证短信发送失败<br>";
	}
}

return 0;

}

if (validate()>=0) {
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
	if (document.all.oValidateCode.value=="") {
		alert("请输入您的认证码");
		document.all.oValidateCode.focus();
		return ;
	}


	mainForm.submit();
}
function  Mobile(){
	document.location.href="<?php echo $_SERVER['PHP_SELF']; ?>?Mobile=1";
}
-->
</script>
	<br>
	<input type=button value="发送认证短信" onclick="Mobile();">
	<br>
                    <form id="mainForm" method="POST" action="dompvalidate.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>用户帐号：</td>
      <td><input type="text" id="oName" name="Name" size="20" ></td>
    </tr>
    <tr>
      <td>用户密码：</td>
      <td><input type="password" id="oPassword" name="Password" size="20" ></td>
    </tr>
    <tr>
      <td>认证码：</td>
      <td><input type="text" id="oValidateCode" name="validateCode" size="20" ></td>
    </tr>
  </table>
  </div>
  <br>
                      <p align="center"> <img src="/image/enter.gif" width="74" height="22" id="oLogOn" value="登陆" onclick="Login();"> 
                      </p>
</form>

<?php
}


?>
</center>
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
                <td><a href="../serv_prod/index.shtml" class="a6">产品与服务</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">客户服务</a></td>
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
require_once( "footer.inc.php" ) ;
?>
