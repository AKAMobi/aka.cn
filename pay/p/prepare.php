<?
/*
<form method=post action="http://pay.beijing.com.cn/prs/user_payment.checkit">
2、FORM表单参数说明
  商户编号(v_mid)              不可为空值，以初始单上所填商户编号为准。
  订单编号(v_oid)               不可为空值，商城订单编号格式统一为：
	             订单生成日期(yyyymmdd)-商户编号-商户流水号
           例如：19990720-88-12345。商户流水号每日内不重复即可，为数字。
          注：订单编号所有字符总和不可超过64位，否则支付平台拒绝接受。
  收货人姓名(v_rcvname)        不可为空值，中英文均可，总长不超过64个字符。
  收货人地址(v_rcvaddr)         不可为空值，总长不超过128个字符。
  收货人电话(v_rcvtel)           不可为空值，总长不超过32个字符。
  收货人邮政编码(v_rcvpost)     不可为空值，总长不超过12个字符。
  订单总金额(v_amount)         不可为空值，单位：元，小数点后保留两位，如13.45
  订单产生日期(v_ymd)          不可为空值，格式为yyyymmdd
  配货状态(v_orderstatus)         商户配货状态，0为未配齐，1为已配齐
  订货人姓名(v_ordername)       总长不超过64个字符
  支付币种(v_moneytype)        0为人民币，1为美元
  订单数字指纹(v_md5info)  	  详情见md5说明
  返回商户页面(v_url)           为消费者完成购物后返回的商户页面
3、示例（注：此例商户号888应改为您的商户号）
<form method=post action="http://pay.beijing.com.cn/prs/user_payment.checkit">
 <input type=hidden name=v_mid value="888">                           商户编号
 <input type=hidden name=v_oid value="19990720-888-000001234">           订单编号
 <input type=hidden name=v_rcvname value="张三">                       收货人姓名
 <input type=hidden name=v_rcvaddr value="北京海淀">                 收货人地址
 <input type=hidden name=v_rcvtel value="68475566">                     收货人电话
 <input type=hidden name=v_rcvpost value="100036">	                收货人邮编
 <input type=hidden name=v_amount value="13.45">                     订单总金额
 <input type=hidden name=v_ymd value="19990720">	              订单产生日期
 <input type=hidden name=v_orderstatus value="0">                       配货状态
 <input type=hidden name=v_ordername value="李四">                   订货人姓名
 <input type=hidden name=v_moneytype value="0">         币种,0为人民币,1为美元
 <input type=hidden name=v_url value="http://domain/program">  支付完成显示商户页面
 <input type=hidden name=v_md5info value="1630dc083d70a1e8af60f49c143a7b95">
  订单数字指纹
 <input type=submit name=v_action value="首都电子商城网上安全支付平台">
 </form>
由于采用HTML表单方式传递参数，就出现了消费者可以任意篡改页面信息的问题，为防止此类现象发生，
我们需要对页面部分敏感信息作签名以保证其真实性和完整性。
首都电子商城安全支付平台向入驻商户提供了一个标准的签名程序源码，该程序提供签名功能，
主功能函数为char* hmac (char* text, char* key)，该函数有两个入口参数：char* text和
char* key。其中text是将表单中部分敏感信息拼串的结果，具体做法如下：
当消费者在商户端生成最终订单的时候，将订单中的
v_moneytype v_ymd v_amount v_rcvname v_oid v_mid v_url七个参数的value值
拼成一个无间隔的字符串(char型，顺序不要改变)。而另一个入口参数key则是商城与商户私下约定
的密钥。该密钥由商户生成，建议为16个字符，字母数字的组合。并通知首都电子商城相关人员。
在更换密钥时，请按照：公司名、商户号、联系人、密钥的顺序发送到e-c@capinfo.com.cn。
该密钥初始值为test，以下所用到的密钥均为此密钥。例如上例表单的拼串结果应为：
01999072013.45张三19990720-888-000001234888http://domain/program
该函数返回值即为我们所需的数字指纹，将其写入v_md5info字段即可。
注：英文支付接口（四种外卡）可使用如下CGI接口链接：
<form method=post action="http://pay.beijing.com.cn/prs/e_user_payment.checkit">
*/

/*
 *	prepare.php
 *	准备支付信息，初始化支付订单的数据库信息
 *
 *	参数：
 *		Session->UserID
 *		MoneyCount	钱数，人民币单位
 *		MoneyType	币种，0: RMB 1: USD
 *		BackURL		支付完毕返回页面URL
 */

require( "header.inc.php" );
require( "../pay.inc.php" );
?>
<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" rowspan="3"> 
<?
$isSuccess=false;
$userid=$_REQUEST['UserID'];
$money=$HTTP_POST_VARS['MoneyCount'];
$moneytype=$HTTP_POST_VARS['MoneyType'];
$backurl=$HTTP_POST_VARS['BackURL'];

/*
echo "user:";
foreach( $_SESSION as $key => $value ){
	print( "session: $key => $value<br>" );
}
*/

if( is_numeric($money) && round($money,2)>0 ){
	if( $userid ){
		$result=mysql_query("select * from User_TB where ID='$userid'");
		if( $row=mysql_fetch_array($result) ){


			//XXX 成功，转交银行
			if( doPrepare($row["AutoID"], $money, $moneytype, $backurl, "Agent") ){
				//提交支付请求成功
				$isSuccess=true;

			}else{
				err_msg( "系统忙" );
			}
		}else{
			//无此用户
			err_msg( "错误：没有这个用户" );
		}
		mysql_free_result($result);
	}else{
		err_msg( "错误：没有这个用户" );
	}
}else{
	//没有输入钱数或输入错误
	err_msg( "请输入正确的金额" );
}

if( !$isSuccess ){
	print "<p align=center><a href='javascript:history.go(-1)'>返回</a></p>\n";
}

require( "footer.inc.php" );
exit;

