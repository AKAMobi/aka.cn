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
if ( (!isset($_REQUEST['u']) ) ) {
?>
请指定用户ID<br>
<?
}else {
?>
<br><br><br>

<p align=center>您可以用几乎所有的支持网上支付的储蓄卡/信用卡进行支付，包括国际信用卡。</p>
<center>
<form action="prepare.php" name=form method=post>
请输入金额：<br>
Please input the amount:<p>
<input type=text name=MoneyCount size=4><br>(人民币支付单位为人民币，US$ pay unit is US$)<p>
<input type=radio name=MoneyType value=0 checked>人民币支付<br>  <input type=radio name=MoneyType value=1>US$ Pay US$<p>
<input type=hidden name=UserID value=<?=$_REQUEST['u']?>>

<input type=submit name=submit value='去银行付款 Go to pay it!'>
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
