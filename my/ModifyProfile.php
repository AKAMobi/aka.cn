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
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font><a href="/my/main.php" class="a5">�û��˵�</a><br>
          <br>
          <span class="newstitle">�޸�ע����Ϣ</span></p>
              <p>��ԭ����д��ע�ᵥ��Ϣ��������ϸ��鲢������дע����Ϣ</p>
		<p>������Ϣ������ȷ����ϸ����д����*�ŵ�����������д�������޷�ͨ��ע��������лл������</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($HTTP_SESSION_VARS['ModifyRegister']))  ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="index.php">��¼</a>��
<?
}else {
require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");

$result=mysql_query("select * from User_TB where ID='{$HTTP_SESSION_VARS['ModifyRegister']}'"); 
$HTTP_SESSION_VARS['DoModifyRegister']=$HTTP_SESSION_VARS['ModifyRegister'];
unset($HTTP_SESSION_VARS['ModifyRegister']);
if ( !($row=mysql_fetch_array($result)) ){ //�޴��û�
?>
	�޴��û����볢�����µ�½��
	<input type="button" onclick="history.back();" value="����">
<?
} else {
?>
<script language="JScript">
<!--
function register(){
	if (document.all.oUserName.value=="") {
		alert("��������������");
		document.all.oUserName.focus();
		return ;
	}
	if (document.all.oIdNum.value=="") {
		alert("�������������֤����");
		document.all.oIdNum.focus();
		return ;
	}
	if (document.all.oCompany.value=="") {
		alert("���������ĵ�λ����");
		document.all.oCompany.focus();
		return ;
	}
	if (document.all.oEMail.value=="") {
		alert("���������ĵ�������");
		document.all.oEMail.focus();
		return ;
	}
	if (document.all.oAddress.value=="") {
		alert("���������ĵ�ַ");
		document.all.oAddress.focus();
		return ;
	}
	if (document.all.oZipCode.value=="") {
		alert("�����������ʱ�");
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
        <td width="83%"><? echo $row[1] ?></td>
      </tr>
      <tr> 
        <td>����</td>
        <td><input type="text" id="oUserName" name="UserName"  value="<? echo $row['UserName'] ?>"> * </td>
      </tr>
      <tr> 
        <td>���֤��</td>
        <td><input type="text" id="oIdNum" name="IdNum" value="<? echo $row['IdentifierNum'] ?>"></td>
      </tr>
      <tr> 
        <td>��λ����</td>
        <td><input type="text" id="oCompany" name="Company" value="<? echo $row[5] ?>"> * </td>
      </tr>
      <tr> 
        <td>��ϵ�绰</td>
        <td><input type="text" id="oTel" name="Tel" value="<? echo $row[6] ?>"></td>
      </tr>
      <tr> 
        <td>�ֻ�</td>
        <td><input type="text" id="oMobile" name="Mobile" value="<? echo $row[7] ?>"></td>
      </tr>
      <tr> 
        <td>��������</td>
        <td><input type="text" id="oEMail" name="EMail" value="<? echo $row[8] ?>"></td>
      </tr>
  <tr>
    <td>��ַ</td>
    <td>
 <input id=oAddress type=text name=Address value="<? echo $row[9] ?>"> * </td></tr>
  <tr>
    <td>�ʱ�</td>
    <td>
 <input id=oZipCode type=text name=ZipCode value="<? echo $row[10] ?>"></td></tr>
    </table>
    <p>
      ˵��������˾�û�ע����õ绰ȷ�Ϸ�ʽ��������ʵ��д���ϸ������ϡ����ǽ��������ύ���������������õ绰������ϵ����ȷ������ע��������ȷ����лл���ĺ�����
    </p>
<p>
      <input type="button" name="Submit" value="�ύ" onclick="register();"> 
</p>
  </form>

</div>
<?
}
}
?>
</td>
</tr>
</table>
<br>
<?
require_once("footer.inc.php");
?>
