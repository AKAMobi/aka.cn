<?
require_once ("header.inc.php");
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
                </font><a href="/PersonalVPN/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
                </font><a href="/PersonalVPN/UserMenu.php" class="a5">�û��˵�</a> 
                <font color="#458DE4">&gt;</font><a href="/PersonalVPN/AddMoney.php" class="a5">�û���Ǯ</a>
				<br>
                <br>
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
������<A HREF="index.php">��½</a>��
<?
}else {
?>
<script language="javascript">
<!--
function AddMoney(){
	if (document.all.oOperTime.value=="") {
		alert("�����������˵�ʱ��");
		document.all.oOperTime.focus();
		return ;
	}
	if (document.all.oMoney.value=="") {
		alert("�����������˵Ľ��");
		document.all.oMoney.focus();
		return ;
	}
	if (document.all.oOperNumber.value=="") {
		alert("�����������˵Ĳ�����ˮ��");
		document.all.oOperNumber.focus();
		return ;
	}

	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_OperTime(){
	if ( IsEnter() ) {
		document.all.oMoney.focus();
	}
}
function testKey_Money(){
	if ( IsEnter() ) {
		document.all.oOperNumber.focus();
	}
}
function testKey_OperNumber(){

	if ( IsEnter() ) {
		document.all.oAddMoney.click();
	}
}
-->
</script>
<form id="mainForm" method="POST" action="DoAddMoney.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>�û��ʺţ�</td>
      <td><? echo $HTTP_SESSION_VARS['UserID']; ?></td>
    </tr>
    <tr>
      <td>����ʱ�䣺</td>
      <td><input type="textfield" id="oOperTime" name="OperTime" size="20" onkeypress="testKey_OperTime();" ></td>
    </tr>
    <tr>
      <td>���˽�</td>
      <td><input type="textfield" id="oMoney" name="Money" size="20" onkeypress="testKey_Money();" ></td>
    </tr>
    <tr>
      <td>��ע�����˲�����ˮ�ţ���</td>
      <td><input type="textfield" id="oOperNumber" name="OperNumber" size="20" onkeypress="testKey_OperNumber();" ></td>
    </tr>

</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddMoney" value="�ύ��Ǯ��Ϣ" onclick="AddMoney();"> 
   </p>
</form>

<?
}
?>
</td></tr></table>
<br>
</td></tr></table>
<?
require_once ("footer.inc.php");
?>
