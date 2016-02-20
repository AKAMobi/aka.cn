#!/usr/bin/perl -w
#<?
use DBI;

%traffic = ();
@trashs = ('tunl0','teql0','dummy0','gre0');

$dbh = DBI->connect("DBI:mysql:database=AKA;host=localhost",'aka','zpzAKA!@#') or die "connect";
$sth_ins = $dbh->prepare(q{
		INSERT INTO EnterpriseVPN_Traffic_TB
		(Name, LastReceive, LastTransmit, Receive, Transmit)
		values
		(?,?,?,?,?)
	}) or die "prepare_ins";
$sth_qry = $dbh->prepare(q{
		SELECT LastReceive, LastTransmit
		FROM EnterpriseVPN_Traffic_TB
		WHERE Name=? 
		ORDER BY TimeStamp DESC
		LIMIT 1
	}) or die "prepare_qry";

open( FD, "</proc/net/dev" ) or die "can't open dev";
DEV: while( $line=<FD> ){
	chomp $line;
	if( $line=~/^\s*([^:]+):\s*(\d+)\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+\s+(\d+)\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+\s+\d+/ ){
		foreach $trash ( @trashs ){
	#		print "$trash, $1\n";
			next DEV if( $trash eq $1 );
		}
		# 转换为 KByte
		$traffic{$1}{'R'} = int( $2/(1024) );
		$traffic{$1}{'T'} = int( $3/(1024) );
	}
}
close( FD );
	
my ($receive, $transmit);
foreach $dev ( keys %traffic ){
	$sth_qry->execute( $dev ) or die "execute_qry";
	($lr, $lt) = $sth_qry->fetchrow_array;
	if( $traffic{$dev}{'R'} < $lr || 
		$traffic{$dev}{'T'} < $lt ){
		$receive = $traffic{$dev}{'R'};
		$transmit = $traffic{$dev}{'T'};
	}else{
		$receive = $traffic{$dev}{'R'} - $lr;
		$transmit = $traffic{$dev}{'T'} - $lt;
	}
		
	# KB 为数据库中 Receive/Transmit 的单位
	$sth_ins->execute( $dev, $traffic{$dev}{'R'}, $traffic{$dev}{'T'},
			$receive, $transmit ) or die "execute sth_ins";
	#print "$dev: \n\tR: $traffic{$dev}{'R'}\n\tT: $traffic{$dev}{'T'}\n\tLastR: $lr\n\tLastT: $lt\n\tReceive: $receive\n\tTransmit: $transmit\n" if ( $dev eq 'zixia' );
}
#?>
