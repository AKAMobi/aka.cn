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
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT ;?>/Log/ViewLog.php" class="a5">�쿴������־</a>
				<br>
                <br>
                <span class="newstitle">�쿴������־</span></p>
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
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��½</a>��
<?
}else {

if ( (!isset($_SESSION['LogAdmin'])) ) {
?>
��û�в쿴������־��Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {
?>
<FORM action="DoViewLog.php" method="post">
<TABLE border="0" width="200">
<thead>
<TH align="left" >��־����ѡ��</th>
</thead>
<tbody>
<tr>
<td>
<INPUT type="checkbox" name="UserAccount" checked="true">�û��ʺŹ�����־
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="PersonalVPN" checked="true">����VPN������־
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="News" checked="true">����ϵͳ������־
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="Money" checked="true">�û��ʽ������־
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="LogOn" checked="true">����Ա��¼��¼
</td>
</tr>
<tr>
<td>
<INPUT type="checkbox" name="AdminUser" checked="true">����Ա�˺Ź���
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
		alert("��������������������");
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
		alert("��������������������");
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
<TH align="left" >��־ʱ���ѡ��</th>
</thead>
<tbody>
<tr><td>
��<input type="text" name="startYear" id="oYear" size="4" maxlength=4 onchange="MonthChanged()"> �� 
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
  </select> �� <select size="1" name="startDay" id="oDay">
  <option selected> 1</option>
  </select> �� </p>
</td></tr>
<tr><td>
��<input type="text" name="endYear" id="oEndYear" size="4" maxlength=4 onchange="EndMonthChanged()"> �� 
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
  </select> �� <select size="1" name="endDay" id="oEndDay">
  <option selected> 1</option>
  </select> �� </p>
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
<INPUT type="submit" value="�쿴�й���־">

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