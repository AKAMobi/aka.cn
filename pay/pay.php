<?
/*
二、首都电子商城订单支付结果返回接口（商城      商户）
   用途：首都电子商城向商户发送订单的支付结果，商户返回接收情况。
   注：此接口以及后面的转帐结果返回接口，需由商户入驻时提供，或者以公司名、
   商户号、联系人、两个接口的URL（请注明哪个接口）的形式发送到
   e-c@capinfo.com.cn。
1、	首都电子商城提交的FORM表单参数说明
    商城一次将返回一个或多个订单的支付结果，返回为多个订单结果时，我们将以
    订单组的形式发送，具体说明如下：
对每一笔订单，商城都实时地将支付结果发送给商户，如果某一笔订单未发送成功
（如出现网络中断）或该笔订单md5校验错，则在发送下一笔订单的支付结果时，
会将未成功发送的订单支付结果一起发送，即批量发送。
在每次发送时，我们将以五个参数（v_count、v_oid、v_pmode、v_pstatus、v_pstring）
表示订单相关内容，另外附加一个数字指纹字段（v_mac）用于以上订单信息的校验。
对于单笔订单，以上五个订单参数说明如下：
 订单个数（v_count）：本次发送的订单总数；
 订单编号组（v_oid）：定义同商户提交待付款订单接口中的订单编号定义；
 支付方式组（v_pmode）：支付方式中文说明，如"中行长城信用卡"。
 支付状态组（v_pstatus）：支付结果，0à已提交；2→扣款中；1à支付完成；
                                   3à支付被拒绝；4→退款中。
 支付结果说明（v_pstring）：对支付结果的说明，成功时（v_pstatus=1）为
 "支付完成"，当v_pstatus=0时为"已提交"，支付被拒绝时（v_pstatus=3）为失败原因。
对于批量订单的发送，以v_oid字段为例，v_oid1表示本次发送的第一笔订单，v_oid2
表示本次发送的第二笔订单，依此类推，组成v_oid字段，中间以"|_|"组合分割，举例
如下：v_oid=v_oid1|_|v_oid2|_|v_oid3|_|v_oid4|_|…………。同理，v_pmode字段
表示为：v_pmode=v_pmode1|_|v_pmode2|_|v_pmode3|_|v_pmode4|_|…………，
v_pstatus字段表示为：v_pstatus=v_pstatus1|_|v_pstatus2|_|v_pstatus3|_|
v_pstatus4|_|…，v_pstring字段表示为：v_pstring=v_pstring1|_|v_pstring2|_|
v_pstring3|_|……。
数字指纹（v_mac）：防篡改信息，v_mac=hmac_md5(text , key)；其中text是表单中
各项的value按如下顺序拼串的结果：v_oid+v_pmode+v_pstatus+v_pstring+v_count，
key为双方约定的密钥。例如一次发送两笔订单：
20001124-888-test002|_|20001124-888-test003招商银行一网通|_|招商银行一网通3|_|
1支付被拒绝|_|支付完成2
2、商户返回消息
当商户收到上述消息后，返回消息定义如下：
"received"，表示成功收到支付结果信息，但尚未发货，主要针对有送货过程的商户。
"sent"，表示成功收到支付结果信息，并已完成发货或相似操作，如电子书籍、
提供信息服务等，没有送货过程的商户。
"error"，表示接收消息发生错误，如md5校验错。
3、例如，在ASP中的参考代码
<%  ' 获取参数 
v_count=request("v_count")
v_oid=request("v_oid")
v_pmode=request("v_pmode")
v_pstatus=request("v_pstatus")
v_pstring=request("v_pstring")
v_mac=request("v_mac")
' 解析参数
a_oid=split(v_oid,"|_|")
a_pmode=split(v_pmode,"|_|")
a_pstatus=split(v_pstatus,"|_|")
a_pstring=split(v_pstring,"|_|")
' md5校验
dim md,fff
set md=server.CreateObject ("md5_VB.md5class")
fff=md.hmac(v_oid&v_pmode&v_pstatus&v_pstring&v_count,"test")
' 按md5校验情况输出结果
if fff<>v_mac then
		response.write "error"
else
			response.write "received"	
			' 或response.write "sent"，依据商品物流特征决定。
		' 操作数据库 （略）
			……
end if
%>
*/
require_once( "pay.inc.php" );
require_once( "db.inc.php" );

