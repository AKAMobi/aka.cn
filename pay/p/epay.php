<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
<br>
      <center>
      </center>
<table width="500" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
<?
if ( (!isset($_REQUEST['u']) ) ) {
?>
Please specify user ID<br>
<?
}else {
?>
<br><br><br>

<center>
<form action="prepare.php" name=form method=post>
Please input the amount:<p>
$<input type=text name=MoneyCount size=4><br><p>
<input type=hidden name=MoneyType value=1>
<input type=hidden name=UserID value=<?=$_REQUEST['u']?>>
<input type=hidden name=BackURL value="http://pay.aka.cn/p/epayback.php?u=<?=$_REQUEST['u']?>">

<input type=submit name=submit value='Go to pay it!'>
</form>
</center>
<br><br><br>

<?
}
?>
</td></tr></table>
<br>


    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
</td>
  </tr>
</table>
