<?
	$FeeType="ProxyPerMonth";

	$resultFee=mysql_query("Select Fee,CutOff from PersonalVPN_Fee_TB where FeeType='". $FeeType ."'");

	if (!($rowFee=mysql_fetch_array($resultFee))){//费用表中不存在纪录
?>
	费用表数据库出错。请联络管理员。<br>
<?
	}else {
		$fee=floatval($rowFee['Fee']) * floatval($rowFee['CutOff']);
		if (!$haveOpen){
		if ($UserAccount<$fee)
		{
			$strFuncStatus=str_replace('PersonalProxy','',$strFuncStatus);
			mysql_query("Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID");
		?>
			由于您的账户余额不足，您尚不能使用个人包月直通车代理功能。<br>
		<?
		} else {
			$strFuncStatus.=",PersonalProxy";
			$query=array();
			$query[]="begin";
			$query[]="Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID";
			$newAccount=$UserAccount-$fee;
			$query[]="Update UserAccount_TB set UserAccount=$newAccount where UserAutoID=$UserAutoID";
			$query[]="Update PersonalVPN_UserChargeTime_TB set UserChargeTime=Now() where UserAutoID=$UserAutoID and FeeType='".$FeeType."'";
			$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason) values (NULL,$UserAutoID,now(),0,{$fee},$newAccount, '缴纳当月直通车代理版包月使用费','PersonalProxy')";
			$query[]="commit";
			$success=true;

			for ($i=0;$i<count($query);++$i){
				if (!mysql_query($query[$i])){
					$success=false;
					mysql_query("rollback");
					break;
				}
			}
			if ($success) {
			?>
				当月个人直通车代理使用费用已从您的账户中扣除。<br>
				您可以开始使用直通车代理版功能。<br>
			<?
			} else {
			?>
				数据操作失败。请联络管理员。<br>
			<?
			}
		}
		}
	}
?>
