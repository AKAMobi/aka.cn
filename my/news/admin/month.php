<?
session_start();
require_once("../header.inc.php");
$year = $_REQUEST['year'];
$month= $_REQUEST['month'];
if ( ! isset( $year )) $year = date( "Y" );
if ( ! isset( $month )) $month = date( "n" );
?>
<link rel="stylesheet" href="../font.css" type="text/css">
<?
echo '��ǰĬ�����';
$area = $_REQUEST['area'];
$result = mysql_query("select Class from News_TB where Class='$area'" );
$cr = mysql_fetch_array( $result );
if ( $cr[0] != '' ) echo $cr[0]; else echo '��';
echo '<br>';

echo "����Ա:".$AdminName."<br><div align=center>".$year. "��" . $month. "��" . "</div><br>";
?>
<table border=1 bordercolor=#c0c0c0 bordercolordark=#c0c0c0 bordercoloclight=#c0c0c0 cellpadding=3 cellspacing=1>
<tr bgcolor=#c0c0c0>
	<td bgcolor=#ffc0c0 align=center>��</td>
	<td  align=center>һ</td>
	<td  align=center>��</td>
	<td  align=center>��</td>
	<td  align=center>��</td>
	<td  align=center>��</td>
	<td  align=center>��</td>
</tr>

<tr>	
<?
if(!isset($area))$area=0;
$first_date_day = date( "w", mktime( 0, 0, 0, $month, 1, $year));
for ( $i = 0 ; $i < $first_date_day; $i++ )
	echo "<td></td>";
for ( $i = 1 ; $i <32 ; $i++)
{
	$weekday = date( "w", mktime( 0, 0, 0, $month, $i, $year ));
	if ( $weekday % 7 == 0 ) echo "</tr><tr>";
	$db_date = date( "Y-m-d", mktime( 0, 0, 0, $month, $i, $year ));
	echo "<td align=center>" . "<a href=\"newslist.php?date_year=".$year."&date_month=".$month."&date_day=".$i."&area=" . $area . "\" target=\"mainFrame\">" . $i . "</a></td>";
}

?>
</tr>
</table>
<br>
<a href="nlm.php?month=<? echo $month ?>&area=<? echo $area; ?>" target="mainFrame">�г����·����д�������</a><br>
<br>
��ת����<br>
<form method=post action="month.php">
<input type=hidden name="area" value="<? echo $area; ?>">
<select name=year size=1>
	<option value=2001 selected>2001</option>
	<option value=2002>2002</option>
	<option value=2003>2003</option>
	<option value=2004>2004</option>
	<option value=2005>2005</option>
	<option value=2006>2006</option>
	<option value=2007>2007</option>
	<option value=2008>2008</option>
	<option value=2009>2009</option>
</select>
��
<select name=month size=1>
<?
	for ( $i = 1 ; $i <13 ; $i ++ )
	{
		echo "<option value=" . $i;
		if ( $i == $month ) echo " selected ";
		echo ">" . $i;
	}
?>
</select>
��<input type=submit name="gotomonth" value=" Go ">
</form>

<br>
<a href="news_add.php" target="mainFrame">�������</a><br>
<br>
���ŷ���
<hr>
<?

$result = mysql_query("select Class from News_TB group by Class" );
while ( $cr = mysql_fetch_array( $result ))
{
	echo '<a href="month.php?area=' . $cr[0] . '&year=' . $year . '&month=' . $month . '" target="leftFrame">' . $cr[0] . '</a><br>';
}
echo '<br><a href="month.php?area=0&year=' . $year . '&month=' . $month . '" target="leftFrame">ȡ������</a><br>';
echo '<a href="logout.php">�˳�</a>';
require_once( "../footer.inc.php" );
?>

