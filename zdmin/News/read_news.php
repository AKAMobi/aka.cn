<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
<?
}else {

if ( (!isset($_SESSION['NewsAdmin'])) ) {
?>
 <td align="center" >
��û�����Ź����Ȩ��<br>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 

$id = $_REQUEST['id'];
$result = mysql_query("select Title, DATE_FORMAT(PostDate,'%Y-%m-%d') as PostDate,Title,Body,ImagePath from News_TB where AutoID=$id" );
if ( !( $ra = mysql_fetch_array( $result ))){
?>
û���ҵ������š�
<?
} else {


	echo $ra['PostDate'] . "<br><br>";
?>
<a href="chg.php?id=<? echo $id ?>" class="a6">�� ��</a> | <a href="del.php?id=<? echo $id ?>" class="a6">ɾ ��</a><br>
<?

?>

<hr width=500 >
<table width=500 borcer=0>
<tr>
<td>
<h3>
<center>
<? 
echo htmlspecialchars( $ra[Title] ) . "<br>";
?>
</center>
</h3>
<br>
<?
if ($ra['ImagePath']!=''){
echo '<p><img src="'.$ra['ImagePath'].'"></p><br>';
}?>
<br>
<?
echo '<p>'.nl2br(  $ra['Body'] ) . '</p><br>';
?>

</td>
</tr>
</table>

<br>
<hr width=500>
<a href="chg.php?id=<? echo $id ?>" class="a6">�� ��</a> | <a href="del.php?id=<? echo $id ?>" class="a6">ɾ ��</a><br>
<?

}
}
}
?>
</div>
