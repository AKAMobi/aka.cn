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
5001		回国VPN功能未打开
5002		出国VPN功能未打开		
6001		包月回国VPN，被停用
6002		包月出国VPN，被停用
7001		计时回国VPN，费用不足
7002		计时出国VPN，费用不足

9999		一切正常,可以连接

第二-倒数第二行
VPN服务器IP list

最后一行
1111	结束
*/

define( "APCLASTVERSIONA", 3 );
define( "APCLASTVERSIONB", 0 );
define( "APCOUT", 0 );
define( "APCBACK", 1 );

$ID=$HTTP_GET_VARS['UserID'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $ID ) ){
	echo "2000\n192.168.0.1\n1111\n0\n";
	exit;
}

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$APCVERSIONA=$HTTP_GET_VARS['APCVERSIONA'] ;
$APCVERSIONB=$HTTP_GET_VARS['APCVERSIONB'] ;
$APCTYPE=$HTTP_GET_VARS['APCTYPE'] ;

$result=mysql_query("select A.password as Password,A.Status as Status ,A.UserFunc as UserFunc ,A.UserFuncStatus as UserFuncStatus , B.UserAccount as UserAccount ,C.Fee as Fee,C.CutOff as CutOff from User_TB as A, UserAccount_TB as B,PersonalVPN_Fee_TB as C where A.ID='{$ID}' and A.AutoID=B.UserAutoID and C.FeeType='PerHour'");

print_r($row);

if ( ! (is_numeric($APCVERSIONA) && is_numeric($APCVERSIONB)) ){
	//版本号不是数字？
	echo "999\n";
}elseif( $APCVERSIONA < APCLASTVERSIONA ){ 
	//客户端版本太低，必需要升级
	echo "1000\n";
    if ( ($APCVERSIONA <3) && ($APCVERSIONB <3)){
        echo "192.168.0.1\n";
        echo "1111\n";
        die();
    }
} else if ( $APCVERSIONB < APCLASTVERSIONB ){
	//客户端不是最新，但仍然可以继续使用
	echo "1001\n";
} else if ( !($row=mysql_fetch_array($result)) ){ //无此用户
	echo "2000\n";
} else if (strcmp($HTTP_GET_VARS['Password'],$row["Password"])){ //密码错误
	echo "3000\n";
} else if (strcmp($row['Status'],"Normal")){ //
	echo "4000\n";
} else {
	if( $APCTYPE==APCBACK ){ //回国
		if ((!strstr($row['UserFunc'],"BackVPNPersonal")) && (!strstr($row['UserFunc'],"BackHourVPNPersonal"))) {
			echo "5001\n";
		} else if (  (strstr($row['UserFunc'],"BackVPNPersonal")) && (!strstr($row['UserFuncStatus'],"BackVPNPersonal")) ) {
			echo "6001\n";
		} else if (floatval($row['UserAccount']<0)){
			echo "7001\n";
		} else {
			echo "9999\n";
		}		
	}else{	//出国
		if ((!strstr($row['UserFunc'],"PersonalVPN")) && (!strstr($row['UserFunc'],"PersonalHourVPN"))) {
			echo "5002\n";
		} else if (  (strstr($row['UserFunc'],"PersonalVPN")) && (!strstr($row['UserFuncStatus'],"PersonalVPN")) ) {
			echo "6002\n";
		} else if (floatval($row['UserAccount']<0)){
			echo "7002\n";
		} else {
			echo "9999\n";
		}
	}	
}

if ( "aka_test_1" == $ID || "aka_test_2" == $ID ){
	echo "211.157.100.10\n";
}else{
	if( $APCTYPE==APCBACK ){ //回国
			echo "211.157.100.8\n";

	}else{	//出国
			echo "202.205.10.7\n";

	}
}

//检查新闻状态

$sql="select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID='" . $ID . "'";

$result=mysql_query($sql);

$row=mysql_fetch_array($result);

$lastreadtime = $row["LastLoginTime"];

$sql="select B.PostDate from News_TB A, PersonalVPN_ClientNews_TB B where B.PostDate>'" . $lastreadtime . "' and A.AutoID=B.NewsID";

$result=mysql_query($sql);
if (mysql_num_rows($result) >0) {  //有新闻
	echo "1\n";
} else {		//无新闻
	echo "0\n";
}

	mysql_free_result( $result );
	//mysql_query( "select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID=" . $ . 
	echo "1111";
?>
