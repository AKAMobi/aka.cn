<?
require_once("../header.inc.php");
$rst=mysql_query("select * from News_TB");
echo '<table border=1>';
while($row=mysql_fetch_row($rst)){
echo '<tr>';
for($i=0;$i<mysql_num_fields($rst);$i++){
echo '<td>'.$row[$i].'</td>';
}
echo '</tr>';
}
?>
</table>

<?
require_once("../footer.inc.php");
?>
