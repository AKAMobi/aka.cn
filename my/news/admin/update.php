<?
session_start();
if(session_is_registered('logined')){
?>
<html>
<head>
<title>News Update System 1.0</title>
<frameset cols="200,560*" frameborder="YES" border="1" framespacing="1" rows="*"> 
  <frame name="leftFrame" scrolling="AUTO" src="month.php">
  <frame name="mainFrame" src="newslist.php">
</frameset>
<noframes><body bgcolor="#FFFFFF">
</body></noframes>
<?
}else {
echo '<script language="javascript">top.window.location="../index.php"</script>';
}
?>