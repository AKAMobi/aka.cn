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
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ApproveUserValidate.php" class="a5">�����ֻ���֤�û�</a>
				<br>
                <br>
                <span class="newstitle">�����û�ע�ᵥ</span></p>
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
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��½</a>��
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
��û���û��ʻ������Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select A.AutoID,A.ID,A.UserName,A.TelephoneNumber,A.MobilePhone from User_TB as A, UserValidate_TB as B  where B.validated='Y' and A.AutoID=B.UserAutoID", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
�޴������û���<br>
<?
} else {
?>
<div align="center">
<form name="RegisterForm" method="post" action="DoApproveUserValidate.php">
<table border="yes" >
		<tr>
		<td align="center">�˺�</td>
		<td align="center">����</td>
		<td align="center">�绰����</td>
		<td align="center">�ֻ�����</td>
		<td align="center">��ϸ����</td>
		<td align="center">ͨ��ע��</td>
		<td align="center">�ܾ�ע��</td>
		</tr>
<?
	while($row=mysql_fetch_array($result)){
?>

		<tr>
		<td><? echo $row['ID'] ?> </td>
		<td><? echo $row['UserName'] ?> </td>
		<td><? echo $row['TelephoneNumber'] ?> </td>
		<td><? echo $row['MobilePhone'] ?> </td>
		<td><a href="ViewUserProfile.php?ID=<? echo $row['ID'] ?>"  class=a6 target="_blank">�쿴</a></td>
		<input type="hidden" ID="oUser<?echo $row['AutoID']?>" name="User<? echo $row['AutoID']?>" value="none">
		<td><INPUT TYPE="checkbox" ID="oAgree<?echo $row['AutoID']?>" onclick="oDisAgree<? echo $row['AutoID']?>.checked=false;oUser<?echo $row['AutoID']?>.value=oAgree<?echo $row['AutoID']?>.checked?'Approve':'none';"></td>
		<td><INPUT TYPE="checkbox" ID="oDisAgree<? echo $row['AutoID']?>" onclick="oAgree<? echo $row['AutoID']?>.checked=false;oUser<?echo $row['AutoID']?>.value=oDisAgree<? echo $row['AutoID']?>.checked?'Deny':'none';"></td>
		
		</tr>
<?
	}
?>
</table>
<br>
	<input type="submit" value="�ύ">
<br>
</form>
</div>
<?
}
}
}
?>
</td></tr></table>

<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>

