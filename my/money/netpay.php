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
                </font><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
                </font><a href="/my/money/netpay.php" class="a5">����֧��</a>
				<br>
                <br>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($HTTP_SESSION_VARS['UserID']) ) ) {
?>
����δ��½��<br>
������<A HREF="/my/" class=a5>��½</a>��
<?
}else {
?>
<br><br><br>

<p align=center>�������ü������е�֧������֧���Ĵ��/���ÿ�����֧���������������ÿ���</p>
<center>
<!-- XXX
ϵͳά����...
-->
<form action="http://pay.aka.cn/prepare.php" name=form method=post>
����������ϣ��ת�롰�ҵİ����ʻ�����Ǯ����<p>
<input type=text name=MoneyCount size=4>Ԫ�����<p>
<input type=hidden name=MoneyType value=0>

<input type=submit name=submit value='ȥ���и���'>
</form>
</center>
<br><br><br>

<?
}
?>
</td></tr></table>
<br>


    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
<?
readfile( "tips.html" );
?>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" );
?>
