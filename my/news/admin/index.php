<?
session_start();
$passwd=$HTTP_POST_VARS['passwd'];
if ($passwd=='zixia.net'){
session_register('logined');
session_register('AdminName');
$AdminName='zixia';
}
if(session_is_registered('logined')){
echo '<script language="javascript">top.window.location="update.php"</script>';
}
?>
<link rel="stylesheet" href="font.css" type="text/css">
<body background="../bbs/images/bg.gif">
<br><br><br><br><br><br>
<fieldset style="width:55%" align="center"><legend>News Updata System 1.0</legend>
<div align=center>
<form name="form1" method="post" action="index.php" enctype="multipart/form-data">
    <p>Please Login System</p>
	Username£º<input type="text" name="na" size=20><br><br>
	Password£º<input type="password" name="passwd" size=20>
	<p> 
    <input type="submit" name="Submit" value="submit">
    <input type="reset" name="Submit2" value="reset">
  </p>
</form>
</div>
</fieldset>
</body>