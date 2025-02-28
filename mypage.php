<center>
<? include ("top.html"); ?>
<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
$result = mysql_query("select * from member where uid='$UserID'", $con);
	
$uid = mysql_result($result, 0,   "UID");
$uname = mysql_result($result, 0,   "UNAME");

$zip = mysql_result($result, 0,   "ZIPCODE");
$addr1 = mysql_result($result, 0,   "ADDR1");
$addr2 = mysql_result($result, 0,   "ADDR2");
$mphone = mysql_result($result, 0,   "MPHONE");
$point =mysql_result($result, 0, "point");
$favorite = mysql_result($result, 0, "favorite");
$age = mysql_result($result, 0, "age");
?>
<table>
<tr height=20><td></td></tr>
</table>
<table width=900 border=0>
<tr><td><font size=6><b>회원 정보</b></td></tr><tr height=20><td></td></tr>
<tr><td align=right><a href=umodify.php><font size=2>회원정보수정</a></td></tr>
</table>

<table border=1 width=900 style='border-left:none; border-right:none;'>
<tr><td width=100 align=center bgcolor=#6C788C style='padding:10px;'><font color=white size=2>이름</td>
<td width=120><font size=2><? echo $uname; ?></td>
<td width=80 align=center style='padding:10px;' bgcolor=#6C788C><font color=white size=2>휴대전화</td>
<td width=140><font size=2><? echo $mphone; ?></td>
<td width=80 align=center style='padding:10px;' bgcolor=#6C788C rowspan=2><font color=white size=2>포인트</td>
<td width=170 rowspan=2><font size=2><? echo ("<font color=blue>$point</font> <b>p</b>"); ?></td></tr>
<tr><td width=100 align=center bgcolor=#6C788C style='padding:10px;'><font color=white size=2>나이</td>
<td width=120><font size=2><? echo $age; ?></td>
<td width=80 align=center style='padding:10px;' bgcolor=#6C788C><font color=white size=2>좋아하는 음식</td>
<td width=140><font size=2><? echo $favorite; ?></td>
</tr>
<tr><td align=center style='padding:10px;' bgcolor=#6C788C><font color=white size=2>주소</td>
<td colspan=5><font  size=2><? echo $zip . " " . $addr1 . " " . $addr2;   ?></td></tr>

</table>
<br><br>

