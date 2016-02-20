<?
require_once( "db.inc.php" );

if ( (!isset($HTTP_POST_VARS['ID'])) || 
	(!isset($HTTP_POST_VARS['Password'])) ||
	(!isset($HTTP_POST_VARS['UserName'])) ||
	(!isset($HTTP_POST_VARS['IdNum'])) ||
	(!isset($HTTP_POST_VARS['Company'])) ||
	(!isset($HTTP_POST_VARS['Tel'])) ||
	(!isset($HTTP_POST_VARS['Mobile'])) ||
	(!isset($HTTP_POST_VARS['EMail'])) ||
	(!isset($HTTP_POST_VARS['Address'])) ||
	(!isset($HTTP_POST_VARS['ZipCode'])) ||
	(!isset($HTTP_POST_VARS['SuperiorUser'])) ||
	(!isset($HTTP_POST_VARS['SuccessAddress'])) ||
	(!isset($HTTP_POST_VARS['FailAddress'])) 
	){
?>

	缺少必要数据,请速与我方联系!
<?
	exit(0);

}

$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

$result=mysql_query("select * from User_TB where ID='{$HTTP_POST_VARS['ID']}'");

if (($row=mysql_fetch_array($result))){//此ID已存在
	header("Refresh: 0;URL={$_REQUEST['FailAddress']}?error=1&id={$_REQUEST['ID']}");
	exit(0);
}
else{
$SuperUserID="NULL";
$SuperUserRight=true;
if ($HTTP_POST_VARS['SuperiorUser']!="") {
	$result=mysql_query("select AutoID from User_TB where ID='{$HTTP_POST_VARS['SuperiorUser']}'");
	if ( ! ($row=mysql_fetch_array($result))) 
	  $SuperUserRight=false;
	else 
	  $SuperUserID=$row['AutoID'];
}
if ( !$SuperUserRight ) { //联系人ID有错误
	header("Refresh: 0;URL={$_REQUEST['FailAddress']}?error=3&id={$_REQUEST['ID']}");
	exit(0);
} else {
$enPassword=$HTTP_POST_VARS['Password'];
$query=array();
$query[]="begin";
$query[]="insert into User_TB(AutoID,ID,Password,UserName,IdentifierNum,Company,TelephoneNumber,MobilePhone,EMail,Address,ZipCode,Status,UserFunc,UserFuncStatus,SuperiorUserAutoID) Values (NULL,'{$HTTP_POST_VARS['ID']}','$enPassword','{$HTTP_POST_VARS['UserName']}'," .
 "'{$HTTP_POST_VARS['IdNum']}','{$HTTP_POST_VARS['Company']}','{$HTTP_POST_VARS['Tel']}','{$HTTP_POST_VARS['Mobile']}'," .
 "'{$HTTP_POST_VARS['EMail']}','{$HTTP_POST_VARS['Address']}','{$HTTP_POST_VARS['ZipCode']}','ProfileNotProved','','',{$SuperUserID})";

$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query('rollback');
		break;
	}
}
if (!$success){
	header("Refresh: 0;URL={$_REQUEST['FailAddress']}?error=1&id={$_REQUEST['ID']}");
	exit(0);
} else {
	header("Refresh: 0;URL={$_REQUEST['SuccessAddress']}?id={$_REQUEST['ID']}");
	exit(0);

}
}
}


