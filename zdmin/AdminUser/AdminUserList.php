<? session_start() ?>
<link rel="stylesheet" href="/css/aka.css" type="text/css"> 
<DIV align="center">
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
?>
<SCRIPT language="JScript">
var isAdminIDAsc=false;
var isPrivilegeAsc=false;

function sortOnAdminID(){
	if (isAdminIDAsc) {
		isAdminIDAsc=false;
		AdminList.sort="-adminID";
	} else {
		isAdminIDAsc=true;
		AdminList.sort="+adminID";
	}
	AdminList.Reset();
}


function sortPrivilegeType(){
	if (isPrivilegeAsc) {
		isPrivilegeAsc=false;
		AdminList.sort="-logType";
	} else {
		isPrivilegeAsc=true;
		AdminList.sort="+logType";
	}
	AdminList.Reset();
}


</script>
<OBJECT id="AdminList" CLASSID="clsid:333C7BC4-460F-11D0-BC04-0080C7055A83">
	<PARAM NAME="DataURL" VALUE="<? echo $ADMINURLROOT ; ?>/AdminUser/AdminUserListContent.php">
	<PARAM NAME="UseHeader" VALUE="True">
	<PARAM NAME="CHARSET" VALUE="GB2312">
</OBJECT>
<TABLE border="0" width="530" datasrc="#AdminList">
<thead>
<th onclick="return sortOnAdminID();">����Ա</th>
<th >����</th>
<th onclick="return sortOnLogTime();">Ȩ��</th>
<th >�޸�����</th>
<th >�޸�����/Ȩ��</th>
<th >ɾ�����˺�</th>
</thead>
<tbody>
<tr>
<td align="center"><SPAN datafld="adminID"></span></td>
<td align="center"><SPAN datafld="Name"></span></td>
<td align="center"><SPAN datafld="Privilege"></span></td>
<td align="center"><A datafld="modifyPasswordURL" class="a6">�޸�����</a></td>
<td align="center"><a datafld="modifyPrivilegeURL" class="a6">�޸�����/Ȩ��</a></td>
<td align="center"><a datafld="deleteAdminURL" class="a6">ɾ�����˺�</a></td>
</tr>
</tbody>
</table>

<?	
}
}
?>
</div>
