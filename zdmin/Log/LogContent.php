<? session_start(); ?>
<?
require_once("zdmin.inc.php");


function isParamExist(){

	if (!isset($_REQUEST['startYear'])) return false;
	if (!isset($_REQUEST['startMonth'])) return false;
	if (!isset($_REQUEST['startDay'])) return false;
	if (!isset($_REQUEST['endYear'])) return false;
	if (!isset($_REQUEST['endMonth'])) return false;
	if (!isset($_REQUEST['endDay'])) return false;
	
	if (!isset($_REQUEST['addCondition'])) return false;
	
	return true;
}

if ( (!isset($_SESSION['AdminID'])) ) exit(0);


if ( (!isset($_SESSION['LogAdmin'])) ) exit(0);


if (!isParamExist()) exit(0);

require "{$ADMINROOT}/Include/InitDB.php"; 
?>
adminID,logContent,logSource,logType,logTime
<?
$startTime=sprintf("%4d-%02d-%02d",$_REQUEST['startYear'],$_REQUEST['startMonth'],$_REQUEST['startDay']); 
$endTime=sprintf("%4d-%02d-%02d",$_REQUEST['endYear'],$_REQUEST['endMonth'],$_REQUEST['endDay']); 

$pattern=preg_quote('\\');

$addCondition=preg_replace("/$pattern/","",$_REQUEST['addCondition']);
$sql="select AdminID,Content,ClientIP,LogType,DATE_FORMAT(LogTime,'%Y-%m-%d %H:%i') as LogTime from AdminUser_Log_TB where LogTime>'{$startTime}' and LogTime<DATE_ADD('{$endTime}' ,INTERVAL +1 DAY) and ({$addCondition})";

$result=mysql_query($sql, $conn);
 
while($row=mysql_fetch_array($result)){
	echo "{$row['AdminID']},{$row['Content']},{$row['ClientIP']},{$row['LogType']},{$row['LogTime']}\n";
}
?>