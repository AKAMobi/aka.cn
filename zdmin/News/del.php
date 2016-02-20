<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

require_once("news.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['NewsAdmin'])) ) {
?>
 <td align="center" >
你没有新闻管理的权限<br>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 

$id = $_REQUEST['id'];
$result = mysql_query("select ImagePath, DATE_FORMAT(PostDate,'%Y-%m-%d') as PostDate,Title from News_TB where AutoID=$id" );

if ( !( $ra = mysql_fetch_array( $result ))){
?>
没有找到该新闻。
<?
} else {

$PostDate=$ra['PostDate'];
$ImagePath=$ra['ImagePath'];
$ImagePath=str_replace( $IMGURL,$IMGROOT,$ra['ImagePath']);
$Title=preg_replace("/,/","，",$ra['Title']);
$query=array();
$query[]="begin";
$query[] = "delete from News_TB where AutoID=$id";
$query[] = "delete from PersonalVPN_ClientNews_TB where NewsID={$id}";
$query[] = "insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 删除了 {$PostDate} 标题为 {$Title} 的新闻 ','{$_SERVER['REMOTE_ADDR']}','News', NOW()) ";
$query[]="commit";
$success=true;;
for ($i=0;$i<count($query);$i++){
	if (!mysql_query($query[$i])){
		$success=false;
		break;
	}
}
if ($success){
?>
删除操作已完成。
<?
	if(is_file($ImagePath))unlink($ImagePath);
}else {
mysql_query("rollback");
?>
数据库操作失败
<?
}
	
}
}
}
?>
</div>