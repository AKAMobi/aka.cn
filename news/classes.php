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
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $NEWSURL; ?>/" class="a5">��������</a><font color="#458DE4">&gt; 
                </font><a href="<? echo $NEWSURL; ?>/classes.php" class="a5">�����б�</a><br>
                <br>
                <span class="newstitle"> �����б� </span></p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?
require_once("{$NEWSROOT}/Include/InitDB.inc.php");
$page=$_REQUEST['page'];
$area=$_REQUEST['area'];
$rst=mysql_query("select count(*) from News_TB where Class='$area'");
$row=mysql_fetch_row($rst);
$c=$row[0];
if(empty($page))$page=1;
$offset=($page*15)-15;
$rst2=mysql_query("SELECT * FROM News_TB where Class='$area' ORDER BY PostDate desc limit $offset,$NUMBERPAGE");
$num_fields = mysql_num_fields($rst2);
echo '����'.$c.'�����ţ���ҳ�ǵ�'.$page.'ҳ';
?>
<br><br>
<table border="0" width="400">
<?
while($row2=mysql_fetch_array($rst2)){
?>
<tr><td>
<LI><a href="read.php?id=<? echo $row2['AutoID']; ?>" class="a6" target="_blank">
<? if ($row2['Important']=='Y') echo "<B>"; ?>
<? echo $row2['Title']; ?>
<? if ($row2['Important']=='Y') echo "</B>"; ?>
</a></td></tr>
<?
}
?>
<tr><td align="center">
<?
if($page==1){
echo '��һҳ&nbsp;&nbsp;';
}else {
$page1=$page-1;
echo '<a href="classes.php?page='.$page1.'&area='.$area.'" class=\"a6\">��һҳ</a>&nbsp;&nbsp;';
}
$j=$c/15;
if(!is_int($j)) $j++;
$j=intval($j);
if($page==$j){
echo '��һҳ&nbsp;&nbsp;';
}else {
$page1=$page+1;
echo '<a href="classes.php?page='.$page1.'&area='.$area.'" class=\"a6\">��һҳ</a>&nbsp;&nbsp;';
}
$xx=$page+9;
for($i=$page;$i<=$j;$i++){
	if($i<=$xx){
		if ($i==$page){
			echo $i."&nbsp;&nbsp;";
			continue;
		}
		echo '<a href="'.$PHP_SELF.'?page='.$i.'&area='.$area.'" class=\"a6\">'.$i.'</a>&nbsp;&nbsp;';
	}else {
		break;
	}
}
echo '<a href="'.$PHP_SELF.'?page='.$j.'&area='.$area.'" class=\"a6\">���һҳ</a>';
?>
</td></tr>
</table>


</td>
</tr>
</table>
<br>
<?
require_once("{$NEWSROOT}/Include/CloseDB.inc.php");

IncludeHTML("{$NEWSROOT}/Include/Part2.html");
IncludeHTML("footer.html");
?>

