<?
require_once("../header.inc.php");
$id = $_REQUEST['id'];
echo '<link rel="stylesheet" href="../font.css" type="text/css">';
$result = mysql_query("select * from News_TB where AutoID=$id" );
if ( $ra = mysql_fetch_array( $result ))
	$news_exist = true;
else	$news_exist = false;
?>
<br><br><br>
<center>
<?
if ( $news_exist )
{
	echo $ra[PostDate] . "<br><br>";
?>
<a href="chg.php?id=<? echo $id ?>">更 改</a> | <a href="del.php?id=<? echo $id ?>">删 除</a><br>
<?
}
?>

<hr width=500 >
<table width=500 borcer=0>
<tr>
<td>
<h3>
<center>
<? 
if ( $news_exist ) echo htmlspecialchars( $ra[Title] ) . "<br>";
	else echo "<font color=#ff0000>错误，信息提取错误！</font><br>";
?>
</center>
</h3>
<br>
<?
if (!$ra[ImagePath]==''){
$imgname=GetNewsImgPath($id);
echo '<p><img src="'.$IMGURL.$imgname.'"></p><br>';
}?>
<br>
<?
if ( $news_exist ) echo '<p>'.nl2br( htmlspecialchars( $ra[Body] )).'</p><br>';
?>

</td>
</tr>
</table>

<br>
<hr width=500>
<?
if ( $news_exist )
{
?>
<a href="chg.php?id=<? echo $id ?>">更 改</a> | <a href="del.php?id=<? echo $id ?>">删 除</a><br>
<?
}
require_once( "../footer.inc.php" );
?>
