<?
require_once( "header.inc.php" );

?>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="/my" class="a5">�ҵİ���</a>
				<font color="#458DE4">&gt; </font><a href="/my/UserRegister.shtml" class="a5">������֤</a><br>
                <br>
            </td>
        </tr>
      </table>
	<br>
	<br>
<?
function validate(){

if (!isset($_SESSION['ValidateID'])) {
	echo "���ò���������<a href='{$_SERVER['HTTP_REFERER']}' class='a6'>����</a>";
	return -1;
}
$result=mysql_query("select AutoID,MobilePhone,EMail,Status from User_TB where ID='{$_SESSION['ValidateID']}'");


if (!($row=mysql_fetch_array($result))){//��ID������
	echo "�û� {$_SESSION['ValidateID']} ������";
	return -2;
}

if ($row['Status']!='ProfileNotProved') {
	echo "�����ܽ��п��������֤<br>";
	return -5;
}

$UserAutoID=$row['AutoID'];
$MobilePhone=$row['MobilePhone'];
$EMail=$row['EMail'];

$result=mysql_query("select * from UserValidate_TB where UserAutoID='{$UserAutoID}'");

if (!($row=mysql_fetch_array($result))){ //��������֤����
        $validationCode=mt_rand();
        $sql="insert into UserValidate_TB(UserAutoID,ValidationCode,validated) values ('{$UserAutoID}','{$validationCode}','N');";
	if (!mysql_query($sql)) {
		echo "���ݿ����ʧ�ܣ����������Ա<br>";
		return -3;
	}
} else{
	if ($row['validated']=='Y') {
		echo "���Ѿ���֤ͨ���ˣ��벻Ҫ�ظ���֤";
		return -4;	
	}
	$validationCode=$row['ValidationCode'];
}

if (isset($_REQUEST['Mobile'])){
	dl('libsms.so');
	if (sendsms("localhost","4000",$UserAutoID,$MobilePhone,"������֤��: {$validationCode}")==0) {
		echo "�ֻ���֤�����ѷ��͵������ֻ� {$MobilePhone} ������ע����գ�<br>";
	} else {
		echo "�ֻ���֤���ŷ���ʧ��<br>";
	}
}

return 0;

}

if (validate()>=0) {
?>
<script language="javascript">
<!--
function Login(){
	if (document.all.oName.value=="") {
		alert("�����������û��ʺ�");
		document.all.oName.focus();
		return ;
	}
	if (document.all.oPassword.value=="") {
		alert("��������������");
		document.all.oPassword.focus();
		return ;
	}
	if (document.all.oValidateCode.value=="") {
		alert("������������֤��");
		document.all.oValidateCode.focus();
		return ;
	}


	mainForm.submit();
}
function  Mobile(){
	document.location.href="<?php echo $_SERVER['PHP_SELF']; ?>?Mobile=1";
}
-->
</script>
	<br>
	<input type=button value="������֤����" onclick="Mobile();">
	<br>
                    <form id="mainForm" method="POST" action="dompvalidate.php">
                      <br>
  <div align="center"><table border="0" id="AutoNumber1">
    <tr>
      <td>�û��ʺţ�</td>
      <td><input type="text" id="oName" name="Name" size="20" ></td>
    </tr>
    <tr>
      <td>�û����룺</td>
      <td><input type="password" id="oPassword" name="Password" size="20" ></td>
    </tr>
    <tr>
      <td>��֤�룺</td>
      <td><input type="text" id="oValidateCode" name="validateCode" size="20" ></td>
    </tr>
  </table>
  </div>
  <br>
                      <p align="center"> <img src="/image/enter.gif" width="74" height="22" id="oLogOn" value="��½" onclick="Login();"> 
                      </p>
</form>

<?php
}


?>
</center>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
      <table width="210" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="120">&nbsp;</td>
        </tr>
        <tr> 
          <td>
            <table width="210" cellspacing="8" cellpadding="3">
              <tr> 
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">�������</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../serv_prod/index.shtml" class="a6">��Ʒ�����</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">�ͻ�����</a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" ) ;
?>
