<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");


?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="760" height="224" valign="top"> 

<br>
      <center>
      <table width="760" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT; ?>/News/NewsAdmin.php" class="a5">新闻管理</a>
				<br>
                <br>
                <span class="newstitle">新闻管理</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
 <table width="760" border="1" cellspacing="0" cellpadding="0">
  <tr> 
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
 <td align="center" >
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['NewsAdmin'])) ) {
?>
 <td align="center" >
你没有新闻管理的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">管理菜单</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
?>
<td width="200" align="center">
<DIV align="center">
<?

if ( ! isset( $_REQUEST['year'] )) {
	$year = date( "Y" );
} else {
	$year = $_REQUEST['year'];
}
if ( ! isset( $_REQUEST['month'] )) {
	$month = date( "n" );
} else {
	$month= $_REQUEST['month'];
}

if(!isset($_REQUEST['area'])) {
	$area=0;
} else {
	$area = $_REQUEST['area'];
}
echo '当前默认类别：';
$result = mysql_query("select Class from News_TB where Class='$area'" );
$cr = mysql_fetch_array( $result );
if ( $cr[0] != '' ) echo $cr[0]; else echo '无';
echo '<br>';

echo "操作员:".$_SESSION['AdminID'] ."<br><div align=center>".$year. "年" . $month. "月" . "</div><br>";
?>
<table border=1 bordercolor=#c0c0c0 bordercolordark=#c0c0c0 bordercoloclight=#c0c0c0 cellpadding=3 cellspacing=1>
<tr bgcolor=#c0c0c0>
	<td bgcolor=#ffc0c0 align=center>日</td>
	<td  align=center>一</td>
	<td  align=center>二</td>
	<td  align=center>三</td>
	<td  align=center>四</td>
	<td  align=center>五</td>
	<td  align=center>六</td>
</tr>

<tr>	
<?
$first_date_day = date( "w", mktime( 0, 0, 0, $month, 1, $year));
for ( $i = 0 ; $i < $first_date_day; $i++ )
	echo "<td></td>";
for ( $i = 1 ; $i <32 ; $i++)
{
	$weekday = date( "w", mktime( 0, 0, 0, $month, $i, $year ));
	if ( $weekday % 7 == 0 ) echo "</tr><tr>";
	$db_date = date( "Y-m-d", mktime( 0, 0, 0, $month, $i, $year ));
	echo "<td align=\"center\" onclick=\" return document.frames('IMainFrame').document.location.href='ListNews.php?date_year=".$year."&date_month=".$month."&date_day=".$i."&area=" . $area . "'\" class=\"a11\" onmouseover=\"this.className='a10';\" onmouseout=\"this.className='a11';\">" . $i . "</td>";
}
?>
</tr>
</table>
<br>
<span onclick="return document.frames('IMainFrame').document.location.href='nlm.php?area=<? echo $area; ?>&year=<? echo $year; ?>&month=<? echo $month; ?>'; " class="a11" onmouseover="this.className='a10';" onmouseout="this.className='a11';">列出此月份所有此类新闻</span><br>
<br>
跳转到：<br>
<form method=post action="<? echo $_SERVER['PHP_SELF']; ?>">
<INPUT type="hidden" name="area" value="<? echo $area;?>">
<select name=year size=1>
<?
	for ( $i = 2001 ; $i <2010 ; $i ++ )
	{
		echo "<option value=" . $i;
		if ( $i == $year ) echo " selected ";
		echo ">" . $i ."</option>";
	}
?>
</select>
年
<select name=month size=1>
<?
	for ( $i = 1 ; $i <13 ; $i ++ )
	{
		echo "<option value=" . $i;
		if ( $i == $month ) echo " selected ";
		echo ">" . $i."</option>";
	}
?>
</select>
月<input type=submit name="gotomonth" value=" Go ">
</form>

<br>
<input value="添加新闻" type="button" onclick="return document.frames('IMainFrame').document.location.href='AddNews.php';">
<br>
新闻分类
<hr>
<?

$result = mysql_query("select Class from News_TB group by Class" );
while ( $cr = mysql_fetch_array( $result ))
{
?>
<a href="<? echo $_SERVER['PHP_SELF']; ?>?area=<? echo $cr[0]; ?>&year=<? echo $year ; ?>&month=<? echo $month ;?>" class="a6"><? echo $cr[0]; ?></a><br>
<?
}
?>
<BR>
<a href="<? echo $_SERVER['PHP_SELF']; ?>?year=<? echo $year ; ?>&month=<? echo $month ;?>" class="a6">取消分类</a><br>

</td>
</td>
<td valign="top">
<IFRAME ID="oMainFrame" name="IMainFrame" FRAMEBORDER="0" SCROLLING="AUTO" SRC="ListNews.php?area=<? echo $area ?>&date_year=<? echo $year ?>&date_month=<? echo $month; ?>" width="560" height="450">
</IFRAME>
</td>
<?
}
}
?>
</td></tr>
</table>
</td>  </tr>

</table>
<?
IncludeHTML("{$AKAROOT}/footer.html");
?>
