<?
/*
�������:
ID �û�ID

���أ�
�û��ͻ��������ʾ��Ϣ
*/

require( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db('AKA',$conn) or die( "2000\n" );

$UserID=$HTTP_GET_VARS['UserID'] ;
$Password=$HTTP_GET_VARS['Password'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $UserID ) ){
	echo "һ������һ���죬��ֻ�۾�������";
	exit;
}

/*
 * ��ʱ���VPN����ҪUserFuncStatus��Ч��������Ҫ���UserFunc
 */
$result=mysql_query("select u.UserFunc, u.UserFuncStatus, ua.UserAccount from User_TB u, UserAccount_TB ua where u.AutoID=ua.UserAutoID and u.ID='" . $UserID . "' and u.Password='" . $Password . "'");

if (!($row=mysql_fetch_array($result))){//��ID������
	echo "�������������죬��ֻ�۾�������";
	exit;
}

$UserFuncStatus = $row["UserFuncStatus"];
$UserFunc = $row["UserFunc"];
$UserAccount = $row["UserAccount"];

$Funcs = explode( ",", $UserFuncStatus );
if( eregi( "PersonalHourVPN", $UserFunc ) ){
	array_push( $Funcs, 'PersonalHourVPN' );
}

$FuncName['PersonalVPN'] = '����VPN';
$FuncName['PersonalHourVPN'] = '��ʱVPN';
$FuncName['PersonalProxy'] = 'Proxy';

echo "���ܣ�";
$n=0;
while( $Funcs[$n] ){
	if (eregi($Funcs[$n], $UserFunc)){
		echo  $FuncName[$Funcs[$n]] . ", ";
	}
	$n++;
}
echo  "\n��" . $UserAccount . "Ԫ";

mysql_free_result( $result );

mysql_close( $conn );
?>
