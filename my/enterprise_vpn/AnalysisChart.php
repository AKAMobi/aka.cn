<?
header("Content-type: image/gif");
session_start();
/*-------------------------------- 
I   AnalysisChart.php            I
I	����VPN��������ͼ
I   ˵���ļ�������ͼ����ģ���㷨.doc
I	Programmer: roy@zixia.net    I
I	Date:		2002.02.24       I
--------------------------------*/


/*---------------- ͳ�Ƴ������� ------------------*/
//ʱ�������
define("YEAR",1);
define("MONTH",2);
define("WEEK",3);
define("DAY",4);

//��������SQL��ѯ�ĳ�������
//��Сͳ�Ƶ�λ
$sUnit=array(YEAR	=>	'DAYOFYEAR',
			 MONTH	=>	'HOUR',
			 WEEK	=>	'HOUR',
			 DAY	=>	'HOUR');

/*********************************/

//ʱ��ζ���
$sInterval=array(YEAR	=>	'-1 YEAR',  //�ӽ�ֹ����������ʼ���ڣ�������ǰ���и���
			 MONTH	=>	'-1 MONTH',
			 WEEK	=>	'-7 DAY',
			 DAY	=>	'-1 DAY');

//ÿ��������ٸ����ݵ㡪���������ݵ�������
$nPointPerDay = array(YEAR	=>	1,  //
			 MONTH	=>	24,			
			 WEEK	=>	24,
			 DAY	=>	24);
			 
//�ϲ����ݵ㣨1--���ϲ���2--ÿ������ϲ���һ����;3--ÿ������ϲ���һ����;��������)
$nJoint = array(YEAR	=>	1,  //
			 MONTH	=>	4,			
			 WEEK	=>	1,
			 DAY	=>	1);
			 			 
//���������ã��������Ӳ�����һ���е�������
$nDateCalStep = 24 * 60 * 60;
/*---------------------�����������--------------------------*/

/*---------------- ��ͼ�������� ------------------*/
$nXBase = 83;
$nXLength = 418;
$nYBase = 106;
$nYLength = 84;
$nFontType = 3;

$sDisplayUint = array(YEAR	=>	"Day",  // ͳ�Ƶ�λ��ʾ�ַ���
			 MONTH	=>	"4 Hours",			
			 WEEK	=>	"Hour",
			 DAY	=>	"Hour");
/*---------------------�����������--------------------------*/

//�����������
if (!isset($HTTP_SESSION_VARS['UserName']) ){
	die("δ��½1����");
}
$sUserName=$HTTP_SESSION_VARS['UserName'];			//�û�ID
if (!isset($HTTP_SESSION_VARS['sAnalysisType']) ){
	die("δ��½2����");
}
$nAnalysisType=$HTTP_SESSION_VARS['sAnalysisType'];				//ͳ��ʱ�������
if  ( (!isset($HTTP_SESSION_VARS['sYEAR'])) || (!isset($HTTP_SESSION_VARS['sMONTH']))
	|| (!isset($HTTP_SESSION_VARS['sDAY'])) ){
	die("δ��½3����");
}
$sTempTime=sprintf("%4d-%02d-%02d",$HTTP_SESSION_VARS['sYEAR'],$HTTP_SESSION_VARS['sMONTH'],$HTTP_SESSION_VARS['sDAY']); //��Session�ж�ȡͳ��ʱ��

$nEndTime=strtotime("{$sTempTime} +1 DAY"); 	//ͳ�ƽ�ֹʱ�䣨�ַ�����ʽ����Ϊmysql��0ʱ��ʼ����ÿһ�죬���Լ���ʱ��Ҫ����ǰһ��
$sEndTime=strftime("%Y-%m-%d",$nEndTime); //ͳ�ƽ�ֹʱ�䣨������ʽ��
if ($nEndTime==-1){
	die("���ڴ��󡭡�" . $sEndTime);
}


/*--------------- Part.I ��ʼ�� Begin ----------------------*/

//ʹ��AnalysisChart.gifͼ���ļ���ʼ��ͼ����Դ
$hImage=ImageCreateFromGIF("AnalysisChart.gif");				//hImage: ͼ����Դ���

