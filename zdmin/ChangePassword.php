<? session_start(); ?>
<?

require_once("zdmin.inc.php");

require("{$ADMINROOT}/Include/IncludeFile.php");

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">����˵�</a> 
                <font color="#458DE4">&gt;</font><a href="<? echo $ADMINURLROOT; ?>/ChangePassword.php" class="a5">��������</a>
				<br>
                <br>
                <span class="newstitle">��������</span></p>
              <p>�����Ǹ����������ҳ�档�������������˺ŵľ����룬�������������������롣�����������롱��ȷ�ϸ�����</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID']) ) ) {
?>
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��½</a>��
<?
}else {
?>
<script language="javascript">
<!--
function ChangePassword(){
	if (document.all.oPassword.value=="") {
		alert("��������������");
		document.all.oPassword.focus();
		return ;
	}
	if (document.all.oNewPassword1.value=="") {
		alert("����������������");
		document.all.oNewPassword1.focus();
		return ;
	}
	if (document.all.oNewPassword2.value!=document.all.oNewPassword1.value) {
		alert("��������������벻һ��");
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
  <div align="center"><table border="0" >
    <tr>
      <td>����Ա�ʺţ�</td>
      <td><? echo $_SESSION['AdminID']; ?></td>
    </tr>
    <tr>
      <td>�����룺</td>
      <td><input type="password" id="oPassword" name="Password" size="20" onkeypress="testKey_Password();" ></td>
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
  <input type="button" id="oChangePassword" value="��������" onclick="ChangePassword();"> 
   </p>
</form>

<?
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");

IncludeHTML("{$AKAROOT}/footer.html");
?>
