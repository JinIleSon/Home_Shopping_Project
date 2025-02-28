<?

?>
<center>
<?include ("top.html");?>
<?
echo("
<table>
	<tr><td height=20></td></tr>
</table>

<table border=0 width=900>
	<tr><td height=20><font size=6><b>구매완료</td></tr>
</table>

<table border=0 width=900>
	<tr><td height=50></td></tr>
	<tr><td height=50 align=center><font size=6>주문이 정상적으로 완료되었습니다.</td></tr>
</table>
");
$totalprice = $totalprice + 2000;
$totaltotalprice=$totalprice-$subpoint;
echo("
<table border=0 width=900>
	<tr><td height=50></td></tr>
	<tr><td height=50 bgcolor=FAF0E6 align=center><b>주문번호</td><td>$ordernum</td></tr>
	<tr><td height=50 bgcolor=FFE4E1 align=center><b>사용한 포인트</td><td><font color=blue>$subpoint</font>&nbsp;<b>p</b></td></tr>
	<tr><td height=50 bgcolor=FAF0E6 align=center><b>총 적립된 포인트</td><td><font color=blue>$totalpoint</font>&nbsp<b>p</b></td></tr>
	<tr><td height=50 bgcolor=FFE4E1 align=center><b>총 구매금액</td><td>$totalprice <font size=2>(구매금액)</font>&nbsp;-&nbsp;$subpoint <font size=2>(사용한 포인트)</font>&nbsp;=&nbsp;$totaltotalprice&nbsp;원</td></tr>
	<tr><td height=50 align=center colspan=2>무통장입금 국민은행 <font size=5>012345-56-678789</font>로 <font size=5>$totaltotalprice</font>&nbsp원 입금 부탁드립니다.</td></tr>
	<tr><td height=50 align=center colspan=2><form method=post action=index.html><input type=submit value='돌아가기' style=\"width:100px; height:40px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></form></td></tr>
</table>


");


echo("
<table>
	<tr><td height=20></td></tr>
</table>");
?>
<?include ("bottom.html");?>
</center>