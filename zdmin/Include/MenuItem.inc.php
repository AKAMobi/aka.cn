<?
session_start();
require_once("zdmin.inc.php");
if (isset($_SESSION['AdminID'])){
?>
ItemURL,ItemName
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/UserAccount/ApproveUser.php,审批用户注册
<? } ?>
<? if (isset($_SESSION['NewsAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/News/NewsAdmin.php,新闻管理
<? } ?>
<? if (isset($_SESSION['PersonalVPNAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewUserOnLine.php,察看个人VPN在线用户信息
<? } ?>
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/UserAccount/FindUser.php,察看、修改用户信息
<? } ?>
<? if (isset($_SESSION['UserAccountAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewInvestigateResult.php,察看个人VPN用户调查结果
<? } ?>
<? if (isset($_SESSION['LogAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Log/ViewLog.php,察看管理日志
<? } ?>
<? if (isset($_SESSION['MoneyAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Money/AddUserMoney.php,给用户加（减）钱
<? } ?>
<? if (isset($_SESSION['MoneyAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/Money/AddAllUserMoney.php,给所有用户加（减）钱
<? } ?>
<? if (isset($_SESSION['AdminAdmin'])) { ?>
<? echo $ADMINURLROOT; ?>/AdminUser/AdminUserControl.php,管理员账号管理
<? } ?>
<? echo $ADMINURLROOT; ?>/ChangePassword.php,更换密码
<? echo $ADMINURLROOT; ?>/Logout.php,退出登录
<? 
}
?>