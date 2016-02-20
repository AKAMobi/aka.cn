<?
/*
输入参数:
ID 用户ID

返回：
用户客户端面板显示信息
*/

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$UserID=$HTTP_GET_VARS['UserID'] ;
$Password=$HTTP_GET_VARS['Password'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $UserID ) ){
	echo "一个青蛙一张嘴，两只眼睛四条腿";
	exit;
}

/*
 * 计时版的VPN不需要UserFuncStatus有效，所以需要检查UserFunc
 */
$result=mysql_query("select u.UserFunc, u.UserFuncStatus, ua.UserAccount from User_TB u, UserAccount_TB ua where u.AutoID=ua.UserAutoID and u.ID='" . $UserID . "' and u.Password='" . $Password . "'");

if (!($row=mysql_fetch_array($result))){//此ID不存在
	echo "两个青蛙两张嘴，四只眼睛八条腿";
	exit;
}

$UserFuncStatus = $row["UserFuncStatus"];
$UserFunc = $row["UserFunc"];
$UserAccount = $row["UserAccount"];

$Funcs = explode( ",", $UserFuncStatus );
if( eregi( "PersonalHourVPN", $UserFunc ) ){
	array_push( $Funcs, 'PersonalHourVPN' );
}

$FuncName['PersonalVPN'] = '包月VPN';
$FuncName['PersonalHourVPN'] = '计时VPN';
$FuncName['PersonalProxy'] = 'Proxy';

echo "功能：";
$n=0;
while( $Funcs[$n] ){
	if (eregi($Funcs[$n], $UserFunc)){
		echo  $FuncName[$Funcs[$n]] . ", ";
	}
	$n++;
}
echo  "\n余额：" . $UserAccount . "元";

mysql_free_result( $result );

mysql_close( $conn );
?>
