<?
	$FeeType="PerMonth";

	$resultFee=mysql_query("Select Fee,CutOff from PersonalVPN_Fee_TB where FeeType='" . $FeeType ."'");

	if (!($rowFee=mysql_fetch_array($resultFee))){//���ñ��в����ڼ�¼
?>
	���ñ����ݿ�������������Ա��<br>
<?
	}else {
		$fee=floatval($rowFee['Fee']) * floatval($rowFee['CutOff']);
		if (!$haveOpen){
		if ($UserAccount<$fee)
		{
			$strFuncStatus=str_replace('PersonalVPN','',$strFuncStatus);
			mysql_query("Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID");
		?>
			<font color=red>���������˻����㣬���в���ʹ�ð�������ֱͨ�����ܡ�<br>
			ע���ʻ���<?= $UserAccount ?>����Ҫ�ɷѣ�<?= $fee ?></font><br>
		<?
		} else {
			$strFuncStatus.=",PersonalVPN";
			$query=array();
			$query[]="begin";
			$query[]="Update User_TB set UserFuncStatus='$strFuncStatus' where AutoID=$UserAutoID";
			$newAccount=$UserAccount-$fee;
			$query[]="Update UserAccount_TB set UserAccount=$newAccount where UserAutoID=$UserAutoID";
			$query[]="Update PersonalVPN_UserChargeTime_TB set UserChargeTime=Now() where UserAutoID=$UserAutoID and FeeType='".$FeeType."'";
			$query[]="insert into UserAccountLog_TB(AutoID,UserAutoID,OperateTime,Incoming,Outcoming,balance,Notes,Reason) values (NULL,$UserAutoID,now(),0,{$fee},$newAccount, '���ɵ��³���ֱͨ������ʹ�÷�','PersonalVPN')";
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
				���³���ֱͨ��ʹ�÷����Ѵ������˻��п۳���<br>
				�����Կ�ʼʹ�ó���ֱͨ�����ܡ�<br>
			<?
			} else {
			?>
				���ݲ���ʧ�ܡ����������Ա��<br>
			<?
			}
		}
		}
	}
?>
