<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="/my/" class="a5">�ҵİ���</a> <font color="#458DE4">&gt; 
                </font><a href="/my/money/ShowAccount.php" class="a5">�쿴�˻���Ϣ</a>
                <br>
				<br>
                <span class="newstitle">�˻���Ϣ</span><br>
				<br>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($HTTP_SESSION_VARS['UserID'])) ){
?>
����δ��½��<br>
������<A HREF="/my/">��½</a>��
<?
}else {

$result=mysql_query("select A.UserAccount as UserAccount, A.UserAccountUSD from UserAccount_TB as A, User_TB as B where A.UserAutoID=B.AutoID and B.ID='{$HTTP_SESSION_VARS['UserID']}'");
if (!($row=mysql_fetch_array($result)) ){
?>
	���ݿ����ʧ�ܡ��������Ա��ϵ��
<?
} else {
?>
�û�<? echo $HTTP_SESSION_VARS['UserID'] ?>���˻����Ϊ��<br>
����ң�<? echo "��" . (intval($row['UserAccount'])==-1?0.00:$row['UserAccount']); ?><br>
��Ԫ��<? echo "$" . (intval($row['UserAccountUSD'])==-1?0.00:$row['UserAccountUSD']); ?><br>
<br>
<div align="Center">
<strong><font size="+1">������������˻��ʽ��������</font></strong><br>
<br> 
</div>
<table id="oTable" width="500">
<thead>
<tr>
<th id="oTime" width="90">ʱ��</th>
<th id="oIncoming" width="55">������</th>
<th id="oOutcoming" width="55">�������</th>
<th id="oBalance" width="50">���</th>
<th id="oNotes">����</th>
</tr>
</thead>
</table>
<iframe src="ShowAccountInside.php" style="width:540;height:300;">
	����������汾̫�ͣ���ʹ��5.5���ϰ汾��IE���ʱ�վ
</iframe>

<br>
<br>
<?
}
}
?>
</td></tr></table>


    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
<?
readfile( "tips.html" );
?>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" )
?>
