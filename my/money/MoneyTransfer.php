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
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="/my/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
                </font><a href="/my/money/TransferMoney.php" class="a5">转帐</a>
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
您尚未登陆。<br>
请首先<A HREF="/my/" class=a5>登陆</a>。
<?
}else {
?>
<script language="javascript">
<!--
function TransferMoney(){
	if (document.all.oTransferTarget.value=="") {
		alert("请输入您划账对象的ID");
		document.all.oTransferTarget.focus();
		return ;
	}
	if (document.all.oTransferTargetName.value=="") {
		alert("请输入您划账对象的真实姓名");
		document.all.oTransferTargetName.focus();
		return ;
	}
	if (document.all.oMoney.value=="") {
		alert("请输入您划账的金额");
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
      <td>用户帐号：</td>
      <td><? echo $HTTP_SESSION_VARS['UserID']; ?></td>
    </tr>
    <tr>
      <td>划账对象账号：</td>
      <td><input type="textfield" id="oTransferTarget" name="TransferTarget" size="20" onkeypress="testKey_TransferTarget();" ></td>
    </tr>
    <tr>
      <td>划账对象真实姓名：</td>
      <td><input type="textfield" id="oTransferTargetName" name="TransferTargetName" size="20" onkeypress="testKey_TransferTargetName();" ></td>
    </tr>
    <tr>
      <td>划账金额：</td>
      <td><input type="textfield" id="oMoney" name="Money" size="20" onkeypress="testKey_Money();" ></td>
    </tr>
    <tr>
      <td>货币种类</td>
      <td><select name="Currency" id="oCurrenect" size="1">
	<option selected value="RMB">人民币</option>
	<option value="USD">美元</option>
	</select>
	</td>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oTransferMoney" value="确定划账" onclick="TransferMoney();"> 
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