$cRed = ImageColorAllocate($hImage,255,0,0) ; //��ɫ
$cYellow = ImageColorAllocate($hImage,255,255,0);	//cYellow: ��ɫ
$cBlue = ImageColorAllocate($hImage,0,0,255);		//cBlue: ��ɫ	
$cBlack = ImageColorAllocate($hImage,0,0,0);		//cBlack: ��ɫ
$cWhite = ImageColorAllocate($hImage,255,255,255);  //cWhite: ��ɫ
$cLightyellow=ImageColorAllocate($hImage,255,255,0xE0); //cLightYellow: ����ɫ
$cSkyblue=ImageColorAllocate($hImage,80,160,208); //����ɫ

/*--------------- Part.I End ----------------------*/


/*--------------- Part.II ͳ�Ƽ��� Begin ----------------------*/
//����ͳ����ֹʱ��

$nBeginTime=strtotime("{$sEndTime} {$sInterval[$nAnalysisType]}"); //ͳ����ʼʱ�䣨������ʽ��
$sBeginTime=strftime("%Y-%m-%d",$nBeginTime); //ͳ����ʼʱ�䣨�ַ�����ʽ��
//echo "\$sBeginTime = $sBeginTime <br>\n"; //������

//����ͳ��ʱ���ڵ�ȫ������
$aDate = array(); //���飬���ͳ��ʱ����ڵ�����

$i=$nBeginTime; //ѭ�����Ʊ���&���ڼ����������ʱ����
do{
	  $aDate[]=$i;
	  $i+=$nDateCalStep;
}while($i<$nEndTime);

/*
//�������ڼ����Ƿ���ȷ
for ($i=0;$i<count($aDate);$i++) {
	echo strftime("%Y-%m-%d",$aDate[$i]),"<br>\n";
}
*/
 

//��ȡͳ������
$connection=mysql_pconnect('localhost','aka','zpzAKA!@#');
mysql_select_db('aka',$connection);

$rst=mysql_query("select DATE_FORMAT(TimeStamp, '%Y-%m-%d') As AssistUnit ,{$sUnit[$nAnalysisType]}(TimeStamp) as Unit ,sum(Transmit), sum(Receive) from Vpn_Log_TB where TimeStamp >= '{$sBeginTime}' and TimeStamp < '{$sEndTime}' and Name='{$sUserName}' group by AssistUnit,Unit Order by AssistUnit,Unit");


//��ʼ�����ݵ������б���д���ݵ�X����
$aTotalFlux=array();  //�������б�
$aInFlux=array();	//�������б�
$aOutFlux=array();	//�������б�
$nPointCount=count($aDate) * $nPointPerDay[$nAnalysisType]; //���ݵ�����

for ($i=0;$i<$nPointCount;$i++){
	$aTotalFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aTotalFlux[]=0;
	$aInFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aInFlux[]=0;
	$aOutFlux[]=$nXBase+($i/($nPointCount-1))*$nXLength;
	$aOutFlux[]=0;
}

//����������ֵ;�������������;������������д���ݵ�Y����
$nMaxFlux=0; //��������ֵ
$nMinFlux=-1; //��������ֵ
$nTotalFlux=0; //�������ܼƣ���ƽ��������

$nOutMaxFlux=0; //��������ֵ
$nOutMinFlux=-1; //��������ֵ
$nOutTotalFlux=0; //�������ܼƣ���ƽ��������

$nInMaxFlux=0; //��������ֵ
$nInMinFlux=-1; //��������ֵ
$nInTotalFlux=0; //�������ܼƣ���ƽ��������

