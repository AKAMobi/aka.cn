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
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Log/ViewLog.php" class="a5">察看管理日志</a>
				<br>
                <br>
                <span class="newstitle">察看管理日志</span></p>
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
请首先<A HREF="<? echo $ADMINURLROOT ;?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['LogAdmin'])) ) {
?>
你没有察看管理日志的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">管理菜单</a>
<?
} else {
?>
<FORM action="DoViewLog.php" method="post">
<TABLE border="0" width="200">
<thead>
<TH align="left" >日志类型选择</th>
</thead>
<tbody>
<tr>
<td>
<INPUT type="checkbox" name="UserAccount" checked="true">用户帐号管理日志
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="PersonalVPN" checked="true">个人VPN管理日志
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="News" checked="true">新闻系统管理日志
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="Money" checked="true">用户资金管理日志
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="LogOn" checked="true">管理员登录记录
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="AdminUser" checked="true">管理员账号管理
</td>
</tr>
</tbody>
</table>
<script language="javascript">
<!--
function MonthChanged(){
	var nYear=parseInt(document.all.oYear.value);
	var nMonth=document.all.oMonth.selectedIndex;
	if ((nYear<2000) || (nYear>2100) || (nYear!=nYear)) {
		alert("年份输入错误。请重新输入");
		document.all.oYear.select();
		document.all.oYear.focus();
	}
	var d=new Date(nYear,nMonth,1);
	var nd =new Date(nYear,nMonth,1);
	nd.setMonth(nMonth+1);
	var nDays=(nd.valueOf()-d.valueOf())/(24*60*60*1000);
	var len=document.all.oDay.options.length;
	for (var i=0;i<len;i++){
		document.all.oDay.options.remove(0);
	}
	for (i=0;i<nDays;i++){
		var oOption=document.createElement("OPTION");
		oOption.text=i+1;
		oOption.value=i+1;
		document.all.oDay.options.add(oOption);
	}
	

}
function EndMonthChanged(){
	var nYear=parseInt(document.all.oEndYear.value);
	var nMonth=document.all.oEndMonth.selectedIndex;
	if ((nYear<2000) || (nYear>2100) || (nYear!=nYear)) {
		alert("年份输入错误。请重新输入");
		document.all.oEndYear.select();
		document.all.oEndYear.focus();
	}
	var d=new Date(nYear,nMonth,1);
	var nd =new Date(nYear,nMonth,1);
	nd.setMonth(nMonth+1);
	var nDays=(nd.valueOf()-d.valueOf())/(24*60*60*1000);
	var len=document.all.oEndDay.options.length;
	for (var i=0;i<len;i++){
		document.all.oEndDay.options.remove(0);
	}
	for (i=0;i<nDays;i++){
		var oOption=document.createElement("OPTION");
		oOption.text=i+1;
		oOption.value=i+1;
		document.all.oEndDay.options.add(oOption);
	}
	
}
-->
</script>
<TABLE border="0" width="200">
<thead>
<TH align="left" >日志时间段选择</th>
</thead>
<tbody>
<tr><td>
从<input type="text" name="startYear" id="oYear" size="4" maxlength=4 onchange="MonthChanged()"> 年 
  <select size="1" name="startMonth" id="oMonth" onchange="MonthChanged()">
  <option value=1>1</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
  <option value=9>9</option>
  <option value=10>10</option>
  <option value=11>11</option>
  <option value=12>12</option>
  </select> 月 <select size="1" name="startDay" id="oDay">
  <option selected> 1</option>
  </select> 日 </p>
</td></tr>
<tr><td>
到<input type="text" name="endYear" id="oEndYear" size="4" maxlength=4 onchange="EndMonthChanged()"> 年 
  <select size="1" name="endMonth" id="oEndMonth" onchange="EndMonthChanged()">
  <option value=1>1</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>
  <option value=8>8</option>
  <option value=9>9</option>
  <option value=10>10</option>
  <option value=11>11</option>
  <option value=12>12</option>
  </select> 月 <select size="1" name="endDay" id="oEndDay">
  <option selected> 1</option>
  </select> 日 </p>
  <script language="javascript">
  <!--
	var da= new Date();

	document.all.oEndYear.value=da.getFullYear();
	document.all.oEndMonth.options(da.getMonth()).selected=true;
	EndMonthChanged();
	document.all.oEndDay.options(da.getDate()-1).selected=true;
	
	da.setDate(da.getDate()-7);
	document.all.oYear.value=da.getFullYear();
	document.all.oMonth.options(da.getMonth()).selected=true;
	MonthChanged();
	document.all.oDay.options(da.getDate()-1).selected=true;	
  -->
  </script>
</td></tr>
</tbody>
</table>
<BR>
<INPUT type="submit" value="察看有关日志">

</FORM>
<BR><BR>
<?
}
}
?>
</td></tr></table>

<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>