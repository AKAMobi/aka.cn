<?
header("Content-type: image/gif");
session_start();
/*-------------------------------- 
I   AnalysisChart.php            I
I	绘制VPN流量分析图
I   说明文件：分析图生成模块算法.doc
I	Programmer: roy@zixia.net    I
I	Date:		2002.02.24       I
--------------------------------*/


/*---------------- 统计常量定义 ------------------*/
//时间段类型
define("YEAR",1);
define("MONTH",2);
define("WEEK",3);
define("DAY",4);

//用于生成SQL查询的常量定义
//最小统计单位
$sUnit=array(YEAR	=>	'DAYOFYEAR',
			 MONTH	=>	'HOUR',
			 WEEK	=>	'HOUR',
			 DAY	=>	'HOUR');

/*********************************/

//时间段定义
$sInterval=array(YEAR	=>	'-1 YEAR',  //从截止日期推算起始日期，故数字前须有负号
			 MONTH	=>	'-1 MONTH',
			 WEEK	=>	'-7 DAY',
			 DAY	=>	'-1 DAY');

//每天包含多少个数据点——计算数据点数量用
$nPointPerDay = array(YEAR	=>	1,  //
			 MONTH	=>	24,			
			 WEEK	=>	24,
			 DAY	=>	24);
			 
//合并数据点（1--不合并；2--每两个点合并成一个点;3--每三个点合并成一个点;以下类推)
$nJoint = array(YEAR	=>	1,  //
			 MONTH	=>	4,			
			 WEEK	=>	1,
			 DAY	=>	1);
			 			 
//计算日期用，日期增加步长（一天中的秒数）
$nDateCalStep = 24 * 60 * 60;
/*---------------------常量定义结束--------------------------*/

/*---------------- 绘图常量定义 ------------------*/
$nXBase = 83;
$nXLength = 418;
$nYBase = 106;
$nYLength = 84;
$nFontType = 3;

$sDisplayUint = array(YEAR	=>	"Day",  // 统计单位显示字符串
			 MONTH	=>	"4 Hours",			
			 WEEK	=>	"Hour",
			 DAY	=>	"Hour");
/*---------------------常量定义结束--------------------------*/

//程序参数定义
if (!isset($HTTP_SESSION_VARS['UserName']) ){
	die("未登陆1……");
}
$sUserName=$HTTP_SESSION_VARS['UserName'];			//用户ID
if (!isset($HTTP_SESSION_VARS['sAnalysisType']) ){
	die("未登陆2……");
}
$nAnalysisType=$HTTP_SESSION_VARS['sAnalysisType'];				//统计时间段类型
if  ( (!isset($HTTP_SESSION_VARS['sYEAR'])) || (!isset($HTTP_SESSION_VARS['sMONTH']))
	|| (!isset($HTTP_SESSION_VARS['sDAY'])) ){
	die("未登陆3……");
}
$sTempTime=sprintf("%4d-%02d-%02d",$HTTP_SESSION_VARS['sYEAR'],$HTTP_SESSION_VARS['sMONTH'],$HTTP_SESSION_VARS['sDAY']); //从Session中读取统计时间

$nEndTime=strtotime("{$sTempTime} +1 DAY"); 	//统计截止时间（字符串形式）因为mysql从0时开始计算每一天，所以计算时需要先推前一天
$sEndTime=strftime("%Y-%m-%d",$nEndTime); //统计截止时间（数字形式）
if ($nEndTime==-1){
	die("日期错误……" . $sEndTime);
}


/*--------------- Part.I 初始化 Begin ----------------------*/

//使用AnalysisChart.gif图形文件初始化图形资源
$hImage=ImageCreateFromGIF("AnalysisChart.gif");				//hImage: 图形资源句柄

$cRed = ImageColorAllocate($hImage,255,0,0) ; //红色
$cYellow = ImageColorAllocate($hImage,255,255,0);	//cYellow: 黄色
$cBlue = ImageColorAllocate($hImage,0,0,255);		//cBlue: 蓝色	
$cBlack = ImageColorAllocate($hImage,0,0,0);		//cBlack: 黑色
$cWhite = ImageColorAllocate($hImage,255,255,255);  //cWhite: 白色
$cLightyellow=ImageColorAllocate($hImage,255,255,0xE0); //cLightYellow: 淡黄色
$cSkyblue=ImageColorAllocate($hImage,80,160,208); //天蓝色

