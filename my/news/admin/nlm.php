<?
require_once("../header.inc.php");
$month = $_REQUEST['month'];
$area = $_REQUEST['area'];

echo '<link rel="stylesheet" href="../font.css" type="text/css">';
$start_date = date( "Y-$month-01" );
$end_date = date( "Y-$month-31" );

if ( !$area=='0') $condition="and Class='".$area."'"; else $condition = "";


echo $news_date . "<br><br>";
$result = mysql_query("select count( * ) from News_TB where PostDate>='$start_date' and PostDate<='$end_date'" . $condition );
$ca = mysql_fetch_array( $result );
echo "本月共有新闻 " . $ca[0] . " 条。<br>";
?>
<br><br>
<?

$result = mysql_query("select * from News_TB where PostDate>='$start_date' and PostDate<='$end_date'" . $condition );
while( $ra = mysql_fetch_array( $result ))
	echo "<LI><a href=\"read_news.php?id=" . $ra[AutoID] . "\">" . $ra[Title] . "</a><br>";
require_once( "../footer.inc.php" );
?>

