<?
/*
�������:
�û���
����
��ǰ���汾	APCVERSIONA
��ǰ���汾	APCVERSIONB
����/�ع�	APCTYPE={0:������1:�ع�};

��һ��
ErrorCode:
999		�汾���д�
1000		��������client
1001		Ӧ������client
2000		û������û�;
3000		�������
4000		�û��ʻ�δͨ����ʽע���ͣ��
5001		�ع�VPN����δ��
5002		����VPN����δ��		
6001		���»ع�VPN����ͣ��
6002		���³���VPN����ͣ��
7001		��ʱ�ع�VPN�����ò���
7002		��ʱ����VPN�����ò���

9999		һ������,��������

�ڶ�-�����ڶ���
VPN������IP list

���һ��
1111	����
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
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$APCVERSIONA=$HTTP_GET_VARS['APCVERSIONA'] ;
$APCVERSIONB=$HTTP_GET_VARS['APCVERSIONB'] ;
$APCTYPE=$HTTP_GET_VARS['APCTYPE'] ;

$result=mysql_query("select A.password as Password,A.Status as Status ,A.UserFunc as UserFunc ,A.UserFuncStatus as UserFuncStatus , B.UserAccount as UserAccount ,C.Fee as Fee,C.CutOff as CutOff from User_TB as A, UserAccount_TB as B,PersonalVPN_Fee_TB as C where A.ID='{$ID}' and A.AutoID=B.UserAutoID and C.FeeType='PerHour'");

print_r($row);

if ( ! (is_numeric($APCVERSIONA) && is_numeric($APCVERSIONB)) ){
	//�汾�Ų������֣�
	echo "999\n";
}elseif( $APCVERSIONA < APCLASTVERSIONA ){ 
	//�ͻ��˰汾̫�ͣ�����Ҫ����
	echo "1000\n";
    if ( ($APCVERSIONA <3) && ($APCVERSIONB <3)){
        echo "192.168.0.1\n";
        echo "1111\n";
        die();
    }
} else if ( $APCVERSIONB < APCLASTVERSIONB ){
	//�ͻ��˲������£�����Ȼ���Լ���ʹ��
	echo "1001\n";
} else if ( !($row=mysql_fetch_array($result)) ){ //�޴��û�
	echo "2000\n";
} else if (strcmp($HTTP_GET_VARS['Password'],$row["Password"])){ //�������
	echo "3000\n";
} else if (strcmp($row['Status'],"Normal")){ //
	echo "4000\n";
} else {
	if( $APCTYPE==APCBACK ){ //�ع�
		if ((!strstr($row['UserFunc'],"BackVPNPersonal")) && (!strstr($row['UserFunc'],"BackHourVPNPersonal"))) {
			echo "5001\n";
		} else if (  (strstr($row['UserFunc'],"BackVPNPersonal")) && (!strstr($row['UserFuncStatus'],"BackVPNPersonal")) ) {
			echo "6001\n";
		} else if (floatval($row['UserAccount']<0)){
			echo "7001\n";
		} else {
			echo "9999\n";
		}		
	}else{	//����
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
	if( $APCTYPE==APCBACK ){ //�ع�
			echo "211.157.100.8\n";

	}else{	//����
			echo "202.205.10.7\n";

	}
}

//�������״̬

$sql="select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID='" . $ID . "'";

$result=mysql_query($sql);

$row=mysql_fetch_array($result);

$lastreadtime = $row["LastLoginTime"];

$sql="select B.PostDate from News_TB A, PersonalVPN_ClientNews_TB B where B.PostDate>'" . $lastreadtime . "' and A.AutoID=B.NewsID";

$result=mysql_query($sql);
if (mysql_num_rows($result) >0) {  //������
	echo "1\n";
} else {		//������
	echo "0\n";
}

	mysql_free_result( $result );
	//mysql_query( "select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID=" . $ . 
	echo "1111";
?>