/*--------------- Part.I End ----------------------*/


/*--------------- Part.II 统计计算 Begin ----------------------*/
//计算统计起止时间

$nBeginTime=strtotime("{$sEndTime} {$sInterval[$nAnalysisType]}"); //统计起始时间（数字形式）
$sBeginTime=strftime("%Y-%m-%d",$nBeginTime); //统计起始时间（字符串形式）
//echo "\$sBeginTime = $sBeginTime <br>\n"; //测试用

//计算统计时间内的全部日期
$aDate = array(); //数组，存放统计时间段内的日期

$i=$nBeginTime; //循环控制变量&日期计算结果存放临时变量
do{
	  $aDate[]=$i;
	  $i+=$nDateCalStep;
}while($i<$nEndTime);

/*
//测试日期计算是否正确
for ($i=0;$i<count($aDate);$i++) {
	echo strftime("%Y-%m-%d",$aDate[$i]),"<br>\n";
}
*/
 

//读取统计数据
$connection=mysql_pconnect('localhost','aka','zpzAKA!@#');
mysql_select_db('aka',$connection);

$rst=mysql_query("select DATE_FORMAT(TimeStamp, '%Y-%m-%d') As AssistUnit ,{$sUnit[$nAnalysisType]}(TimeStamp) as Unit ,sum(Transmit), sum(Receive) from Vpn_Log_TB where TimeStamp >= '{$sBeginTime}' and TimeStamp < '{$sEndTime}' and Name='{$sUserName}' group by AssistUnit,Unit Order by AssistUnit,Unit");


//初始化数据点坐标列表；填写数据点X坐标
$aTotalFlux=array();  //总流量列表
$aInFlux=array();	//入流量列表
$aOutFlux=array();	//出流量列表
$nPointCount=count($aDate) * $nPointPerDay[$nAnalysisType]; //数据点数量

for ($i=0;$i<$nPointCount;$i++){
	$aTotalFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aTotalFlux[]=0;
	$aInFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aInFlux[]=0;
	$aOutFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aOutFlux[]=0;
}

//查找流量峰值;计算出入总流量;用流量数据填写数据点Y坐标
$nMaxFlux=0; //总流量峰值
$nMinFlux=-1; //总流量谷值
$nTotalFlux=0; //总流量总计，算平均流量用

$nOutMaxFlux=0; //总流量峰值
$nOutMinFlux=-1; //总流量谷值
$nOutTotalFlux=0; //总流量总计，算平均流量用

$nInMaxFlux=0; //总流量峰值
$nInMinFlux=-1; //总流量谷值
$nInTotalFlux=0; //总流量总计，算平均流量用

$nRealPointNum =0 ;//有效数据点个数（数据库记录数目），计算平均流量用
while($row=mysql_fetch_row($rst)){
	$nIndex=((strtotime($row[0])-$nBeginTime) / $nDateCalStep) ; //计算纪录在数据点列表中的序号

	if ($nPointPerDay[$nAnalysisType]!=1){	//如果每天不只一个数据点,坐标计算中还需要增加每天点数因子
		$nIndex=$nIndex*$nPointPerDay[$nAnalysisType] + $row[1];
	}
	$aTotalFlux[($nIndex*2)+1]=$row[2]+$row[3];
	$aOutFlux[($nIndex*2)+1]=$row[3];
	$aInFlux[($nIndex*2)+1]=$row[2];
	if ($aTotalFlux[($nIndex*2)+1]>$nMaxFlux) {
		$nMaxFlux=$aTotalFlux[($nIndex*2)+1];
	}
	if ( ($nMinFlux==-1)  || ($nMinFlux>$aTotalFlux[($nIndex*2)+1])){
		$nMinFlux=$aTotalFlux[($nIndex*2)+1];
	}
	$nTotalFlux+=$aTotalFlux[($nIndex*2)+1];

	if ($aOutFlux[($nIndex*2)+1]>$nOutMaxFlux) {
		$nOutMaxFlux=$aOutFlux[($nIndex*2)+1];
	}
	if ( ($nOutMinFlux==-1)  || ($nOutMinFlux>$aOutFlux[($nIndex*2)+1])){
		$nOutMinFlux=$aOutFlux[($nIndex*2)+1];
	}
	$nOutTotalFlux+=$aOutFlux[($nIndex*2)+1];

	if ($aInFlux[($nIndex*2)+1]>$nInMaxFlux) {
		$nInMaxFlux=$aInFlux[($nIndex*2)+1];
	}
	if ( ($nInMinFlux==-1)  || ($nInMinFlux>$aInFlux[($nIndex*2)+1])){
		$nInMinFlux=$aInFlux[($nIndex*2)+1];
	}
	$nInTotalFlux+=$aInFlux[($nIndex*2)+1];
	
	$nRealPointNum++;
}

