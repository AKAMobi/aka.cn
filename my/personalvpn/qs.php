<?
/*
输入参数:
用户名
密码
当前主版本	APCVERSIONA
当前副版本	APCVERSIONB
出国/回国	APCTYPE={0:出国，1:回国};

第一行
ErrorCode:
999		版本号有错
1000		必须升级client
1001		应该升级client
2000		没有这个用户;
3000		密码错误
4000		用户帐户未通过正式注册或被停用
5000		VPN功能未打开		
6000		包月VPN，被停用
7000		计时VPN，费用不足
9999		一切正常,可以连接

第二-倒数第二行
VPN服务器IP list

最后一行
1111	结束
*/

define( "APCLASTVERSIONA", 2 );
define( "APCLASTVERSIONB", 1 );
define( "APCOUT", 0 );
define( "APCBACK", 1 );

$ID=$HTTP_GET_VARS['UserID'] ;
if( !eregi( "^[a-z][_0-9a-z\.]*$", $ID ) ){
	echo "时间：秦朝 \n最新新闻：一个青蛙一张嘴，两只眼睛四条腿";
	exit;
}

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$result=mysql_query("select A.password as Password,A.Status as Status ,A.UserFunc as UserFunc ,A.UserFuncStatus as UserFuncStatus , B.UserAccount as UserAccount ,C.Fee as Fee,C.CutOff as CutOff from User_TB as A, UserAccount_TB as B,PersonalVPN_Fee_TB as C where A.ID='{$ID}' and A.AutoID=B.UserAutoID and C.FeeType='PerHour'");

$APCVERSIONA=$HTTP_GET_VARS['APCVERSIONA'] ;
$APCVERSIONB=$HTTP_GET_VARS['APCVERSIONB'] ;
$APCTYPE=$HTTP_GET_VARS['APCTYPE'] ;

if ( ! (is_numeric($APCVERSIONA) && is_numeric($APCVERSIONB)) ){
	//版本号不是数字？
	echo "999\n";
echo $APCVERSIONA . "\n";
echo $APCVERSIONB . "\n";
}elseif( $APCVERSIONA < APCLASTVERSIONA ){ 
	//客户端版本太低，必需要升级
	echo "1000\n";
} else if ( $APCVERSIONB < APCLASTVERSIONB ){
	//客户端不是最新，但仍然可以继续使用
	echo "1001\n";
} else if ( !($row=mysql_fetch_array($result)) ){ //无此用户
	echo "2000\n";
} else if (strcmp($HTTP_GET_VARS['Password'],$row["Password"])){ //密码错误
	echo "3000\n";
} else if (strcmp($row['Status'],"Normal")){ //
	echo "4000\n";
} else if (!strstr($row['UserFunc'],"VPN")){ //
	echo "5000\n";
} else if (  (strstr($row['UserFunc'],"PersonalVPN")) && (!strstr($row['UserFuncStatus'],"PersonalVPN")) ){
	echo "6000\n";
} else if (floatval($row['UserAccount']<0)){
	echo "7000\n";
} else {
	echo "9999\n";
}

if( $APCTYPE==APCBACK ){
	echo "211.157.100.8\n";
}else{
	echo "202.205.10.7\n";
}
	mysql_free_result( $result );
	//mysql_query( "select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID=" . $ . 
	echo "1111";
?>
