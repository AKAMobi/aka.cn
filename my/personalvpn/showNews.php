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
                <span class="newstitle"> ����ֱͨ������֪ͨ </span></p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

$ID=$_REQUEST['UserID'] ;
if( !eregi( "^[0-9a-z][_0-9a-z\.]*$", $ID ) ){
?>
����ֱ�ӷ��ʱ�ҳ��
<?
}else{

require_once("{$NEWSROOT}/Include/InitDB.inc.php");

$sql="select max(udl.RecordTime) as LastLoginTime from User_TB u, PersonalVPN_UserDialLog_TB udl where u.AutoID=UserAutoID and u.ID='" . $ID . "'";

$result=mysql_query($sql);

$row=mysql_fetch_array($result);

$lastreadtime = $row["LastLoginTime"];

if (!$lastreadtime) {
	$lastreadtime="2000-01-01";
}

if (isset($_REQUEST['page'])) {
	$page=$_REQUEST['page'];
} else {
	$page=1;
}
$offset=($page*15)-15;

$sql="select A.AutoID as AutoID, A.Title As Title, A.Important As Important from News_TB A, PersonalVPN_ClientNews_TB B where B.PostDate>'" . $lastreadtime . "' and A.AutoID=B.NewsID ORDER BY A.PostDate desc limit $offset,15";

$result=mysql_query($sql);
if (mysql_num_rows($result) <=0) { 
?>
û������֪ͨ��
<?
} else {		//������
echo '��ҳ�ǵ�'.$page.'ҳ';
?>
<br><br>
<table border="0" width="400">
<?
$num=0;
while($row2=mysql_fetch_array($result)){
$num++;
?>
<tr><td>
<LI><a href="<? echo $NEWSURL; ?>/read.php?id=<? echo $row2['AutoID']; ?>" class="a6" target="_blank">
<? if ($row2['Important']=='Y') echo "<B>"; ?>
<? echo $row2['Title']; ?>
<? if ($row2['Important']=='Y') echo "</B>"; ?>
</a></td></tr>
<?
}
for ($i=0;$i<(15-$num);$i++){
?>
<tr><td>&nbsp</td></tr>
<?
}
?>
<tr><td align="center">
<br>
<?
if($page==1){
echo '��һҳ&nbsp;&nbsp;';
}else {
$page1=$page-1;
echo '<a href="showNews.php?page='.$page1.'&area='.$area.'" class=\"a6\">��һҳ</a>&nbsp;&nbsp;';
}
$j=$c/15;
if(!is_int($j)) $j++;
$j=intval($j);
if($page==$j){
echo '��һҳ&nbsp;&nbsp;';
}else {
$page1=$page+1;
echo '<a href="showNews.php?page='.$page1.'&area='.$area.'" class=\"a6\">��һҳ</a>&nbsp;&nbsp;';
}
$xx=$page+9;
for($i=$page;$i<=$j;$i++){
	if($i<=$xx){
		if ($i==$page){
			echo $i."&nbsp;&nbsp;";
			continue;
		}
		echo '<a href="showNews.php?page='.$i.'&area='.$area.'" class=\"a6\">'.$i.'</a>&nbsp;&nbsp;';
	}else {
		break;
	}
}
echo '<a href="showNews.php?page='.$j.'&area='.$area.'" class=\"a6\">���һҳ</a>';

?>
</td></tr>
</table>

<?

}
require_once("{$NEWSROOT}/Include/CloseDB.inc.php");


}
?>
</td>
</tr>
</table>
<br>
<?


IncludeHTML("{$NEWSROOT}/Include/Part2.html");
IncludeHTML("footer.html");
?>