if( $v_count = $HTTP_GET_VARS['v_count'] ){
	// GET 方式传递参数
	$v_oid = $HTTP_GET_VARS['v_oid'];
	$v_pmode = $HTTP_GET_VARS['v_pmode'];
	$v_pstatus = $HTTP_GET_VARS['v_pstatus'];
	$v_pstring = $HTTP_GET_VARS['v_pstring'];
	$v_mac = $HTTP_GET_VARS['v_mac'];
}else if( $v_count = $HTTP_POST_VARS['v_count'] ){
	// POST 方式传递参数
	$v_oid = $HTTP_POST_VARS['v_oid'];
	$v_pmode = $HTTP_POST_VARS['v_pmode'];
	$v_pstatus = $HTTP_POST_VARS['v_pstatus'];
	$v_pstring = $HTTP_POST_VARS['v_pstring'];
	$v_mac = $HTTP_POST_VARS['v_mac'];
}else{
	print "error";
	paylog( "pay.php: 没有参数" );
	exit;
}


$a_oid = explode( "|_|", $v_oid );
$a_pmode = explode( "|_|", $v_pmode );
$a_pstatus = explode( "|_|", $v_pstatus );
$a_pstring = explode( "|_|", $v_pstring );

$v_md5 = mhash( MHASH_MD5, $v_oid . $v_pmode . $v_pstatus . $v_pstring . $v_count, MD5_KEY );
$v_md5 = bin2hex( $v_md5 );

if( $v_md5 != $v_mac ){
	print "error";
	paylog( "pay.php: md5 ERROR! v_oid=" . $v_oid . "\tv_pmode=" . $v_pmode . "\tv_pstatus=" . $v_pstatus . "\tv_pstring=" . $v_pstring );
	exit;
}


$isSucceed = false;
for( $i=0; $i<$v_count; $i++ ){
	//调用函数处理每一笔支付
	if( !do_pay( $a_oid[$i], $a_pmode[$i], $a_pstatus[$i], $a_pstring[$i] ) ){
		paylog( "pay.php: do_pay($a_oid[$i],$a_pmode[$i],$a_pstatus[$i],$a_pstring[$i]) error" );
		break;
	}
	$isSucceed = true;
}

if( $isSucceed ){
	print "sent"; //确认，已发货
}else{
	print "error"; //错误
	#print "received"; //确认，未发货
}
exit;

function do_pay( $v_oid, $v_pmode, $v_pstatus, $v_pstring )
{
/*
 订单编号组（v_oid）：定义同商户提交待付款订单接口中的订单编号定义；
 支付方式组（v_pmode）：支付方式中文说明，如"中行长城信用卡"。
 支付状态组（v_pstatus）：支付结果，0à已提交；2→扣款中；1à支付完成；
                                   3à支付被拒绝；4→退款中。
 支付结果说明（v_pstring）：对支付结果的说明，成功时（v_pstatus=1）为
 "支付完成"，当v_pstatus=0时为"已提交"，支付被拒绝时（v_pstatus=3）为失败原因。
 */

	if( 0==$v_pstatus ){ 
		$v_pstatus_memo='已提交';
	}else if( 1==$v_pstatus ){ 
		$v_pstatus_memo='支付完成';
		$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
		mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");
		if( !pay_ok( $v_oid, $v_pmode ) ){
			paylog( "pay.php: 调用 pay_ok 失败" );
		}
		mysql_close( $conn );
	}else if( 2==$v_pstatus ){
		$v_pstatus_memo='扣款中';
	}else if( 3==$v_pstatus ){
		$v_pstatus_memo='支付被拒绝';
	}else{
		$v_pstatus_memo='未文档的参数值';
	}

	$memo = "pay.php: v_oid=$v_oid v_pmode=$v_pmode $v_pstatus_memo v_pstring=$v_pstring";

	$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
	mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'Yes', '$v_pstatus', 'pay.php: $memo') ") ){
		paylog( "pay.php: mysql_query失败。v_oid=" . $v_oid . "\tv_pmode=" . $v_pmode . "\tv_pstatus=" . $v_pstatus . "\tv_pstring=" . $v_pstring );
	}
	mysql_close($conn);
	return true;
}
?>
