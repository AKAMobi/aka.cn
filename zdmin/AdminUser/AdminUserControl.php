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
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminUser/AdminUserControl.php" class="a5">����Ա�˺Ź���</a>
				<br>
                <br>
                <span class="newstitle">����Ա�˺Ź���</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
 <table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr> 
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
 <td align="center" >
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��½</a>��
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
��û�й�����������Ա�˺ŵ�Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">����˵�</a>
<?
} else {

?>
<TD width="550" >
<TABLE width="550" border="1" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<TABLE border="0">
<tr>
<td >
<INPUT type="button" value="��ǰ����Ա�˺��б�" onclick="return document.frames('IMainFrame').document.location.href='AdminUserList.php';">
</td>
<td >
<INPUT type="button" value="����¹���Ա�˺�" onclick="return document.frames('IMainFrame').document.location.href='AddAdmin.php';">
</td>
<tr>
</table>
</td>
</tr>
<tr>
<td>
<IFRAME ID="oMainFrame" name="IMainFrame" FRAMEBORDER="0" SCROLLING="AUTO" SRC="AdminUserList.php" width="550" height="450">
</IFRAME>
</td>
</tr>
</table>
</td>
<?
}
}
?>
</td></tr>
</table>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
