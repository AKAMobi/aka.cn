<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/" class="a5">��վ����Ա</a><font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT ;?>/AdminMenu.php" class="a5">����˵�</a> 
                <font color="#458DE4">&gt;</font><a href="<? echo $ADMINURLROOT ;?>/UserAccount/FindUser.php" class="a5">�����û�</a>
				<br>
                <br>
                <span class="newstitle">�����û�</span></p>
              
			  <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID']) ) ) {
?>
����δ��½��<br>
������<A HREF="<? echo $ADMINURLROOT ;?>/index.php">��½</a>��
<?
}else {

if ( (!isset($_SESSION['UserAccountAdmin'])) ) {
?>
��û���û��ʻ������Ȩ��<br>
�뷵��<A HREF="<? echo $ADMINURLROOT ;?>/AdminMenu.php">����˵�</a>
<?
} else {


?>
<script language="javascript">
<!--
function FindUser(){
	if (document.all.oUserID.value=="") {
		alert("������������û���ID");
		document.all.oUserID.focus();
		return ;
	}
	mainForm.submit();
}

function IsEnter(){
	return (window.event.keyCode == 13);
}

function testKey_UserID(){

	if ( IsEnter() ) {
		document.all.oFindUser.click();
	}
}
-->
</script>
<form id="mainForm" method="get" action="ViewUserProfile.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>�û�ID</td>
      <td><input type="textfield" id="oUserID" name="ID" size="20" onkeypress="testKey_UserID();" ></td>
    </tr>
</table>
  </div>
  <br>
  <p align="center">
  <input type="button" id="oFindUser" value="�����û�" onclick="FindUser();"> 
   </p>
</form>

<?
}
}
?>
</td></tr></table>
<br>
<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>

