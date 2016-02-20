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
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="/PersonalVPN/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
                </font><a href="/PersonalVPN/UserMenu.php" class="a5">用户菜单</a> 
                <font color="#458DE4">&gt;</font><a href="/PersonalVPN/AddMoney.php" class="a5">用户加钱</a>
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
您尚未登陆。<br>
请首先<A HREF="index.php">登陆</a>。
<?
}else {
?>
<script language="javascript">
<!--
function AddMoney(){
	if (document.all.oOperTime.value=="") {
		alert("请输入您划账的时间");
		document.all.oOperTime.focus();
		return ;
	}
	if (document.all.oMoney.value=="") {
		alert("请输入您划账的金额");
		document.all.oMoney.focus();
		return ;
	}
	if (document.all.oOperNumber.value=="") {
		alert("请输入您划账的操作流水号");
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
      <td>用户帐号：</td>
      <td><? echo $HTTP_SESSION_VARS['UserID']; ?></td>
    </tr>
    <tr>
      <td>划账时间：</td>
      <td><input type="textfield" id="oOperTime" name="OperTime" size="20" onkeypress="testKey_OperTime();" ></td>
    </tr>
    <tr>
      <td>划账金额：</td>
      <td><input type="textfield" id="oMoney" name="Money" size="20" onkeypress="testKey_Money();" ></td>
    </tr>
    <tr>
      <td>备注（划账操作流水号）：</td>
      <td><input type="textfield" id="oOperNumber" name="OperNumber" size="20" onkeypress="testKey_OperNumber();" ></td>
    </tr>

</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddMoney" value="提交加钱信息" onclick="AddMoney();"> 
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