<?
echo("
	<style>
		table { border-collapse:collapse; }
	</style>
");
$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
$total = mysql_num_rows($result);

echo ("
	<table width=900 border=0>
	<tr><td ><font size=6><b>구매 내역</b></td></tr><tr height=20><td></td></tr>
	<tr><td>* <font color=red   size=2>주문 물품이 배송 이전 단계이면 온라인으로 주문   취소가 가능합니다.</td></tr>
	<tr><td>* <font size=2>배송중이거나 구매 완료된 제품에 대한 반품 및 환불 요청은     당사 고객센터(전화: 070-4065-8670)로 문의바랍니다.</td></tr>
	<tr height=20><td></td></tr></table>

	<table border=1 width=900 style='border-left:none; border-right:none;'>
	<tr bgcolor=#6C788C style='padding:10px;'><td align=center style='padding:10px;border-left:none; border-right:none;''><font size=2 color=white>구매번호</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>구매일자</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>주문내역</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>주원산지</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>금액</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>적립 포인트</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>주문상태</td></tr>");	

if ($total > 0) {	
	$counter = 0;
	while($counter < $total) :
		$session = mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
		$oldstatus = $status;
	 
		switch ($status) {
		  case 1:
				$status = "주문신청";
				break;
		  case 2:
				$status = "주문접수";
				break;
		  case 3: 
				$status = "배송준비중";
				break;
		  case 4:
				$status = "배송중";
				break;
		  case 5:
				$status = "배송완료";
				break;
		  case 6:
				$status = "구매완료";
				break;
		}
	 
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;
		
        while ($subcounter <   $subtotal) :
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price2");
			 $point = mysql_result($tmpresult, 0, "point");
			 $origin = mysql_result($tmpresult, 0, "origin");
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
			 
			 
             $subcounter++;
        endwhile;
		$totalpoint = $totalprice * 0.01;
		$totalprice = $totalprice + 2000;
		$items = $subtotal - 1;
		
        echo ("<tr style='border-left:none; border-right:none;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\" ><td align=center style='border-left:none; border-right:none;'><font size=2>
			<a href=# onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new',   'width=940, height=250, scrollbars=yes');\" onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">$ordernum</a></td><td style='border-left:none; border-right:none;'  align=center><font size=2>$buydate</td>
			<td align=center style='border-left:none; border-right:none;'><font size=2>$pname 외 $items 종</td>
			<td  style='border-left:none; border-right:none;' align=center><font size=2>$origin</td>
			<td  style='border-left:none; border-right:none;' align=center><font size=2>$totalprice 원</td>
			<td  style='border-left:none; border-right:none;' align=center><font size=2 color=blue>$totalpoint</font> <b>p</b></td>
	
			<td align=center style='border-left:none; border-right:none;'><font size=2>$status
			
			");
      
		if ($oldstatus < 4) echo ("<br>(<a href=ordercancel.php?ordernum=$ordernum onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">주문취소</a>)");

		
		
		
		$counter++;
	endwhile;
	echo ("</td></tr></table>
			<table>
			<tr height=20><td></td></tr>
			</table>
		");
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;
		
		echo ("<table width=900 border=1  style='border-left:none; border-right:none; border:none;'>
			<tr style='boerder-right:none;'>
				<td align=left colspan=4 style='border-left:none; border-right:none;'><font size=6><b>포인트 관리</b></td>
				
			</tr>
			<tr ><td height=20></td></tr>
			<tr  align=center>
				<td bgcolor=#6C788C width=200 style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>구매 일자</td>
				<td bgcolor=#6C788C width=100 style='border-left:none; border-right:none;'><font size=2 color=white>주문 금액</td>
				<td bgcolor=#6C788C width=150 style='border-left:none; border-right:none;'><font size=2 color=white>적립된 포인트</td>
				<td></td>
			</tr>
			
			");
		$result = mysql_query("select * from receivers where id='$UserID' order by buydate desc", $con);
        while ($subcounter <   $subtotal) :
			
             $pcode = mysql_result($subresult, $subcounter, "pcode");
             $quantity = mysql_result($subresult, $subcounter, "quantity");
      
             $tmpresult = mysql_query("select * from product where code='$pcode'", $con);
             $pname = mysql_result($tmpresult, 0, "name");
			 $price = mysql_result($tmpresult, 0, "price2");
       
             $subtotalprice = $quantity * $price;
             $totalprice = $totalprice + $subtotalprice;
			 
			 $totalpoint = $totalprice * 0.01;
             $totalprice = $totalprice + 2000;
        
			echo("
			<tr>
				<td onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\" style='border-left:none; border-right:none;' align=center><font size=2>$buydate</td>
				<td onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\" style='border-left:none; border-right:none;' align=center><font size=2>$totalprice</td>
				<td onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\" style='border-left:none; border-right:none;' align=center><font size=2 color=blue>$totalpoint</font> <b>p</b></td>
				<td></td>
			</tr>
			
			");
			$subcounter++;
		endwhile;
		echo ("<tr><td colspan=3  align=right style='border-top:1px solid black;'><font size=2>총 적립된 포인트</font><font color=blue> $totalpoint </font> <b>p</b></td>
		</tr></table>");
} else {

	echo ("<tr><td align=center colspan=8><font size=2><b>주문 내역이 존재하지 않습니다</b></td></tr>");
echo ("</td></tr></table>
			<table>
			<tr height=20><td></td></tr>
			</table>
		");
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
        $subtotal =  mysql_num_rows($subresult);

        $subcounter=0;
        $totalprice=0;
		
		echo ("<table width=900 border=1  style='border:none;'>
			<tr style='boerder-right:none;'>
				<td align=left colspan=4 style='boerder-right:none;'><font size=6><b>포인트 관리</b></td>
				
			</tr>
			<tr><td height=20></td></tr>
			<tr align=center>
				<td width=200 bgcolor=#6C788C width=200 style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>구매 일자</td>
				<td bgcolor=#6C788C width=100 style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>주문 금액</td>
				<td bgcolor=#6C788C width=150 style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>적립된 포인트</td>
				<td></td>
			</tr>
			
			");
		
		echo ("
		<tr>
			<td colspan=3 onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\" style='border-left:none; border-right:none;' style='border-top:1px solid black;' align=center><font size=2>적립된 포인트가 존재하지 않습니다.</font></td>
		</tr>
		
		<tr><td colspan=3 align=right style='border-top:1px solid black;'><font size=2></font><font color=blue>  </font> <b></b></td>
		</tr></table>");
}

echo ("</table>");

mysql_close($con);	

?>
<table>
<tr height=20><td></td></tr>
</table>
<center>
<? include ("bottom.html"); ?>
</center>