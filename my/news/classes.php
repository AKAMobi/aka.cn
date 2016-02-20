<?
require_once("header.inc.php");
$page=$HTTP_GET_VARS['page'];
$area=$HTTP_GET_VARS['area'];
$rst=mysql_query("select count(*) from News_TB where Class='$area'");
$row=mysql_fetch_row($rst);
$c=$row[0];
if(empty($page))$page=1;
$offset=($page*15)-15;
$rst2=mysql_query("SELECT * FROM News_TB where Class='$area' ORDER BY AutoID limit $offset,$NUMBERPAGE");
$num_fields = mysql_num_fields($rst2);
echo '<br>';
echo '<br>内容列表，共有'.$c.'条记录:<br><br>本页是第'.$page.'页';
echo '<table>';
while($row2=mysql_fetch_array($rst2)){
?>
<TR bgColor=#ffffff id=row onmouseout="this.bgColor='#ffffff'" onmouseover="this.bgColor='#ff9933';this.style.cursor='hand'">
<? echo '<td><a href=read.php?id='.$row2[AutoID].'&area='.$area.'>'.$row2[Title].'</a></td></tr>';
}
?>
<tr><td>
<?
if($page==1){
echo '上一页&nbsp;';
}else {
$page1=$page-1;
echo '<a href="'.$PHP_SELF.'?page='.$page1.'&area='.$area.'">上一页</a>&nbsp;';
}
$j=$c/15;
if(!is_int($j)) $j++;
$j=intval($j);
$xx=$page+9;
for($i=$page;$i<=$j;$i++){
if($i<=$xx){
echo '<a href="'.$PHP_SELF.'?page='.$i.'&area='.$area.'">'.$i.'</a>&nbsp;';
}
}
echo '<a href="'.$PHP_SELF.'?page='.$j.'&area='.$area.'">最后一页</a>';
?>
<form action="" enctype=multipart/form-data method=post>
<input type=text name="page" size=3><input name=Submit type=submit value=跳转到此页>
</form>
</table>
<?
require_once("footer.inc.php");
?>
