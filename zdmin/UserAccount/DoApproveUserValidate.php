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
                <span class="newstitle">审批手机认证用户<span></p>
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

$result=mysql_query("select A.AutoID,A.ID,A.UserName,A.TelephoneNumber,A.MobilePhone from User_TB as A, UserValidate_TB as B where B.validated='Y' and A.AutoID=B.UserAutoID", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
无待注册用户。<br>
<?
} else {
	while($row=mysql_fetch_array($result)){
		$UserID="User{$row['AutoID']}";
		if (isset($_REQUEST[$UserID]) ){
			if ($_REQUEST[$UserID]=="Approve") {
				if (!mysql_query("begin",$conn)) 
					continue;
				if (!mysql_query("delete from UserValidate_TB where UserAutoID='{$row['AutoID']}'", $conn)) {
					echo "用户{$row['ID']}状态修改失败";
					mysql_query("rollback",$conn);
					continue;
				}
				
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  通过了　{$row['ID']} 的手机认证', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
				
				mysql_query("commit",$conn);
				continue;
			}
			if ($_REQUEST[$UserID]=="Deny") {
				mysql_query("begin",$conn);
				mysql_query("update User_TB set Status='RegisterFailed' where ID='{$row['ID']}'", $conn);
				mysql_query("delete from UserValidate_TB where UserAutoID='{$row['AutoID']}'", $conn);
				mysql_query("delete from UserAccount_TB where UserAutoID='{$row['AutoID']}'", $conn);
				mysql_query("delete from UserActive_TB where UserAutoID='{$row['AutoID']}'", $conn);
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  拒绝了　{$row['ID']} 手机认证','{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
				mysql_query("commit",$conn);
				continue;
			}
		}
	}
	
?>
	注册单处理完毕。
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

