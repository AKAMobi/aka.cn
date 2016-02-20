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
                </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ApproveUser.php" class="a5">审批用户</a>
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

// Roy ,为清风小木虫
$result=mysql_query("select AutoID from User_TB where ID='emuch'");
if ( ! ($row=mysql_fetch_array($result))) {
?>
	错误!找不到李国德同学的账号!
<?
	exit(0);
} else {
	$SuperUserID=$row['AutoID'];
}
// ---- end




$result=mysql_query("select ID,AutoID,SuperiorUserAutoID from User_TB where Status='ProfileNotProved'", $conn);
 
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
				if ($row['SuperiorUserAutoID']==$SuperUserID) { //李国德同学的用户

					if (!mysql_query("update User_TB set Status='Normal',UserFunc='PersonalHourVPN' where AutoID='{$row['AutoID']}'", $conn)) {
						echo "用户{$row[0]}状态修改失败";
						mysql_query("rollback",$conn);
						continue;
					}
					mysql_query("insert into UserAccount_TB(UserAutoID, UserAccount,AccountEnable) values ({$row['AutoID']},1,'Y')", $conn);
				} else {
				if (!mysql_query("update User_TB set Status='Normal' where AutoID='{$row['AutoID']}'", $conn)) {
					echo "用户{$row[0]}状态修改失败";
					mysql_query("rollback",$conn);
					continue;
				}
				
				// by zixia: 增加双币种支持
				if (!mysql_query("insert into UserAccount_TB(UserAutoID, UserAccount,UserAccountUSD,AccountEnable) values ({$row['AutoID']},0,0,'N')", $conn)) {
//					echo "用户{$row['ID']}账户建立失败";
// by zixia for 2002.11.1 用户从新注册					mysql_query("rollback",$conn);
// 同上					continue;
				}
				}
				if (!mysql_query("insert into UserActive_TB(UserAutoID,LastActiveTime) values ({$row['AutoID']},now())", $conn)) {
// by zixia for 11.1					echo "用户{$row['ID']}活动记录建立失败";
// 同上					mysql_query("rollback",$conn);
// 同上					continue;
				}
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  通过了　{$row['ID']} 的注册申请', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
				
				mysql_query("commit",$conn);
				continue;
			}
			if ($_REQUEST[$UserID]=="Deny") {
				mysql_query("begin",$conn);
				mysql_query("update User_TB set Status='RegisterFailed' where ID='{$row[0]}'", $conn);
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  拒绝了　{$row['ID']} 的注册申请', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
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

