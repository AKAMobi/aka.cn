<?
/*
�������:
UserID �û�ID

���أ�
�û�δ����������Ϣ
*/

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$UserID=$_REQUEST['UserID'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $UserID ) ){
	echo "ʱ�䣺�س� \n�������ţ�һ������һ���죬��ֻ�۾�������";
	exit;
}

$result=mysql_query("select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID='" . $UserID . "'");

if (!($row=mysql_fetch_array($result))){//��ID������
	echo "ʱ�䣺�س� \n�������ţ��������������죬��ֻ�۾�������";
	exit;
}

$lastreadtime = $row["LastLoginTime"];

$sql="select B.PostDate from News_TB A, PersonalVPN_ClientNews_TB B where B.PostDate>'" . $lastreadtime . "' and A.AutoID=B.NewsID";

$result=mysql_query($sql);
if (mysql_num_rows($result) >0) {
	echo  "������\n";
	echo  "������\n";
	echo  "������\n";
}


mysql_close( $conn );
?>
