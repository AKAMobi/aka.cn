<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
修改管理员密码
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
你没有管理其他管理员的权限<br>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//此管理员不存在
?>
管理员账号 <? echo $_REQUEST['AdminID'] ; ?> 不存在！
<?
}else {
?>
<script language="javascript">
<!--
function ChangeAdminPassword(){
	if (document.all.oNewPassword1.value=="") {
		alert("请输入新管理员的密码");
		document.all.oNewPassword1.focus();
		return ;
	}
	if (document.all.oNewPassword2.value!=document.all.oNewPassword1.value) {
		alert("两次输入的密码不一致");
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

	if ( IsEnter() ) {document.all.oChangeAdminPassword.click();
	}
}
-->
</script>
<form id="mainForm" method="POST" action="DoChangeAdminPassword.php">
<INPUT type="hidden" name="AdminID" value="<? echo $_REQUEST['AdminID']; ?>">
                      <br>
  <div align="center"><table border="0" >
    <tr>
      <td>管理员：</td>
      <td><? echo $_REQUEST['AdminID']; ?></td>
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
  <input type="button" id="oChangeAdminPassword" value="修改管理员密码" onclick="ChangeAdminPassword();"> 
   </p>
</form>

<?	
}
}
}
?>
</div>