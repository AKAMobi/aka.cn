<?
/*
֧����ɺ�ҳ��ת���̻�ʱ�����׶������̳Ƿ��ص���Ϣ��ʽ(ע�⣬�붨ʱ���ͷ�ʽʹ�õ���Ϣ��ʽ������)Ϊ��
http://v_url?v_oid=19990720-*-000001234&v_pstatus=30&v_pstring=��Ч����&v_pmode=֧����ʽ(�ַ���)&v_md5info=a1b2c3d4e5f6 a1b2c3d4e5f6 a1b2c3d4
����Ϣ��ʽ��ϸ�������£�
v_urlΪ�ö����ύʱ���������Ĳ���
Capinfo���̻��Ľӿ�
<form method=get action="*" target=_self> 
    <input type="hidden" name="v_oid" value="">
    <input type="hidden" name="v_pstatus" value=""> 
    <input type="hidden" name="v_pstring" value=""> 
    <input type="hidden" name="v_pmode" value="">
    <input type="hidden" name="v_md5info" value=""> 
 </form> 
���У� 
*Ϊ�̻����͵�v_url�� 
v_oid = �̻����͵�v_oid������ţ�
v_pmode = ֧����ʽ(�ַ���); 
v_pstatus = 1�����ύ���Բ�֧��ʵʱ�����У�
        20��֧���ɹ�����֧��ʵʱ�����У�
        30��֧��ʧ�ܣ���֧��ʵʱ�����У��� 
v_pstring ֧�����˵��
v_md5info =char* hmac_md5(char* text, char* key)
          char* text     ƴ�����
          char* key    �Գ���Կ
ע��MD5У��ʱƴ���ַ�����˳��Ϊ��v_oid��v_pstatus��v_pstring��v_pmode
*/

require_once( "header.inc.php" );
require_once( "../pay.inc.php" );
?>
<table width="760" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" rowspan="3"> 
<?
/* 
 * ��ȡ����
 */
if( $v_oid = $HTTP_GET_VARS['v_oid'] ){
	//GET ��ʽ���ݲ���
	$v_pstatus = $HTTP_GET_VARS['v_pstatus'];
	$v_pstring = $HTTP_GET_VARS['v_pstring'];
	$v_pmode = $HTTP_GET_VARS['v_pmode'];
	$v_md5info = $HTTP_GET_VARS['v_md5info'];
}else if( $v_oid = $HTTP_POST_VARS['v_oid'] ){ 
	//POST ��ʽ���ݲ���
	$v_pstatus = $HTTP_POST_VARS['v_pstatus'];
	$v_pstring = $HTTP_POST_VARS['v_pstring'];
	$v_pmode = $HTTP_POST_VARS['v_pmode'];
	$v_md5info = $HTTP_POST_VARS['v_md5info'];
}else{
	paylog( "payback.php: û�д��ݲ���" );
	err_msg( "ϵͳæ����͹���Ա��ϵ������� 900" );
	require( "footer.inc.php" );
	exit;
}
	

foreach( $_REQUEST as $key => $value ){
        print( "<font color=white>REQUEST: $key => $value</font><br>" );
}

$v_md5 = bin2hex( mhash( MHASH_MD5, $v_oid . $v_pstatus . $v_pstring . $v_pmode, MD5_KEY ) );

if( 1==$v_pstatus ){ //���ύ���Բ�֧��ʵʱ������
	$v_pstatus_memo='���ύ���Բ�֧��ʵʱ������';
}else if( 20==$v_pstatus ){//֧���ɹ�����֧��ʵʱ������
	$v_pstatus_memo='֧���ɹ�����֧��ʵʱ������';
}else if( 30==$v_pstatus ){//֧��ʧ�ܣ���֧��ʵʱ������
	$v_pstatus_memo='֧��ʧ�ܣ���֧��ʵʱ������';
}else{//δ�ĵ��Ĳ���ֵ
	$v_pstatus_memo='δ�ĵ��Ĳ���ֵ';
}

/*
 * ����Ƿ��Ѿ��ύ���Ķ���
 */
