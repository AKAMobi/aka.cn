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
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="/my/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
                </font><a href="/my/money/netpay.php" class="a5">网上支付</a>
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
您尚未登陆。<br>
请首先<A HREF="/my/" class=a5>登陆</a>。
<?
}else {
?>
<br><br><br>

<p align=center>您可以用几乎所有的支持网上支付的储蓄卡/信用卡进行支付，包括国际信用卡。</p>
<center>
<!-- XXX
系统维护中...
-->
<form action="http://pay.aka.cn/prepare.php" name=form method=post>
在下面输入希望转入“我的阿卡帐户”的钱数：<p>
<input type=text name=MoneyCount size=4>元人民币<p>
<input type=hidden name=MoneyType value=0>

<input type=submit name=submit value='去银行付款'>
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
