<?
require_once("../header.inc.php");
$id = $_REQUEST['id'];
$delitem=GetNewsImgPath($id);
$result = mysql_query("delete from News_TB where AutoID=$id");
if ($result){
$msg="删除操作已完成。";
if(is_file($IMGROOT.$delitem))unlink($IMGROOT.$delitem);
}
	else $msg="未知错误，删除操作未完成。";
require_once("../footer.inc.php");
?>
<script language="javascript">alert("<?echo $msg;?>");top.window.location="update.php"</script>
