<? session_start() ?>
<html>
<head>
<TITLE>添加新闻</title>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
</head>
<body>
<DIV align="center">
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['NewsAdmin'])) ) {
?>
 <td align="center" >
你没有新闻管理的权限<br>
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

if(is_uploaded_file($_FILES['file']['tmp_name'])){//上传

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
}else{//使用原图
	$ImagePath=$oldImage;
}

//修改记录
$sql="update News_TB set Class='$eClass',Important='$Important',Title='$Title',Body='$Body',PostDate=PostDate,ImagePath='{$ImagePath}' where AutoID=$id";
$rst=mysql_query($sql);
if($rst){
$originTitle=preg_replace("/,/","，",$_REQUEST['originTitle']);
$Title=preg_replace("/,/","，",$Title);
mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 修改了 {$_REQUEST['originPostDate']} 标题为 {$originTitle} 的新闻，新标题为 {$Title}','{$_SERVER['REMOTE_ADDR']}','News', NOW()) ");
?>
新闻已成功修改！
<?
}else{
?>
数据库操作失败。请联络管理员。
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
<tr><td>新闻类型：<input type="text" name="eClass" size=20 value="<? echo $row['Class']; ?>"></td></tr>
<?
if($row['Important']=="N"){
?>
<tr><td>是否为重要新闻：<input type="radio" name="Important" value="N" checked>否<input type="radio" name="Important" value="Y">是</td></tr>
<?
}else{
?>
<tr><td>是否为重要新闻：<input type="radio" name="Important" value="N">否<input type="radio" name="Important" value="Y" checked>是</td></tr>
<?
}
?>
<tr><td>图片上传<br><input type="hidden" name="oldimage" value="<? echo $row['ImagePath']; ?>">
<input type=file name=file size=20>
<tr><td>新闻题目<input type="text" name="Title" size=70 value="<? echo $row['Title'] ; ?>"></td></tr>
<tr><td>新闻内容<textarea name="Body" wrap="VIRTUAL" cols="70" rows="20"><? echo htmlspecialchars($row[Body]); ?>
</textarea></td></tr>
<tr><td><input type="hidden" name="id" value="<? echo $row['AutoID']; ?>"><input type="submit" name="sub1" value="Modify"></td></tr>
</table></form>
<?
} else {
?>
未找到指定的新闻。
<?
}

}

}
}
?>
</div>
</body>
</html>