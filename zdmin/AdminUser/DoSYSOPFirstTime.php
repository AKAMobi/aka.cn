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
          </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/SYSOPFirstTime.php" class="a5">�趨��߹���Ա����</a><br>
          <br>
          <span class="newstitle">�趨��߹���Ա����</span></p>
              <p>��������һ�ε�½��ϵͳ��</p>
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
if ( (!isset($_SESSION['AdminID'])) || (!isset($_REQUEST['NewPassword1'])) ){
?>
	<p>������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
} else {

if ($_SESSION['AdminID']!=$SYSOPID){
?>
��������߹���Ա��������<A HREF="<? echo $ADMINROOT; ?>/index.php">��¼</a>��
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$passwd=crypt($_REQUEST['NewPassword1']);
if (mysql_query("Insert into AdminUser_TB(ID,Password,FullName,Information,Privilege) values ( '{$SYSOPID}','{$passwd}','ϵͳ����Ա','ϵͳ��߹���Ա','') ")) {
	mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}',' ��߹���Ա {$_SESSION['AdminID']} ���˺Ž����ɹ�', '{$_SERVER['REMOTE_ADDR']}','Admin', NOW()) ", $conn);
?>
	��߹���Ա�˺� <? echo $SYSOPID; ?> �����趨�ɹ���<br>
	<A href="<? echo $ADMINURLROOT; ?>/AdminMenu.php">�������˵�</a>
<?
} else {
?>
	���ݿ����ʧ�ܻ򱾹���Ա�Ѵ��ڣ�������ϵͳά������Ա��<br>
	<A href="<? echo $ADMINURLROOT; ?>/SYSOPFirstTime.php">�����޸�����ҳ��</a>
<?
}

}
}
?>
<BR>
<BR>

</td></tr></table>

<?
// Closing connection
mysql_close($conn);

require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
