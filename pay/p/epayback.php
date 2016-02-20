<?
function err_msg( $msg )
{
	print "<p align=center><font color=red size=+1>$msg</font></p>";
}
function notice_msg( $msg )
{
	print "<p align=center><font color=blue size=+1>$msg</font></p>";
}
require_once( "db.inc.php" );
$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");
/*
支付完成后页面转到商户时，从首都电子商城返回的消息格式(注意，与定时发送方式使用的消息格式有区别)为：
http://v_url?v_oid=19990720-*-000001234&v_pstatus=30&v_pstring=无效卡号&v_pmode=支付方式(字符串)&v_md5info=a1b2c3d4e5f6 a1b2c3d4e5f6 a1b2c3d4
该消息格式详细解释如下：
v_url为该订单提交时传送上来的参数
Capinfo到商户的接口
<form method=get action="*" target=_self> 
    <input type="hidden" name="v_oid" value="">
    <input type="hidden" name="v_pstatus" value=""> 
    <input type="hidden" name="v_pstring" value=""> 
    <input type="hidden" name="v_pmode" value="">
    <input type="hidden" name="v_md5info" value=""> 
 </form> 
其中， 
*为商户发送的v_url； 
v_oid = 商户发送的v_oid定单编号；
v_pmode = 支付方式(字符串); 
v_pstatus = 1（已提交，对不支持实时的银行）
        20（支付成功，对支持实时的银行）
        30（支付失败，对支持实时的银行）； 
v_pstring 支付结果说明
v_md5info =char* hmac_md5(char* text, char* key)
          char* text     拼串结果
          char* key    对称密钥
注：MD5校验时拼接字符串的顺序为：v_oid，v_pstatus，v_pstring，v_pmode
*/

require_once( "../pay.inc.php" );
?>
<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" rowspan="3"> 
<?
/* 
 * 获取参数
 */
if( $v_oid = $HTTP_GET_VARS['v_oid'] ){
	//GET 方式传递参数
	$v_pstatus = $HTTP_GET_VARS['v_pstatus'];
	$v_pstring = $HTTP_GET_VARS['v_pstring'];
	$v_pmode = $HTTP_GET_VARS['v_pmode'];
	$v_md5info = $HTTP_GET_VARS['v_md5info'];
}else if( $v_oid = $HTTP_POST_VARS['v_oid'] ){ 
	//POST 方式传递参数
	$v_pstatus = $HTTP_POST_VARS['v_pstatus'];
	$v_pstring = $HTTP_POST_VARS['v_pstring'];
	$v_pmode = $HTTP_POST_VARS['v_pmode'];
	$v_md5info = $HTTP_POST_VARS['v_md5info'];
}else{
	paylog( "payback.php: 没有传递参数" );
	print "<p align=center><font color=red size=+1>System Busy.</font></p>";
	exit;
}
	

foreach( $_REQUEST as $key => $value ){
        print( "<font color=white>REQUEST: $key => $value</font><br>" );
}

$v_md5 = bin2hex( mhash( MHASH_MD5, $v_oid . $v_pstatus . $v_pstring . $v_pmode, MD5_KEY ) );

if( 1==$v_pstatus ){ //已提交，对不支持实时的银行
	$v_pstatus_memo='已提交，对不支持实时的银行';
}else if( 20==$v_pstatus ){//支付成功，对支持实时的银行
	$v_pstatus_memo='支付成功，对支持实时的银行';
}else if( 30==$v_pstatus ){//支付失败，对支持实时的银行
	$v_pstatus_memo='支付失败，对支持实时的银行';
}else{//未文档的参数值
	$v_pstatus_memo='未文档的参数值';
}

/*
 * 检查是否已经提交过的订单
 */
$result=mysql_query( "select EndDate from NetPay_TB where PayNO='$v_oid'" );
if( !$result ){
	paylog( "payback.php: 没有 $v_oid 这个订单号或mysql error" );
	print "<p align=center><font color=red size=+1>System busy, Please contact system administrator. error no.: 1000</font></p>";
	exit;
}
if( $row=mysql_fetch_array($result) ){
	$enddate=$row['EndDate'];
}else{
	paylog( "payback.php: mysql error, v_oid=$v_oid" );
	err_msg( "System busy, Please contact system administrator. error no.: 2000" );
	exit;
}
mysql_free_result( $result );

if( isset($enddate) ){
	err_msg( "Pay Succeed! Please remeber the time of now." );
	exit;
}

/*
 * 检验md5指纹
 */
$isSuccess = false;
if( $v_md5 == $v_md5info ){
	$isSuccess = true;
}
$memo = "($v_pstatus_memo), v_pstring=$v_pstring, v_pmode=$v_pmode";
if( $isSuccess ){
	// 记录调用
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'Yes', '$v_pstatus', 'payback.php: $memo') ") ){
		paylog( "payback.php: PayNO: $v_oid, isSuccess: Yes, $memo" );
	}
}else{
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'No', '$v_pstatus', 'payback.php: md5验证失败, $memo, v_md5info=$v_md5info ')" ) ){
		paylog( "payback.php: PayNO: $v_oid, isSuccess: No, md5验证失败, $memo, v_md5info=$v_md5info" );
	}
	err_msg( "OOPs! ooPs! OoPs! FBI's coming!" );
	exit;

}


if( 1==$v_pstatus ){ //已提交，对不支持实时的银行
	notice_msg( 	"Pay has been completed<br>" . 
			"system should receive the money in 24 hours." );
}else if( 20==$v_pstatus ){//支付成功，对支持实时的银行
	/*
 	 * 用户加钱
 	 */
	//TODO finish pay_ok
	mysql_query( "begin" );
	if( !agent_pay_ok( $v_oid, $v_pmode ) ){
		mysql_query( "rollback" );
		paylog( "payback.php: agent_pay_ok($v_oid, $v_pmode)失败" );
		err_msg( "System error, Please remember the time of now and contact systemadministrator" );
	}else{
		mysql_query( "commit" );
		ok_msg( "转帐成功！" );
		ok_msg( "Pay Succeed!" );

	}
}else if( 30==$v_pstatus ){//支付失败，对支持实时的银行
	notice_msg( "Pay operation failed." );
}else{//未文档的参数值
	paylog( "payback.php: v_pstatus未文档的值, $memo" );
}
//printf( "v_oid=%s, v_pmode=%s, v_pstatus=%s, v_pstring=%s, v_md5info=%s<br>", $v_oid, $v_pmode, $v_pstatus, $v_pstring, $v_md5info );

print "</td></tr></table>\n";
mysql_close($conn);
?>


