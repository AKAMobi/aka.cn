<?
require_once( "header.inc.php" );
?>

<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><font color="#458DE4"><a href="/my/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font></font><a href="/my/personalvpn/UserFunction.php" class="a5">�����û�����</a> 
          <br>
          <br>
        <p>��ѡ��ر�/����Ҫ�Ĺ��ܡ�<p>
	<p>��ע�������������ѡ����ȷ�ĳ���/�ع����͡�<!-- by zixia: ̫���Ѻ��� ����������ѡ�������ɵ���ʧ����˾�����κ�����--></p>
	<p>ע����ȡ�����¹��ܣ�ϵͳ�����᷵�ذ��·��ã���ע�⡣</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
  <br>
  <br>
  <br>
  <br>
<?
if ( (!isset($HTTP_SESSION_VARS['UserID']))  ){
?>
	<p>������<A HREF="/my/" class=a5>��¼</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	die;
}

#require 'Include/InitDB.php'; 
$result=mysql_query("select A.UserFunc as UserFunc,A.UserFuncStatus as UserFuncStatus , A.AutoID as UserAutoID ,B.UserAccount as UserAccount from User_TB as A, UserAccount_TB as B  where A.ID='{$HTTP_SESSION_VARS['UserID']}' and A.AutoID=B.UserAutoID", $conn);
if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
������<A HREF="/my/" class=a5>��¼</a>
<?
}
else{
$UserAutoID=$row['UserAutoID'];
$UserAccount=floatval($row['UserAccount']);
$functions=explode(",",$row['UserFunc']);
$functionStatus=explode(",",$row['UserFuncStatus']);
?>
<!--//
<?

if ( ( in_array("PersonalProxy",$functions) ) && (!in_array("PersonalProxy",$functionStatus)) ){
include 'Include/ProxyMonthFee.php';

}

if( ( in_array("PersonalVPN",$functions) ) && (!in_array("PersonalVPN",$functionStatus)) ){
include 'Include/MonthFee.php';
}

if( ( in_array("BackVPNPersonal",$functions) ) && (!in_array("BackVPNPersonal",$functionStatus)) ){
include 'Include/BackMonthFee.php';
}
?>
//-->
<?
$result=mysql_query("select UserFunc,UserFuncStatus from User_TB where ID='{$HTTP_SESSION_VARS['UserID']}'", $conn);

if (!($row=mysql_fetch_array($result))){//�޴��û�
?>
�޴��û���<BR>
������<A HREF="/my/" class=a5>��¼</a>
<?
}
else{
$functions=explode(",",$row['UserFunc']);

$functionStatus=explode(",",$row['UserFuncStatus']);
?>
	<div align="center">
	<form name="mainForm" method="post" action="DoUserFunction.php">
	<table>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalVPN" name="PersonalVPN" <? echo in_array("PersonalVPN",$functions)?'checked':''; ?> onclick="oPersonalHourVPN.checked=false;oBackPersonalVPN.checked=false;oBackPersonalHourVPN.checked=false;">

	</td>
	<td>
<? if( in_array("PersonalVPN",$functions) ){

	echo in_array("PersonalVPN",$functionStatus)?'<font color=green>����</font> ':'<font color=red>���ò��㣬ʧЧ��...</font>'; 
   }
?>

��������ֱͨ��(���°�) 28.8RMB/��</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalHourVPN" name="PersonalHourVPN" <? echo in_array("PersonalHourVPN",$functions)?'checked':''; ?> onclick="oPersonalVPN.checked=false;oBackPersonalHourVPN.checked=false;oBackPersonalVPN.checked=false;">
	</td>
	<td>��������ֱͨ��(��ʱ��) 0.04RMB/���ӣ���2003��8������</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oBackPersonalVPN" name="BackPersonalVPN" <? echo in_array("BackVPNPersonal",$functions)?'checked':''; ?> 
onclick="oBackPersonalHourVPN.checked=false;oPersonalVPN.checked=false;oPersonalHourVPN.checked=false;">

	</td>
	<td>
<? if( in_array("BackVPNPersonal",$functions) ){

	echo in_array("BackVPNPersonal",$functionStatus)?'<font color=green>����</font> ':'<font color=red>���ò��㣬ʧЧ��...</font>'; 
   }
?>

�����ع�ֱͨ��(���°�) 88RMB/�£���2003��8������</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oBackPersonalHourVPN" name="BackPersonalHourVPN" <? echo in_array("BackHourVPNPersonal",$functions)?'checked':''; ?> onclick="oBackPersonalVPN.checked=false;oPersonalHourVPN.checked=false;oPersonalVPN.checked=false;">
	</td>
	<td>�����ع�ֱͨ��(��ʱ��) 0.04RMB/���ӣ���2003��8������</td>
	</tr>
	<tr>
	<td>
	<input type="checkbox" id="oPersonalProxy" name="PersonalProxy" <? echo in_array("PersonalProxy",$functions)?'checked':''; ?> >
	</td>
	<td>
<? if( in_array("PersonalProxy",$functions) ){

 	echo in_array("PersonalProxy",$functionStatus)?'<font color=green>����</font> ':'<font color=red>���ò��㣬ʧЧ��...</font>'; 
   }
?>
����ֱͨ��(Proxy��) 55RMB/�£���2003��8������</td>
	</tr>
	</table>
	<br>
	<input type="submit" value="�ύ">
	<br>
	</form>
	</div>
<?
}
}
?>
<BR>
</td></tr></table>


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
