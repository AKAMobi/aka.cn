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
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/SYSOPFirstTime.php" class="a5">�趨��߹���Ա����</a><br>
          <br>
          <span class="newstitle">�趨��߹���Ա����</span></p>
              <p>��������һ�ε�½��ϵͳ�����趨��������:</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))  ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINROOT; ?>/index.php">��¼</a>��
<?
}else {

if ($_SESSION['AdminID']!=$SYSOPID){
?>
��������߹���Ա��������<A HREF="<? echo $ADMINROOT; ?>/index.php">��¼</a>��
<?
} else {
?>
<script language="javascript">
<!--
function ChangePassword(){
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
      <td>��߹���Ա�ʺţ�</td>
      <td><? echo $_SESSION['AdminID']; ?></td>
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
    <input type="button" id="oChangePassword" value="��������" onclick="ChangePassword();"> 
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
