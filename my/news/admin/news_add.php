<?
session_start();
require_once("../header.inc.php");
echo '<link rel="stylesheet" href="../font.css" type="text/css">';
$sub1=$HTTP_POST_VARS['sub1'];
if($sub1=="���"){
$files=$HTTP_POST_FILES['files'];
$ExistClass=$HTTP_POST_VARS['ExistClass'];
$OldClass=$HTTP_POST_VARS['OldClass'];
$NewClass=$HTTP_POST_VARS['NewClass'];
$Body=$HTTP_POST_VARS['Body'];
$Title=$HTTP_POST_VARS['Title'];
//�ж��Ƿ���ͼƬ�ϴ����������ϴ�ͼƬ����Ŀ¼
if($files){
echo "<h1>" . $IMGROOT.date("Y") . "</h1>";
echo "<h1>pic: " . $files['name'] . "</h1>";
if(!is_dir($IMGROOT.date("Y"))){
	mkdir($IMGROOT.date("Y"),0777);
}
if(!is_dir($IMGROOT.date("Y").'/'.date("m"))){
	mkdir($IMGROOT.date("Y").'/'.date("m"),0777);
}
$thistime=date("dHis");
//�ϴ�ͼƬ
$ImagePath=$IMGROOT.date("Y").'/'.date("m").'/';
foreach ($files['name'] as $key=>$name) { //������Լ���ϴ��ļ��Ĵ�С����չ��(jpg.gif.bmp.png��)
    if ($files['size'][$key]) { 
       $location=$ImagePath.$thistime.'-'.$name; 
	   $ImagePath=$name;
       copy($files['tmp_name'][$key],$location); 
       unlink($files['tmp_name'][$key]); 
    }
}
//$ImagePath=$name;
}else $ImagePath='';
//����Ƿ�Ϊ������������
if($ExistClass=="yes"){$Class=$OldClass;}else{$Class=$NewClass;}
//�滻���س��Ϳո��Ա���html�ļ���������ʾ
//$Body=ereg_replace(" ","&nbsp;",$Body);
//$Body=ereg_replace("\n","<br>",$Body);
$Body=htmlspecialchars( $Body );
//��Ӽ�¼
$thistime=date("Y-m-d H:i:s");
mysql_query("insert into News_TB (Class,PostDate,Important,Poster,Title,Body,ImagePath) values ('$Class','$thistime','$Important','$AdminName','$Title','$Body','$ImagePath')");

echo '<script language="javascript">alert("����������!");top.location="update.php";</script>';

}
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table border=1>
<tr><td>�������ͣ�ԭ����������<input type="radio" name="ExistClass" value="yes" checked><select name="OldClass">
	<?
	$rst=mysql_query("select Class from News_TB group by Class");
	while($row=mysql_fetch_row($rst)){
	echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
	?>
	</select><br>����������������������<input type="radio" name="ExistClass" value="no"><input type="text" name="NewClass" size=20></td></tr>
<tr><td>�Ƿ�Ϊ��Ҫ���ţ�<input type="radio" name="Important" value="N" checked>��<input type="radio" name="Important" value="Y">��</td></tr>
<tr><td>ѡ��ͼƬ�ϴ���<input type=file name=files[] size=20></td></tr>
<tr><td>������Ŀ<input type="text" name="Title" size=70></td></tr>
<tr><td>��������<textarea name="Body" wrap="VIRTUAL" cols="70" rows="20"></textarea></td></tr>
<tr><td><input type="submit" name="sub1" value="���"></td></tr>
</table>
</form>
<?require_once("../footer.inc.php");?>
