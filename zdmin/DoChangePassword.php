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
          </font><font color="#458DE4"><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt; 
          </font></font><a href="<? echo $ADMINURLROOT; ?>/ChangePassword.php" class="a5">�޸�����</a> 
          <br>
          <br>
        <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
  <br>
  <br>
  <br>
  <br>
<?
if ( (!isset($_SESSION['AdminID'])) || (!isset($_REQUEST['Password']))
	|| (!isset($_REQUEST['NewPassword1'])) ){
?>
	<p>������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	IncludeHTML("{$AKAROOT}/footer.html");
	die;
}

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select Password from AdminUser_TB where ID='{$_SESSION['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>
<?
}
else{
if (crypt($_REQUEST['Password'],$row["Password"])!=$row["Password"]){//�������
?>
�������<br>
��<A href="<? echo $ADMINURLROOT; ?>/ChangePassword.php">����</a>������������
<?
}
else{//������¼
$passwd=crypt($_REQUEST['NewPassword1']);
if (mysql_query("Update AdminUser_TB Set Password='{$passwd}' where ID='{$_SESSION['AdminID']}'")) {
?>
	�����޸ĳɹ���<br>
	<A href="<? echo $ADMINURLROOT; ?>/AdminMenu.php">�������˵�</a>
<?
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	<A href="<? echo $ADMINURLROOT; ?>/ChangePassword.php">�����޸�����ҳ��</a>
<?
}
}
}
?>
<BR>
</td></tr></table>

<?
mysql_free_result($result);

// Closing connection
mysql_close($conn);

require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
