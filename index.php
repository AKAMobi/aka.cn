<?
if (!isset($_COOKIE["AKA_NEWS_POPUP"])) {
setcookie("AKA_NEWS_POPUP");
$isPopupNews=true;
} else {
$isPopupNews=false;
}
require_once( "header.inc.php" );
?>

<? 
/*弹出新闻窗口 */
if ($isPopupNews){
?>
<script language="JScript">
window.open("popMsg.html",null,"width=500,height=400,status=yes,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=no")
;
</script>
<?
}
?>
<table width="760" border="0" cellspacing="0" cellpadding="0">
	<tr><td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="584" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="233" valign="top" rowspan="2"> 
                  <table width="100%" border="0" cellspacing="3" cellpadding="0">
                    <tr> 
                      <td valign=top> 
                        <font color="#666666"><b><font color="#818181">.:: 
                          阿卡热点 ::.</font></b></font><br>
                        <font size="1" color="#FF0000"><? echo date('Y.m.d'); ?></font><br>
                        <IFRAME src="news/scroll.php" frameborder="0" height="210" width="230" scrolling="no"></iframe>
<? /* 原有新闻
                        <a href="news/index.shtml" class="a4">- 新增代办国际驾驶执照服务</a><br>
                          <a href="news/index.shtml" class="a4">- 服务器专用Linux发行版紧张开发中</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4">- 
                          </a><a href="news/index.shtml" class="a4">AKA网站开通</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4"></a><a href="news/index.shtml" class="a4">- 
                          阿卡 VPN 解决方案获得用户好评</a><br>
                          <a href="news/index.shtml" class="a4">- 阿卡 VPN 安全性又上台阶</a><br>
                          <a href="news/index.shtml" class="a4">- 阿卡 VPN 企业解决方案正式推出</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4">- 
                          阿卡 VPN 组建技术支持服务队伍</a><br>
                          <a href="news/index.shtml" class="a4">- 阿卡 VPN 解决方案进行大规模测试<br>
                          </a><a href="news/index.shtml" class="a4">- 阿卡 VPN 解决方案进行开放式测试</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4"></a><a href="news/index.shtml" class="a4">- 
                          阿卡 VPN 解决方案推出 Beta 版</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4"></a>
*/
?>                          
                        </td>
                    </tr>
                    <tr> 
                      <td valign=top> 
                        <div align="right"><a href="news/"><img src="image/morebutton.gif" width="88" height="24" border="0"></a></div>
                      </td>
                    </tr>
                  </table>

                </td>
                <td valign=top>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="351"><a href="/company/about/index.shtml"><img src="image/aka.jpg" width="351" height="194" border="0"></a></td>
              </tr>
              <tr> 
                <td valign=top>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                            <td width="8" height="79"><img src="image/midspl.gif"></td>
                            <td valign="bottom">
                              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                                <tr>
                                  <td><img src="image/smallrndarw.gif" width="14" height="14"> 
                                    &nbsp;&nbsp;VPN：出国VPN解决方案，专门为教育网提供服务！<a href="serv_prod/vpn/edu/index.shtml" class="a4">点击这里进入</a><br>
                                    &nbsp;&nbsp;&nbsp;相关链接：<a href="customer/index.shtml" class="a4">客户服务</a><a href="customer/index.shtml" class="a4"></a> 
                                  </td>
                                </tr>
                              </table>
                            </td>
                    </tr>
                  </table>
                </td>
              
                    </tr>
                  </table>

                </td></tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td bgcolor="666666" height="20"><!--  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.local.forinvestors" class="a2">For 
                  Investors</a>&nbsp;<img src="images/smallleftdb.gif" width="14" height="7"> 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.local.knowledge" class="a2">知识</a>&nbsp;<img src="images/smallleftdb.gif" width="14" height="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.local.market" class="a2">市场</a>&nbsp;<img src="images/smallleftdb.gif" width="14" height="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.newsletter" class="a2">ProsLetter</a>&nbsp;<img src="images/smallleftdb.gif"> --> </td>
  </tr>
</table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="98">
              <tr> 
                <td bgcolor="4C94B7" width="249"><a href="partner/index.shtml"><img src="image/channelad.gif" width="249" height="98" border="0"></a></td>
                <td bgcolor="4C94B7" width="335"><a href="customer/index.shtml"><img src="image/cmsad.gif" width="335" height="98" border="0"></a></td>
              </tr>
            </table>
          </td>
          <td width="176">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td valign="top" bgcolor="CCCCFF">
                  <table width="100%" border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td height="2"> 
                        <div align="center"><img src="image/smallarrow.gif" width="6" height="10"> <img src="/cgi-bin/Count.cgi?ft=0&tr=Y&md=5&dd=D&df=aka.com.cn" border=0 align=absmiddle width=54 height=13></div>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="BFBFBF">
                    <tr> 
                      <td height="18" width="132" bgcolor="737373"><b><font color="#FFFFFF"> 
                        &nbsp;公司新闻</font></b></td>
                      <td height="18" width="44"><img src="image/rmenubdr.gif" width="15" height="17"></td>
                    </tr>
                    <tr> 
                      <td colspan="2"> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/news/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;最新消息</td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr>
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/company/about/companymilestones.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;阿卡历程</td>
                          </tr>
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("javascript://");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing=0 cellpadding="0" bgcolor="BFBFBF">
                    <tr> 
                      <td bgcolor="FFFFFF"><img src="image/htsplit.gif"></td>
                    </tr>
                    <tr> 
                      <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="BFBFBF" dwcopytype="CopyTableRow">
                          <tr> 
                            <td height="18" width="132" bgcolor="737373"><b><font color="#FFFFFF"> 
                              &nbsp;产品与服务</font></b></td>
                            <td height="18" width="44"><img src="image/rmenubdr.gif" width="15" height="17"></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/serv_prod/wmail/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;WMAIL企业邮件系统</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
<!--
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr>
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("serv_prod/idl/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;办理国际驾照&nbsp;</td>
                          </tr>
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("javascript://");'  
  class=rmenu>&nbsp;&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
-->
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
   <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/serv_prod/vpn/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;VPN</td>                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/serv_prod/nas/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;NAS网络存储服务器</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("javascript://");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          </tr>
                  </table>


                  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="BFBFBF">


                    <tr> 
                      <td> 
                        <table width="100%" border="0" cellspacing=0 cellpadding="0" bgcolor="BFBFBF">
                          <tr> 
                            <td bgcolor="FFFFFF"><img src="image/htsplit.gif"></td>
                          </tr>
                          <tr> 
                            <td>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="BFBFBF" dwcopytype="CopyTableRow">
                                <tr> 
                                  <td height="18" width="132" bgcolor="737373"><b><font color="#FFFFFF"> 
                                    &nbsp;客户服务</font></b></td>
                                  <td height="18" width="44"><img src="image/rmenubdr.gif" width="15" height="17"></td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr> 
                            <td> 
                              <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr> 
                                  <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/customer/downloads/index.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;下载专区</td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr> 
                                  <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/customer/support/index.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;技术支持</td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr> 
                                  <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/customer/contact/index.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;联系我们</td>
                                </tr>
                              </table>
                            </td>
                          </tr>
						  <tr><td>
						  
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("javascript://");'  
  class=rmenu>&nbsp;</td>
                          </tr>
                        </table>
						  </td></tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?
require_once( "footer.inc.php" );
?>