mysql_free_result($rst);

// Closing connection
mysql_close($connection);

if ($nJoint[$nAnalysisType]!=1){
	$i=0;
	$aTempTotalFlux=array();  	//临时数组,用于合并总流量
	$aTempOutFlux=array();		//临时数组,用于合并出流量
	$aTempInFlux=array();		//临时数组,用于合并入流量
	$nJointCount=$nJoint[$nAnalysisType];
	$nCount=0;
	$nPointJoint=$nPointCount/$nJoint[$nAnalysisType];//合并后的点数,计算横坐标用
	$nMinFlux=-1;
	$nMaxFlux=0;
	$nOutMinFlux=-1;
	$nOutMaxFlux=0;
	$nInMinFlux=-1;
	$nInMaxFlux=0;
	while ($i<$nPointCount){
		$nTempTotalFlux=0;
		$nTempOutFlux=0;
		$nTempInFlux=0;
		for ($t=0;$t<$nJointCount;$t++){
			$nTempTotalFlux+=$aTotalFlux[2*($i)+1];
			$nTempOutFlux+=$aOutFlux[2*($i)+1];
			$nTempInFlux+=$aInFlux[2*($i)+1];
			$i++;
		}
		
		$aTempTotalFlux[]=$nXBase+($nCount/($nPointJoint-1))*$nXLength;
		$aTempTotalFlux[]=$nTempTotalFlux;
		if ($nTempTotalFlux>$nMaxFlux) {
			$nMaxFlux=$nTempTotalFlux;
		}
		if ( ($nMinFlux==-1)  || ($nMinFlux>$nTempTotalFlux)){
			$nMinFlux=$nTempTotalFlux;
		}		

		if ($nTempOutFlux>$nOutMaxFlux) {
			$nOutMaxFlux=$nTempOutFlux;
		}
		if ( ($nOutMinFlux==-1)  || ($nOutMinFlux>$nTempOutFlux)){
			$nOutMinFlux=$nTempOutFlux;
		}		

		if ($nTempInFlux>$nInMaxFlux) {
			$nInMaxFlux=$nTempInFlux;
		}
		if ( ($nInMinFlux==-1)  || ($nInMinFlux>$nTempInFlux)){
			$nInMinFlux=$nTempInFlux;
		}		


		$aTempOutFlux[]=$nXBase+($nCount/($nPointJoint-1))*$nXLength;
		$aTempOutFlux[]=$nTempOutFlux;
		$aTempInFlux[]=$nXBase+($nCount/($nPointJoint-1))*$nXLength;
		$aTempInFlux[]=$nTempInFlux;
		$nCount++;
	}
	$aTotalFlux=$aTempTotalFlux;
	$aOutFlux=$aTempOutFlux;
	$aInFlux=$aTempInFlux;
	$nPointCount=$nPointJoint;
	$nRealPointNum = $nPointCount;
}

if ($nInMinFlux==-1){
	$nInMinFlux=0;
}
if ($nOutMinFlux==-1){
	$nOutMinFlux=0;
}
if ($nMinFlux==-1){
	$nMinFlux=0;
}

