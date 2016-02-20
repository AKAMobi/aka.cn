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
if (!isset($_REQUEST['date_year'])){
	$date_year=	date( "Y" );
} else {
	$date_year=	$_REQUEST['date_year'];
}
if ( ! isset( $_REQUEST['date_month'] )) {
	$date_month = date( "n" );
} else {
	$date_month= $_REQUEST['date_month'];
}
if ( ! isset( $_REQUEST['date_day'] )) {
	$date_day = date( "d" );
} else {
	$date_day= $_REQUEST['date_day'];
}
echo "日期：{$date_year}-{$date_month}-{$date_day}<br>";

echo "分类：";
if ((isset($_REQUEST['area'])) && ($_REQUEST['area']!='0')){
	$condition=" and Class='".$_REQUEST['area']."'";
	echo $_REQUEST['area'];
}else{
	$condition='';
	echo "无";
}

echo "<br>";



$news_date=$date_year.'-'.$date_month.'-'.$date_day;
$news_date1=$date_year.'-'.$date_month.'-'.$date_day.' 0:0:0';
$news_date2=$date_year.'-'.$date_month.'-'.$date_day.' 23:59:59';
$result = mysql_query("select count(*) from News_TB where PostDate>='$news_date1' and PostDate<='$news_date2'".$condition);
$ca = mysql_fetch_array($result );
?>
<br><br><br>
<?
echo "本日共有新闻 " . $ca[0] . " 条。<br>";
?>
<br><br>
<?
$result = mysql_query("select AutoID,Title,Important from News_TB where PostDate>='$news_date1' and PostDate<='$news_date2'".$condition);
?>
<table border="0" >
<?
while( $ra = mysql_fetch_array( $result )) {
?>
<tr><td>
<?
if ($ra['Important']=="Y"){
	echo "<b>";
}
?>
<a href="read_news.php?id=<? echo $ra['AutoID']; ?>" class="a6"><? echo $ra['Title'] ; ?></a>
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
