<?
/*
<form method=post action="http://pay.beijing.com.cn/prs/user_payment.checkit">
2��FORM������˵��
  �̻����(v_mid)              ����Ϊ��ֵ���Գ�ʼ���������̻����Ϊ׼��
  �������(v_oid)               ����Ϊ��ֵ���̳Ƕ�����Ÿ�ʽͳһΪ��
	             ������������(yyyymmdd)-�̻����-�̻���ˮ��
           ���磺19990720-88-12345���̻���ˮ��ÿ���ڲ��ظ����ɣ�Ϊ���֡�
          ע��������������ַ��ܺͲ��ɳ���64λ������֧��ƽ̨�ܾ����ܡ�
  �ջ�������(v_rcvname)        ����Ϊ��ֵ����Ӣ�ľ��ɣ��ܳ�������64���ַ���
  �ջ��˵�ַ(v_rcvaddr)         ����Ϊ��ֵ���ܳ�������128���ַ���
  �ջ��˵绰(v_rcvtel)           ����Ϊ��ֵ���ܳ�������32���ַ���
  �ջ�����������(v_rcvpost)     ����Ϊ��ֵ���ܳ�������12���ַ���
  �����ܽ��(v_amount)         ����Ϊ��ֵ����λ��Ԫ��С���������λ����13.45
  ������������(v_ymd)          ����Ϊ��ֵ����ʽΪyyyymmdd
  ���״̬(v_orderstatus)         �̻����״̬��0Ϊδ���룬1Ϊ������
  ����������(v_ordername)       �ܳ�������64���ַ�
  ֧������(v_moneytype)        0Ϊ����ң�1Ϊ��Ԫ
  ��������ָ��(v_md5info)  	  �����md5˵��
  �����̻�ҳ��(v_url)           Ϊ��������ɹ���󷵻ص��̻�ҳ��
3��ʾ����ע�������̻���888Ӧ��Ϊ�����̻��ţ�
<form method=post action="http://pay.beijing.com.cn/prs/user_payment.checkit">
 <input type=hidden name=v_mid value="888">                           �̻����
 <input type=hidden name=v_oid value="19990720-888-000001234">           �������
 <input type=hidden name=v_rcvname value="����">                       �ջ�������
 <input type=hidden name=v_rcvaddr value="��������">                 �ջ��˵�ַ
 <input type=hidden name=v_rcvtel value="68475566">                     �ջ��˵绰
 <input type=hidden name=v_rcvpost value="100036">	                �ջ����ʱ�
 <input type=hidden name=v_amount value="13.45">                     �����ܽ��
 <input type=hidden name=v_ymd value="19990720">	              ������������
 <input type=hidden name=v_orderstatus value="0">                       ���״̬
 <input type=hidden name=v_ordername value="����">                   ����������
 <input type=hidden name=v_moneytype value="0">         ����,0Ϊ�����,1Ϊ��Ԫ
 <input type=hidden name=v_url value="http://domain/program">  ֧�������ʾ�̻�ҳ��
 <input type=hidden name=v_md5info value="1630dc083d70a1e8af60f49c143a7b95">
  ��������ָ��
 <input type=submit name=v_action value="�׶������̳����ϰ�ȫ֧��ƽ̨">
 </form>
���ڲ���HTML����ʽ���ݲ������ͳ����������߿�������۸�ҳ����Ϣ�����⣬Ϊ��ֹ������������
������Ҫ��ҳ�沿��������Ϣ��ǩ���Ա�֤����ʵ�Ժ������ԡ�
�׶������̳ǰ�ȫ֧��ƽ̨����פ�̻��ṩ��һ����׼��ǩ������Դ�룬�ó����ṩǩ�����ܣ�
�����ܺ���Ϊchar* hmac (char* text, char* key)���ú�����������ڲ�����char* text��
char* key������text�ǽ����в���������Ϣƴ���Ľ���������������£�
�����������̻����������ն�����ʱ�򣬽������е�
v_moneytype v_ymd v_amount v_rcvname v_oid v_mid v_url�߸�������valueֵ
ƴ��һ���޼�����ַ���(char�ͣ�˳��Ҫ�ı�)������һ����ڲ���key�����̳����̻�˽��Լ��
����Կ������Կ���̻����ɣ�����Ϊ16���ַ�����ĸ���ֵ���ϡ���֪ͨ�׶������̳������Ա��
�ڸ�����Կʱ���밴�գ���˾�����̻��š���ϵ�ˡ���Կ��˳���͵�e-c@capinfo.com.cn��
����Կ��ʼֵΪtest���������õ�����Կ��Ϊ����Կ��������������ƴ�����ӦΪ��
01999072013.45����19990720-888-000001234888http://domain/program
�ú�������ֵ��Ϊ�������������ָ�ƣ�����д��v_md5info�ֶμ��ɡ�
ע��Ӣ��֧���ӿڣ������⿨����ʹ������CGI�ӿ����ӣ�
<form method=post action="http://pay.beijing.com.cn/prs/e_user_payment.checkit">
*/

/*
 *	prepare.php
 *	׼��֧����Ϣ����ʼ��֧�����������ݿ���Ϣ
 *
 *	������
 *		Session->UserID
 *		MoneyCount	Ǯ��������ҵ�λ
 *		MoneyType	���֣�0: RMB 1: USD
 *		BackURL		֧����Ϸ���ҳ��URL
 */

require( "header.inc.php" );
require( "../pay.inc.php" );
?>
<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" rowspan="3"> 
<?
$isSuccess=false;
$userid=$_REQUEST['UserID'];
$money=$HTTP_POST_VARS['MoneyCount'];
$moneytype=$HTTP_POST_VARS['MoneyType'];
$backurl=$HTTP_POST_VARS['BackURL'];

/*
echo "user:";
foreach( $_SESSION as $key => $value ){
	print( "session: $key => $value<br>" );
}
*/

if( is_numeric($money) && round($money,2)>0 ){
	if( $userid ){
		$result=mysql_query("select * from User_TB where ID='$userid'");
		if( $row=mysql_fetch_array($result) ){


			//XXX �ɹ���ת������
			if( doPrepare($row["AutoID"], $money, $moneytype, $backurl, "Agent") ){
				//�ύ֧������ɹ�
				$isSuccess=true;

			}else{
				err_msg( "ϵͳæ" );
			}
		}else{
			//�޴��û�
			err_msg( "����û������û�" );
		}
		mysql_free_result($result);
	}else{
		err_msg( "����û������û�" );
	}
}else{
	//û������Ǯ�����������
	err_msg( "��������ȷ�Ľ��" );
}

if( !$isSuccess ){
	print "<p align=center><a href='javascript:history.go(-1)'>����</a></p>\n";
}

require( "footer.inc.php" );
exit;

