<? 

session_set_cookie_params( 0, "/", "aka.com.cn" );

session_start(); 

require_once("zdmin.inc.php");


if ( (!isset($_SESSION['AdminID'])) ){

require("{$ADMINROOT}/Include/IncludeFile.php");



IncludeHTML("{$AKAROOT}/header.html");

?>

<script language="javascript">

<!--

function Login(){

	if (document.all.oName.value=="") {

		alert("�����������û��ʺ�");

		document.all.oName.focus();

		return ;

	}


	mainForm.submit();

}



function IsEnter(){

	return (window.event.keyCode == 13);

}



function testKey_Name(){

	if ( IsEnter() ) {

		document.all.oPassword.focus();

	}

}



function testKey_Password(){



	if ( IsEnter() ) {

		document.all.oLogOn.click();

	}

}

-->

</script>



<table width="760" border="0" cellspacing="0" cellpadding="0">

  <tr> 

    <td width="550" height="224" valign="top"> 

      <center>

      <table width="500" cellspacing="0" cellpadding="0">

        <tr>

            <td> 

              <p><b><font color="#3366CC"><br>

                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 

                </font><a href="<? echo $ADMINURLROOT; ?>" class="a5">��վ����Ա</a><br>

                <br>

                <span class="newstitle"> ��վ����Ա</span></p>

              <p>ͨ���û�ע�ᣬ�鿴ϵͳ״̬��</p>

              <p>&nbsp;</p>

            </td>

        </tr>

      </table>

      </center>

      <div align="left"> 

        <table width="500" cellspacing="0" cellpadding="0" align="center">

          <tr> 

            <td bgcolor="#006699" height="14"><b><font color="#FFFFFF">��¼�û�����ϵͳ</font></b> 

              <table width="500" cellspacing="0" cellpadding="0" align="center">

                <tr> 

                  <td bgcolor="#FFFFFF" height="14">



                    <form id="mainForm" method="POST" action="Logon.php">

                      <br>

  <div align="center"><table border="0" id="AutoNumber1">

    <tr>

      <td>����Ա�ʺţ�</td>

      <td><input type="text" id="oName" name="Name" size="20" onkeypress="testKey_Name();" ></td>

    </tr>

    <tr>

      <td>����Ա���룺</td>

      <td><input type="password" id="oPassword" name="Password" size="20" onkeypress="testKey_Password();" ></td>

    </tr>

  </table>

  </div>

  <br>

                      <p align="center"> <img src="/customer/images/enter.gif" width="74" height="22" id="oLogOn" value="��½" onclick="Login();"> 

                      </p>

</form>

                    <p>&nbsp;</p>

                    <p>&nbsp;</p>

                  </td>

                </tr>

              </table>

            </td>

          </tr>

        </table>

        

      </div>

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

                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>

                </td>

                <td><a href="/serv_prod/index.shtml" class="a6">��Ʒ�����</a></td>

              </tr>

              <tr> 

                <td width="27"> 

                  <div align="right"><img src="/image/leadarrow.gif" width="5" height="10"></div>

                </td>

                <td><a href="/customer/index.shtml" class="a6">�ͻ�����</a></td>

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

IncludeHTML("{$AKAROOT}/footer.html");

}else {

header("Refresh: 0;URL=AdminMenu.php");

exit();

}

?>

