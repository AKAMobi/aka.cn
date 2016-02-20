<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

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

if (!isset($_REQUEST['year'])){
	$year=	date( "Y" );
} else {
	$year=	$_REQUEST['year'];
}
if ( ! isset( $_REQUEST['month'] )) {
	$month = date( "n" );
} else {
	$month= $_REQUEST['month'];
}

$area = $_REQUEST['area'];

$start_date = "{$year}-{$month}-01" ;
$end_date = "{$year}-{$month}-31" ;

echo "日期：{$year}-{$month}<br>";

echo "分类：";
if ((isset($_REQUEST['area'])) && ($_REQUEST['area']!='0')){
	$condition=" and Class='".$_REQUEST['area']."'";
	echo $_REQUEST['area'];
}else{
	$condition='';
	echo "无";
}

?>
<br>
<?

$result = mysql_query("select count( * ) from News_TB where PostDate>='$start_date' and PostDate<='$end_date'" . $condition );
$ca = mysql_fetch_array( $result );
echo "<br><br><br>本月共有此类新闻 " . $ca[0] . " 条。<br>";
?>
<br><br>
<?

$result = mysql_query("select AutoID,Title,Important from News_TB where PostDate>='$start_date' and PostDate<='$end_date'" . $condition );
?>
<table border="0">
<?
while( $ra = mysql_fetch_array( $result )) {
?>
<tr><td>
<?
if ($ra['Important']=="Y"){
	echo "<b>";
}
?>
<a href="read_news.php?id=<? echo $ra['AutoID']; ?>"><? echo $ra['Title'] ; ?></a>
<?
if ($ra['Important']=="Y"){
	echo "</b>";
}
?>
</td></tr>
<?
}
?>
</table>
<?

}
}
?>
</div>


