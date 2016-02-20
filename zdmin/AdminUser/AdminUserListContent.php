<? session_start() ?>
<?
require_once("zdmin.inc.php");

if ( (!isset($_SESSION['AdminID'])) )
	exit(0);


if ( (!isset($_SESSION['AdminAdmin'])) )
	exit(0);
?>
adminID,Privilege,modifyPasswordURL,modifyPrivilegeURL,deleteAdminURL,Name
<?
require "{$ADMINROOT}/Include/InitDB.php"; 
$sql="select ID,FullName,Privilege from AdminUser_TB ";

$result=mysql_query($sql, $conn);
 
while($row=mysql_fetch_array($result)){
	if ($row['ID']==$SYSOPID) continue;
	$AdminAccountID=urlencode($row['ID']);
	$privilege=preg_replace("/,/","、",$row['Privilege']);
	echo "{$row['ID']},{$privilege},ChangeAdminPassword.php?AdminID={$AdminAccountID},ModifyPrivilege.php?AdminID={$AdminAccountID},DeleteAdmin.php?AdminID={$AdminAccountID},{$row['FullName']}\n";
}
?>
