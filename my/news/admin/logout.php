<?
session_start();
session_unregister('logined');
echo '<script language="javascript">top.window.location="../index.php"</script>';
?>