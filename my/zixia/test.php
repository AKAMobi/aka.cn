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
          </font><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font><a href="/my/main.php" class="a5">�û��˵�</a><br>
          <br>
          <span class="newstitle">�޸�ע����Ϣ</span></p>
              <p>��ԭ����д��ע�ᵥ��Ϣ��������ϸ��鲢������дע����Ϣ</p>
		<p>������Ϣ������ȷ����ϸ����д����*�ŵ�����������д�������޷�ͨ��ע��������лл������</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?

require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");

$result=mysql_query("select * from User_TB u left join tmp t on u.AutoID=t.UserAutoID where t.UserAutoID in( u.AutoID) limit 50" );
$HTTP_SESSION_VARS['DoModifyRegister']=$HTTP_SESSION_VARS['ModifyRegister'];
unset($HTTP_SESSION_VARS['ModifyRegister']);
$n = 0;
while ( $row=mysql_fetch_array($result) ){ 
?>
<div align="center">
<form name="RegisterForm" method="post" action="DoModifyProfile.php">
    <table width="75%" >
      <tr> 
        <td width="17%">ID <?= ++$n ?></td>
        <td width="83%"><? echo $row[1] ?></td>
      </tr>
      <tr> 
        <td>����</td>
        <td><? echo $row['UserName'] ?></td>
      </tr>
      <tr> 
        <td>���֤��</td>
        <td><? echo $row['IdentifierNum'] ?></td>
      </tr>
      <tr> 
        <td>��λ����</td>
        <td><? echo $row[5] ?></td>
      </tr>
      <tr> 
        <td>��ϵ�绰</td>
        <td><? echo $row[6] ?></td>
      </tr>
      <tr> 
        <td>�ֻ�</td>
        <td><? echo $row[7] ?></td>
      </tr>
      <tr> 
        <td>��������</td>
        <td><? echo $row[8] ?></td>
      </tr>
  <tr>
    <td>��ַ</td>
    <td>
 <? echo $row[9] ?>"</td></tr>
  <tr>
    <td>�ʱ�</td>
    <td>
 <? echo $row[10] ?></td></tr>
    </table>
  </form>
<hr>

</div>
<?
}
?>
</td>
</tr>
</table>
<br>
<?
require_once("footer.inc.php");
?>
