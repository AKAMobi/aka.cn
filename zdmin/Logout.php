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
                </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/Logout.php" class="a5">�˳���¼</a>
				<br>
                <br>
                <span class="newstitle">�˳���¼</span></p>
              <p>�������˳���¼ҳ�档</p>
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
unset($_SESSION['AdminID']);
unset($_SESSION['NewsAdmin']);
unset($_SESSION['UserAccountAdmin']);
unset($_SESSION['PersonalVPNAdmin']);
unset($_SESSION['LogAdmin']);
unset($_SESSION['AdminAdmin']);
unset($_SESSION['MoneyAdmin']);


session_unset();

session_destroy(); 
?>
���Ѿ��ɹ����˳���¼!
<?
}
?>
</td></tr></table>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
      <table width="210" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="120">&nbsp;</td>
        </tr>
        <tr> 
          <td>
            <table width="210" cellspacing="8" cellpadding="3">
              <tr> 
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">�������</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../serv_prod/index.shtml" class="a6">��Ʒ�����</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">�ͻ�����</a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?
IncludeHTML("{$AKAROOT}/footer.html");
?>
