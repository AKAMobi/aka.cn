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
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Money/AddAllUserMoney.php" class="a5">给所有用户加钱</a>
				<br>
                <br>
                <span class="newstitle">给所有用户加钱</span></p>
              <p>给所有用户加钱</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))   ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登录</a>。
<?
}else {

if ( (!isset($_SESSION['MoneyAdmin'])) ) {
?>
你没有给其他用户加钱的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {

if ((!isset($_REQUEST['AddAll'])) || (!isset($_REQUEST['Amount'])) || (!isset($_REQUEST['Reason'])) 
	|| (!isset($_REQUEST['Currency'])) ){
?>
输入参数不全，请检查您的输入。
<INPUT type="button" value="返回" onclick="history.back();">
<?
}else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$accountType="UserAccount";
$currencyType="RMB";
if ($_REQUEST['Currency']=="USD"){
	$accountType="UserAccountUSD";
	$currencyType="USD";
}

$result=mysql_query("select A.AutoID as UserAutoID ,B.{$accountType} as UserAccount,  A.ID as UserID from User_TB as A, UserAccount_TB as B where A.Status='Normal' and  A.AutoID=B.UserAutoID ");

while($row=mysql_fetch_array($result)) { //对每个用户循环

$reason=preg_replace("/,/","，",$_REQUEST['Reason']);
$query=array();
$query[]="begin";
$NewAccount=floatval($row['UserAccount'])+floatval($_REQUEST['Amount']);
$query[]="Update UserAccount_TB Set {$accountType}={$NewAccount} where UserAutoID='{$row['UserAutoID']}'";
$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason,Currency) values (NULL,{$row['UserAutoID']},now(),{$_REQUEST['Amount']},0,$NewAccount,'因为 {$reason} 给您加 {$_REQUEST['Amount']} 元','Bonus','{$currencyType}')";
$query[]="commit";

for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		mysql_query('rollback');
		break;
	}
}
}

mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 给所有用户的个人账户上加钱 {$_REQUEST['Amount']} 元 {$currencyType}，理由是：{$reason}', '{$_SERVER['REMOTE_ADDR']}','Money', NOW()) ");

mysql_close($conn);
?>

给所有用户加钱成功！

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
