<? session_start(); ?>
<?
require_once("zdmin.inc.php");

require "{$ADMINROOT}/Include/IncludeFile.php";

IncludeHTML("{$AKAROOT}/header.html");

IncludeHTML("{$ADMINROOT}/Include/Part1.html");
?>
<br>
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                当前位置：</font> </b><a href="/" class="a5">阿卡首页</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/" class="a5">网站管理员</a> <font color="#458DE4">&gt; 
                </font><a href="<? echo $ADMINURLROOT; ?>/AdminMenu.php" class="a5">管理菜单</a> <font color="#458DE4">&gt;
                </font><a href="<? echo $ADMINURLROOT; ?>/PersonalVPN/ViewUserOnLine.php" class="a5">察看在线用户</a>
				<br>
                <br>
                <span class="newstitle">在线用户列表</span></p>
              <p>&nbsp;</p>
            </td>
        </tr>
      </table>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_SESSION['AdminID'])) ){
?>
您尚未登陆。<br>
请首先<A HREF="<? echo $ADMINURLROOT; ?>/index.php">登陆</a>。
<?
}else {

if ( (!isset($_SESSION['PersonalVPNAdmin'])) ) {
?>
你没有PersonalVPN管理的权限<br>
请返回<A HREF="<? echo $ADMINURLROOT; ?>/AdminMenu.php">管理菜单</a>
<?
} else {

require "{$ADMINROOT}/Include/InitDB.php"; 
$result=mysql_query("select * from PersonalVPN_Investigate", $conn);
 
if ( mysql_num_rows($result)==0) {
?>
无待在线用户。<br>
<?
} else {
?>
目前共有<font color="#ff3247"><?echo mysql_num_rows($result) ?></font>名用户的调查数据.<br>
<div align="center">

<?
	while($row=mysql_fetch_array($result)){
?>
<hr>
<table>
<tr >
<td width="30%">用户ID</td><td><? echo $row['UserID'] ?></td>
</tr>
<tr>
<td>收费后是否继续使用？</td><td><? echo $row['ContinueUse'] ?></td>
</tr>
<tr>
<td>希望包月收费？</td><td><? echo $row['LikeMonthFeeType']?></td>
</tr>
<tr>
<td>希望按分钟收费？</td><td><? echo $row['LikeMinFeeType']?></td>
</tr>
<tr>
<td>需要其他收费方式：</td><td><? echo $row['OtherFeeType']?></td>
</tr>
<tr>
<td>能接受的包月收费上限</td><td><? echo $row['MaxMonthFee']?></td>
</tr>
<tr>
<td>能接受的按分钟收费上限</td><td><? echo $row['MaxMinFee']?></td>
</tr>
<tr>
<td>能接受的其他收费上限</td><td><? echo $row['MaxOtherFee']?></td>
</tr>
<tr>
<td>理想的包月收费数额</td><td><? echo $row['FavoriteMonthFee']?></td>
</tr>
<tr>
<td>理想的按分钟收费数额</td><td><? echo $row['FavoriteMinFee']?></td>
</tr>
<tr>
<td>理想的其他收费数额</td><td><? echo $row['FavoriteOtherFee']?></td>
</tr>
<tr>
<td>知道发展下线有奖励吗？</td><td><? echo $row['Known']?></td>
</tr>
<tr>
<td>愿意做销售代表吗</td><td><? echo $row['Will']?></td>
</tr>

</table>
<?
	}
?>


</div>
<?
}
}
}
?>
</td></tr></table>

<?
require("{$ADMINROOT}/Include/Part2.php");
IncludeHTML("{$AKAROOT}/footer.html");
?>
