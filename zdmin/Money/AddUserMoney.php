<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

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
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Money/AddUserMoney.php" class="a5">���û���Ǯ</a>
				<br>
                <br>
                <span class="newstitle">���û���Ǯ</span></p>
              <p>�������û���Ǯ</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php" class="a6">��½</a>��
<?
}else {

if ( (!isset($_SESSION['MoneyAdmin'])) ) {
?>
��û�и������û���Ǯ��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a6">����˵�</a>
<?
} else {
?>
<script language="javascript">
<!--
function AddUserMoney(){
	if (document.all.oUserID.value=="") {
		alert("�������Ǯ�����û���ID");
		document.all.oUserID.focus();
		return ;
	}
	if (document.all.oAddMoneyAmount.value=="") {
		alert("�������Ǯ������");
		document.all.oAddMoneyAmount.focus();
		return ;
	}
	if (document.all.oAddMoneyReason.value=="") {
		alert("�������Ǯ������");
		document.all.oAddMoneyReason.focus();
		return ;
	}	
	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_UserID(){

	if ( IsEnter() ) {
		document.all.oAddMoneyAmount.focus();
	}
}
function testKey_AddMoneyAmount(){

	if ( IsEnter() ) {
		document.all.oAddMoneyReason.focus();
	}
}

-->
</script>
<form id="mainForm" method="Post" action="DoAddUserMoney.php">
                      <br>
  <div align="center"><table border="0">
    <tr>
      <td>�û�ID</td>
      <td><input type="textfield" id="oUserID" name="UserID" size="20" onkeypress="return testKey_UserID();" ></td>
    </tr>
    <tr>
      <td>��Ǯ����</td>
      <td><input type="textfield" id="oAddMoneyAmount" name="Amount" size="20" onkeypress="return testKey_AddMoneyAmount();" ></td>
    </tr>
    <tr>
      <td>��Ǯ����</td>
      <td><TEXTAREA id="oAddMoneyReason" name="Reason" ></textarea>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddUserMoney" value="���û���Ǯ" onclick="AddUserMoney();"> 
   </p>
</form>

<?
}
}
?>
</td></tr></table>

<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
