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
                </font><a href="<? echo $NEWSURL; ?>/" class="a5">阿卡新闻</a><br>
                <br>
                <span class="newstitle"> 阿卡新闻 </span></p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?
require_once("{$NEWSROOT}/Include/InitDB.inc.php");
$rst=mysql_query("select Class from News_TB group by Class order by Class");

while($row=mysql_fetch_array($rst)){
?>
<TABLE border="0" width="400">

<tr><td align="left" ><b><? echo $row['Class'] ; ?></b></td></tr>
<tr><td align="left">
<?
$rst1=mysql_query("select AutoID,Important,Title from News_TB where Class='{$row['Class']}' order by PostDate  Desc limit  5");
while($row1=mysql_fetch_array($rst1)){
?>
<tr><td>
<LI><a href="read.php?id=<? echo $row1['AutoID']; ?>" class="a6" target="_blank">
<? if ($row1['Important']=='Y') echo "<B>"; ?>
<? echo $row1['Title']; ?>
<? if ($row1['Important']=='Y') echo "</B>"; ?>
</a></td></tr>
<?
}
?>
<td></tr>
<tr><td align="right" >
<a href="classes.php?area=<? echo $row['Class']; ?>" class="a6">更多内容...&nbsp;&nbsp;</a>
</td></tr>
</table>
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

