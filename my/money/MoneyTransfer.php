<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
                </font><a href="/my/money/TransferMoney.php" class="a5">ת��</a>
				<br>
                <br>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($HTTP_SESSION_VARS['UserID']) ) ) {
?>
����δ��½��<br>
������<A HREF="/my/" class=a5>��½</a>��
<?
}else {
?>
<script language="javascript">
<!--
function TransferMoney(){
	if (document.all.oTransferTarget.value=="") {
		alert("�����������˶����ID");
		document.all.oTransferTarget.focus();
		return ;
	}
	if (document.all.oTransferTargetName.value=="") {
		alert("�����������˶������ʵ����");
		document.all.oTransferTargetName.focus();
		return ;
	}
	if (document.all.oMoney.value=="") {
		alert("�����������˵Ľ��");
		document.all.oMoney.focus();
		return ;
	}

	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_TransferTarget(){
	if ( IsEnter() ) {
		document.all.oTransferTargetName.focus();
	}
}
function testKey_TransferTargetName(){
	if ( IsEnter() ) {
		document.all.oMoney.focus();
	}
}
function testKey_Money(){

	if ( IsEnter() ) {
		document.all.oCurrency.focus();
	}
}
-->
</script>
<form id="mainForm" method="post" action="DoMoneyTransfer.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>�û��ʺţ�</td>
      <td><? echo $HTTP_SESSION_VARS['UserID']; ?></td>
    </tr>
    <tr>
      <td>���˶����˺ţ�</td>
      <td><input type="textfield" id="oTransferTarget" name="TransferTarget" size="20" onkeypress="testKey_TransferTarget();" ></td>
    </tr>
    <tr>
      <td>���˶�����ʵ������</td>
      <td><input type="textfield" id="oTransferTargetName" name="TransferTargetName" size="20" onkeypress="testKey_TransferTargetName();" ></td>
    </tr>
    <tr>
      <td>���˽�</td>
      <td><input type="textfield" id="oMoney" name="Money" size="20" onkeypress="testKey_Money();" ></td>
    </tr>
    <tr>
      <td>��������</td>
      <td><select name="Currency" id="oCurrenect" size="1">
	<option selected value="RMB">�����</option>
	<option value="USD">��Ԫ</option>
	</select>
	</td>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oTransferMoney" value="ȷ������" onclick="TransferMoney();"> 
   </p>
</form>

<?
}
?>
</td></tr></table>
<br>


    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
<?
readfile( "tips.html" );
?>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" );
?>
