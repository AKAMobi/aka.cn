<?php
session_set_cookie_params( 0, "/", "aka.cn" );
session_start();

if ( 0==strlen($HTTP_SESSION_VARS['UserID']) ){
	Header( "Location: http://my.aka.cn/" );
}

require_once( "header.inc.php" );


?>

<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550">
      <table width="501" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td valign="top"> 
            <p><br>
              <b><font color="#3366CC">当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> 
              <font color="#458DE4">&gt; </font><a href="/my/" class="a5">我的阿卡</a></p>
            <table width="475" cellspacing="0" cellpadding="0">
              <tr> 
                <td height="28" background="/serv_prod/images/bluegradient.gif" class="newstitle">我的阿卡</td>
              </tr>
            </table>
<p><a href="news/2002-10-26.shtml" class=a6><font size=+2>阿卡直通车2002年11月1日正式收费通知</font></a></p>
你好，<?= $HTTP_SESSION_VARS['UserID'] ?>，
<?php
$result=mysql_query("select A.UserAccount as UserAccount, A.UserAccountUSD as UserAccountUSD from UserAccount_TB as A, User_TB as B where A.UserAutoID=B.AutoID and B.ID='{$HTTP_SESSION_VARS['UserID']}'");
if (!($row=mysql_fetch_array($result)) ){
?>
	数据库操作失败。请与管理员联系。
<?php
} else {
?>
您当前的帐户余额：￥<?=intval($row['UserAccount'])==-1?0.00:$row['UserAccount'] ?> ，
$<?=intval($row['UserAccountUSD'])==-1?0.00:$row['UserAccountUSD'] ?>.
<?php
}
?>
            <blockquote>&nbsp;</blockquote>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td valign="top" width=50%> 
                  <table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">个人信息</span></td>
                    <tr></table><p>
                  <blockquote> 
                    <p><a href="" class=a6>修改个人资料 &gt; </a></p>
                    <p><a href="ChangePassword.php" class=a6>更改密码 &gt; </a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">我的阿卡资金帐户</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="money/ShowAccount.php" class=a6>察看账户信息 
                      &gt;</a></p>
                    <p><a href="money/netpay.php" class=a6>网上支付 
                      &gt;</a></p>
                    <p><a href="money/MoneyTransfer.php" class=a6>转账 
                      &gt;</a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">退出登录</span></td>
                    </tr></table><p>
                  <blockquote> <a href="Logout.php" class=a6>退出登陆 
                    &gt;</a> </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr><td background="/image/gradident_s.gif"><span class="newssubtitle">客户服务</span></td></tr></table><p>
                  <blockquote> 
                    <p><a href="/customer/contact/index.shtml" class=a6> 联系我们 &gt;</a></p>
                    <p><a href="/customer/support/index.shtml" class=a6>技术支持 &gt;</a></p>
                    <p><a href="/customer/downloads/index.shtml" class=a6>下载专区 
                      &gt;</a></p>
                    <p>&nbsp;</p>
                  </blockquote>
                  <p><span class="newssubtitle"><br>
                    <br>
                    </span></p>
            </td>
                <td valign="top"> 
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">阿卡企业出国VPN</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="/solution/vpn/edu/" class=a6 target=_blank>企业出国VPN介绍 
                      &gt; </a></p>
                    <p><a href="javascript://" class=a6>流量分析统计报表 &gt; </a></p>
                  </blockquote>
                  <p><table border=0  cellspacing="0" cellpadding="0" width=230><tr>
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">阿卡个人出国/回国直通车</span></td>
                    </tr></table><p>
                  <blockquote> 
                    <p><a href="personalvpn/UserFunction.php" class=a6>购买/取消直通车服务 
                      &gt; </a></p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage.shtml" class=a6>直通车使用说明 
                      &gt; </a> </p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage_vpn_step.shtml" class=a6>如何使用阿卡直通车(VPN版) &gt;</a> 
                    </p>
                    <p><a href="/serv_prod/vpn/edu/personal/usage_pro_step.shtml" class=a6>如何使用阿卡直通车(Proxy版) &gt;</a> 
                    </p>
                  </blockquote>
                  <table border=0  cellspacing="0" cellpadding="0" width=230>
                    <tr> 
                      <td background="/image/gradident_s.gif"><span class="newssubtitle">FAQ专区</span></td>
                    </tr>
                  </table>
                  <p>
                  <blockquote> 
                    <p><a href="javascript://" class=a6>我的阿卡常见问题 
                      &gt;</a></p>
                        <p><a href="/serv_prod/vpn/edu/personal/faq.shtml" class=a6>阿卡直通车常见问题 &gt;</a></p>
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
            <div align="left"><b><font color="032B7A" face="Arial"> 公司信息</font></b></div>
          </td>
        </tr>
        <tr> 
          <td width="27"> 
            <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"> 
            </div>
          </td>
          <td width="159"> 
            <p><a href="/company/about/index.shtml" class="a6">关于阿卡</a></a></p>
          </td>
        </tr>
        <tr> 
          <td width="27"> 
            <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"> 
            </div>
          </td>
          <td width="159"><a href="/company/about/companymilestones.shtml" class="a6">阿卡历程</a></td>

        </tr>
        <!-- tr> 
          <td bgcolor="C3D4F4" colspan="2"> 
            <div align="left"><font color="032B7A"><b><font face="Arial"> 管理团队</font></b></font></div>
          </td>
        </tr>
        <tr> 
          <td> 
            <div align="right"><img src="../../image/leadarrow.gif" width="5" height="10"></div>
          </td>
          <td><a href="../mgmt/index.shtml" class="a6">董事会</a></td>
        </tr -->
      </table>
    </td>
  </tr>
</table>
<?
require_once( "footer.inc.php" );
?>
