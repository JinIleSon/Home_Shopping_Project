<center>
<?include ("top.html");?>
<?

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('관리자만 접근 가능한 기능입니다')
		history.go(-1)
		</script>");
    exit;
} 

echo ("<style>
	table {border-collapse:collapse;}

</style>");

echo ("
	<table><tr><td height=20></td></tr></table>

	<table border=0 width=900>
    <tr><td ><font size=6><b>주문 내역 조회</b></td></tr>
    <tr><td align=right>
		<form method=post action=admin.php>
	<input type=submit value='돌아가기' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:4px;padding-bottom:4px;'></form>
	</td>
	</tr></table>");
	  	  
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from receivers order by buydate desc", $con);
$total = mysql_num_rows($result);

echo (" <table border=1 width=900 style='border-right:none;border-left:none;'>
	<tr bgcolor=#6C788C height=25 valign=center style='border-right:none;border-left:none;'>
	<td align=center width=90 style='padding:10px;border-right:none;border-left:none;'><font size=2 color=white><b>주문번호</b></td>
	<td width=140 align=center style='border-right:none;border-left:none;'><font size=2 color=white><b>주문일자</b></td>
	<td width=300 align=center style='border-right:none;border-left:none;'><font size=2 color=white><b>주문내역</b></td>
	<td width=70 align=center style='border-right:none;border-left:none;'><font size=2 color=white><b>주문총액</b></td>
	<td width=90 align=center style='border-right:none;border-left:none;'><font size=2 color=white><b>상태변경</b></td></tr>");	

if ($total > 0) {	

	$counter = 0;
		
	while($counter < $total) :

		$session =  mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
			 
		switch ($status) {
			case 1:
				$tstatus = "주문신청";
				break;
			case 2:
				$tstatus = "주문접수";
				break;
			case 3: 
				$tstatus = "배송준비중";
				break;
			case 4:
				$tstatus = "배송중";
				break;
			case 5:
				$tstatus = "배송완료";
				break;
			case 6:
				$tstatus = "구매확정";
				break;
		}
		  
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
		$subtotal = mysql_num_rows($subresult);

		$subcounter=0;
		$totalprice=0;

		while ($subcounter < $subtotal) :
			$pcode = mysql_result($subresult, $subcounter, "pcode");
			$quantity = mysql_result($subresult, $subcounter, "quantity");
			$tmpresult = mysql_query("select * from product where code='$pcode'", $con);
			$pname = mysql_result($tmpresult, 0, "name");
			$price = mysql_result($tmpresult, 0, "price2");
		   
			$subtotalprice = $quantity * $price;
			$totalprice = $totalprice + $subtotalprice;
			$subcounter++;
		endwhile;
		
		$items = $subtotal - 1;
		
		echo ("<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
			<td align=center style='padding:15px;border-right:none;border-left:none;'><a href=#   onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new', 'width=940, height=250, scrollbars=yes');\" style='border-right:none;border-left:none;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>$ordernum</a></td>
			<td align=center style='border-right:none;border-left:none;'><font size=2>$buydate</td>
			<td align=center style='border-right:none;border-left:none;'><font size=2>$pname 외 $items 종</td>
			<td align=center style='border-right:none;border-left:none;'><font size=2>$totalprice 원</td>
			<td align=center style='border-right:none;border-left:none;'><font size=2>");
		if ($status < 6) { 
			echo ("<a href=changestatus.php?ordernum=$ordernum onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"> <b>$tstatus</b></a></td></tr>");
		} else {
		  echo ("<b>$tstatus</b></td></tr>");
		}
		
		$counter++;

	endwhile;

} else {
       echo ("<tr><td align=center colspan=5><font size=2><b>주문 내역이 존재하지 않습니다</b></td></tr>");
}

echo ("</table><table><tr><td height=200></td></tr></table>");

mysql_close($con);

?>
<?include ("bottom.html");?>
</center>