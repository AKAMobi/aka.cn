<?
define( 'MD5_KEY', 'Qx16YDa8eHI5kCYi' );
define( 'AKA_NO', 306 );

define( 'NetPay', 1 );
define( 'Bonus', 2 );

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
		paylog( "pay_ok: 支付号'$v_oid'已经完成，却被再次提交" );
		return false;
	}

	if( !mysql_query( "update NetPay_TB set EndDate=now(), Bank='$v_pmode' where PayNO='$v_oid'" ) ){
		return false;
	}

	$result = mysql_query( "select UserAutoID,Money from NetPay_TB where PayNO='$v_oid'" );
	if( !$result ){
		paylog( "pay_ok: mysql_query error select UserAutoID,Money from NetPay_TB where PayNO='$v_oid'" );
		return false;
	}
	if( ! $row=mysql_fetch_array( $result ) ){
		paylog( "pay_ok: mysql_fetch_array error" );
		return false;
	}

	return add_money( $row['UserAutoID'], $row['Money'], "网上支付划帐" );
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
function add_money( $userautoid, $amount, $msg )
{
	if( !mysql_query("begin") ){
		paylog( "mysql begin error" );
		return false;
	}
	if( !user_add_money( $userautoid, $amount, $msg, NetPay ) ){
		mysql_query("rollback");
		paylog( "add_money: user_add_money($userautoid, $amount, $msg, NetPay) error" );
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
		if( !user_add_money($superuserid,$amount*$srate,"下线 $userid 向账户加钱给您的奖励", Bonus) ){
			mysql_query("rollback");
			paylog( "add_money: user_add_money($superuserid, $amount*$srate,下线 $userid 向账户加钱给您的奖励, Bonus) error" );
			return false;
		}
		mysql_free_result( $result );
		
		// 上上线
		$result = mysql_query( "select B.AutoID as SuperUserAutoID ,B.ID as SuperUserID, A.ID as ID from User_TB as A, User_TB as B where A.AutoID=$superuserid and A.SuperiorUserAutoID=B.AutoID" );	
		if( $row=mysql_fetch_array($result) ){
			$userid=$row['ID'];
			$ssuserid=$row['SuperUserAutoID'];
			if( !user_add_money($ssuserid,$amount*$ssrate,"下线 $userid 的下线向账户加钱给您的奖励", Bonus) ){
				mysql_query("rollback");
				paylog( "add_money: user_add_money($superuserid, $amount*$srate,下线$userid的下线向账户加钱给您的奖励,Bonus) error" );
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
function user_add_money( $userautoid, $amount, $msg, $type )
{
	paylog( "user_add_money( $userautoid, $amount, $msg )" );
	if( ! (is_numeric($userautoid) && is_numeric($amount) && round($amount,2)>0) ){
		paylog( "user_add_money($userautoid,$amount,$msg)参数错误" );
		return false;
	}

	//给用户帐户加钱
	if( !mysql_query("update UserAccount_TB set UserAccount=UserAccount+$amount,AccountEnable='Y' where UserAutoID=$userautoid") ){
		paylog( "sql query error: update UserAccount_TB set UserAccount=UserAccount+$amount where UserAutoID=$userautoid" );
		mysql_query( "rollback" );
		return false;
	}

	//选出用户账上金额
	$result = mysql_query( "select UserAccount from UserAccount_TB where UserAutoID=$userautoid" );
	if( !result ){
		paylog( "sql query error: select UserAccount from UserAccount_TB where UserAutoID=$userautoid" );
		mysql_query( "rollback" );
		return false;
	}
	if( !$row=mysql_fetch_array($result) ){
		paylog( "mysql_fetch_array error" );
		mysql_query( "rollback" );
		return false;
	}
	$UserAccount=$row['UserAccount'];
		
	if( NetPay==$type ){
		$Reason = 'NetPay';
	}elseif( Bonus==$type ){
		$Reason = 'Bonus';
	}else{
		paylog( "user_add_money's type is neither NetPay nor Bonus" );
	}
	//记录帐户日志
	if( !mysql_query("insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=$amount,Outcoming=0,balance=$UserAccount,Notes='$msg',Reason='$Reason'") ){
		paylog( "mysql_query: insert into UserAccountLog_TB set UserAutoID=$userautoid,OperateTime=now(),Incoming=$amount,Outcoming=0,balance=$UserAccount,Notes='$msg',Reason='$Reason'" );
		mysql_query( "rollback" );
		return false;
	}
	return true;
}
