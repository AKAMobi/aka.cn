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
                </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ApproveUserValidate.php" class="a5">审批手机认证用户</a>
				<br>
                <br>
                <span class="newstitle">审批用户注册单</span></p>
              <p>&nbsp;</p>
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
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
你没有用户帐户管理的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select A.AutoID,A.ID,A.UserName,A.TelephoneNumber,A.MobilePhone from User_TB as A, UserValidate_TB as B  where B.validated='Y' and A.AutoID=B.UserAutoID", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
无待审批用户。<br>
<?
} else {
?>
<div align="center">
<form name="RegisterForm" method="post" action="DoApproveUserValidate.php">
<table border="yes" >
		<tr>
		<td align="center">账号</td>
		<td align="center">姓名</td>
		<td align="center">电话号码</td>
		<td align="center">手机号码</td>
		<td align="center">详细资料</td>
		<td align="center">通过注册</td>
		<td align="center">拒绝注册</td>
		</tr>
<?
	while($row=mysql_fetch_array($result)){
?>

		<tr>
		<td><? echo $row['ID'] ?> </td>
		<td><? echo $row['UserName'] ?> </td>
		<td><? echo $row['TelephoneNumber'] ?> </td>
		<td><? echo $row['MobilePhone'] ?> </td>
		<td><a href="ViewUserProfile.php?ID=<? echo $row['ID'] ?>"  class=a6 target="_blank">察看</a></td>
		<input type="hidden" ID="oUser<?echo $row['AutoID']?>" name="User<? echo $row['AutoID']?>" value="none">
		<td><INPUT TYPE="checkbox" ID="oAgree<?echo $row['AutoID']?>" onclick="oDisAgree<? echo $row['AutoID']?>.checked=false;oUser<?echo $row['AutoID']?>.value=oAgree<?echo $row['AutoID']?>.checked?'Approve':'none';"></td>
		<td><INPUT TYPE="checkbox" ID="oDisAgree<? echo $row['AutoID']?>" onclick="oAgree<? echo $row['AutoID']?>.checked=false;oUser<?echo $row['AutoID']?>.value=oDisAgree<? echo $row['AutoID']?>.checked?'Deny':'none';"></td>
		
		</tr>
<?
	}
?>
</table>
<br>
	<input type="submit" value="提交">
<br>
</form>
</div>
<?
}
}
}
?>
</td></tr></table>

<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>

