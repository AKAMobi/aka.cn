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
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
          </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">����˵�</a><br>
          <br>
          <span class="newstitle">����˵�</span></p>
              <p>�����ǰ�����˾�ͻ���Ϣ����ϵͳ�����˵�����ѡ������ʹ�õķ���</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center">
<?
if ( (!isset($_SESSION['AdminID']))  ){//δ������¼
?>
����δ��¼��<BR>
������<A HREF="<? echo $ADMINURLROOT; ?>/index.php">��¼</a>��
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
