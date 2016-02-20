<?
/*
输入参数:
UserID 用户ID

返回：
用户未读的最新消息
*/

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$UserID=$_REQUEST['UserID'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $UserID ) ){
	echo "时间：秦朝 \n最新新闻：一个青蛙一张嘴，两只眼睛四条腿";
	exit;
}

$result=mysql_query("select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID='" . $UserID . "'");

if (!($row=mysql_fetch_array($result))){//此ID不存在
	echo "时间：秦朝 \n最新新闻：两个青蛙两张嘴，四只眼睛八条腿";
	exit;
}

$lastreadtime = $row["LastLoginTime"];

$sql="select B.PostDate from News_TB A, PersonalVPN_ClientNews_TB B where B.PostDate>'" . $lastreadtime . "' and A.AutoID=B.NewsID";

$result=mysql_query($sql);
if (mysql_num_rows($result) >0) {
	echo  "有新闻\n";
	echo  "由新闻\n";
	echo  "有新闻\n";
}


mysql_close( $conn );
?>
