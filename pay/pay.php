<?
/*
�����׶������̳Ƕ���֧��������ؽӿڣ��̳�      �̻���
   ��;���׶������̳����̻����Ͷ�����֧��������̻����ؽ��������
   ע���˽ӿ��Լ������ת�ʽ�����ؽӿڣ������̻���פʱ�ṩ�������Թ�˾����
   �̻��š���ϵ�ˡ������ӿڵ�URL����ע���ĸ��ӿڣ�����ʽ���͵�
   e-c@capinfo.com.cn��
1��	�׶������̳��ύ��FORM������˵��
    �̳�һ�ν�����һ������������֧�����������Ϊ����������ʱ�����ǽ���
    ���������ʽ���ͣ�����˵�����£�
��ÿһ�ʶ������̳Ƕ�ʵʱ�ؽ�֧��������͸��̻������ĳһ�ʶ���δ���ͳɹ�
������������жϣ���ñʶ���md5У������ڷ�����һ�ʶ�����֧�����ʱ��
�Ὣδ�ɹ����͵Ķ���֧�����һ���ͣ����������͡�
��ÿ�η���ʱ�����ǽ������������v_count��v_oid��v_pmode��v_pstatus��v_pstring��
��ʾ����������ݣ����⸽��һ������ָ���ֶΣ�v_mac���������϶�����Ϣ��У�顣
���ڵ��ʶ��������������������˵�����£�
 ����������v_count�������η��͵Ķ���������
 ��������飨v_oid��������ͬ�̻��ύ��������ӿ��еĶ�����Ŷ��壻
 ֧����ʽ�飨v_pmode����֧����ʽ����˵������"���г������ÿ�"��
 ֧��״̬�飨v_pstatus����֧�������0�����ύ��2���ۿ��У�1��֧����ɣ�
                                   3��֧�����ܾ���4���˿��С�
 ֧�����˵����v_pstring������֧�������˵�����ɹ�ʱ��v_pstatus=1��Ϊ
 "֧�����"����v_pstatus=0ʱΪ"���ύ"��֧�����ܾ�ʱ��v_pstatus=3��Ϊʧ��ԭ��
�������������ķ��ͣ���v_oid�ֶ�Ϊ����v_oid1��ʾ���η��͵ĵ�һ�ʶ�����v_oid2
��ʾ���η��͵ĵڶ��ʶ������������ƣ����v_oid�ֶΣ��м���"|_|"��Ϸָ����
���£�v_oid=v_oid1|_|v_oid2|_|v_oid3|_|v_oid4|_|����������ͬ��v_pmode�ֶ�
��ʾΪ��v_pmode=v_pmode1|_|v_pmode2|_|v_pmode3|_|v_pmode4|_|����������
v_pstatus�ֶα�ʾΪ��v_pstatus=v_pstatus1|_|v_pstatus2|_|v_pstatus3|_|
v_pstatus4|_|����v_pstring�ֶα�ʾΪ��v_pstring=v_pstring1|_|v_pstring2|_|
v_pstring3|_|������
����ָ�ƣ�v_mac�������۸���Ϣ��v_mac=hmac_md5(text , key)������text�Ǳ���
�����value������˳��ƴ���Ľ����v_oid+v_pmode+v_pstatus+v_pstring+v_count��
keyΪ˫��Լ������Կ������һ�η������ʶ�����
20001124-888-test002|_|20001124-888-test003��������һ��ͨ|_|��������һ��ͨ3|_|
1֧�����ܾ�|_|֧�����2
2���̻�������Ϣ
���̻��յ�������Ϣ�󣬷�����Ϣ�������£�
"received"����ʾ�ɹ��յ�֧�������Ϣ������δ��������Ҫ������ͻ����̵��̻���
"sent"����ʾ�ɹ��յ�֧�������Ϣ��������ɷ��������Ʋ�����������鼮��
�ṩ��Ϣ����ȣ�û���ͻ����̵��̻���
"error"����ʾ������Ϣ����������md5У���
3�����磬��ASP�еĲο�����
<%  ' ��ȡ���� 
v_count=request("v_count")
v_oid=request("v_oid")
v_pmode=request("v_pmode")
v_pstatus=request("v_pstatus")
v_pstring=request("v_pstring")
v_mac=request("v_mac")
' ��������
a_oid=split(v_oid,"|_|")
a_pmode=split(v_pmode,"|_|")
a_pstatus=split(v_pstatus,"|_|")
a_pstring=split(v_pstring,"|_|")
' md5У��
dim md,fff
set md=server.CreateObject ("md5_VB.md5class")
fff=md.hmac(v_oid&v_pmode&v_pstatus&v_pstring&v_count,"test")
' ��md5У�����������
if fff<>v_mac then
		response.write "error"
else
			response.write "received"	
			' ��response.write "sent"��������Ʒ��������������
		' �������ݿ� ���ԣ�
			����
end if
%>
*/
require_once( "pay.inc.php" );
require_once( "db.inc.php" );

