<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
修改管理员姓名/权限
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
你没有管理其他管理员的权限<br>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select Privilege,FullName from AdminUser_TB where ID='{$_REQUEST['AdminID']}'");

if (!($row=mysql_fetch_array($result))){//此管理员不存在
?>
管理员账号 <? echo $_REQUEST['AdminID'] ; ?> 不存在！
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
      <td>管理员：</td>
      <td><? echo $_REQUEST['AdminID']; ?></td>
    </tr>
    <tr>
      <td>姓名：</td>
      <td><input type="text" id="oAdminName" name="AdminName" size="20" value="<? echo $row['FullName']; ?>"></td>
    </tr>
    <tr>
      <td valign="top">权限：</td>
      <td align>
      <TABLE border="0">
      <tr><td><INPUT type="checkbox" <? echo in_array('UserAccount',$privileges)?'Checked':'' ;?> name="UserAccount">用户管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('News',$privileges)?'Checked':'' ;?> name="News">新闻管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('PersonalVPN',$privileges)?'Checked':'' ;?> name="PersonalVPN">个人VPN管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Money',$privileges)?'Checked':'' ;?> name="Money">用户资金管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Admin',$privileges)?'Checked':'' ;?> name="Admin">管理员账号管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('Log',$privileges)?'Checked':'' ;?> name="Log">日志管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('SMSChild',$privileges)?'Checked':'' ;?> name="SMSChild">短信客户管理</td></td>
      <tr><td><INPUT type="checkbox" <? echo in_array('SMSLog',$privileges)?'Checked':'' ;?> name="SMSLog">短信日志管理</td></td>
      </table> 
      </td>
    </tr>
   
    </table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oModifyPrivilege" value="修改" onclick="ModifyPrivilege();"> 
   </p>
</form>

<?	
}
}
}
?>
</div>
