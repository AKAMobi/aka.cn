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
/*�������Ŵ��� */
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
                          �����ȵ� ::.</font></b></font><br>
                        <font size="1" color="#FF0000"><? echo date('Y.m.d'); ?></font><br>
                        <IFRAME src="news/scroll.php" frameborder="0" height="210" width="230" scrolling="no"></iframe>
<? /* ԭ������
                        <a href="news/index.shtml" class="a4">- ����������ʼ�ʻִ�շ���</a><br>
                          <a href="news/index.shtml" class="a4">- ������ר��Linux���а���ſ�����</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4">- 
                          </a><a href="news/index.shtml" class="a4">AKA��վ��ͨ</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4"></a><a href="news/index.shtml" class="a4">- 
                          ���� VPN �����������û�����</a><br>
                          <a href="news/index.shtml" class="a4">- ���� VPN ��ȫ������̨��</a><br>
                          <a href="news/index.shtml" class="a4">- ���� VPN ��ҵ���������ʽ�Ƴ�</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4">- 
                          ���� VPN �齨����֧�ַ������</a><br>
                          <a href="news/index.shtml" class="a4">- ���� VPN ����������д��ģ����<br>
                          </a><a href="news/index.shtml" class="a4">- ���� VPN ����������п���ʽ����</a><br>
                          <a href="news/akanews20011208052.shtml" class="a4"></a><a href="news/index.shtml" class="a4">- 
                          ���� VPN ��������Ƴ� Beta ��</a><br>
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
                                    &nbsp;&nbsp;VPN������VPN���������ר��Ϊ�������ṩ����<a href="serv_prod/vpn/edu/index.shtml" class="a4">����������</a><br>
                                    &nbsp;&nbsp;&nbsp;������ӣ�<a href="customer/index.shtml" class="a4">�ͻ�����</a><a href="customer/index.shtml" class="a4"></a> 
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
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.local.knowledge" class="a2">֪ʶ</a>&nbsp;<img src="images/smallleftdb.gif" width="14" height="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.local.market" class="a2">�г�</a>&nbsp;<img src="images/smallleftdb.gif" width="14" height="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prov.newsletter" class="a2">ProsLetter</a>&nbsp;<img src="images/smallleftdb.gif"> --> </td>
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
                        &nbsp;��˾����</font></b></td>
                      <td height="18" width="44"><img src="image/rmenubdr.gif" width="15" height="17"></td>
                    </tr>
                    <tr> 
                      <td colspan="2"> 
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr> 
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/news/");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;������Ϣ</td>
                          </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                          <tr>
                            <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/company/about/companymilestones.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;��������</td>
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
                              &nbsp;��Ʒ�����</font></b></td>
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
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;WMAIL��ҵ�ʼ�ϵͳ</td>
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
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;������ʼ���&nbsp;</td>
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
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;NAS����洢������</td>
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
                                    &nbsp;�ͻ�����</font></b></td>
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
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;����ר��</td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr> 
                                  <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/customer/support/index.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;����֧��</td>
                                </tr>
                              </table>
                              <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr> 
                                  <td onMouseOver="this.style.backgroundColor='#E8E8E8';this.style.border='1px #999999 solid';" onMouseOut="this.style.backgroundColor='BFBFBF';this.style.border='1px #BFBFBF solid';" onClick='naVigateto("/customer/contact/index.shtml");'  
  class=rmenu>&nbsp;&nbsp;&nbsp;&nbsp;��ϵ����</td>
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
