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
$sub1=$_REQUEST['sub1'];
if($sub1=="Add"){
$files=$_REQUEST['files'];
$ExistClass=$_REQUEST['ExistClass'];
$OldClass=$_REQUEST['OldClass'];
$NewClass=$_REQUEST['NewClass'];
$Body=$_REQUEST['Body'];
$Title=$_REQUEST['Title'];
$Important=$_REQUEST['Important'];

//�ж��Ƿ���ͼƬ�ϴ����������ϴ�ͼƬ����Ŀ¼
if(is_uploaded_file($_FILES['file']['tmp_name'])){
	if(!is_dir($IMGROOT.date("Y"))){
		mkdir($IMGROOT.date("Y"),0777);
	}
	if(!is_dir($IMGROOT.date("Y").'/'.date("m"))){
		mkdir($IMGROOT.date("Y").'/'.date("m"),0777);
	}
	$thistime=date("dHis");
	//�ϴ�ͼƬ
	$ImagePath=date("Y").'/'.date("m").'/';
	
	$name=$_FILES['file']['name'];
	$location=$IMGROOT.$ImagePath.$thistime.'-'.$name; 
	$ImagePath=$IMGURL.$ImagePath.$thistime.'-'.$name;
	move_uploaded_file($_FILES['file']['tmp_name'],$location); 
}else {
	$ImagePath='';
}
//����Ƿ�Ϊ������������
if($ExistClass=="yes"){$Class=$OldClass;}else{$Class=$NewClass;}
//�滻���س��Ϳո��Ա���html�ļ���������ʾ
//$Body=ereg_replace(" ","&nbsp;",$Body);
//$Body=ereg_replace("\n","<br>",$Body);
//��Ӽ�¼
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
$temp=preg_replace("/,/","��",$Title);
mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} ����˱���Ϊ {$temp} ������ ','{$_SERVER['REMOTE_ADDR']}','News', NOW()) ", $conn);
?>
<BR>���ųɹ������ϣ�<BR><BR>
<?
} else {
	mysql_query("rollback");
?>
���ݿ����ʧ�ܣ����������Ա��
<?
}

}  else {
?>
<form name="form1" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
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
<tr><td>�Ƿ���Ҫ�ڸ���VPN�ͻ�����ʾ��<input type="radio" name="ShowOnVPNClient" value="N" checked>��<input type="radio" name="ShowOnVPNClient" value="Y">��</td></tr>
<tr><td>ѡ��ͼƬ�ϴ���<input type=file name=file size=20></td></tr>
<tr><td>������Ŀ<input type="text" name="Title" size=70></td></tr>
<tr><td>��������<textarea name="Body" wrap="VIRTUAL" cols="70" rows="20"></textarea></td></tr>
<tr><td><input type="submit" name="sub1" value="Add"></td></tr>
</table>
</form>

<?
}
}
}
?>
</div>
</body>
</html>

