function GetRandomProxy()
{
var array = new Array(
"211.157.100.8:8213"
);
	var i = Math.round( Math.random() * (array.length-1) );
	return array[i];
}

function isInCernet(host)
{
        if( isInNet(host,"162.105.0.0","255.255.0.0")) return true;
        if( isInNet(host,"166.111.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.4.128.0","255.255.224.0")) return true;
        if( isInNet(host,"202.38.96.0","255.255.224.0")) return true;
        if( isInNet(host,"210.25.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.112.0.0","255.254.0.0")) return true;
        if( isInNet(host,"202.204.0.0","255.252.0.0")) return true;
        if( isInNet(host,"210.31.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.68.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.71.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.81.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.82.0.0","255.255.0.0")) return true;
        if( isInNet(host,"219.242.0.0","255.254.0.0")) return true;
        if( isInNet(host,"202.117.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.200.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.26.0.0","255.254.0.0")) return true;
        if( isInNet(host,"218.195.0.0","255.255.0.0")) return true;
        if( isInNet(host,"219.244.0.0","255.252.0.0")) return true;
        if( isInNet(host,"202.115.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.202.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.40.0.0","255.254.0.0")) return true;
        if( isInNet(host,"211.83.0.0","255.255.0.0")) return true;
        if( isInNet(host,"218.194.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.38.192.0","255.255.192.0")) return true;
        if( isInNet(host,"202.116.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.192.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.36.0.0","255.252.0.0")) return true;
        if( isInNet(host,"211.66.0.0","255.255.0.0")) return true;
        if( isInNet(host,"218.192.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.114.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.196.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.42.0.0","255.254.0.0")) return true;
        if( isInNet(host,"211.69.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.67.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.84.0.0","255.254.0.0")) return true;
        if( isInNet(host,"218.196.0.0","255.252.0.0")) return true;
        if( isInNet(host,"202.38.64.0","255.255.224.0")) return true;
        if( isInNet(host,"202.119.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.194.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.44.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.28.0.0","255.254.0.0")) return true;
        if( isInNet(host,"211.64.0.0","255.254.0.0")) return true;
        if( isInNet(host,"211.70.0.0","255.255.0.0")) return true;
        if( isInNet(host,"211.86.0.0","255.254.0.0")) return true;
        if( isInNet(host,"202.120.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.32.0.0","255.252.0.0")) return true;
        if( isInNet(host,"211.80.0.0","255.255.0.0")) return true;
        if( isInNet(host,"218.193.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.118.0.0","255.255.0.0")) return true;
        if( isInNet(host,"202.198.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.46.0.0","255.254.0.0")) return true;
        if( isInNet(host,"210.30.0.0","255.255.0.0")) return true;
        if( isInNet(host,"219.216.0.0","255.254.0.0")) return true;
	return false;
}

function FindProxyForURL(url, host)
{
	var direct="DIRECT";
	var str ="PROXY "; 
	str += GetRandomProxy();
	if(!isResolvable(host))
	{
		return direct;
	}
	var IpAddr=dnsResolve(host);

	if(isPlainHostName(host))  return direct;
	if(isInCernet(IpAddr)) return str;
	return direct;
}