$nRealPointNum =0 ;//��Ч���ݵ���������ݿ��¼��Ŀ��������ƽ��������
while($row=mysql_fetch_row($rst)){
	$nIndex=((strtotime($row[0])-$nBeginTime) / $nDateCalStep) ; //�����¼�����ݵ��б��е����

	if ($nPointPerDay[$nAnalysisType]!=1){	//���ÿ�첻ֻһ�����ݵ�,��������л���Ҫ����ÿ���������
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
	$aTempTotalFlux=array();  	//��ʱ����,���ںϲ�������
	$aTempOutFlux=array();		//��ʱ����,���ںϲ�������
	$aTempInFlux=array();		//��ʱ����,���ںϲ�������
	$nJointCount=$nJoint[$nAnalysisType];
	$nCount=0;
	$nPointJoint=$nPointCount/$nJoint[$nAnalysisType];//�ϲ���ĵ���,�����������
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

//����ƽ������
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
//	�������������ֵ

$nTempCord=1; //��������������ʱ��
if ($nMaxFlux>=1024*1024){
	$nTempCord=1024*1024;
} else if ($nMaxFlux>=1024) {
	$nTempCord=1024;
}
$nTempCord2=(int)((((int)(($nMaxFlux/$nTempCord)*10))-1)/4)+1;
echo $nTempCord2;
$nCordMax=(($nTempCord2*4)*$nTempCord/10); //�����������ֵ
*/

$nCordMax=$nMaxFlux; //��ʱ�ã��Ժ��Ƿ��޸����������
if ($nCordMax==0) {
	$nCordMax=4;
}

//�����ݵ�Y�����������������Ϊ����ֵ
for ($i=0;$i<$nPointCount;$i++)
{
	$aInFlux[($i*2)+1]=$nYBase-(($aInFlux[($i*2)+1] / $nCordMax) * $nYLength);
	$aOutFlux[($i*2)+1]=$nYBase-(($aOutFlux[($i*2)+1] / $nCordMax) * $nYLength);
	$aTotalFlux[($i*2)+1]=$nYBase-(($aTotalFlux[($i*2)+1] / $nCordMax) * $nYLength);
}

//ÿ���б�����X��������˵㣬����ʹ��ImagePolygon()������ͼ
$aInFlux[]=$nXBase+$nXLength;
$aInFlux[]=$nYBase;
$aOutFlux[]=$nXBase+$nXLength;
$aOutFlux[]=$nYBase;
$aInFlux[]=$nXBase;
$aInFlux[]=$nYBase;
$aOutFlux[]=$nXBase;
$aOutFlux[]=$nYBase;

/*
//�������ݵ�����
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

/*--------------- Part.III ͳ��ͼ���� Begin ----------------------*/
//����ͳ��ͼ����
imagefilledrectangle($hImage,$nXBase,$nYBase-$nYLength,$nXBase+$nXLength,$nYBase,$cLightyellow);

//����������ͳ��ͼ��
for ($i=0;$i<$nPointCount-1;$i++)
{
	$aQuad=array(	//�ı��ε��ĸ�����
			$aTotalFlux[$i*2],$nYBase,
			$aTotalFlux[$i*2],$aTotalFlux[$i*2+1],
			$aTotalFlux[($i+1)*2],$aTotalFlux[($i+1)*2+1],
			$aTotalFlux[($i+1)*2],$nYBase
			);
	ImageFilledPolygon($hImage,$aQuad,4,$cSkyblue);
//	ImageFilledRectangle($hImage,$aTotalFlux[$i*2],$aTotalFlux[$i*2+1],$aTotalFlux[($i+1)*2],$nYBase,$cSkyblue);
}	
//���Ƴ�������ͼ��
ImagePolygon($hImage,$aInFlux,$nPointCount+2,$cRed);
ImagePolygon($hImage,$aOutFlux,$nPointCount+2,$cBlue);

//���������С��ƽ������ֵ
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

//����ͳ��ͼ���ο�
imagerectangle($hImage,$nXBase,$nYBase-$nYLength,$nXBase+$nXLength,$nYBase,$cBlack);

//����X��̶���
//����
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*3/4),$nXBase+$nXLength,$nYBase-($nYLength*3/4),$cBlack);
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*2/4),$nXBase+$nXLength,$nYBase-($nYLength*2/4),$cBlack);
ImageDashedLine($hImage,$nXBase,$nYBase-($nYLength*1/4),$nXBase+$nXLength,$nYBase-($nYLength*1/4),$cBlack);
//�Ҳ�̶�
imageline($hImage,$nXBase+$nXLength,$nYBase,$nXBase+$nXLength+3,$nYBase,$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*1/4),$nXBase+$nXLength+3,$nYBase-($nYLength*1/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*2/4),$nXBase+$nXLength+3,$nYBase-($nYLength*2/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-($nYLength*3/4),$nXBase+$nXLength+3,$nYBase-($nYLength*3/4),$cBlack);
imageline($hImage,$nXBase+$nXLength,$nYBase-$nYLength,$nXBase+$nXLength+3,$nYBase-$nYLength,$cBlack);
//���̶�
imageline($hImage,$nXBase-3,$nYBase,$nXBase,$nYBase,$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*1/4),$nXBase,$nYBase-($nYLength*1/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*2/4),$nXBase,$nYBase-($nYLength*2/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-($nYLength*3/4),$nXBase,$nYBase-($nYLength*3/4),$cBlack);
imageline($hImage,$nXBase-3,$nYBase-$nYLength,$nXBase,$nYBase-$nYLength,$cBlack);

