<? session_start(); ?>
<? 
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<object id=oClose type="application/x-oleobject"
classid="clsid:adb880a6-d8ff-11cf-9377-00aa003b7a11">
<param name="Command" value="Close"></object>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/FindUser.php" class="a5">�����û�</a><br>
          <br>
          <span class="newstitle">�û���Ϣ</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

if ( (!isset($_SESSION['AdminID']))  || (!isset($HTTP_GET_VARS['ID']))   ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��¼</a>��
<?
}else {

if ( (!isset($_SESSION['PersonalVPNAdmin'])) && (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
��û�в쿴�û���Ϣ��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {


require "{$ADMINROOT}/Include/InitDB.php"; 

$result=mysql_query("select * from User_TB where ID='{$_REQUEST['ID']}'"); 
if ( !($row=mysql_fetch_array($result)) ){ //�޴��û�
?>
	�޴��û�������������û�ID�Ƿ���ȷ��
	<a onclick="history.back();">����</a>
<?
} else {
?>
<table>
<tr>
<td>�û�ID</td><td><? echo $row['ID'] ?></td>
</tr>
<tr>
<td>����</td><td><? echo $row['UserName'] ?></td>
</tr>
<tr>
<td>���֤��</td><td><? echo $row['IdentifierNum']?></td>
</tr>
<tr>
<td>������λ</td><td><? echo $row['Company']?></td>
</tr>
<tr>
<td>�绰</td><td><? echo $row['TelephoneNumber']?></td>
</tr>
<tr>
<td>�ֻ�</td><td><? echo $row['MobilePhone']?></td>
</tr>
<tr>
<td>E-Mail</td><td><? echo $row['EMail']?></td>
</tr>
<tr>
<td>��ַ</td><td><? echo $row['Address']?></td>
</tr>
<tr>
<td>�ʱ�</td><td><? echo $row['ZipCode']?></td>
</tr>
<tr>
<td>״̬</td><td><? echo $row['Status']?></td>
</tr>
<tr>
<td>ʹ�õĹ���</td><td><? echo (($row['UserFunc']=="")?"��":$row['UserFunc']) ?></td>
</tr>
<tr>
<td>ʹ�ù��ܵ�״̬</td><td><? echo (($row['UserFunc']=="")?"��":$row['UserFunc']) ?></td>
</tr>

</table>
<br>
<?
if ( (isset($_SESSION['UserAccountAdmin'])) )  {
$_SESSION['UserID']=$_REQUEST['ID'];
?>
<input type="button" value="�Ը��û�����ݵ�¼" onclick="window.open('/my/');">
<br><br>
<input type="button" value="�޸ĸ��û���Ϣ" onclick="document.location.href='ModifyProfile.php?ID=<? echo $_REQUEST['ID']; ?>';">
<br><br>
<?
}
?>

<input type="button" value="�رմ���" onclick="oClose.Click();">
<br>
<?
}
}
}
?>
</td>
</tr>
</table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
