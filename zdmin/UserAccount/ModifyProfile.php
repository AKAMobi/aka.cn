<? session_start(); ?>
<? 
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ModifyProfile.php" class="a5">�޸��û���Ϣ</a><br>
          <br>
          <span class="newstitle">�޸��û���Ϣ</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?



if ( (!isset($_SESSION['AdminID']))  || (!isset($_REQUEST['ID']))   ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��¼</a>��
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
��û���޸��û���Ϣ��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {

require_once("{$ADMINROOT}/Include/InitDB.php"); 

$result=mysql_query("select * from User_TB where ID='{$_REQUEST['ID']}'"); 
if ( !($row=mysql_fetch_array($result)) ){ //�޴��û�
?>
	�޴��û��������ԡ�
	<input type="button" onclick="history.back();" value="����">
<?
} else {
?>
<script language="JScript">
<!--
function register(){
	if (document.all.oUserName.value=="") {
		alert("�������û�������");
		document.all.oUserName.focus();
		return ;
	}
	if (document.all.oPassword.value!=document.all.oPassword1.value) {
		alert("�����������벻һ��");
		document.all.oPassword1.focus();
		return ;
	}
	if (document.all.oIdNum.value=="") {
		alert("�������û������֤����");
		document.all.oIdNum.focus();
		return ;
	}
	if (document.all.oCompany.value=="") {
		alert("�������û��ĵ�λ����");
		document.all.oCompany.focus();
		return ;
	}
	if (document.all.oEMail.value=="") {
		alert("�������û��ĵ�������");
		document.all.oEMail.focus();
		return ;
	}
	if (document.all.oAddress.value=="") {
		alert("�������û��ĵ�ַ");
		document.all.oAddress.focus();
		return ;
	}
	if (document.all.oZipCode.value=="") {
		alert("�������û����ʱ�");
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
        <td width="83%"><? echo $row['ID'] ?><input type="hidden" id="oID" name="ID"  value="<? echo $row['ID'] ?>"></td>
      </tr>
      <tr> 
        <td>����</td>
        <td><input type="text" id="oUserName" name="UserName"  value="<? echo $row['UserName'] ?>"> * </td>
      </tr>
      <tr> 
        <td>����</td>
        <td><input type="password" id="oPassword" name="Password" ></td>
      </tr>
      <tr> 
        <td>��֤����</td>
        <td><input type="password" id="oPassword1" name="Password1" ></td>
      </tr>
      <tr> 
        <td>���֤��</td>
        <td><input type="text" id="oIdNum" name="IdNum" value="<? echo $row['IdentifierNum'] ?>"></td>
      </tr>
      <tr> 
        <td>��λ����</td>
        <td><input type="text" id="oCompany" name="Company" value="<? echo $row['Company']?>"> * </td>
      </tr>
      <tr> 
        <td>��ϵ�绰</td>
        <td><input type="text" id="oTel" name="Tel" value="<? echo $row['TelephoneNumber']?>"></td>
      </tr>
      <tr> 
        <td>�ֻ�</td>
        <td><input type="text" id="oMobile" name="Mobile" value="<? echo $row['MobilePhone']?>"></td>
      </tr>
      <tr> 
        <td>��������</td>
        <td><input type="text" id="oEMail" name="EMail" value="<? echo $row['EMail']?>"></td>
      </tr>
  <tr>
    <td>��ַ</td>
    <td>
 <input id=oAddress type=text name=Address value="<? echo $row['Address']?>"> * </td></tr>
  <tr>
    <td>�ʱ�</td>
    <td>
 <input id=oZipCode type=text name=ZipCode value="<? echo $row['ZipCode']?>"></td></tr>
    </table>

<p>
      <input type="button" name="Submit" value="�ύ" onclick="register();"> 
</p>
  </form>

</div>
<?
}
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
