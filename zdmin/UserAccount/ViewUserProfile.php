<? session_start(); ?>
<? 
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<object id=oClose type="application/x-oleobject"
classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11">
<param name="Command" value="Close"></object>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/FindUser.php" class="a5">查找用户</a><br>
          <br>
          <span class="newstitle">用户信息</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))  || (!isset($HTTP_GET_VARS['ID']))   ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登录</a>。
<?
}else {

if ( (!isset($_SESSION['PersonalVPNAdmin'])) && (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
你没有察看用户信息的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {


require "{$ADMINROOT}/Include/InitDB.php"; 

$result=mysql_query("select * from User_TB where ID='{$_REQUEST['ID']}'"); 
if ( !($row=mysql_fetch_array($result)) ){ //无此用户
?>
	无此用户。请检查输入的用户ID是否正确。
	<a onclick="history.back();">返回</a>
<?
} else {
?>
<table>
<tr>
<td>用户ID</td><td><? echo $row['ID'] ?></td>
</tr>
<tr>
<td>姓名</td><td><? echo $row['UserName'] ?></td>
</tr>
<tr>
<td>身份证号</td><td><? echo $row['IdentifierNum']?></td>
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
<td>邮编</td><td><? echo $row['ZipCode']?></td>
</tr>
<tr>
<td>状态</td><td><? echo $row['Status']?></td>
</tr>
<tr>
<td>使用的功能</td><td><? echo (($row['UserFunc']=="")?"无":$row['UserFunc']) ?></td>
</tr>
<tr>
<td>使用功能的状态</td><td><? echo (($row['UserFunc']=="")?"无":$row['UserFunc']) ?></td>
</tr>

</table>
<br>
<?
if ( (isset($_SESSION['UserAccountAdmin'])) )  {
$_SESSION['UserID']=$_REQUEST['ID'];
?>
<input type="button" value="以该用户的身份登录" onclick="window.open('/my/');">
<br><br>
<input type="button" value="修改该用户信息" onclick="document.location.href='ModifyProfile.php?ID=<? echo $_REQUEST['ID']; ?>';">
<br><br>
<?
}
?>

<input type="button" value="关闭窗口" onclick="oClose.Click();">
<br>
<?
}
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
