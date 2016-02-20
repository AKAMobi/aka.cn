<? session_start(); ?>
<? 

require_once("zdmin.inc.php");

require("{$ADMINROOT}/Include/IncludeFile.php");

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">网站管理员</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a><br>
          <br>
          <span class="newstitle">管理菜单</span></p>
              <p>这里是阿卡公司客户信息服务系统的主菜单。请选择您想使用的服务。</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?
if ( (!isset($_SESSION['AdminID']))  ){//未正常登录
?>
您尚未登录。<BR>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登录</a>。
<?
}else {
?>
<OBJECT id="MenuItem" CLASSID="clsid:333C7BC4-460F-11D0-BC04-0080C7055A83">
	<PARAM NAME="DataURL" VALUE="<? echo $ADMINURLROOT ; ?>/Include/MenuItem.inc.php">
	<PARAM NAME="UseHeader" VALUE="True">
	<PARAM NAME="CHARSET" VALUE="GB2312">
</OBJECT>
<table datasrc="#MenuItem">
<tr><td align="Center">
<tr><td align="Center">
<A datafld="ItemURL" class=a6><SPAN datafld="ItemName"></span></a>
</td></tr>
</table><?
}
?>
</td>
</tr>
</table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");

IncludeHTML("{$AKAROOT}/footer.html");
?>
