<? session_start(); ?>
<? 
include '../../php/IncludeFile.php';

IncludeHTML("../../header.html");

IncludeHTML("../Include/Part1.html");
?>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            
      <td> 
        <p><b><font color="#3366CC"><br>
          ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
          </font><a href="/personal/" class="a5">�ҵİ���</a><font color="#458DE4">&gt; 
          </font><a href="/personal/UserMenu.php" class="a5">�û��˵�</a> <font color="#458DE4">&gt;</font><a href="/personal/vpn/SelectDate.shtml" class="a5">VPN����ͳ��</a> 
          <br>
          <br>
          <span class="newstitle">VPN����ͳ��</span></p>
              <p>���ǲ쿴VPN����ͳ��ҳ�档������ѡ��ͳ�����ͣ�Ȼ��ѡ��ͳ�ƽ�ֹ���ڡ�ѡ����Ϻ��밴���鿴�������������ʼͳ�ơ�</p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td>
<?
session_unregister("sAnalysisType");
session_unregister("sYEAR");
session_unregister("sMONTH");
session_unregister("sDAY");
if ( (!isset($HTTP_SESSION_VARS['UserName'])) || (!isset($HTTP_POST_VARS['AnalysisType']))
	|| (!isset($HTTP_POST_VARS['YEAR'])) || (!isset($HTTP_POST_VARS['MONTH'])) || (!isset($HTTP_POST_VARS['DAY'])) ){//δ������¼
?>
������<A HREF="../index.shtml">��½</a>��
<?
}else {
$temp=intval($HTTP_POST_VARS['AnalysisType']);
if (($temp<1) || ($temp>4)){ //AnalysisType����
?>
���ύ�ı���Ϣ������<A HREF="../index.shtml">��½</a>�����ԣ�
<? 
} else{
$sAnalysisType=$temp;
session_register("sAnalysisType");
$sYEAR=$HTTP_POST_VARS['YEAR'];
session_register("sYEAR");
$sMONTH=$HTTP_POST_VARS['MONTH'];
session_register("sMONTH");
$sDAY=$HTTP_POST_VARS['DAY'];
session_register("sDAY");
?>
	<div align="center">
	<span class="newstitle">
<?
	echo $HTTP_SESSION_VARS['NickName'];
	$str;
	if ($sAnalysisType==4) {
		$str=sprintf("%d��%d��%d��",$sYEAR,$sMONTH,$sDAY);
	} else {
		$sEndTime=sprintf("%4d-%02d-%02d",$sYEAR,$sMONTH,$sDAY);
		switch($sAnalysisType){
		case 3:
			$nBeginTime=strtotime("{$sEndTime} -7 DAY");
			break;
		case 2:
			$nBeginTime=strtotime("{$sEndTime} -1 MONTH");
			break;
		case 1:
			$nBeginTime=strtotime("{$sEndTime} -1 YEAR");
			break;
		}
		$sBeginTime=strftime("%Y��%m��%d��",$nBeginTime); //ͳ����ʼʱ�䣨�ַ�����ʽ��
		$str= sprintf("%d��%d��%d��",$sYEAR,$sMONTH,$sDAY);
		$str= $sBeginTime . "��" . $str;
	}
	$conn=mysql_pconnect('localhost','aka','zpzAKA!@#');
	mysql_select_db('aka',$conn);
	$ip = getenv ("REMOTE_ADDR"); 
    mysql_query("INSERT INTO  VPN_QUERY_LOG(OperTime,UserName,UserIP,OperType,Note) VALUES (NOW(),'$UserName','$ip',1,'$str')");
	mysql_close($conn);
	echo $str;
?>VPN��������</span><br>
	<IMG src="AnalysisChart.php">
	</div>
	<br>

<?
IncludeHTML("SelectDate.html");
?>


<?
}
}
?>
</td>
</tr>
</table>
      </center>
<?
IncludeHTML("../Include/Part2.html");
IncludeHTML("../../footer.html");
?>
