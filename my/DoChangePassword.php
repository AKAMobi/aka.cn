<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><font color="#458DE4"><a href="<? echo dirname($_SERVER['PHP_SELF']); ?>" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font></font><font class="a5"><a href="<? echo dirname($_SERVER['PHP_SELF']); ?>/ChangePassword.php" class="a5">�޸�����</a></font> 
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
if ( (!isset($HTTP_SESSION_VARS['UserID'])) || (!isset($HTTP_POST_VARS['Password']))
	|| (!isset($HTTP_POST_VARS['NewPassword1'])) ){
?>
	<p>������<A HREF="<? echo dirname($_SERVER['PHP_SELF']); ?>">��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
}

//require 'Include/InitDB.php';
$result=mysql_query("select * from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'");

if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
������<A HREF="index.php">��¼</a>
<?
}
else{
if (strcmp($HTTP_POST_VARS['Password'],$row["Password"])){//�������
?>
�������<br>
��<A href="ChangePassword.php" class=a5>����</a>������������
<?
}
else{//������¼
$enNewPasswd=$HTTP_POST_VARS['NewPassword1'];
if (mysql_query("Update User_TB Set Password='{$enNewPasswd}' where ID='{$HTTP_SESSION_VARS['UserID']}'")) {
?>
	�����޸ĳɹ���<br>
	<A href="<? echo dirname($_SERVER['PHP_SELF']); ?>" class=a5>�������˵�</a>
<?
if ((isset($_SESSION['AdminID'])) ){
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP,LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']} �޸��� {$_SESSION['UserID']} ������', '{$_SERVER['REMOTE_ADDR']}', 'UserAccount', NOW()) ", $conn);
}
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	<A href="ChangePassword.php" class=a5>�����޸�����ҳ��</a>
<?
}
}
}
?>
<BR>
</td></tr></table>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
<?
readfile( "tips.html" );
?>
</td></tr></table>

<?
require_once( "footer.inc.php" );
?>
