<?

create table EnterpriseVPN_Traffic_TB(
    Name    varchar(16) default 'unknown',
    TimeStamp   TIMESTAMP,
    Receive     INT default 0,
    Transmit    INT default 0,
    LastReceive     INT default 0,
    LastTransmit    INT default 0
  KEY index_TS (TimeStamp),
  KEY index_Name ( Name )

);


User='aka', Password=password('zpzAKA!@#');

select Name, HOUR(TimeStamp) as hour ,sum(Transmit), sum(Receive)
from Vpn_Log_TB 
where TimeStamp >= '2002-01-01' and
TimeStamp < DATE_ADD('2002-01-01',INTERVAL 1 MONTH) and
Name='zixia'
group by hour 

*/
?>
