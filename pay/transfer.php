<?
/*
四、商城通知商户转帐结果接口（商城      商户）
用途：商城将订单转帐结果通知商户。
1、	首都电子商城提交的FORM表单参数说明
订单数目（v_count）：本次发送的订单个数；
订单编号组（v_oid）：定义同首都电子商城订单支付结果返回接口中的订单编号定义；
    形式如下：v_oid=v_oid1|_|v_oid2|_|v_oid3|_|v_oid4|_|…………。
转帐结果（v_virement）：1à转帐成功；（一批订单无论多少只返回一个1。）
数字指纹（v_mac）：拼串顺序为v_oid+v_virement+v_count。例如发送九笔订单：
20001220-888-135|_|20001220-888-143|_|20001221-888-144|_|20001221-888-145|_|20001221-888-146|_|20001222-888-148|_|20001220-888-141|_|20001222-888-149|_|20001222-888-14719
2、	商户返回消息
"received"，表示成功收到转帐结果。
"error"，表示接收消息发生错误，如md5校验错。
3、例如，在ASP中的参考代码：
 <% ' 获取参数 
v_oid=request("v_oid")
v_virement=request("v_virement")
v_count=request("v_count")
' 解析参数
a_oid=split(v_oid,"|_|")
' 验证md5
dim md,fff
set md=server.CreateObject ("md5_VB.md5class")
fff=md.hmac(v_oid&v_virement&v_count,"test")
' 按验证结果输出结果
if fff<>v_mac then
		response.write "error"
else
		response.write "received"
		' 操作数据库 （略）
			……
end if
%>
*/

require_once ("pay.inc.php");
require_once ("db.inc.php");

if( $v_count = $HTTP_GET_VARS['v_count'] ){
	// GET 方式
	$v_oid = $HTTP_GET_VARS['v_oid'];
	$v_virement = $HTTP_GET_VARS['v_virement'];
	$v_mac = $HTTP_GET_VARS['v_mac'];
}else if( $v_count = $HTTP_POST_VARS['v_count'] ){
	$v_oid = $HTTP_POST_VARS['v_oid'];
	$v_virement = $HTTP_POST_VARS['v_virement'];
	$v_mac = $HTTP_POST_VARS['v_mac'];
}else{
	print "error";
	paylog( "transfer.php: 没有参数" );
	exit;
}

$a_oid = explode( "|_|", $v_oid );

$v_md5 = mhash( MHASH_MD5, $v_oid . $v_virement . $v_count, MD5_KEY );
$v_md5 = bin2hex( $v_md5 );

if( $v_md5 != $v_mac ){
	paylog( "transfer.php: md5校验错误, v_count=$v_count ,v_oid=$v_oid , v_virement=$v_virement ,v_mac=$v_mac" );
	print "error";
	exit;
}

$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("无法连接DBM.");
mysql_select_db( DB_NAME, $conn) or die("无法打开数据库.");

for( $i=0; $i<$v_count; $i++ ){
	//调用函数处理每一笔支付
	do_transfer( $a_oid[$i] );
}

mysql_close($conn);

#print "error";
print "received";
#print "sent";

exit();

function do_transfer( $v_oid )
{
	//TODO...
	global $v_virement;
	if( 1==$v_virement ){
		transfer_ok( $v_oid );
	}
	/*
	$fp = fopen("/tmp/transfer.txt", "a");
	if( !$fp ){
		return false;
	}
	flock( $fp, 2 );//acquire an exclusive lock (writer), set operation to 2

	fputs( $fp, "v_oid=" . $v_oid . "\tv_virement=" . $v_virement . "\n" );

	flock( $fp, 3 );//release a lock (shared or exclusive), set operation to 3. 
	fclose( $fp );
	*/
}
?>