//计算平均流量
if ($nRealPointNum){
	$nAveFlux=$nTotalFlux / $nRealPointNum;
	$nInAveFlux=$nInTotalFlux / $nRealPointNum;
	$nOutAveFlux=$nOutTotalFlux / $nRealPointNum;
} else {
	$nAveFlux=0;
	$nInAveFlux=0;
	$nOutAveFlux=0;
}

/*
//	求流量坐标最大值

$nTempCord=1; //辅助变量，求整时用
if ($nMaxFlux>=1024*1024){
	$nTempCord=1024*1024;
} else if ($nMaxFlux>=1024) {
	$nTempCord=1024;
}
$nTempCord2=(int)((((int)(($nMaxFlux/$nTempCord)*10))-1)/4)+1;
echo $nTempCord2;
$nCordMax=(($nTempCord2*4)*$nTempCord/10); //流量坐标最大值
*/

$nCordMax=$nMaxFlux; //临时用，以后是否修改视情况而定
if ($nCordMax==0) {
	$nCordMax=4;
}

//将数据点Y坐标从数据流量换算为坐标值
for ($i=0;$i<$nPointCount;$i++)
{
	$aInFlux[($i*2)+1]=$nYBase-(($aInFlux[($i*2)+1] / $nCordMax) * $nYLength);
	$aOutFlux[($i*2)+1]=$nYBase-(($aOutFlux[($i*2)+1] / $nCordMax) * $nYLength);
	$aTotalFlux[($i*2)+1]=$nYBase-(($aTotalFlux[($i*2)+1] / $nCordMax) * $nYLength);
}

//每个列表增加X轴的两个端点，便于使用ImagePolygon()函数绘图
$aInFlux[]=$nXBase+$nXLength;
$aInFlux[]=$nYBase;
$aOutFlux[]=$nXBase+$nXLength;
$aOutFlux[]=$nYBase;
$aInFlux[]=$nXBase;
$aInFlux[]=$nYBase;
$aOutFlux[]=$nXBase;
$aOutFlux[]=$nYBase;

/*
//测试数据点坐标
echo "<table border=1>\n";
for ($i=0;$i<$nPointCount+2;$i++)
{
	echo "<tr> \n";
	echo "<td> {$i} </td>\n";
	echo "<td> {$aInFlux[($i*2)+1]} </td>\n";
	echo "<td> {$aOutFlux[($i*2)+1]} </td>\n";
	echo "<td> {$aTotalFlux[($i*2)+1]} </td>\n";
	echo "</tr> \n";
}	
echo "</table> \n";
*/

/*--------------- Part.II End ----------------------*/

/*--------------- Part.III 统计图绘制 Begin ----------------------*/
//绘制统计图背景
imagefilledrectangle($hImage,$nXBase,$nYBase-$nYLength,$nXBase+$nXLength,$nYBase,$cLightyellow);

//绘制总流量统计图形
for ($i=0;$i<$nPointCount-1;$i++)
{
	$aQuad=array(	//四边形的四个顶点
			$aTotalFlux[$i*2],$nYBase,
			$aTotalFlux[$i*2],$aTotalFlux[$i*2+1],
			$aTotalFlux[($i+1)*2],$aTotalFlux[($i+1)*2+1],
			$aTotalFlux[($i+1)*2],$nYBase
			);
	ImageFilledPolygon($hImage,$aQuad,4,$cSkyblue);
//	ImageFilledRectangle($hImage,$aTotalFlux[$i*2],$aTotalFlux[$i*2+1],$aTotalFlux[($i+1)*2],$nYBase,$cSkyblue);
}	
//绘制出入流量图形
ImagePolygon($hImage,$aInFlux,$nPointCount+2,$cRed);
ImagePolygon($hImage,$aOutFlux,$nPointCount+2,$cBlue);

