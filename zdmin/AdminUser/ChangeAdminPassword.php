<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
�޸Ĺ���Ա����
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

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select ID from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//�˹���Ա������
?>
����Ա�˺� <? echo $_REQUEST['AdminID'] ; ?> �����ڣ�
<?
}else {
?>
<script language="javascript">
<!--
function ChangeAdminPassword(){
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
      <td>����Ա��</td>
      <td><? echo $_REQUEST['AdminID']; ?></td>
    </tr>
    <tr>
      <td>�����룺</td>
      <td><input type="password" id="oNewPassword1" name="NewPassword1" size="20" onkeypress="testKey_NewPassword1();" ></td>
    </tr>
    <tr>
      <td>�ٴ����������룺</td>
      <td><input type="password" id="oNewPassword2" name="NewPassword2" size="20" onkeypress="testKey_NewPassword2();" ></td>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oChangeAdminPassword" value="�޸Ĺ���Ա����" onclick="ChangeAdminPassword();"> 
   </p>
</form>

<?	
}
}
}
?>
</div>