if( $v_count = $HTTP_GET_VARS['v_count'] ){
	// GET ��ʽ���ݲ���
	$v_oid = $HTTP_GET_VARS['v_oid'];
	$v_pmode = $HTTP_GET_VARS['v_pmode'];
	$v_pstatus = $HTTP_GET_VARS['v_pstatus'];
	$v_pstring = $HTTP_GET_VARS['v_pstring'];
	$v_mac = $HTTP_GET_VARS['v_mac'];
}else if( $v_count = $HTTP_POST_VARS['v_count'] ){
	// POST ��ʽ���ݲ���
	$v_oid = $HTTP_POST_VARS['v_oid'];
	$v_pmode = $HTTP_POST_VARS['v_pmode'];
	$v_pstatus = $HTTP_POST_VARS['v_pstatus'];
	$v_pstring = $HTTP_POST_VARS['v_pstring'];
	$v_mac = $HTTP_POST_VARS['v_mac'];
}else{
	print "error";
	paylog( "pay.php: û�в���" );
	exit;
}


$a_oid = explode( "|_|", $v_oid );
$a_pmode = explode( "|_|", $v_pmode );
$a_pstatus = explode( "|_|", $v_pstatus );
$a_pstring = explode( "|_|", $v_pstring );

$v_md5 = mhash( MHASH_MD5, $v_oid . $v_pmode . $v_pstatus . $v_pstring . $v_count, MD5_KEY );
$v_md5 = bin2hex( $v_md5 );

if( $v_md5 != $v_mac ){
	print "error";
	paylog( "pay.php: md5 ERROR! v_oid=" . $v_oid . "\tv_pmode=" . $v_pmode . "\tv_pstatus=" . $v_pstatus . "\tv_pstring=" . $v_pstring );
	exit;
}


$isSucceed = false;
for( $i=0; $i<$v_count; $i++ ){
	//���ú�������ÿһ��֧��
	if( !do_pay( $a_oid[$i], $a_pmode[$i], $a_pstatus[$i], $a_pstring[$i] ) ){
		paylog( "pay.php: do_pay($a_oid[$i],$a_pmode[$i],$a_pstatus[$i],$a_pstring[$i]) error" );
		break;
	}
	$isSucceed = true;
}

if( $isSucceed ){
	print "sent"; //ȷ�ϣ��ѷ���
}else{
	print "error"; //����
	#print "received"; //ȷ�ϣ�δ����
}
exit;

function do_pay( $v_oid, $v_pmode, $v_pstatus, $v_pstring )
{
/*
 ��������飨v_oid��������ͬ�̻��ύ��������ӿ��еĶ�����Ŷ��壻
 ֧����ʽ�飨v_pmode����֧����ʽ����˵������"���г������ÿ�"��
 ֧��״̬�飨v_pstatus����֧�������0�����ύ��2���ۿ��У�1��֧����ɣ�
                                   3��֧�����ܾ���4���˿��С�
 ֧�����˵����v_pstring������֧�������˵�����ɹ�ʱ��v_pstatus=1��Ϊ
 "֧�����"����v_pstatus=0ʱΪ"���ύ"��֧�����ܾ�ʱ��v_pstatus=3��Ϊʧ��ԭ��
 */

	if( 0==$v_pstatus ){ 
		$v_pstatus_memo='���ύ';
	}else if( 1==$v_pstatus ){ 
		$v_pstatus_memo='֧�����';
		$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
		mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");
		if( !pay_ok( $v_oid, $v_pmode ) ){
			paylog( "pay.php: ���� pay_ok ʧ��" );
		}
		mysql_close( $conn );
	}else if( 2==$v_pstatus ){
		$v_pstatus_memo='�ۿ���';
	}else if( 3==$v_pstatus ){
		$v_pstatus_memo='֧�����ܾ�';
	}else{
		$v_pstatus_memo='δ�ĵ��Ĳ���ֵ';
	}

	$memo = "pay.php: v_oid=$v_oid v_pmode=$v_pmode $v_pstatus_memo v_pstring=$v_pstring";

	$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
	mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'Yes', '$v_pstatus', 'pay.php: $memo') ") ){
		paylog( "pay.php: mysql_queryʧ�ܡ�v_oid=" . $v_oid . "\tv_pmode=" . $v_pmode . "\tv_pstatus=" . $v_pstatus . "\tv_pstring=" . $v_pstring );
	}
	mysql_close($conn);
	return true;
}
?>
