<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ModifyProfile.php" class="a5">修改用户信息</a><br>
          <br>
          <span class="newstitle">修改用户信息</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">


<?

if ( (!isset($_SESSION['AdminID']))  || (!isset($_REQUEST['ID']))   ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登录</a>。
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
你没有修改用户信息的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {
	
if ( (!isset($_REQUEST['ID'])) || 
	(!isset($_REQUEST['UserName'])) ||
	(!isset($_REQUEST['Password'])) ||
	(!isset($_REQUEST['IdNum'])) ||
	(!isset($_REQUEST['Company'])) ||
	(!isset($_REQUEST['Tel'])) ||
	(!isset($_REQUEST['Mobile'])) ||
	(!isset($_REQUEST['EMail'])) ||
	(!isset($_REQUEST['Address'])) ||
	(!isset($_REQUEST['ZipCode'])) ){

?>
	提交的信息不全<br>
	请返回重试。<br><input type="button" onclick="history.back();" value="返回">
<?
} else {
$UserID=$_REQUEST['ID'];
	
require_once("{$ADMINROOT}/Include/InitDB.php"); 
	

$result=mysql_query("select * from User_TB where ID='{$UserID}'");

if (!($row=mysql_fetch_array($result))){//此ID不存在

?>

此ID不存在！<BR>
请返回重试。<br><input type="button" onclick="history.back();" value="返回">

	<br>
	<br>
<?
} else{

$query=array();
$query[]="begin";
$sql="Update User_TB Set UserName='{$_REQUEST['UserName']}'," .
  "IdentifierNum='{$_REQUEST['IdNum']}',Company='{$_REQUEST['Company']}',".
  "TelephoneNumber='{$_REQUEST['Tel']}',MobilePhone='{$_REQUEST['Mobile']}'," .
  "EMail='{$_REQUEST['EMail']}',Address='{$_REQUEST['Address']}',ZipCode='{$_REQUEST['ZipCode']}' ";
if ($_REQUEST['Password']!='') {
	$sql = $sql . " , Password='{$_REQUEST['Password']} ' ";
}
$query[]= $sql .  "where ID='{$UserID}'";
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		break;
	}
}
if (!$success){
?>
用户信息修改失败。<BR>
重新尝试提交。如果问题依旧，请直接与管理员联系。<br>
<?
} else {
?>
用户信息已成功修改。<BR>
<?
}
}
}
}
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
