<?
require_once("news.inc.php");
require_once("header.inc.php");
$rst=mysql_query("select Class from News_TB group by Class order by Class");

while($row=mysql_fetch_array($rst)){
echo '分类：'.$row[0].'<br>';
$rst1=mysql_query("select * from News_TB where Class='$row[0]'");
while($row1=mysql_fetch_array($rst1)){
echo "<LI><a href=\"read.php?id=".$row1[AutoID]."\">".$row1[Title]."</a><br>";
}
echo '<br>