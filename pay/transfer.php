<?
/*
�ġ��̳�֪ͨ�̻�ת�ʽ���ӿڣ��̳�      �̻���
��;���̳ǽ�����ת�ʽ��֪ͨ�̻���
1��	�׶������̳��ύ��FORM������˵��
������Ŀ��v_count�������η��͵Ķ���������
��������飨v_oid��������ͬ�׶������̳Ƕ���֧��������ؽӿ��еĶ�����Ŷ��壻
    ��ʽ���£�v_oid=v_oid1|_|v_oid2|_|v_oid3|_|v_oid4|_|����������
ת�ʽ����v_virement����1��ת�ʳɹ�����һ���������۶���ֻ����һ��1����
����ָ�ƣ�v_mac����ƴ��˳��Ϊv_oid+v_virement+v_count�����緢�;űʶ�����
20001220-888-135|_|20001220-888-143|_|20001221-888-144|_|20001221-888-145|_|20001221-888-146|_|20001222-888-148|_|20001220-888-141|_|20001222-888-149|_|20001222-888-14719
2��	�̻�������Ϣ
"received"����ʾ�ɹ��յ�ת�ʽ����
"error"����ʾ������Ϣ����������md5У���
3�����磬��ASP�еĲο����룺
 <% ' ��ȡ���� 
v_oid=request("v_oid")
v_virement=request("v_virement")
v_count=request("v_count")
' ��������
a_oid=split(v_oid,"|_|")
' ��֤md5
dim md,fff
set md=server.CreateObject ("md5_VB.md5class")
fff=md.hmac(v_oid&v_virement&v_count,"test")
' ����֤���������
if fff<>v_mac then
		response.write "error"
else
		response.write "received"
		' �������ݿ� ���ԣ�
			����
end if
%>
*/

require_once ("pay.inc.php");
require_once ("db.inc.php");

if( $v_count = $HTTP_GET_VARS['v_count'] ){
	// GET ��ʽ
	$v_oid = $HTTP_GET_VARS['v_oid'];
	$v_virement = $HTTP_GET_VARS['v_virement'];
	$v_mac = $HTTP_GET_VARS['v_mac'];
}else if( $v_count = $HTTP_POST_VARS['v_count'] ){
	$v_oid = $HTTP_POST_VARS['v_oid'];
	$v_virement = $HTTP_POST_VARS['v_virement'];
	$v_mac = $HTTP_POST_VARS['v_mac'];
}else{
	print "error";
	paylog( "transfer.php: û�в���" );
	exit;
}

$a_oid = explode( "|_|", $v_oid );

$v_md5 = mhash( MHASH_MD5, $v_oid . $v_virement . $v_count, MD5_KEY );
$v_md5 = bin2hex( $v_md5 );

if( $v_md5 != $v_mac ){
	paylog( "transfer.php: md5У�����, v_count=$v_count ,v_oid=$v_oid , v_virement=$v_virement ,v_mac=$v_mac" );
	print "error";
	exit;
}

$conn=mysql_pconnect( DB_HOST, DB_USER, DB_PASS ) or die("�޷�����DBM.");
mysql_select_db( DB_NAME, $conn) or die("�޷������ݿ�.");

for( $i=0; $i<$v_count; $i++ ){
	//���ú�������ÿһ��֧��
	do_transfer( $a_oid[$i] );
}

mysql_close($conn);

#print "error";
print "received";
#print "sent";

exit();

function do_transfer( $v_oid )
{
	//TODO...
	global $v_virement;
	if( 1==$v_virement ){
		transfer_ok( $v_oid );
	}
	/*
	$fp = fopen("/tmp/transfer.txt", "a");
	if( !$fp ){
		return false;
	}
	flock( $fp, 2 );//acquire an exclusive lock (writer), set operation to 2

	fputs( $fp, "v_oid=" . $v_oid . "\tv_virement=" . $v_virement . "\n" );

	flock( $fp, 3 );//release a lock (shared or exclusive), set operation to 3. 
	fclose( $fp );
	*/
}
?>
