<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
添加管理员账号
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
?>
<script language="javascript">
<!--
function AddAdmin(){
	if (document.all.oAdminID.value=="") {
		alert("请输入新管理员的账号");
		document.all.oAdminID.focus();
		return ;
	}
	if (document.all.oAdminName.value=="") {
		alert("请输入新管理员的姓名");
		document.all.oAdminID.focus();
		return ;
	}	
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

-->
</script>
<form id="mainForm" method="POST" action="DoAddAdmin.php">
                      <br>
  <div align="center"><table border="0" >
    <tr>
      <td>新管理员账号：</td>
      <td><input type="text" id="oAdminID" name="AdminID" size="20" ></td>
    </tr>
    <tr>
      <td>新管理员姓名：</td>
      <td><input type="text" id="oAdminName" name="AdminName" size="20" ></td>
    </tr>
    
    <tr>
      <td>密码：</td>
      <td><input type="password" id="oNewPassword1" name="NewPassword1" size="20" ></td>
    </tr>
    <tr>
      <td>再次输入密码：</td>
      <td><input type="password" id="oNewPassword2" name="NewPassword2" size="20" ></td>
    </tr>
    <tr>
      <td valign="top">权限：</td>
      <td align>
      <TABLE border="0">
      <tr><td><INPUT type="checkbox" name="UserAccount">用户管理</td></td>
      <tr><td><INPUT type="checkbox" name="News">新闻管理</td></td>
      <tr><td><INPUT type="checkbox" name="PersonalVPN">个人VPN管理</td></td>
      <tr><td><INPUT type="checkbox" name="Money">用户资金管理</td></td>
      <tr><td><INPUT type="checkbox" name="Admin">管理员账号管理</td></td>
      <tr><td><INPUT type="checkbox" name="Log">日志管理</td></td>
      </table> 
      </td>
    </tr>
    <tr>
      <td>备注：</td>
      <td><textarea id="oNote" name="Note" ></textarea></td>
    </tr>

</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddAdmin" value="添加管理员账号" onclick="AddAdmin();"> 
   </p>
</form>

<?	
}
}
?>
</div>

