<html>
<head>
<title>滚动新闻</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" href="/css/aka.css" type="text/css">
</head>
<body>
<MARQUEE direction="up" BEHAVIOR="SCROLL" SCROLLAMOUNT="1" SCROLLDELAY="20" id="oMarquee" >
<TABLE border="0" width="220" onmouseover="document.all.oMarquee.stop();" onmouseout="document.all.oMarquee.start();">
<?
require_once("news.inc.php");

require_once("{$NEWSROOT}/Include/InitDB.inc.php");
$rst=mysql_query("select Title,AutoID,Important,DATE_FORMAT(PostDate,'%Y-%m-%d') as PostDate from News_TB order by PostDate desc limit 50");

while($row=mysql_fetch_array($rst)){
?>
<tr><td width="65">[<? echo $row['PostDate']; ?>]</td>
<td><a href="<? echo $NEWSURL; ?>/read.php?id=<? echo $row['AutoID']; ?>" class="a6" target="_blank">
<? if ($row['Important']=='Y') echo "<B>"; ?>
<? echo $row['Title']; ?>
<? if ($row['Important']=='Y') echo "</B>"; ?>
</a></td></tr>
<?

}
require_once("{$NEWSROOT}/Include/CloseDB.inc.php");

?>
</table>
</MARQUEE>
</body>
</html>
