<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");

function isParamExist(){
	if (!isset($_REQUEST['startYear'])) return false;
	if (!isset($_REQUEST['startMonth'])) return false;
	if (!isset($_REQUEST['startDay'])) return false;
	if (!isset($_REQUEST['endYear'])) return false;
	if (!isset($_REQUEST['endMonth'])) return false;
	if (!isset($_REQUEST['endDay'])) return false;
	
	return true;
}
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

$addCondition="";
if (isset($_REQUEST['UserAccount'])) {
	$addCondition=$addCondition." LogType='UserAccount' or"; 
}
if (isset($_REQUEST['PersonalVPN'])) {
	$addCondition=$addCondition." LogType='PersonalVPN' or"; 
}
if (isset($_REQUEST['News'])) {
	$addCondition=$addCondition." LogType='News' or"; 
}
if (isset($_REQUEST['Money'])) {
	$addCondition=$addCondition." LogType='Money' or"; 
}
if (isset($_REQUEST['LogOn'])) {
	$addCondition=$addCondition." LogType='LogOn' or"; 
}
if (isset($_REQUEST['AdminUser'])) {
	$addCondition=$addCondition." LogType='Admin' or"; 
}

if ( (!isParamExist()) || ($addCondition=="")){
?>
���ò�����ȫ��<br>
���쿴ϵͳ��־����������<a href="<? echo $ADMINURLROOT ;?>/Log/ViewLog.php">����</a>��
<?
}else {

$addCondition=preg_replace("/or$/","",$addCondition);

$params=array();
$params[]=urlencode('startYear') . "=" . urlencode($_REQUEST['startYear']);
$params[]=urlencode('startMonth') . "=" . urlencode($_REQUEST['startMonth']);
$params[]=urlencode('startDay') . "=" . urlencode($_REQUEST['startDay']);
$params[]=urlencode('endYear') . "=" . urlencode($_REQUEST['endYear']);
$params[]=urlencode('endMonth') . "=" . urlencode($_REQUEST['endMonth']);
$params[]=urlencode('endDay') . "=" . urlencode($_REQUEST['endDay']);
$params[]=urlencode('addCondition') ."=". urlencode($addCondition);

$param=join("&",$params);

?>
<SCRIPT language="JScript">
var isAdminIDAsc=false;
var isLogTimeAsc=false;
var isSourceIPAsc=false;
var isLogTypeAsc=false;

function sortOnAdminID(){
	if (isAdminIDAsc) {
		isAdminIDAsc=false;
		LogContent.sort="-adminID";
	} else {
		isAdminIDAsc=true;
		LogContent.sort="+adminID";
	}
	LogContent.Reset();
}

function sortOnLogTime(){
	if (isLogTimeAsc) {
		isLogTimeAsc=false;
		LogContent.sort="-LogTime";
	} else {
		isLogTimeAsc=true;
		LogContent.sort="+LogTime";
	}
	LogContent.Reset();
}

function sortOnSourceIP(){
	if (isSourceIPAsc) {
		isSourceIPAsc=false;
		LogContent.sort="-SourceIP";
	} else {
		isSourceIPAsc=true;
		LogContent.sort="+SourceIP";
	}
	LogContent.Reset();
}

function sortOnLogType(){
	if (isLogTypeAsc) {
		isLogTypeAsc=false;
		LogContent.sort="-LogType";
	} else {
		isLogTypeAsc=true;
		LogContent.sort="+LogType";
	}
	LogContent.Reset();
}


</script>
<OBJECT id="LogContent" CLASSID="clsid:333C7BC4-460F-11D0-BC04-0080C7055A83">
	<PARAM NAME="DataURL" VALUE="<? echo $ADMINURLROOT ; ?>/Log/LogContent.php?<? echo $param ;?>">
	<PARAM NAME="UseHeader" VALUE="True">
	<PARAM NAME="CHARSET" VALUE="GB2312">
</OBJECT>
<TABLE border="0" width="530" datasrc="#LogContent">
<thead>
<th onclick="return sortOnAdminID();">����Ա</th>
<th onclick="return sortOnLogTime();">ʱ��</th>
<th >��¼����</th>
<th onclick="return sortOnSourceIP();">��ԴIP</th>
<th onclick="return sortOnLogType();">����</th>
</thead>
<tbody>
<tr>
<td><SPAN datafld="adminID"></span></td>
<td><SPAN datafld="logTime"></span></td>
<td><SPAN datafld="logContent"></span></td>
<td><SPAN datafld="logSource"></span></td>
<td><SPAN datafld="logType"></span></td>
</tr>
</tbody>
</table>
<?
}
}
}
?>
</td></tr></table>
<BR>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>