<?
session_start();
require_once("zdmin.inc.php");
if (isset($_SESSION['AdminID'])){
?>
ItemURL,ItemName
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/UserAccount/ApproveUser.php,�����û�ע��
<? } ?>
<? if (isset($_SESSION['NewsAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/News/NewsAdmin.php,���Ź���
<? } ?>
<? if (isset($_SESSION['PersonalVPNAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewUserOnLine.php,�쿴����VPN�����û���Ϣ
<? } ?>
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/UserAccount/FindUser.php,�쿴���޸��û���Ϣ
<? } ?>
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewInvestigateResult.php,�쿴����VPN�û�������
<? } ?>
<? if (isset($_SESSION['LogAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Log/ViewLog.php,�쿴������־
<? } ?>
<? if (isset($_SESSION['MoneyAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Money/AddUserMoney.php,���û��ӣ�����Ǯ
<? } ?>
<? if (isset($_SESSION['MoneyAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Money/AddAllUserMoney.php,�������û��ӣ�����Ǯ
<? } ?>
<? if (isset($_SESSION['AdminAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/AdminUser/AdminUserControl.php,����Ա�˺Ź���
<? } ?>
<? echo $ADMINURLROOT; ?>/ChangePassword.php,��������
<? echo $ADMINURLROOT; ?>/Logout.php,�˳���¼
<? 
}
?>