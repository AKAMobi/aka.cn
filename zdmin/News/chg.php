<? session_start() ?>
<html>
<head>
<TITLE>�������</title>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
</head>
<body>
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
require_once("news.inc.php");
require "{$ADMINROOT}/Include/InitDB.php"; 

$id = $_REQUEST['id'];
$eClass = $_REQUEST['eClass'];
$Important = $_REQUEST['Important'];
$oldImage = $_REQUEST['oldimage'];

$files = $_REQUEST['files'];
$Title = $_REQUEST['Title'];
$Body = $_REQUEST['Body'];
$sub1 = $_REQUEST['sub1'];

if($sub1=='Modify'){

if(is_uploaded_file($_FILES['file']['tmp_name'])){//�ϴ�

	if(!is_dir($IMGROOT.date("Y"))){
		mkdir($IMGROOT.date("Y"),0777);
	}
	if(!is_dir($IMGROOT.date("Y").'/'.date("m"))){
		mkdir($IMGROOT.date("Y").'/'.date("m"),0777);
	}
	$thistime=date("dHis");
	
	$ImagePath=date("Y").'/'.date("m").'/';
	$name=$_FILES['file']['name'];
	$location=$IMGROOT.$ImagePath.$thistime.'-'.$name; 
	$ImagePath=$IMGURL.$ImagePath.$thistime.'-'.$name;
	move_uploaded_file($_FILES['file']['tmp_name'],$location); 

	$oldImage=str_replace( $IMGURL,$IMGROOT,$oldImage);
	if(is_file($oldImage))unlink($oldImage);
}else{//ʹ��ԭͼ
	$ImagePath=$oldImage;
}

//�޸ļ�¼
$sql="update News_TB set Class='$eClass',Important='$Important',Title='$Title',Body='$Body',PostDate=PostDate,ImagePath='{$ImagePath}' where AutoID=$id";
$rst=mysql_query($sql);
if($rst){
$originTitle=preg_replace("/,/","��",$_REQUEST['originTitle']);
$Title=preg_replace("/,/","��",$Title);
mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �޸��� {$_REQUEST['originPostDate']} ����Ϊ {$originTitle} �����ţ��±���Ϊ {$Title}','{$_SERVER['REMOTE_ADDR']}','News', NOW()) ");
?>
�����ѳɹ��޸ģ�
<?
}else{
?>
���ݿ����ʧ�ܡ����������Ա��
<?
}//end if

} else {
$rst=mysql_query("select AutoID,Class,DATE_FORMAT(PostDate,'%Y-%m-%d') as PostDate, Important, Title,Body,ImagePath from News_TB where AutoID=$id");
if ($row=mysql_fetch_array($rst)) {
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
<INPUT type="hidden" name="originTitle" value="<? echo $row['Title']; ?>">
<INPUT type="hidden" name="originPostDate" value="<? echo $row['PostDate']; ?>">
<table border=1>
<tr><td>�������ͣ�<input type="text" name="eClass" size=20 value="<? echo $row['Class']; ?>"></td></tr>
<?
if($row['Important']=="N"){
?>
<tr><td>�Ƿ�Ϊ��Ҫ���ţ�<input type="radio" name="Important" value="N" checked>��<input type="radio" name="Important" value="Y">��</td></tr>
<?
}else{
?>
<tr><td>�Ƿ�Ϊ��Ҫ���ţ�<input type="radio" name="Important" value="N">��<input type="radio" name="Important" value="Y" checked>��</td></tr>
<?
}
?>
<tr><td>ͼƬ�ϴ�<br><input type="hidden" name="oldimage" value="<? echo $row['ImagePath']; ?>">
<input type=file name=file size=20>
<tr><td>������Ŀ<input type="text" name="Title" size=70 value="<? echo $row['Title'] ; ?>"></td></tr>
<tr><td>��������<textarea name="Body" wrap="VIRTUAL" cols="70" rows="20"><? echo htmlspecialchars($row[Body]); ?>
</textarea></td></tr>
<tr><td><input type="hidden" name="id" value="<? echo $row['AutoID']; ?>"><input type="submit" name="sub1" value="Modify"></td></tr>
</table></form>
<?
} else {
?>
δ�ҵ�ָ�������š�
<?
}

}

}
}
?>
</div>
</body>
</html>