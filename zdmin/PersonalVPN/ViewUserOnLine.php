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
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewUserOnLine.php" class="a5">察看在线用户</a>
				<br>
                <br>
                <span class="newstitle">在线用户列表</span></p>
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
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['PersonalVPNAdmin'])) ) {
?>
你没有PersonalVPN管理的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">管理菜单</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
if ( $_POST["CleanDB"] ){
	mysql_query("delete from PersonalVPN_UserOnLine_TB");
}
$result=mysql_query("select DATE_FORMAT(A.LogOnTime,'%Y-%m-%d %H:%i:%s') as LogOnTime, B.ID as ID, B.UserName as UserName, B.Company as Company, B.TelephoneNumber as TelephoneNumber, B.MobilePhone as MobilePhone, B.EMail as EMail, B.Address as Address , B.Status as Status , B.UserFunc as UserFunc , B.UserFuncStatus as UserFuncStatus, B.AutoID as AutoID from PersonalVPN_UserOnLine_TB as A, User_TB as B where A.UserAutoID=B.AutoID order by B.ID", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
无待在线用户。<br>
<?
} else {
?>
目前共有<font color="#ff3247"><?echo mysql_num_rows($result) ?></font>名用户在线.<br>
<div align="center">
<table border="yes" >
		<tr>
		<td align="center">账号</td>
		<td align="center">姓名</td>
		<td align="center">上线时间</td>
		<td align="center">VPN类型</td>
		<td align="center">详细资料</td>
		</tr>
<?
	while($row=mysql_fetch_array($result)){
?>

		<tr>
		<td><? echo $row['ID'] ?> </td>
		<td><? echo $row['UserName'] ?> </td>
		<td><? echo $row['LogOnTime'] ?> </td>
		<td><? echo $row['UserFunc'] ?> </td>
		<td ><a href="<? echo $ADMINURLROOT; ?>/UserAccount/ViewUserProfile.php?ID=<? echo $row['ID'] ?>"  target="_blank"><span id="o<? echo $row['AutoID'] ?>" class="a6">察看</span></a>
<? 
/*
<!---------------------------------------------------------------------------->
<!-- TOOLTIP (Use conditional comments to hide from non-behavior browsers) --->
<!---------------------------------------------------------------------------->

<!--[if gte IE 5]><tool:tip element="o<? echo $row[1] ?>" avoidmouse="false" style="width:310px;visibility: hidden">
<table>
<tr >
<td width="30%">用户ID</td><td><? echo $row[1] ?></td>
</tr>
<tr>
<td>姓名</td><td><? echo $row['UserName'] ?></td>
</tr>
<tr>
<td>工作单位</td><td><? echo $row['Company']?></td>
</tr>
<tr>
<td>电话</td><td><? echo $row['TelephoneNumber']?></td>
</tr>
<tr>
<td>手机</td><td><? echo $row['MobilePhone']?></td>
</tr>
<tr>
<td>E-Mail</td><td><? echo $row['EMail']?></td>
</tr>
<tr>
<td>地址</td><td><? echo $row['Address']?></td>
</tr>
<tr>
<td>状态</td><td><? echo $row['Status']?></td>
</tr>
<tr>
<td>使用的功能</td><td><? echo (($row['UserFunc']=="")?"无":$row['UserFunc']) ?></td>
</tr>
<tr>
<td>使用功能的状态</td><td><? echo (($row['UserFuncStatus']=="")?"无":$row['UserFuncStatus']) ?></td>
</tr>
</table>
</tool:tip><![endif]-->
*/
?>
</tr>

<?
	}
?>
</table>

</div>
<?
}
}
}
?>
</td></tr></table>
<br>
<center><form method=post><input type=submit value="清空记录" name="CleanDB"></form></center>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
