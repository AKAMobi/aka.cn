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
$result=mysql_query("select * from PersonalVPN_Investigate", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
�޴������û���<br>
<?
} else {
?>
Ŀǰ����<font color="#ff3247"><?echo mysql_num_rows($result) ?></font>���û��ĵ�������.<br>
<div align="center">

<?
	while($row=mysql_fetch_array($result)){
?>
<hr>
<table>
<tr >
<td width="30%">�û�ID</td><td><? echo $row['UserID'] ?></td>
</tr>
<tr>
<td>�շѺ��Ƿ����ʹ�ã�</td><td><? echo $row['ContinueUse'] ?></td>
</tr>
<tr>
<td>ϣ�������շѣ�</td><td><? echo $row['LikeMonthFeeType']?></td>
</tr>
<tr>
<td>ϣ���������շѣ�</td><td><? echo $row['LikeMinFeeType']?></td>
</tr>
<tr>
<td>��Ҫ�����շѷ�ʽ��</td><td><? echo $row['OtherFeeType']?></td>
</tr>
<tr>
<td>�ܽ��ܵİ����շ�����</td><td><? echo $row['MaxMonthFee']?></td>
</tr>
<tr>
<td>�ܽ��ܵİ������շ�����</td><td><? echo $row['MaxMinFee']?></td>
</tr>
<tr>
<td>�ܽ��ܵ������շ�����</td><td><? echo $row['MaxOtherFee']?></td>
</tr>
<tr>
<td>����İ����շ�����</td><td><? echo $row['FavoriteMonthFee']?></td>
</tr>
<tr>
<td>����İ������շ�����</td><td><? echo $row['FavoriteMinFee']?></td>
</tr>
<tr>
<td>����������շ�����</td><td><? echo $row['FavoriteOtherFee']?></td>
</tr>
<tr>
<td>֪����չ�����н�����</td><td><? echo $row['Known']?></td>
</tr>
<tr>
<td>Ը�������۴�����</td><td><? echo $row['Will']?></td>
</tr>

</table>
<?
	}
?>


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
