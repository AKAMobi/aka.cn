<?session_start();?>
<link rel="stylesheet" href="../font.css" type="text/css">
<br><br>
<?
require_once("../header.inc.php");
$id = $_REQUEST['id'];
$eClass = $_REQUEST['eClass'];
$Important = $_REQUEST['Important'];
$oldimage = $_REQUEST['oldimage'];
$Cimage = $_REQUEST['Cimage'];
$files = $_REQUEST['files'];
$Title = $_REQUEST['Title'];
$Body = $_REQUEST['Body'];
$mid = $_REQUEST['mid'];
$sub1 = $_REQUEST['sub1'];

if($sub1=='�޸�'){

if($Cimage=='1'){//�ϴ�
if($oldimage==''){//�ϴ���ͼ
$thistime=date("dHis");
$location=$IMGROOT.date("Y").'/'.date("m").'/'.$thistime.'-'.$files['name'];
$ImagePath=$files['name'];
$s1="ImagePath='$ImagePath'";
}else{//����ԭͼ
$aa=$imgname=GetNewsImgPath($mid);
$location=$IMGROOT.$aa;
$ImagePath=$oldimage;
$s1="ImagePath=ImagePath";
}
foreach ($files['name'] as $key=>$name) {
    if ($files['size'][$key]) { 
	if(is_file($location))unlink($location);
       copy($files['tmp_name'][$key],$location); 
       unlink($files['tmp_name'][$key]);
		}}
}

if($Cimage=='0'){//ɾ��ԭͼ
$imgname=GetNewsImgPath($mid);
if(is_file($IMGROOT.$imgname))unlink($IMGROOT.$imgname);
$s1="ImagePath=''";
}
if($Cimage=='2'){//����ԭͼ
$s1="ImagePath=ImagePath";
}
//�޸ļ�¼
$rst=mysql_query("update News_TB set Class='$eClass',Important='$Important',Title='$Title',Body='$Body',$s1 where AutoID=$mid");
if($rst){echo '<script language="javascript">alert("�޸����!");top.location="update.php";</script>';
}else{echo '<script language="javascript">alert("δ֪���󣬲����޸�!");top.location="update.php";</script>';}
}//end if

$rst=mysql_query("select * from News_TB where AutoID=$id");
$row=mysql_fetch_array($rst);
echo '<form name="form1" method="post" action="" enctype="multipart/form-data"><table border=1>';
echo '<tr><td>�������ͣ�<input type="text" name="eClass" size=20 value="'.$row[1].'"></td></tr>';
if($row[Important]=="N"){
echo '<tr><td>�Ƿ�Ϊ��Ҫ���ţ�<input type="radio" name="Important" value="N" checked>��<input type="radio" name="Important" value="Y">��</td></tr>';
}else{
echo '<tr><td>�Ƿ�Ϊ��Ҫ���ţ�<input type="radio" name="Important" value="N">��<input type="radio" name="Important" value="Y" checked>��</td></tr>';
}
$imgname=GetNewsImgPath($id);
echo '<tr><td>ͼƬ�ϴ�<br><input type="hidden" name="oldimage" value="'.$row[ImagePath].'"><input type="radio" name="Cimage" value="2" checked>����ԭ��(�л�û��ͼ)<br><input type="radio" name="Cimage" value="1">�ϴ���ͼor����ԭͼ<input type=file name=files[] size=20><img src="'.$IMGURL.$imgname.'" align=right><br><input type="radio" name="Cimage" value="0">ɾ��ԭͼ</td></tr>';
echo '<tr><td>������Ŀ<input type="text" name="Title" size=70 value="'.$row[Title].'"></td></tr>';

echo '<tr><td>��������<textarea name="Body" wrap="VIRTUAL" cols="70" rows="20">'.htmlspecialchars($row[Body]).'</textarea></td></tr>';
echo '<tr><td><input type="hidden" name="mid" value="'.$row[AutoID].'"><input type="submit" name="sub1" value="�޸�"></td></tr></table></form>';
require_once("../footer.inc.php");
?>
