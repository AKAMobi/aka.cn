<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewUserOnLine.php" class="a5">�쿴�����û�</a>
				<br>
                <br>
                <span class="newstitle">�����û��б�</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��½</a>��
<?
}else {

if ( (!isset($_SESSION['PersonalVPNAdmin'])) ) {
?>
��û��PersonalVPN�����Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">����˵�</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
if ( $_POST["CleanDB"] ){
	mysql_query("delete from PersonalVPN_UserOnLine_TB");
}
$result=mysql_query("select DATE_FORMAT(A.LogOnTime,'%Y-%m-%d %H:%i:%s') as LogOnTime, B.ID as ID, B.UserName as UserName, B.Company as Company, B.TelephoneNumber as TelephoneNumber, B.MobilePhone as MobilePhone, B.EMail as EMail, B.Address as Address , B.Status as Status , B.UserFunc as UserFunc , B.UserFuncStatus as UserFuncStatus, B.AutoID as AutoID from PersonalVPN_UserOnLine_TB as A, User_TB as B where A.UserAutoID=B.AutoID order by B.ID", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
�޴������û���<br>
<?
} else {
?>
Ŀǰ����<font color="#ff3247"><?echo mysql_num_rows($result) ?></font>���û�����.<br>
<div align="center">
<table border="yes" >
		<tr>
		<td align="center">�˺�</td>
		<td align="center">����</td>
		<td align="center">����ʱ��</td>
		<td align="center">VPN����</td>
		<td align="center">��ϸ����</td>
		</tr>
<?
	while($row=mysql_fetch_array($result)){
?>

		<tr>
		<td><? echo $row['ID'] ?> </td>
		<td><? echo $row['UserName'] ?> </td>
		<td><? echo $row['LogOnTime'] ?> </td>
		<td><? echo $row['UserFunc'] ?> </td>
		<td ><a href="<? echo $ADMINURLROOT; ?>/UserAccount/ViewUserProfile.php?ID=<? echo $row['ID'] ?>"  target="_blank"><span id="o<? echo $row['AutoID'] ?>" class="a6">�쿴</span></a>
<? 
/*
<!---------------------------------------------------------------------------->
<!-- TOOLTIP (Use conditional comments to hide from non-behavior browsers) --->
<!---------------------------------------------------------------------------->

<!--[if gte IE 5]><tool:tip element="o<? echo $row[1] ?>" avoidmouse="false" style="width:310px;visibility: hidden">
<table>
<tr >
<td width="30%">�û�ID</td><td><? echo $row[1] ?></td>
</tr>
<tr>
<td>����</td><td><? echo $row['UserName'] ?></td>
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
<td>״̬</td><td><? echo $row['Status']?></td>
</tr>
<tr>
<td>ʹ�õĹ���</td><td><? echo (($row['UserFunc']=="")?"��":$row['UserFunc']) ?></td>
</tr>
<tr>
<td>ʹ�ù��ܵ�״̬</td><td><? echo (($row['UserFuncStatus']=="")?"��":$row['UserFuncStatus']) ?></td>
</tr>
</table>
</tool:tip><![endif]-->
*/
?>
</tr>

<?
	}
?>
</table>

</div>
<?
}
}
}
?>
</td></tr></table>
<br>
<center><form method=post><input type=submit value="��ռ�¼" name="CleanDB"></form></center>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