//��дY��̶�
//�Ҳ�̶�
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
//���̶�
for ($i=1;$i<=4;$i++){
	$sText=OutFlux($nCordMax,$nCordMax*$i/4);
	imagestring($hImage,$nFontType ,$nXBase-64,$nYBase-($nYLength*$i/4)-7,$sText,$cBlack);  
}
imagestring($hImage,$nFontType ,$nXBase-64,$nYBase-7,"       0",$cBlack);
/*--------------- Part.III End ----------------------*/

/*--------------- Part.IV Begin ----------------------*/

//����Y��̶�
switch($nAnalysisType){
case DAY:
	for ($i=0;$i<$nPointCount;$i+=4){
		imagedashedline($hImage,	//����
			$aTotalFlux[2*$i],$nYBase-$nYLength,
			$aTotalFlux[2*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//�̶�ͷ
			$aTotalFlux[2*$i],$nYBase,
			$aTotalFlux[2*$i],$nYBase+2,
			$cBlack);			
		//�̶�����		
		imagestring($hImage,$nFontType,$aTotalFlux[2*$i]-16,$nYBase+4,sprintf("%2d:00",$i),$cBlack);
	}
	BREAK;
case WEEK:
	for ($i=0;$i<7;$i++){
		imagedashedline($hImage,	//����
			$aTotalFlux[2*24*$i],$nYBase-$nYLength,
			$aTotalFlux[2*24*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//�̶�ͷ
			$aTotalFlux[2*24*$i],$nYBase,
			$aTotalFlux[2*24*$i],$nYBase+2,
			$cBlack);			
		//�̶�����		
		imagestring($hImage,$nFontType,$aTotalFlux[2*24*$i]-10,$nYBase+4,strftime("%a",$aDate[$i]),$cBlack);
	}
	BREAK;
case MONTH:
	for ($i=0;$i<count($aDate);$i+=5){
		imagedashedline($hImage,	//����
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase-$nYLength,
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase,
			$cBlack);
		imageline($hImage,			//�̶�ͷ
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase,
			$aTotalFlux[2*24/$nJoint[MONTH]*$i],$nYBase+2,
			$cBlack);	
		//�̶�����		
		imagestring($hImage,$nFontType,$aTotalFlux[2*24/$nJoint[MONTH]*$i]-20,$nYBase+4,strftime("%b %d",$aDate[$i]),$cBlack);
	}	
	BREAK;
case YEAR:
	for ($i=1;$i<=12;$i++){	//ѭ��12��(һ���ܹ���Ҫ��ʾ12���µĿ̶�)
		$nTime1 = strtotime("$sBeginTime +{$i} MONTH");	//��ͳ����ʼʱ�����$i����
		$sTime2 = strftime("%Y-%m",$nTime1) . "-01";		//�ҵ����µĵ�һ��
		$nTime2 = strtotime($sTime2);					//ת����timestamp��ʽ
		$nIndex=(($nTime2-$nBeginTime) / $nDateCalStep) ; //�����¼�����ݵ��б��е����
		imagedashedline($hImage,	//����
			$aTotalFlux[2*$nIndex],$nYBase-$nYLength,
			$aTotalFlux[2*$nIndex],$nYBase,
			$cBlack);
		imageline($hImage,			//�̶�ͷ
			$aTotalFlux[2*$nIndex],$nYBase,
			$aTotalFlux[2*$nIndex],$nYBase+2,
			$cBlack);	
		//�̶�����		
		imagestring($hImage,$nFontType,$aTotalFlux[2*$nIndex]-10,$nYBase+4,strftime("%b",$nTime2),$cBlack);
		
	}	
	BREAK;
}

/*--------------- Part.IV End ----------------------*/

/*--------------- Part.V Begin ----------------------*/
/*--------------- Part.V End ----------------------*/

/*--------------- Part.VI Begin ----------------------*/
/*--------------- Part.VI End ----------------------*/

//����ͼ���ļ����ر�ͼ����Դ���������
Imagegif($hImage);
ImageDestroy($hImage); 

?>