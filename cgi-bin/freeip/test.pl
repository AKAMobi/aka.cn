#!/usr/bin/perl -w

print mask2bitnum( '128.0.0.0' );

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
