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
                </font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/ApproveUser.php" class="a5">�����û�</a>
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

// Roy ,Ϊ���Сľ��
$result=mysql_query("select AutoID from User_TB where ID='emuch'");
if ( ! ($row=mysql_fetch_array($result))) {
?>
	����!�Ҳ��������ͬѧ���˺�!
<?
	exit(0);
} else {
	$SuperUserID=$row['AutoID'];
}
// ---- end




$result=mysql_query("select ID,AutoID,SuperiorUserAutoID from User_TB where Status='ProfileNotProved'", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
�޴�ע���û���<br>
<?
} else {
	while($row=mysql_fetch_array($result)){
		$UserID="User{$row['AutoID']}";
		if (isset($_REQUEST[$UserID]) ){
			if ($_REQUEST[$UserID]=="Approve") {
				if (!mysql_query("begin",$conn)) 
					continue;
				if ($row['SuperiorUserAutoID']==$SuperUserID) { //�����ͬѧ���û�

					if (!mysql_query("update User_TB set Status='Normal',UserFunc='PersonalHourVPN' where AutoID='{$row['AutoID']}'", $conn)) {
						echo "�û�{$row[0]}״̬�޸�ʧ��";
						mysql_query("rollback",$conn);
						continue;
					}
					mysql_query("insert into UserAccount_TB(UserAutoID, UserAccount,AccountEnable) values ({$row['AutoID']},1,'Y')", $conn);
				} else {
				if (!mysql_query("update User_TB set Status='Normal' where AutoID='{$row['AutoID']}'", $conn)) {
					echo "�û�{$row[0]}״̬�޸�ʧ��";
					mysql_query("rollback",$conn);
					continue;
				}
				if (!mysql_query("insert into UserAccount_TB(UserAutoID, UserAccount,AccountEnable) values ({$row['AutoID']},0,'N')", $conn)) {
//					echo "�û�{$row['ID']}�˻�����ʧ��";
// by zixia for 2002.11.1 �û�����ע��					mysql_query("rollback",$conn);
// ͬ��					continue;
				}
				}
				if (!mysql_query("insert into UserActive_TB(UserAutoID,LastActiveTime) values ({$row['AutoID']},now())", $conn)) {
// by zixia for 11.1					echo "�û�{$row['ID']}���¼����ʧ��";
// ͬ��					mysql_query("rollback",$conn);
// ͬ��					continue;
				}
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  ͨ���ˡ�{$row['ID']} ��ע������', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
				
				mysql_query("commit",$conn);
				continue;
			}
			if ($_REQUEST[$UserID]=="Deny") {
				mysql_query("begin",$conn);
				mysql_query("update User_TB set Status='RegisterFailed' where ID='{$row[0]}'", $conn);
				mysql_query("insert into AdminUser_Log_TB(AutoID, AdminID,Content,ClientIP, LogType, LogTime) values (NULL,'{$_SESSION['AdminID']}','{$_SESSION['AdminID']}  �ܾ��ˡ�{$row['ID']} ��ע������', '{$_SERVER['REMOTE_ADDR']}','UserAccount', NOW()) ", $conn);
				mysql_query("commit",$conn);
				continue;
			}
		}
	}
	
?>
	ע�ᵥ������ϡ�
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

