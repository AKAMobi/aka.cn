<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
��ӹ���Ա�˺�
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
��û�й�����������Ա��Ȩ��<br>
<?
} else {
?>
<script language="javascript">
<!--
function AddAdmin(){
	if (document.all.oAdminID.value=="") {
		alert("�������¹���Ա���˺�");
		document.all.oAdminID.focus();
		return ;
	}
	if (document.all.oAdminName.value=="") {
		alert("�������¹���Ա������");
		document.all.oAdminID.focus();
		return ;
	}	
	if (document.all.oNewPassword1.value=="") {
		alert("�������¹���Ա������");
		document.all.oNewPassword1.focus();
		return ;
	}
	if (document.all.oNewPassword2.value!=document.all.oNewPassword1.value) {
		alert("������������벻һ��");
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
      <td>�¹���Ա�˺ţ�</td>
      <td><input type="text" id="oAdminID" name="AdminID" size="20" ></td>
    </tr>
    <tr>
      <td>�¹���Ա������</td>
      <td><input type="text" id="oAdminName" name="AdminName" size="20" ></td>
    </tr>
    
    <tr>
      <td>���룺</td>
      <td><input type="password" id="oNewPassword1" name="NewPassword1" size="20" ></td>
    </tr>
    <tr>
      <td>�ٴ��������룺</td>
      <td><input type="password" id="oNewPassword2" name="NewPassword2" size="20" ></td>
    </tr>
    <tr>
      <td valign="top">Ȩ�ޣ�</td>
      <td align>
      <TABLE border="0">
      <tr><td><INPUT type="checkbox" name="UserAccount">�û�����</td></td>
      <tr><td><INPUT type="checkbox" name="News">���Ź���</td></td>
      <tr><td><INPUT type="checkbox" name="PersonalVPN">����VPN����</td></td>
      <tr><td><INPUT type="checkbox" name="Money">�û��ʽ����</td></td>
      <tr><td><INPUT type="checkbox" name="Admin">����Ա�˺Ź���</td></td>
      <tr><td><INPUT type="checkbox" name="Log">��־����</td></td>
      </table> 
      </td>
    </tr>
    <tr>
      <td>��ע��</td>
      <td><textarea id="oNote" name="Note" ></textarea></td>
    </tr>

</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddAdmin" value="��ӹ���Ա�˺�" onclick="AddAdmin();"> 
   </p>
</form>

<?	
}
}
?>
</div>

