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
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/Logout.php" class="a5">退出登录</a>
				<br>
                <br>
                <span class="newstitle">退出登录</span></p>
              <p>这里是退出登录页面。</p>
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
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
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
您已经成功的退出登录!
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
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">相关链接</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../serv_prod/index.shtml" class="a6">产品与服务</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">客户服务</a></td>
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