//绘制最大、最小、平均流量值
function DrawFlux($Flux,$unit){
	if ($Flux>=1024*1024){
		return sprintf("%3.1f GB/%s",$Flux/(1024*1024),$unit);
	}
	if ($Flux>=1024){
		return sprintf("%3.1f MB/%s",$Flux/1024,$unit);
	}
	return sprintf("%5d KB/%s",$Flux,$unit);
}
imagestring($hImage,$nFontType, $nXBase  - 50 ,$nYBase+40, sprintf("Max: %s",DrawFlux($nInMaxFlux, $sDisplayUint[$nAnalysisType]) ),$cRed);
imagestring($hImage,$nFontType, $nXBase  - 50 ,$nYBase+55, sprintf("Min: %s",DrawFlux($nInMinFlux, $sDisplayUint[$nAnalysisType]) ),$cRed);
imagestring($hImage,$nFontType, $nXBase  - 50 ,$nYBase+70, sprintf("Ave: %s",DrawFlux($nInAveFlux, $sDisplayUint[$nAnalysisType]) ),$cRed);

imagestring($hImage,$nFontType, $nXBase + 120 ,$nYBase+40, sprintf("Max: %s",DrawFlux($nOutMaxFlux, $sDisplayUint[$nAnalysisType]) ),$cBlue);
imagestring($hImage,$nFontType, $nXBase + 120 ,$nYBase+55, sprintf("Min: %s",DrawFlux($nOutMinFlux, $sDisplayUint[$nAnalysisType]) ),$cBlue);
imagestring($hImage,$nFontType, $nXBase + 120 ,$nYBase+70, sprintf("Ave: %s",DrawFlux($nOutAveFlux, $sDisplayUint[$nAnalysisType]) ),$cBlue);

imagestring($hImage,$nFontType, $nXBase + 300 ,$nYBase+40, sprintf("Max: %s",DrawFlux($nMaxFlux, $sDisplayUint[$nAnalysisType]) ),$cBlack);
imagestring($hImage,$nFontType, $nXBase + 300 ,$nYBase+55, sprintf("Min: %s",DrawFlux($nMinFlux, $sDisplayUint[$nAnalysisType]) ),$cBlack);
imagestring($hImage,$nFontType, $nXBase + 300 ,$nYBase+70, sprintf("Ave: %s",DrawFlux($nAveFlux, $sDisplayUint[$nAnalysisType]) ),$cBlack);

//绘制统计图矩形框
imagerectangle($hImage,$nXBase,$nYBase-$nYLength,$nXBase+$nXLength,$nYBase,$cBlack);

//绘制X向刻度线
//虚线
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*3/4),$nXBase+$nXLength,$nYBase-($nYLength*3/4),$cBlack);
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*2/4),$nXBase+$nXLength,$nYBase-($nYLength*2/4),$cBlack);
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*1/4),$nXBase+$nXLength,$nYBase-($nYLength*1/4),$cBlack);
//右侧刻度
imageline($hImage,$nXBase+$nXLength,$nYBase,$nXBase+$nXLength+3,$nYBase,$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*1/4),$nXBase+$nXLength+3,$nYBase-($nYLength*1/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*2/4),$nXBase+$nXLength+3,$nYBase-($nYLength*2/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*3/4),$nXBase+$nXLength+3,$nYBase-($nYLength*3/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-$nYLength,$nXBase+$nXLength+3,$nYBase-$nYLength,$cBlack);
//左侧刻度
imageline($hImage,$nXBase-3,$nYBase,$nXBase,$nYBase,$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*1/4),$nXBase,$nYBase-($nYLength*1/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*2/4),$nXBase,$nYBase-($nYLength*2/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*3/4),$nXBase,$nYBase-($nYLength*3/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-$nYLength,$nXBase,$nYBase-$nYLength,$cBlack);

//书写Y轴刻度
//右侧刻度
imagestring($hImage,$nFontType ,$nXBase+$nXLength+5,$nYBase-7,"  0%",$cBlack);
imagestring($hImage,$nFontType ,$nXBase+$nXLength+5,$nYBase-($nYLength*1/4)-7," 25%",$cBlack);
imagestring($hImage,$nFontType ,$nXBase+$nXLength+5,$nYBase-($nYLength*2/4)-7," 50%",$cBlack);
imagestring($hImage,$nFontType ,$nXBase+$nXLength+5,$nYBase-($nYLength*3/4)-7," 75%",$cBlack);
imagestring($hImage,$nFontType ,$nXBase+$nXLength+5,$nYBase-$nYLength-7,"100%",$cBlack);