$result=mysql_query( "select EndDate from NetPay_TB where PayNO='$v_oid'" );
if( !$result ){
	paylog( "payback.php: û�� $v_oid ��������Ż�mysql error" );
	err_msg( "ϵͳæ����͹���Ա��ϵ������� 1000" );
	err_msg( "System busy, Please contact system administrator. error no.: 1000" );
	require( "footer.inc.php" );
	exit;
}
if( $row=mysql_fetch_array($result) ){
	$enddate=$row['EndDate'];
}else{
	paylog( "payback.php: mysql error, v_oid=$v_oid" );
	err_msg( "ϵͳæ����͹���Ա��ϵ, ����� 2000" );
	err_msg( "System busy, Please contact system administrator. error no.: 2000" );
	require( "footer.inc.php" );
	exit;
}
mysql_free_result( $result );

if( isset($enddate) ){
	notice_msg( "����֧���Ѿ��ɹ�����������AKA�ʻ���������������ϵ����Ա" );
	err_msg( "Pay Succeed! Please remeber the time of now." );
	require( "footer.inc.php" );
	exit;
}

/*
 * ����md5ָ��
 */
$isSuccess = false;
if( $v_md5 == $v_md5info ){
	$isSuccess = true;
}
$memo = "($v_pstatus_memo), v_pstring=$v_pstring, v_pmode=$v_pmode";
if( $isSuccess ){
	// ��¼����
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'Yes', '$v_pstatus', 'payback.php: $memo') ") ){
		paylog( "payback.php: PayNO: $v_oid, isSuccess: Yes, $memo" );
	}
}else{
	if( !mysql_query( "insert into NetPayProcess_TB (PayNO, OccurTime, isSuccess, Status, Memo) values('$v_oid', now(), 'No', '$v_pstatus', 'payback.php: md5��֤ʧ��, $memo, v_md5info=$v_md5info ')" ) ){
		paylog( "payback.php: PayNO: $v_oid, isSuccess: No, md5��֤ʧ��, $memo, v_md5info=$v_md5info" );
	}
	err_msg( "������ڷ���������ݡ���������ǰ����·�ϣ����㼰����110���ס�" );
	err_msg( "OOPs! ooPs! OoPs! FBI's coming!" );
	require( "footer.inc.php" );
	exit;

}


if( 1==$v_pstatus ){ //���ύ���Բ�֧��ʵʱ������
	notice_msg( 	"֧����ϣ������������п���֧��ʵʱ���ʣ�<br>" . 
			"ֻ�������л��ʲ�����Ϻ�<br>" .
			"����AKA�ʻ��вŻ������Ӧ��<br>" .
			"�����ĵȴ�(Ӧ�ò�����24Сʱ��" );

	notice_msg( 	"Pay has been completed<br>" . 
			"system should receive the money in 24 hours." );
}else if( 20==$v_pstatus ){//֧���ɹ�����֧��ʵʱ������
	/*
 	 * �û���Ǯ
 	 */
	//TODO finish pay_ok
	mysql_query( "begin" );
	if( !agent_pay_ok( $v_oid, $v_pmode ) ){
		mysql_query( "rollback" );
		paylog( "payback.php: agent_pay_ok($v_oid, $v_pmode)ʧ��" );
		err_msg( "��Ǯ����ʧ�ܣ�����µ�ǰʱ�䲢��ϵ����Ա" );
		err_msg( "System error, Please remember the time of now and contact systemadministrator" );
	}else{
		mysql_query( "commit" );
		ok_msg( "ת�ʳɹ���" );
		ok_msg( "Pay Succeed!" );

	}
}else if( 30==$v_pstatus ){//֧��ʧ�ܣ���֧��ʵʱ������
	notice_msg( "֧��������֧��ʧ��" );
	notice_msg( "Pay operation failed." );
}else{//δ�ĵ��Ĳ���ֵ
	paylog( "payback.php: v_pstatusδ�ĵ���ֵ, $memo" );
}
//printf( "v_oid=%s, v_pmode=%s, v_pstatus=%s, v_pstring=%s, v_md5info=%s<br>", $v_oid, $v_pmode, $v_pstatus, $v_pstring, $v_md5info );

print "</td></tr></table>\n";
require_once( "footer.inc.php" );
?>


