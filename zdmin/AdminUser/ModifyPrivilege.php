<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
�޸Ĺ���Ա����/Ȩ��
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
��û�й�����������Ա��Ȩ��<br>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select Privilege,FullName from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//�˹���Ա������
?>
����Ա�˺� <? echo $_REQUEST['AdminID'] ; ?> �����ڣ�
<?
}else {
$privileges=explode(",",$row['Privilege']);
?>
<SCRIPT language="JScript">
function ModifyPrivilege(){
	mainForm.submit();
}
</Script>
<form id="mainForm" method="POST" action="DoModifyPrivilege.php">
<INPUT type="hidden" name="AdminID" value="<? echo $_REQUEST['AdminID']; ?>">
                      <br>
  <div align="center"><table border="0" >
    <tr>
      <td>����Ա��</td>
      <td><? echo $_REQUEST['AdminID']; ?></td>
    </tr>
    <tr>
      <td>������</td>
      <td><input type="text" id="oAdminName" name="AdminName" size="20" value="<? echo $row['FullName']; ?>"></td>
    </tr>
    <tr>
      <td valign="top">Ȩ�ޣ�</td>
      <td align>
      <TABLE border="0">
      <tr><td><INPUT type="checkbox" <? echo in_array('UserAccount',$privileges)?'Checked':'' ;?> name="UserAccount">�û�����</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('News',$privileges)?'Checked':'' ;?> name="News">���Ź���</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('PersonalVPN',$privileges)?'Checked':'' ;?> name="PersonalVPN">����VPN����</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Money',$privileges)?'Checked':'' ;?> name="Money">�û��ʽ����</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Admin',$privileges)?'Checked':'' ;?> name="Admin">����Ա�˺Ź���</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Log',$privileges)?'Checked':'' ;?> name="Log">��־����</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('SMSChild',$privileges)?'Checked':'' ;?> name="SMSChild">���ſͻ�����</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('SMSLog',$privileges)?'Checked':'' ;?> name="SMSLog">������־����</td></td>
      </table> 
      </td>
    </tr>
   
    </table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oModifyPrivilege" value="�޸�" onclick="ModifyPrivilege();"> 
   </p>
</form>

<?	
}
}
}
?>
</div>
