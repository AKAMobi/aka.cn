<?
require_once( "db.inc.php" );
$conn=mysql_pconnect(DB_HOST,DB_USER,DB_PASS) or die("�޷�����DBM.");
mysql_select_db(DB_NAME,$conn) or die("�޷������ݿ�.");
?>
