<?
require_once("news.inc.php");

require_once("{$NEWSROOT}/Include/UserFunctions.inc.php");
require_once("{$NEWSROOT}/Include/IncludeFile.php");

IncludeHTML("header.html");
IncludeHTML("{$NEWSROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $NEWSURL; ?>/" class="a5">阿卡新闻</a>
                <br>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?
require_once("{$NEWSROOT}/Include/InitDB.inc.php");

$result = mysql_query("select Title,DATE_FORMAT(PostDate,'%Y-%m-%d') as PostDate ,Body,ImagePath from News_TB where AutoID={$_REQUEST['id']}" );
if (!( $ra = mysql_fetch_array( $result )) ){
?>
<font color=#ff0000>错误，信息提取错误！</font><br>
<?
} else {
echo "<span class=\"newstitle\">".$ra['Title']  . "</span><br>";
?>
<span><? echo $ra['PostDate'] ; ?></span>
<hr width="480">
<?
if ($ra['ImagePath']!=''){
$imgname=$ra['ImagePath'];
echo '<img src="'.$imgname.'"><br>';
}
?>
<br>
<table width="480" border="0"><tr><td>
<?
echo '<p>'.nl2br(  $ra['Body'] ) . '</p><br>';
?>
</td></tr></table>
<?
}
?>

</td>
</tr>
</table>
<br>
<?

require_once("{$NEWSROOT}/Include/CloseDB.inc.php");

IncludeHTML("{$NEWSROOT}/Include/Part2.html");
IncludeHTML("footer.html");
?>
