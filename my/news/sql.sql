CREATE TABLE News_TB (
  AutoID int(8) DEFAULT NULL auto_increment PRIMARY KEY,
  Class varchar(20),
  PostDate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  Important enum('Y','N') DEFAULT 'N' NOT NULL,
  Poster varchar(20) DEFAULT '' NOT NULL,
  Title varchar(200) DEFAULT '' NOT NULL,
  Body text NOT NULL,
  ImagePath varchar(200),
  KEY PostDate (PostDate),
  KEY Class (Class)
);

#
# Dumping data for table 'News_TB'
#

INSERT INTO News_TB VALUES (1,'VPN','2002-11-13 16:09:08','Y','zixia','好车！',':)\r\n\r\n呵呵\r\n飞机打；jfsdf几份；的撒娇；分了三角枫；jj\r\n\r\n发达斯基；fjfjdsafsa军服的撒；几份；adsj\r\n','2002/11/13160908-DSCF0077.JPG');
INSERT INTO News_TB VALUES (2,'VPN','2002-11-13 16:14:01','N','zixia','非重要新闻','en','2002/11/13161401-');
INSERT INTO News_TB VALUES (3,'VPN','2002-11-13 16:14:13','Y','zixia','重要新闻','en','2002/11/13161413-');
