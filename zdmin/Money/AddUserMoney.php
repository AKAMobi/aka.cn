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
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Money/AddUserMoney.php" class="a5">给用户加钱</a>
				<br>
                <br>
                <span class="newstitle">给用户加钱</span></p>
              <p>给单个用户加钱</p>
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
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php" class="a6">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['MoneyAdmin'])) ) {
?>
你没有给其他用户加钱的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a6">管理菜单</a>
<?
} else {
?>
<script language="javascript">
<!--
function AddUserMoney(){
	if (document.all.oUserID.value=="") {
		alert("请输入加钱对象用户的ID");
		document.all.oUserID.focus();
		return ;
	}
	if (document.all.oAddMoneyAmount.value=="") {
		alert("请输入加钱的数额");
		document.all.oAddMoneyAmount.focus();
		return ;
	}
	if (document.all.oAddMoneyReason.value=="") {
		alert("请输入加钱的理由");
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
      <td>用户ID</td>
      <td><input type="textfield" id="oUserID" name="UserID" size="20" onkeypress="return testKey_UserID();" ></td>
    </tr>
    <tr>
      <td>加钱数额</td>
      <td><input type="textfield" id="oAddMoneyAmount" name="Amount" size="20" onkeypress="return testKey_AddMoneyAmount();" ></td>
    </tr>
    <tr>
      <td>加钱理由</td>
      <td><TEXTAREA id="oAddMoneyReason" name="Reason" ></textarea>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oAddUserMoney" value="给用户加钱" onclick="AddUserMoney();"> 
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
