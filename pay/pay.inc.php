<?
define( 'MD5_KEY', 'Qx16YDa8eHI5kCYi' );
define( 'AKA_NO', 306 );

define( 'NetPay', 1 );
define( 'Bonus', 2 );
define( 'Agent', 3 );
define( 'Poundage', 3 );

function transfer_ok( $v_oid )
{
	//检查是否已经支付成功
	$result=mysql_query( "select EndDate, TransferDate from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "transfer.php: mysql_query error: " . "select EndDate, TransferDate from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( $row=mysql_fetch_array($result) ){
		$enddate=$row['EndDate'];
		$transferdate=$row['TransferDate'];
	}else{
		paylog( "transfer.php: mysql_fetch_array error" );
		return false;
	}
	mysql_free_result( $result );

	if( !isset($enddate) ){
		paylog( "transfer.php: 支付号'$v_oid'没有完成，却被转帐" );
	}
	if( isset($transferdate) ){
		paylog( "transfer.php: 支付号'$v_oid'已经转帐，却被再次转帐" );
		return false;
	}

	if( !mysql_query( "update NetPay_TB set TransferDate=now() where PayNO='$v_oid'" ) ){
		return false;
	}

	return true;
}

/*
 * 用户网上支付成功
 * 代收费不调用 pay_ok，代收费调用 agent_pay_ok
 */
function pay_ok( $v_oid, $v_pmode )
{
	//检查是否已经支付成功
	$result=mysql_query( "select EndDate from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "payback.php: mysql_query error" . "select EndDate from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( $row=mysql_fetch_array($result) ){
		$enddate=$row['EndDate'];
	}else{
		paylog( "payback.php: mysql_fetch_array error" );
		return false;
	}
	mysql_free_result( $result );

	if( isset($enddate) ){
		//paylog( "pay_ok: 支付号'$v_oid'已经完成，却被再次提交" );
		return true;
	}

	if( !mysql_query( "update NetPay_TB set EndDate=now(), Bank='$v_pmode' where PayNO='$v_oid'" ) ){
		return false;
	}

	$result = mysql_query( "select UserAutoID,Money,Currency from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "pay_ok: mysql_query error select UserAutoID,Money,Currency from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( ! $row=mysql_fetch_array( $result ) ){
		paylog( "pay_ok: mysql_fetch_array error" );
		return false;
	}

	return add_money( $row['UserAutoID'], $row['Money'], $row['Currency'], "网上支付划帐" );
}

/*
 * 代收费网上支付成功
 */
function agent_pay_ok( $v_oid, $v_pmode )
{
	//检查是否已经支付成功
	$result=mysql_query( "select EndDate from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "payback.php: mysql_query error" . "select EndDate from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( $row=mysql_fetch_array($result) ){
		$enddate=$row['EndDate'];
	}else{
		paylog( "payback.php: mysql_fetch_array error" );
		return false;
	}
	mysql_free_result( $result );

	if( isset($enddate) ){
		//paylog( "pay_ok: 支付号'$v_oid'已经完成，却被再次提交" );
		return true;
	}

	if( !mysql_query( "update NetPay_TB set EndDate=now(), Bank='$v_pmode' where PayNO='$v_oid'" ) ){
		return false;
	}

	$result = mysql_query( "select UserAutoID,Money,Currency from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "pay_ok: mysql_query error select UserAutoID,Money,Currency from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( ! $row=mysql_fetch_array( $result ) ){
		paylog( "pay_ok: mysql_fetch_array error" );
		return false;
	}

	// 给用户帐户加钱

	$userautoid = $row['UserAutoID'];
	$amount = $row['Money'];
	$currency = $row['Currency'];
	$msg = "阿卡代收费业务";

	// 手续费 30%
	$poundage_rate = 0.3;

	if( !mysql_query("begin") ) {
		paylog( "mysql begin error" );
		return false;
	}
	if( !user_add_money( $userautoid, $amount, $currency, $msg, Agent ) ){
		mysql_query("rollback");
		paylog( "agent_pay_ok: user_add_money($userautoid, $amount, $currency $msg, Agent) error" );
		return false;
	}

	if ( $amount > 0.1 ){
		$poundage = $amount*$poundage_rate - 2*$amount*$poundage_rate;
	}else{
		$poundage = -0.01;
	}

	if( !user_add_money( $userautoid, $poundage, $currency, "代收费业务30%手续费", Poundage ) ){
		mysql_query("rollback");
		paylog( "agent_pay_ok: user_add_money($userautoid, $poundage, $currency, 30%手续费, Agent) error" );
		return false;
	}
	mysql_query( "commit" );
	return true;

}

function paylog( $msg )
{
	$date = date( "Y-m-d H:i:s" );
	$fp = fopen("/var/log/netpay", "a");
	if( !$fp ){
		return false;
	}
	flock( $fp, 2 );//acquire an exclusive lock (writer), set operation to 2
	fputs( $fp, "$date $msg\n" );

	flock( $fp, 3 );//release a lock (shared or exclusive), set operation to 3. 
	fclose( $fp );
}

/*
 * add_money
 * 给用户号 userautoid 的用户加 amount 钱，理由是 $msg
 * 同时奖励上线与上上线
 */
function add_money( $userautoid, $amount, $currency, $msg )
{
	$amount = floatval( $amount );

	if( !mysql_query("begin") ){
		paylog( "mysql begin error" );
		return false;
	}
	if( !user_add_money( $userautoid, $amount, $currency, $msg, NetPay ) ){
		mysql_query("rollback");
		paylog( "add_money: user_add_money($userautoid, $amount, $currency $msg, NetPay) error" );
		return false;
	}
	/*
	 * 给上线加钱
	 * 上线： 5%，上上线：10%
	 */
	 $srate = 0.05;
	 $ssrate = 0.1;

	$result = mysql_query( "select B.AutoID as SuperUserAutoID ,B.ID as SuperUserID, A.ID as ID from User_TB as A, User_TB as B where A.AutoID=$userautoid and A.SuperiorUserAutoID=B.AutoID" );	
	if ($row=mysql_fetch_array($result)){
		$superuserid=$row['SuperUserAutoID'];
		$userid=$row['ID'];
		if( !user_add_money($superuserid,floatval($amount*$srate),$currency,"下线 $userid 向账户加钱给您的奖励", Bonus) ){
			mysql_query("rollback");
			paylog( "add_money: user_add_money($superuserid, $amount*$srate,$currency,下线 $userid 向账户加钱给您的奖励, Bonus) error" );
			return false;
		}
		mysql_free_result( $result );
		
		// 上上线
		$result = mysql_query( "select B.AutoID as SuperUserAutoID ,B.ID as SuperUserID, A.ID as ID from User_TB as A, User_TB as B where A.AutoID=$superuserid and A.SuperiorUserAutoID=B.AutoID" );	
		if( $row=mysql_fetch_array($result) ){
			$userid=$row['ID'];
			$ssuserid=$row['SuperUserAutoID'];
			if( !user_add_money($ssuserid,floatval($amount*$ssrate),$currency,"下线 $userid 的下线向账户加钱给您的奖励", Bonus) ){
				mysql_query("rollback");
				paylog( "add_money: user_add_money($superuserid, $amount*$srate,$currency,下线$userid的下线向账户加钱给您的奖励,Bonus) error" );
				return false;
			}
		} //上上线
		mysql_free_result( $result );
	} //上线
	mysql_query( "commit" );
	return true;
}



/*
 * user_add_money
 * 给用户号 userautoid 的用户加 amount 钱，理由是 $msg
 * 只给用户加钱，没有其他奖励
 * 内部操作没有 commit，需要额外的 begin/commit
 */
function user_add_money( $userautoid, $amount, $currency, $msg, $type )
{
	$amount = floatval ( $amount );
	
	if ( 0.01>$amount ){
		return true;
	}

	paylog( "user_add_money( $userautoid, $amount, $currency, $msg )" );
	if( ! (is_numeric($userautoid) && is_numeric($amount) && round($amount,2)>=0) ){ //XXX round($amount,2)判断这个有什么用？
		paylog( "user_add_money($userautoid,$amount,$currency,$msg,$type)参数错误" );
		return false;
	}

	//给用户帐户加钱
	// 美元
	if ( "USD"==$currency ){
		if( !mysql_query("update UserAccount_TB set UserAccountUSD=UserAccountUSD+$amount,AccountEnable='Y' where UserAutoID=$userautoid") ){
			paylog ( "XXX1 sql query error: update UserAccount_TB set UserAccountUSD=UserAccountUSD+$amount,AccountEnable='Y' where UserAutoID=$userautoid" );
			mysql_query( "rollback" );
			return false;
		}
	}else if( "RMB"==$currency ){
		if( !mysql_query("update UserAccount_TB set UserAccount=UserAccount+$amount,AccountEnable='Y' where UserAutoID=$userautoid") ){
			paylog( "XXX2 sql query error: update UserAccount_TB set UserAccount=UserAccount+$amount,AccountEnable='Y'  where UserAutoID=$userautoid" );
			mysql_query( "rollback" );
			return false;
		}
	}else{
		paylog ( "currency is neither USD nor RMB! currency is [$currency] !" );
		return false;
	}

	//选出用户账上金额
	$result = mysql_query( "select UserAccount,UserAccountUSD from UserAccount_TB where UserAutoID=$userautoid" );
	if( !$result ){
		paylog( "sql query error: select UserAccount,UserAccountUSD from UserAccount_TB where UserAutoID=$userautoid and Currency='$currency'" );
		mysql_query( "rollback" );
		return false;
	}
	if( !$row=mysql_fetch_array($result) ){
		paylog( "mysql_fetch_array error" );
		mysql_query( "rollback" );
		return false;
	}

	if ( "RMB"==$currency ){
		$UserAccount=$row['UserAccount'];
	}else if ( "USD"==$currency ){
		$UserAccount=$row['UserAccountUSD'];
	}
		
	if( NetPay==$type ){
		$Reason = 'NetPay';
	}elseif( Bonus==$type ){
		$Reason = 'Bonus';
	}elseif( Agent==$type ){
		$Reason = 'Agent';
	}elseif( Poundage==$type ){
		$Reason = 'Poundage';
	}else{
		paylog( "user_add_money's type is neither NetPay nor Bonus nor Agent nor Poundage" );
	}
	//记录帐户日志
	if ($amount>0){
		if( !mysql_query("insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=$amount,Outcoming=0,balance=$UserAccount,Notes='$msg',Reason='$Reason',Currency='$currency'") ){
			paylog( "mysql_query: insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=$amount,Outcoming=0,balance=$UserAccount,Notes='$msg',Reason='$Reason',Currency='$currency'" );
			mysql_query( "rollback" );
			return false;
		}
	}else{
		if( !mysql_query("insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=0,Outcoming=$amount,balance=$UserAccount,Notes='$msg',Reason='$Reason',Currency='$currency'") ){
			paylog( "mysql_query: insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=0,Outcoming=$amount,balance=$UserAccount,Notes='$msg',Reason='$Reason',Currency='$currency'" );
			mysql_query( "rollback" );
			return false;
		}
	}
	return true;
}


/*
 * 将页面转向首都电子商城
 * $type 币种,0为人民币,1为美元
 * $url 是支付完毕后的返回地址
 */
function doPrepare( $userautoid, $money, $type, $url )
{
	global $v_mid;

	$v_url=$url;  //支付完成显示商户页面
	$v_moneytype=$type?$type:0;  //币种,0为人民币,1为美元
	$currency=$type?'USD':'RMB';  //币种,0为人民币,1为美元

	$v_mid=AKA_NO; //AKA 的首信商户编号

/*
	if( $v_moneytype ){ //美元，按照 1:8 汇率换算为RMB
		$v_amount=round( $money/8, 2 ); //美元按照 1:8 汇率换算
	}else{ //人民币
*/
		$v_amount=$money;
/*
	}
*/

	$v_ymd=date( "Ymd" );

	if( !mysql_query("begin") ){
		return false;
	}

	if( !mysql_query("insert into NetPay_TB ( UserAutoID, StartDate, Money, Currency ) values ( $userautoid, now(), $money, '$currency')") ){
		mysql_query( "rollback" );
		return false;
	}

	$result=mysql_query("select last_insert_id()");
	if( !$result ){
		mysql_query( "rollback" );
		return false;
	}

	//生成网上支付订单号
	if( $row=mysql_fetch_array($result) ){
		$netpayid=$row[0];
		$v_oid=$v_ymd . "-" . $v_mid . "-" . $netpayid;
	}else{
		mysql_query( "rollback" );
		return false;
	}
	mysql_free_result($result);

	if( !mysql_query("update NetPay_TB set PayNO='$v_oid' where AutoID=$netpayid") ){
		mysql_query( "rollback" );
		return false;
	}

	if( !mysql_query("commit") ){
		mysql_query("rollback");
		return false;
	}

	$v_rcvname='姓名';
	$v_rcvaddr='地址';
	$v_rcvtel='电话';
	$v_rcvpost='邮编';
	$v_orderstatus=1; //商户配货状态，0为未配齐，1为已配齐
	$v_ordername='订货人姓名';

	$mark=$v_moneytype . $v_ymd . $v_amount . $v_rcvname . $v_oid . $v_mid . $v_url;
	$hash = bin2hex( mhash (MHASH_MD5, $mark, MD5_KEY ) );
	#print "<b>$hash = bin2hex( mhash (MHASH_MD5, '$mark', MD5_KEY ) );</b>";
	//$hash = bin2hex( $hashbin );
	print "<br><p align=center>";
	if( $v_moneytype ){
		print "<form method=post action='http://pay.beijing.com.cn/prs/e_user_payment.checkit' name=capform>\n";
	}else{ //人民币
		print "<form method=post action='http://pay.beijing.com.cn/prs/user_payment.checkit' name=capform>\n";
	}
?>
	<input type=hidden name=v_mid value="<?=$v_mid?>">
	<input type=hidden name=v_oid value="<?=$v_oid?>">
	<input type=hidden name=v_rcvname value="<?=$v_rcvname?>">
	<input type=hidden name=v_rcvaddr value="<?=$v_rcvaddr?>">
	<input type=hidden name=v_rcvtel value="<?=$v_rcvtel?>">
	<input type=hidden name=v_rcvpost value="<?=$v_rcvpost?>">
	<input type=hidden name=v_amount value="<?=$v_amount?>">
	<input type=hidden name=v_ymd value="<?=$v_ymd?>">
	<input type=hidden name=v_orderstatus value="<?=$v_orderstatus?>">
	<input type=hidden name=v_ordername value="<?=$v_ordername?>">
	<input type=hidden name=v_moneytype value="<?=$v_moneytype?>">
	<input type=hidden name=v_url value="<?=$v_url?>">
	<input type=hidden name=v_md5info value="<?=$hash?>">
	<input type=submit name=v_action value="首都电子商城网上安全支付平台">
</form>
</p>
<script language=javascript>
	document.capform.submit();
</script>
<?
	return true;
}

?>
