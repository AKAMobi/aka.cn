#!/usr/bin/perl -w

use CGI;
use LWP::Simple;

$URL = 'http://www.nic.edu.cn/RS/ipstat/internalip/';
$html = get( $URL );
$html or die "can't get html....";

print $html;
exit;
$state = 0;
while( $line=<STDIN> ){
        chop $line;
        if( $line=~/^(\d+)/ ){
                $state = 1;
        }elsif( $line=~/ (\d+)\.(\d+)\.(\d+)\.(\d+)/ ){
                $line =~ s/ //g;
                if( 1==$state ){
                        $sip = ip2int( $line );
                        $strip_src = $line;
                        $state = 2;
                }else{
                        $dip = ip2int ( $line );
                        $strip_dest = $line;
                        $state = 0;
                }
        }else{
                @sip = @dip = ();
                $k=0;
                do{
                        push( @sip, $sip%2 );
                        push( @dip, $dip%2 );
                        $sip=int($sip/2);
                        $dip=int($dip/2);
                }while( $k++ < 32 );

                $mask = 0;
                for( $i=31; $i>=0; $i-- ){
                        if( $sip[$i]==$dip[$i] ){
                                $mask++;
                        }else{
                                last;
                        }
                }
                print "$strip_src/$mask\n";
        }
}
exit 0;


sub ip2int{
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
