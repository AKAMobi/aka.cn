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
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a> 
                <font color="#458DE4">&gt;</font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/FindUser.php" class="a5">查找用户</a>
				<br>
                <br>
                <span class="newstitle">查找用户</span></p>
              
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
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
你没有用户帐户管理的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {


?>
<script language="javascript">
<!--
function FindUser(){
	if (document.all.oUserID.value=="") {
		alert("请输入待查找用户的ID");
		document.all.oUserID.focus();
		return ;
	}
	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_UserID(){

	if ( IsEnter() ) {
		document.all.oFindUser.click();
	}
}
-->
</script>
<form id="mainForm" method="get" action="ViewUserProfile.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>用户ID</td>
      <td><input type="textfield" id="oUserID" name="ID" size="20" onkeypress="testKey_UserID();" ></td>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oFindUser" value="查找用户" onclick="FindUser();"> 
   </p>
</form>

<?
}
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>

