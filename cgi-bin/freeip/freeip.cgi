#!/usr/bin/perl -w

use CGI;

$q = new CGI;

$INPUT = 0;
$WINROUTE = 1;
$LINUXROUTE = 2;
$IPROUTE = 3;
$APCTAB = 4;

$sw = $q->param('sw');
if( $sw ){
	$freeip = $q->param( 'freeip' );
	$gw = $q->param( 'gw' );
	$dev = $q->param( 'dev' );
}else{
	$sw = $INPUT;
}

print $q->header;

if( $INPUT == $sw ){
	print <<_INPUT_;
<a href="http://www.nic.edu.cn/RS/ipstat/internalip/" target=_blank>
nic.edu.cn的免费列表
</a>
<form action=freeip.cgi method=post>
	<textarea name=freeip ROWS=20 COLS=60></textarea>
	<br>
	Gateway: <input type=text name=gw length=10>
	<br>
	DEV: <input type=text name=dev length=10>
	<br>
	<input type=radio name=sw value=$IPROUTE checked>Linux iproute2 command
	<input type=radio name=sw value=$LINUXROUTE>Linux route command
	<input type=radio name=sw value=$WINROUTE>Windows route command
	<input type=radio name=sw value=$APCTAB>客户端用免费IP数组
	<br>
	<input type=submit>
</form>
_INPUT_
}elsif( $LINUXROUTE == $sw ){
	print <<_LINUX_;
<pre>

_LINUX_
	@lines = split( /\n/, $freeip );
	foreach $line ( @lines ){
		($net, $ksam, $mask) = split(/\s+/,$line);
		print "ERROR: $line<br>" unless $net;
		print "/sbin/route add -net $net netmask $mask gw $gw\n";
	}
	print "</pre>\n";
}elsif( $WINROUTE == $sw ){
	print <<_WINROUTE_;
$freeip
_WINROUTE_
}elsif( $IPROUTE == $sw ){
	print <<_IPROUTE_;
<pre>
_IPROUTE_
	@lines = split( /\n/, $freeip );
	foreach $line ( @lines ){
		($net, $ksam, $mask) = split(/\s+/,$line);
		print "ERROR: $line<br>" unless $net;
		$mask = mask2bitnum( $mask );
		print "/sbin/ip route add table vpn $net/$mask via $gw\n";
	}
	print "</pre>\n";
}elsif( $APCTAB == $sw ){
	print <<_IPROUTE_;
<pre>
_IPROUTE_
	@lines = split( /\n/, $freeip );
	foreach $line ( @lines ){
		($net, $ksam, $mask) = split(/\s+/,$line);
		print "ERROR: $line<br>" unless $net;
		print "\t{\"$net\",\"$mask\"},\n";
	}
	print "</pre>\n";
}


sub mask2bitnum{
	local( $mask, $k, $bits );
	local @bits;

	$mask = shift;
	$mask or print "mask2bitnum: need param!";

	$mask = ip2int( $mask );
	@bits = ();
	$k = 0;
	do{     
        push( @bits, $mask%2 );
        $mask=int($mask/2);
	}while( $k++ < 32 );

	$bits=0;
	for( $i=31; $i>=0; $i-- ){
        if( $bits[$i] ){
                $bits++;
        }else{
                last;
        }
	}
	return( $bits );
}

sub ip2int{
		local $ip;
        $ip = shift ;
        return undef unless $ip ;
        $ip =~ /(\d+)\.(\d+)\.(\d+)\.(\d+)/ ;
        $ip[0] = $1 ; $ip[1] = $2 ; $ip[2] = $3 ; $ip[3] = $4 ;
        $ip[0] = 0 if( !$ip[0] ) ; $ip[1] = 0 if( !$ip[1] ) ;
        $ip[2] = 0 if( !$ip[2] ) ; $ip[3] = 0 if( !$ip[3] ) ;
        $ip[0] =~ s/^0+// ;$ip[1] =~ s/^0+// ;
        $ip[2] =~ s/^0+// ;$ip[3] =~ s/^0+// ;
        $ip[0] = 0 if( !$ip[0] ) ; $ip[1] = 0 if( !$ip[1] ) ;
        $ip[2] = 0 if( !$ip[2] ) ; $ip[3] = 0 if( !$ip[3] ) ;
        ($ip[0] << 24) + ($ip[1]<<16) + ($ip[2]<<8) + $ip[3] ;
}
