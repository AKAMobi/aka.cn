<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ModifyProfile.php" class="a5">�޸��û���Ϣ</a><br>
          <br>
          <span class="newstitle">�޸��û���Ϣ</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">


<?

if ( (!isset($_SESSION['AdminID']))  || (!isset($_REQUEST['ID']))   ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��¼</a>��
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
��û���޸��û���Ϣ��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {
	
if ( (!isset($_REQUEST['ID'])) || 
	(!isset($_REQUEST['UserName'])) ||
	(!isset($_REQUEST['Password'])) ||
	(!isset($_REQUEST['IdNum'])) ||
	(!isset($_REQUEST['Company'])) ||
	(!isset($_REQUEST['Tel'])) ||
	(!isset($_REQUEST['Mobile'])) ||
	(!isset($_REQUEST['EMail'])) ||
	(!isset($_REQUEST['Address'])) ||
	(!isset($_REQUEST['ZipCode'])) ){

?>
	�ύ����Ϣ��ȫ<br>
	�뷵�����ԡ�<br><input type="button" onclick="history.back();" value="����">
<?
} else {
$UserID=$_REQUEST['ID'];
	
require_once("{$ADMINROOT}/Include/InitDB.php"); 
	

$result=mysql_query("select * from User_TB where ID='{$UserID}'");

if (!($row=mysql_fetch_array($result))){//��ID������

?>

��ID�����ڣ�<BR>
�뷵�����ԡ�<br><input type="button" onclick="history.back();" value="����">

	<br>
	<br>
<?
} else{

$query=array();
$query[]="begin";
$sql="Update User_TB Set UserName='{$_REQUEST['UserName']}'," .
  "IdentifierNum='{$_REQUEST['IdNum']}',Company='{$_REQUEST['Company']}',".
  "TelephoneNumber='{$_REQUEST['Tel']}',MobilePhone='{$_REQUEST['Mobile']}'," .
  "EMail='{$_REQUEST['EMail']}',Address='{$_REQUEST['Address']}',ZipCode='{$_REQUEST['ZipCode']}' ";
if ($_REQUEST['Password']!='') {
	$sql = $sql . " , Password='{$_REQUEST['Password']} ' ";
}
$query[]= $sql .  "where ID='{$UserID}'";
$query[]="commit";

$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		break;
	}
}
if (!$success){
?>
�û���Ϣ�޸�ʧ�ܡ�<BR>
���³����ύ������������ɣ���ֱ�������Ա��ϵ��<br>
<?
} else {
?>
�û���Ϣ�ѳɹ��޸ġ�<BR>
<?
}
}
}
}
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
