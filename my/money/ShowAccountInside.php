<? session_set_cookie_params( time()+60*60*24*365, "/", "aka.cn" ); ?>
<? session_start(); ?>
<html>
<head>
<title>Welcome - 阿卡信息技术有限公司</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="/css/aka.css" type="text/css">
</head>
<body>
<?
if ( (!isset($HTTP_SESSION_VARS['UserID'])) ){
?>
您尚未登陆。<br>
请首先<A HREF="/my/">登陆</a>。
<?
}else {
require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select DATE_FORMAT(A.OperateTime,'%Y-%m-%d %H:%i') as OperateTime, A.Incoming as Incoming , A.Outcoming as Outcoming , A.balance as balance, A.Notes as Notes, A.Currency as Currency from UserAccountLog_TB as A, User_TB as B where A.UserAutoID=B.AutoID and B.ID='{$HTTP_SESSION_VARS['UserID']}' and  To_Days(DATE_ADD(A.OperateTime,INTERVAL 2 Month))>=To_Days(Now()) order by OperateTime desc, A.AutoID desc");
if ( mysql_num_rows($result)!=0) {
?>
<table width=500 id="oTable" style="position:absolute;top:0px; left:20px">
<tbody>
<?
	while($row=mysql_fetch_array($result)){
		if ((floatval($row['Incoming'])!=0) || (floatval($row['Outcoming'])!=0) ){
			if ( 'RMB'==$row['Currency'] ){
				$currency = "￥";
			}else if ( 'USD'==$row['Currency'] ){
				$currency = '$';
			}else{
				$currency = "系统错误，请报告系统管理员";
			}
?>
<tr>
	<td width="90">
	<? echo $row['OperateTime'] ?>
	</td>
	<td align="right" width="55">
	<? echo ((floatval($row['Incoming'])!=0)? ($currency . $row['Incoming']):"") ; ?>
	</td >
	<td align="right" width="55"><font color="#ff0000">
	<? echo ((floatval($row['Outcoming'])!=0)?($currency . $row['Outcoming']):"") ; ?>
	</font>
	</td>
	<td align="right" width="50">
	<? echo $currency . $row['balance'] ?>
	</td>
	<td>
	<? echo $row['Notes'] ?>
	</td>
</tr>
<?
		}
	}
?>
</tbody>
</table>

<?
}else {
?>
	目前您的账户尚未有资金流动纪录<br>
<?
}
}


?>
</body>
</html>
