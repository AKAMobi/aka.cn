<?
	$FeeType="PerMonth";

	$resultFee=mysql_query("Select Fee,CutOff from PersonalVPN_Fee_TB where FeeType='" . $FeeType ."'");

	if (!($rowFee=mysql_fetch_array($resultFee))){//费用表中不存在纪录
?>
	费用表数据库出错。请联络管理员。<br>
<?
	}else {
		$fee=floatval($rowFee['Fee']) * floatval($rowFee['CutOff']);
		if (!$haveOpen){
		if ($UserAccount<$fee)
		{
			$strFuncStatus=str_replace('PersonalVPN','',$strFuncStatus);
			mysql_query("Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID");
		?>
			<font color=red>由于您的账户余额不足，您尚不能使用阿卡出国直通车功能。<br>
			注：帐户余额：<?= $UserAccount ?>，需要缴费：<?= $fee ?></font><br>
		<?
		} else {
			$strFuncStatus.=",PersonalVPN";
			$query=array();
			$query[]="begin";
			$query[]="Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID";
			$newAccount=$UserAccount-$fee;
			$query[]="Update UserAccount_TB set UserAccount=$newAccount where UserAutoID=$UserAutoID";
			$query[]="Update PersonalVPN_UserChargeTime_TB set UserChargeTime=Now() where UserAutoID=$UserAutoID and FeeType='".$FeeType."'";
			$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason) values (NULL,$UserAutoID,now(),0,{$fee},$newAccount, '缴纳当月出国直通车包月使用费','PersonalVPN')";
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
				当月出国直通车使用费用已从您的账户中扣除。<br>
				您可以开始使用出国直通车功能。<br>
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
