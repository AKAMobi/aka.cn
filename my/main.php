<?php
require_once( "header.inc.php" );
?>

<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550">
      <table width="501" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td valign="top"> 
            <p><br>
              <b><font color="#3366CC">��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> 
              <font color="#458DE4">&gt; </font><a href="/my/" class="a5">�ҵİ���</a></p>
            <table width="475" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="28" background="/serv_prod/images/bluegradient.gif" class="newstitle">�ҵİ���</td>
              </tr>
            </table>
<p><a href="news/2002-10-26.shtml" class=a6><font size=+2>����ֱͨ��2002��11��1����ʽ�շ�֪ͨ</font></a></p>
��ã�<?= $HTTP_SESSION_VARS['UserID'] ?>��
<?php
$result=mysql_query("select A.UserAccount as UserAccount, A.UserAccountUSD as UserAccountUSD from UserAccount_TB as A, User_TB as B where A.UserAutoID=B.AutoID and B.ID='{$HTTP_SESSION_VARS['UserID']}'");
if (!($row=mysql_fetch_array($result)) ){
?>
	���ݿ����ʧ�ܡ��������Ա��ϵ��
<?php
} else {
?>
����ǰ���ʻ�����<?=intval($row['UserAccount'])==-1?0.00:$row['UserAccount'] ?> ��
$<?=intval($row['UserAccountUSD'])==-1?0.00:$row['UserAccountUSD'] ?>.
<?php
}
?>
            <blockquote>&nbsp;</blockquote>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td valign="top" width=50%> 
                  <table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">������Ϣ</span></td>
                    <tr></table><p>
                  <blockquote> 
                    <p><a href="" class=a6>�޸ĸ������� &gt; </a></p>
                    <p><a href="ChangePassword.php" class=a6>�������� &gt; </a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">�ҵİ����ʽ��ʻ�</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="money/ShowAccount.php" class=a6>�쿴�˻���Ϣ 
                      &gt;</a></p>
                    <p><a href="money/netpay.php" class=a6>����֧�� 
                      &gt;</a></p>
                    <p><a href="money/MoneyTransfer.php" class=a6>ת�� 
                      &gt;</a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">�˳���¼</span></td>
                    </tr></table><p>
                  <blockquote> <a href="Logout.php" class=a6>�˳���½ 
                    &gt;</a> </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr><td background="/image/gradident_s.gif"><span class="newssubtitle">�ͻ�����</span></td></tr></table><p>
                  <blockquote> 
                    <p><a href="/customer/contact/index.shtml" class=a6> ��ϵ���� &gt;</a></p>
                    <p><a href="/customer/support/index.shtml" class=a6>����֧�� &gt;</a></p>
                    <p><a href="/customer/downloads/index.shtml" class=a6>����ר�� 
                      &gt;</a></p>
                    <p>&nbsp;</p>
                  </blockquote>
                  <p><span class="newssubtitle"><br>
                    <br>
                    </span></p>
            </td>
                <td valign="top"> 
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">������ҵ����VPN</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="/solution/vpn/edu/" class=a6 target=_blank>��ҵ����VPN���� 
                      &gt; </a></p>
                    <p><a href="javascript://" class=a6>��������ͳ�Ʊ��� &gt; </a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">�������˳���/�ع�ֱͨ��</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="personalvpn/UserFunction.php" class=a6>����/ȡ��ֱͨ������ 
                      &gt; </a></p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage.shtml" class=a6>ֱͨ��ʹ��˵�� 
                      &gt; </a> </p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage_vpn_step.shtml" class=a6>���ʹ�ð���ֱͨ��(VPN��) &gt;</a> 
                    </p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage_pro_step.shtml" class=a6>���ʹ�ð���ֱͨ��(Proxy��) &gt;</a> 
                    </p>
                  </blockquote>
                  <table border=0  cellspacing="0" cellpadding="0" width=230>
                    <tr> 
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">FAQר��</span></td>
                    </tr>
                  </table>
                  <p>
                  <blockquote> 
                    <p><a href="javascript://" class=a6>�ҵİ����������� 
                      &gt;</a></p>
                        <p><a href="/serv_prod/vpn/edu/personal/faq.shtml" class=a6>����ֱͨ���������� &gt;</a></p>
                    </blockquote>
                    <blockquote>&nbsp;</blockquote>
                  </blockquote>
                  <blockquote> 
                    <blockquote> 
                      <p>&nbsp;</p>
                    </blockquote>
                  </blockquote>
                  <p><span class="newssubtitle"></span></p>
                  <p>&nbsp;</p>
                </td>
              </tr>
            </table>
            <p>&nbsp;</p>
            </td>
        </tr>
      </table>
    </td>
    <td width="210" bgcolor="#F0FAFF" valign=top>
      <table width="210" border="0" cellspacing="8" cellpadding="3" dwcopytype="CopyTableRow">
        <tr> 
          <td colspan="2">&nbsp; </td>
        </tr>
        <tr> 
          <td colspan="2">&nbsp; </td>
        </tr>
        <tr bgcolor="C3D4F4"> 
          <td colspan="2"> 
            <div align="left"><b><font color="032B7A" face="Arial"> ��˾��Ϣ</font></b></div>
          </td>
        </tr>
        <tr> 
          <td width="27"> 
            <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"> 
            </div>
          </td>
          <td width="159"> 
            <p><a href="/company/about/index.shtml" class="a6">���ڰ���</a></a></p>
          </td>
        </tr>
        <tr> 
          <td width="27"> 
            <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"> 
            </div>
          </td>
          <td width="159"><a href="/company/about/companymilestones.shtml" class="a6">��������</a></td>

        </tr>
        <!-- tr> 
          <td bgcolor="C3D4F4" colspan="2"> 
            <div align="left"><font color="032B7A"><b><font face="Arial"> �����Ŷ�</font></b></font></div>
          </td>
        </tr>
        <tr> 
          <td> 
            <div align="right"><img src="../../image/leadarrow.gif" width="5" height="10"></div>
          </td>
          <td><a href="../mgmt/index.shtml" class="a6">���»�</a></td>
        </tr -->
      </table>
    </td>
  </tr>
</table>
<?
require_once( "footer.inc.php" );
?>
