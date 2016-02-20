<link rel="stylesheet" href="../font.css" type="text/css">
<br><br>
<?
require_once("../header.inc.php");
if (!isset($date_year)){
	echo "今天日期：".date("Y-m-d")."<br>";
	exit;
}
if (!$area=='0'){
$condition=" and Class='".$area."'";
}else{
$condition='';}

$news_date=$date_year.'-'.$date_month.'-'.$date_day;
echo $news_date . "<br><br>";
$news_date1=$date_year.'-'.$date_month.'-'.$date_day.' 0:0:0';
$news_date2=$date_year.'-'.$date_month.'-'.$date_day.' 23:59:59';
$result = mysql_query("select count(*) from News_TB where PostDate>='$news_date1' and PostDate<='$news_date2'".$condition);
$ca = mysql_fetch_array($result );
echo "本日共有新闻 " . $ca[0] . " 条。<br>";
?>
<br><br>
<?

$result = mysql_query("select * from News_TB where PostDate>='$news_date1' and PostDate<='$news_date2'".$condition);
while( $ra = mysql_fetch_array( $result ))
	echo "<LI><a href=\"read_news.php?id=" . $ra[AutoID] . "\">" . $ra[Title] . "</a><br>";
require_once("../footer.inc.php")
?>