function OutFlux($Max,$Flux){
	if ($Max>=1024*1024){
		return sprintf("%3.1f GB",$Flux/(1024*1024));
	}
	if ($Max>=1024){
		return sprintf("%3.1f MB",$Flux/1024);
	}
	return sprintf("%5d KB",$Flux);
}
//左侧刻度
for ($i=1;$i<=4;$i++){
	$sText=OutFlux($nCordMax,$nCordMax*$i/4);
	imagestring($hImage,$nFontType ,$nXBase-64,$nYBase-($nYLength*$i/4)-7,$sText,$cBlack);  
}
imagestring($hImage,$nFontType ,$nXBase-64,$nYBase-7,"       0",$cBlack);
/*--------------- Part.III End ----------------------*/

/*--------------- Part.IV Begin ----------------------*/

//绘制Y向刻度
switch($nAnalysisType){
case DAY:
	for ($i=0;$i<$nPointCount;$i+=4){
		imagedashedline($hImage,	//虚线
			$aTotalFlux[2*$i],$nYBase-$nYLength,
			$aTotalFlux[2*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//刻度头
			$aTotalFlux[2*$i],$nYBase,
			$aTotalFlux[2*$i],$nYBase+2,
			$cBlack);			
		//刻度文字		
		imagestring($hImage,$nFontType,$aTotalFlux[2*$i]-16,$nYBase+4,sprintf("%2d:00",$i),$cBlack);
	}
	BREAK;
case WEEK:
	for ($i=0;$i<7;$i++){
		imagedashedline($hImage,	//虚线
			$aTotalFlux[2*24*$i],$nYBase-$nYLength,
			$aTotalFlux[2*24*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//刻度头
			$aTotalFlux[2*24*$i],$nYBase,
			$aTotalFlux[2*24*$i],$nYBase+2,
			$cBlack);			
		//刻度文字		
		imagestring($hImage,$nFontType,$aTotalFlux[2*24*$i]-10,$nYBase+4,strftime("%a",$aDate[$i]),$cBlack);
	}
	BREAK;
case MONTH:
	for ($i=0;$i<count($aDate);$i+=5){
		imagedashedline($hImage,	//虚线
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase-$nYLength,
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//刻度头
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase,
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase+2,
			$cBlack);	
		//刻度文字		
		imagestring($hImage,$nFontType,$aTotalFlux[2*24/$nJoint[MONTH]*$i]-20,$nYBase+4,strftime("%b %d",$aDate[$i]),$cBlack);
	}	
	BREAK;
case YEAR:
	for ($i=1;$i<=12;$i++){	//循环12次(一年总共需要显示12个月的刻度)
		$nTime1 = strtotime("$sBeginTime +{$i} MONTH");	//从统计起始时间后推$i个月
		$sTime2 = strftime("%Y-%m",$nTime1) . "-01";		//找到该月的第一天
		$nTime2 = strtotime($sTime2);					//转换成timestamp形式
		$nIndex=(($nTime2-$nBeginTime) / $nDateCalStep) ; //计算纪录在数据点列表中的序号
		imagedashedline($hImage,	//虚线
			$aTotalFlux[2*$nIndex],$nYBase-$nYLength,
			$aTotalFlux[2*$nIndex],$nYBase,
			$cBlack);
		imageline($hImage,			//刻度头
			$aTotalFlux[2*$nIndex],$nYBase,
			$aTotalFlux[2*$nIndex],$nYBase+2,
			$cBlack);	
		//刻度文字		
		imagestring($hImage,$nFontType,$aTotalFlux[2*$nIndex]-10,$nYBase+4,strftime("%b",$nTime2),$cBlack);
		
	}	
	BREAK;
}

/*--------------- Part.IV End ----------------------*/

/*--------------- Part.V Begin ----------------------*/
/*--------------- Part.V End ----------------------*/

/*--------------- Part.VI Begin ----------------------*/
/*--------------- Part.VI End ----------------------*/

//生成图形文件、关闭图形资源。程序结束
Imagegif($hImage);
ImageDestroy($hImage); 

?>