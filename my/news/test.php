<?
//if(mkdir('./images/test',0777))echo 'ok';else echo 'false';
//rmdir('./images/test');
/*if(unlink('./images/2002/11/08/04.jpg'))echo 'ok'; else echo 'false';
unlink('./images/2002/11/08/002.gif');
rmdir('./images/2002/11/08');
rmdir('./images/2002/11');
*/
require_once("header.inc.php");
mysql_query("delete from News_TB");
//$rst=mysql_query("select ImagePath from News_TB where AutoID=17");
//$row=mysql_fetch_row($rst);
//echo $row[0];
require_once("footer.inc.php");
?>