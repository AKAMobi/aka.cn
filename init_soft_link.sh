
echo -n "必须在脚本文件所在目录执行程序，确认？[Yes/N]"
read yn

if [ -z $yn ] ; then 
	echo "Canceled..."
	exit;
fi
	
if [ $yn != "Yes" ]  ; then
	echo "Canceled..."
	exit;
fi

echo "Linking..."


# ?? pay.aka.cn ?????? vhost
cd pay
ln -s ../image .
ln -s ../css .
ln -s ../js .
ln -s ../favicon.ico .
cd ..

# my.aka.cn/proxy{in,out].pac
cd f/my
ln -s ../../serv_prod/vpn/edu/personal/proxy*.pac .
cd ../..

# download
cd download
./ln.sh
cd ..


# cgi-bin

cd cgi-bin
chmod +x Count.cgi order/idl order/vpn contact/post
cd ..
