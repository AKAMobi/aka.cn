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
$sub1=$_REQUEST['sub1'];
if($sub1=="Add"){
$files=$_REQUEST['files'];
$ExistClass=$_REQUEST['ExistClass'];
$OldClass=$_REQUEST['OldClass'];
$NewClass=$_REQUEST['NewClass'];
$Body=$_REQUEST['Body'];
$Title=$_REQUEST['Title'];
$Important=$_REQUEST['Important'];

//判断是否有图片上传，并建立上传图片所需目录
if(is_uploaded_file($_FILES['file']['tmp_name'])){
	if(!is_dir($IMGROOT.date("Y"))){
		mkdir($IMGROOT.date("Y"),0777);
	}
	if(!is_dir($IMGROOT.date("Y").'/'.date("m"))){
		mkdir($IMGROOT.date("Y").'/'.date("m"),0777);
	}
	$thistime=date("dHis");
	//上传图片
	$ImagePath=date("Y").'/'.date("m").'/';
	
	$name=$_FILES['file']['name'];
	$location=$IMGROOT.$ImagePath.$thistime.'-'.$name; 
	$ImagePath=$IMGURL.$ImagePath.$thistime.'-'.$name;
	move_uploaded_file($_FILES['file']['tmp_name'],$location); 
}else {
	$ImagePath='';
}
//检查是否为新增新闻类型
if($ExistClass=="yes"){$Class=$OldClass;}else{$Class=$NewClass;}
//替换掉回车和空格，以便在html文件中正常显示
//$Body=ereg_replace(" ","&nbsp;",$Body);
//$Body=ereg_replace("\n","<br>",$Body);
//添加记录
$thistime=date("Y-m-d H:i:s");

$query=array();
$isQuerySuccessful=mysql_query("begin");
if ($isQuerySuccessful) {
$isQuerySuccessful=mysql_query("insert into News_TB (Class,PostDate,Important,Poster,Title,Body,ImagePath) values ('$Class','$thistime','$Important','{$_SESSION['AdminID']}','$Title','$Body','$ImagePath')");
}
$AutoID=0;
if ( ($isQuerySuccessful) && (isset($_REQUEST['ShowOnVPNClient'])) && ($_REQUEST['ShowOnVPNClient']=="Y") ) {
	$isQuerySuccessful=false;
	$result=mysql_query("select AutoID from News_TB order by AutoID desc limit 1");
	$row=mysql_fetch_array($result);
	if ($row){
		$AutoID=$row['AutoID'];
		$isQuerySuccessful=true;
	}
}
if ($AutoID!=0){
	$isQuerySuccessful=mysql_query("insert into PersonalVPN_ClientNews_TB(NewsID) values ({$AutoID})");
}

if ($isQuerySuccessful) {
	$isQuerySuccessful=mysql_query("commit");
}

if ($isQuerySuccessful) {
$temp=preg_replace("/,/","，",$Title);
mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} 添加了标题为 {$temp} 的新闻 ','{$_SERVER['REMOTE_ADDR']}','News', NOW()) ", $conn);
?>
<BR>新闻成功添加完毕！<BR><BR>
<?
} else {
	mysql_query("rollback");
?>
数据库操作失败，请联络管理员。
<?
}

}  else {
?>
<form name="form1" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
<table border=1>
<tr><td>新闻类型：原有新闻类型<input type="radio" name="ExistClass" value="yes" checked><select name="OldClass">
	<?
	$rst=mysql_query("select Class from News_TB group by Class");
	while($row=mysql_fetch_row($rst)){
	echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
	?>
	</select><br>