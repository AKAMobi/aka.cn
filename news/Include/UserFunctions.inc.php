<?
require_once("news.inc.php");
require_once("InitDB.inc.php");

$NUMBERPAGE='15';

function GetLastNewsID($n){
	$rst=mysql_query("select AutoID from News_TB order by PostDate desc limit $n");
	$news=array();
	while($row=mysql_fetch_row($rst)){
    		$news[]=$row['AutoID'];
	}
	unset($rst);
	unset($row);
	return $news;
}
function GetNewsDetail($newsAutoID){
	$rst=mysql_query("select * from News_TB where AutoID='$newsAutoID'");
	$row=mysql_fetch_row($rst);
	return $row;
}
function GetNewsTitle($newsAutoID){
	$rst=mysql_query("select Title,PostDate,Important,Poster from News_TB where AutoID='$newsAutoID'");
	$row=mysql_fetch_row($rst);
	return $row;
}
function GetNewsHTML($newsAutoID){
	$rst=mysql_query("select Title,Body,ImagePath from News_TB where AutoID='$newsAutoID'");
	$row=mysql_fetch_row($rst);
	$content= htmlspecialchars($row[Title]).'<br>'.'<img src="'.$row[ImagePath].'" align=right><br>'.htmlspecialchars($row[Body]).'<br>';
	return $content;
}
function GetNearNews($newsAutoID,$n){
	$rst=mysql_query("select AutoID from News_TB where AutoID>=$newsAutoID-$n and AutoID<=$newsAutoID+$n order by PostDate");
	$row=mysql_fetch_row($rst);
	return $row;
}
function GetNewsImgPath($newsAutoID){
	$rst=mysql_query("select ImagePath from News_TB where AutoID=$newsAutoID");
	$row=mysql_fetch_row($rst);
	$ImagePath=str_replace($IMGURL,$IMGROOT,$row['ImagePath']);
	return $ImagePath;
}

?>