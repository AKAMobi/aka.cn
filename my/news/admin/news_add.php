<?
session_start();
require_once("../header.inc.php");
echo '<link rel="stylesheet" href="../font.css" type="text/css">';
$sub1=$HTTP_POST_VARS['sub1'];
if($sub1=="添加"){
$files=$HTTP_POST_FILES['files'];
$ExistClass=$HTTP_POST_VARS['ExistClass'];
$OldClass=$HTTP_POST_VARS['OldClass'];
$NewClass=$HTTP_POST_VARS['NewClass'];
$Body=$HTTP_POST_VARS['Body'];
$Title=$HTTP_POST_VARS['Title'];
//判断是否有图片上传，并建立上传图片所需目录
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
//上传图片
$ImagePath=$IMGROOT.date("Y").'/'.date("m").'/';
foreach ($files['name'] as $key=>$name) { //这里可以检查上传文件的大小和扩展名(jpg.gif.bmp.png等)
    if ($files['size'][$key]) { 
       $location=$ImagePath.$thistime.'-'.$name; 
	   $ImagePath=$name;
       copy($files['tmp_name'][$key],$location); 
       unlink($files['tmp_name'][$key]); 
    }
}
//$ImagePath=$name;
}else $ImagePath='';
//检查是否为新增新闻类型
if($ExistClass=="yes"){$Class=$OldClass;}else{$Class=$NewClass;}
//替换掉回车和空格，以便在html文件中正常显示
//$Body=ereg_replace(" ","&nbsp;",$Body);
//$Body=ereg_replace("\n","<br>",$Body);
$Body=htmlspecialchars( $Body );
//添加记录
$thistime=date("Y-m-d H:i:s");
mysql_query("insert into News_TB (Class,PostDate,Important,Poster,Title,Body,ImagePath) values ('$Class','$thistime','$Important','$AdminName','$Title','$Body','$ImagePath')");

echo '<script language="javascript">alert("新闻添加完毕!");top.location="update.php";</script>';

}
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
<table border=1>
<tr><td>新闻类型：原有新闻类型<input type="radio" name="ExistClass" value="yes" checked><select name="OldClass">
	<?
	$rst=mysql_query("select Class from News_TB group by Class");
	while($row=mysql_fetch_row($rst)){
	echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
	?>
	</select><br>