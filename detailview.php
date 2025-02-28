<?
echo("
<style>
	table {border-collapse:collapse; }

</style>

");
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from receivers where ordernum='$ordernum'", $con);
$total = mysql_num_rows($result);

$session = mysql_result($result, 0, "session");
$sender = mysql_result($result, 0, "sender");
$receiver = mysql_result($result, 0, "receiver");
$phone = mysql_result($result, 0, "phone");
$address = mysql_result($result, 0, "address");
$message = mysql_result($result, 0, "message");
$buydate = mysql_result($result, 0,  "buydate");
$status = mysql_result($result, 0, "status");
	 
switch ($status) {
	case 1:
		$status   = "주문신청";
		break;
	case 2:
		$status   = "주문접수";
		break;
	case 3: 
		$status   = "배송준비중";
		break;
	case 4:
		$status   = "배송중";
		break;
	case 5:
		$status   = "배송완료";
		break;
	case 6:
		$status   = "구매완료";
		break;
}
	 
echo ("
    <center><font size=2>주문번호 <b>$ordernum</b> [<font color=red size=2><b>$status</b></font>]</center>
	<table border=1 width=900 style='border-left:none; border-right:none;'>
");

echo ("
	<tr bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><td align=center width=120 style='border-left:none; border-right:none;'><font size=2 color=white>주문번호</td>
	<td align=center width=150 style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>주문일자</td>
	<td align=center width=550 style='border-left:none; border-right:none;'>
		<table border=0>
			<tr ><td width=385 align=center><font size=2 color=white>상품명</td>
			<td align=center width=60><font size=2 color=white>원산지</td>
			<td align=center width=80><font size=2 color=white>포인트</td>
			
			</tr>
		</table></td>
	<td align=center width=100 style='border-left:none; border-right:none;'><font size=2 color=white>가격</td></tr>
");	

echo("
	<tr><td align=center style='padding-top:10px;padding-bottom:10px;'><font size=2>$ordernum</td>
	<td align=center><font size=2>$buydate</td>
	<td>
");
	
$subresult = mysql_query("select * from orderlist where session='$session'", $con);
$subtotal = mysql_num_rows($subresult);

$subcounter=0;
$totalprice=0;
          
while ($subcounter < $subtotal) :
	$pcode = mysql_result($subresult, $subcounter, "pcode");
	$quantity = mysql_result($subresult, $subcounter, "quantity");
	   
	$tmpresult = mysql_query("select * from product where code='$pcode'", $con);

	$pname = mysql_result($tmpresult, 0,   "name");
	$price = mysql_result($tmpresult, 0,   "price2");
	$origin = mysql_result($tmpresult, 0,   "origin");
	$point = mysql_result($tmpresult, 0, "point");
	
	$subtotalprice = $quantity * $price;
	$totalprice = $totalprice + $subtotalprice;
	$subtotalpoint = $quantity * $point;
	echo("
		<table border=0>
		<tr><td width=390 align=center style='border-left:none; border-right:none;'><font size=2>$pname</td>
		<td align=center width=60 style='border-left:none; border-right:none;'><font size=2>$origin</td>
		<td align=center width=80 style='border-left:none; border-right:none;'><font size=2 color=blue>$subtotalpoint</font><font size=2><b>p</b></td>
		
		</tr>
		</table>
	");
	
     $subcounter++;
endwhile;
	
echo ("
	</td>
	<td align=center style='border-left:none; border-right:none;'><font color=red size=2><b>$totalprice</b></td>
	</tr>
	</table>
");

echo ("
	<table border=1 width=900 style='border-left:none; border-right:none;'>
	<tr bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><td   align=center style='border-left:none; border-right:none;'><font size=2 color=white>주문자명</td>
	<td align=center bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>수신자명</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>수신주소</td>
	<td align=center style='border-left:none; border-right:none;'><font size=2 color=white>수신자연락처</td>
	</tr>
");

echo ("
	<tr style='border-left:none; border-right:none;'><td align=center><font size=2>$sender</td>
	<td align=center style='border-left:none; border-right:none; padding-top:10px;padding-bottom:10px;'><font size=2>$receiver</td>
	<td><font size=2>$address</td>
	<td align=center><font size=2>$phone</td></tr>
	<tr bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><td align=center colspan=4 bgcolor=#6C788C style='padding:10px;border-left:none; border-right:none;'><font size=2 color=white>주문 메시지</td></tr>
	<tr><td colspan=10><font size=2>$message</font></td></tr>
	</table>
");

mysql_close($con);

?>