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
          当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
          </font><a href="/personal/" class="a5">我的阿卡</a><font color="#458DE4">&gt; 
          </font><a href="/personal/UserMenu.php" class="a5">用户菜单</a> <font color="#458DE4">&gt;</font><a href="/personal/vpn/SelectDate.shtml" class="a5">VPN流量统计</a> 
          <br>
          <br>
          <span class="newstitle">VPN流量统计</span></p>
              <p>这是察看VPN流量统计页面。请首先选择统计类型，然后选择统计截止日期。选择完毕后，请按“查看分析结果”键开始统计。</p>
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
	|| (!isset($HTTP_POST_VARS['YEAR'])) || (!isset($HTTP_POST_VARS['MONTH'])) || (!isset($HTTP_POST_VARS['DAY'])) ){//未正常登录
?>
请首先<A HREF="../index.shtml">登陆</a>！
<?
}else {
$temp=intval($HTTP_POST_VARS['AnalysisType']);
if (($temp<1) || ($temp>4)){ //AnalysisType错误
?>
你提交的表单信息错误，请<A HREF="../index.shtml">登陆</a>后重试！
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
		$str=sprintf("%d年%d月%d日",$sYEAR,$sMONTH,$sDAY);
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
		$sBeginTime=strftime("%Y年%m月%d日",$nBeginTime); //统计起始时间（字符串形式）
		$str= sprintf("%d年%d月%d日",$sYEAR,$sMONTH,$sDAY);
		$str= $sBeginTime . "到" . $str;
	}
	$conn=mysql_pconnect('localhost','aka','zpzAKA!@#');
	mysql_select_db('aka',$conn);
	$ip = getenv ("REMOTE_ADDR"); 
    mysql_query("INSERT INTO  VPN_QUERY_LOG(OperTime,UserName,UserIP,OperType,Note) VALUES (NOW(),'$UserName','$ip',1,'$str')");
	mysql_close($conn);
	echo $str;
?>VPN流量分析</span><br>
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
