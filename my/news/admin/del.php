<?
require_once("../header.inc.php");
$id = $_REQUEST['id'];
$delitem=GetNewsImgPath($id);
$result = mysql_query("delete from News_TB where AutoID=$id");
if ($result){
$msg="ɾ����������ɡ�";
if(is_file($IMGROOT.$delitem))unlink($IMGROOT.$delitem);
}
	else $msg="δ֪����ɾ������δ��ɡ�";
require_once("../footer.inc.php");
?>
<script language="javascript">alert("<?echo $msg;?>");top.window.location="update.php"</script>
