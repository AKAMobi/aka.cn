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
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminUser/AdminUserControl.php" class="a5">管理员账号管理</a>
				<br>
                <br>
                <span class="newstitle">管理员账号管理</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
 <table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr> 
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
 <td align="center" >
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['AdminAdmin'])) ) {
?>
 <td align="center" >
你没有管理其他管理员账号的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">管理菜单</a>
<?
} else {

?>
<TD width="550" >
<TABLE width="550" border="1" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<TABLE border="0">
<tr>
<td >
<INPUT type="button" value="当前管理员账号列表" onclick="return document.frames('IMainFrame').document.location.href='AdminUserList.php';">
</td>
<td >
<INPUT type="button" value="添加新管理员账号" onclick="return document.frames('IMainFrame').document.location.href='AddAdmin.php';">
</td>
<tr>
</table>
</td>
</tr>
<tr>
<td>
<IFRAME ID="oMainFrame" name="IMainFrame" FRAMEBORDER="0" SCROLLING="AUTO" SRC="AdminUserList.php" width="550" height="450">
</IFRAME>
</td>
</tr>
</table>
</td>
<?
}
}
?>
</td></tr>
</table>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
