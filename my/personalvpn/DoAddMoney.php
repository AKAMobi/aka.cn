<?
require_once ("header.inc.php");
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
          </font><font color="#458DE4"><a href="/PersonalVPN/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font><a href="/PersonalVPN/UserMenu.php" class="a5">�û��˵�</a> <font color="#458DE4">&gt; 
          </font></font><a href="/PersonalVPN/AddMoney.php" class="a5">�û���Ǯ</a> 
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
if ( (!isset($HTTP_SESSION_VARS['UserID'])) || (!isset($HTTP_POST_VARS['OperTime']))
	|| (!isset($HTTP_POST_VARS['Money'])) || (!isset($HTTP_POST_VARS['OperNumber'])) ){
?>
	<p>������<A HREF="index.php">��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	IncludeHTML("../footer.html");
	die;
}

require_once ("db.inc.php");
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");
$result=mysql_query("select AutoID from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'");

if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
������<A HREF="index.php">��¼</a>
<?
}
else{
if (mysql_query("insert into UserAddMoney_TB(AutoID, UserAutoID, OperateTime, Money, OperateNumber, LogTime,Status) values (NULL, {$row['AutoID']}, '{$HTTP_POST_VARS['OperTime']}', {$HTTP_POST_VARS['Money']},'{$HTTP_POST_VARS['OperNumber']}',Now(),'Submitting')")) {
?>
	��Ǯ��Ϣ�ѳɹ��ύ��<br>
	<A href="UserMenu.php">�������˵�</a>
<?
} else {
?>
	���ݿ����ʧ�ܣ����������Ա��<br>
	����<A href="AddMoney.php">��Ǯҳ��</a>
<?
}
}
?>
<BR>
</td></tr></table>

<?
require_once ("footer.inc.php");
?>
