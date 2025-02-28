<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>

<center>
<? include ("top.html"); ?>
<table>
	<tr height=20><td></td></tr>
	</table>
<table width=900 border=0>
<tr><td><font size=6><b>상품 구매 단계</b></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>님의 구입 예정   품목</td>
</table>

<?
echo("
<style>
	table{border-collapse:collapse;}
</style>
");
switch ($mode){

	case 0:
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from heart where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=900 style='border-left:none; border-right:none;'>
    <tr bgcolor=#6C788C style='border-left:none; border-right:none;'><td width=100 align=center style='padding:10px; border-left:none; border-right:none;'><font size=2 color=white>상품사진</td>
	<td width=300 align=center style='border-left:none; border-right:none;'><font size=2 color=white>상품명</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>원산지</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>가격</td>
	<td width=50 align=center style='border-left:none; border-right:none;'><font size=2 color=white>수량</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>포인트(개당)</td>
	<td width=100 align=center style='border-left:none; border-right:none;'><font size=2 color=white>품목별합계</td>
	
	");

if (!$total) {
     echo("<tr><td colspan=10 align=center><font   size=2><b>쇼핑백에 담긴 상품이   없습니다.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
		$id = mysql_result($result, $counter, "id");
		$session = mysql_result($result, $counter, "session");
		$pcode = mysql_result($result, $counter, "pcode");
		$quantity = mysql_result($result, $counter, "quantity");
      
		$subresult = mysql_query("select * from product where code='$pcode'", $con);
		$userfile = mysql_result($subresult, 0, "userfile");
		$pname = mysql_result($subresult, 0, "name");
		$price = mysql_result($subresult, 0, "price2");
        $origin = mysql_result($subresult, 0, "origin");
	    $point = mysql_result($subresult, 0, "point");
		$subtotalprice = $quantity * $price;
		$totalprice = $totalprice + $subtotalprice; 
		$subtotalpoint = $quantity * $point;
	    $totalpoint = $totalpoint + $subtotalpoint;
		echo ("<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='border-left:none; border-right:none;'>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left style='border-left:none; border-right:none;'><font size=2><a   href=p-show.php?code=$pcode onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">$pname </a></td>
			<td align=center style='border-left:none; border-right:none;'><font size=2>$origin</td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$price&nbsp;원</td>
			<td align=center style='border-left:none; border-right:none;'>
			<font size=2>$quantity 개
			</td></form>
			<td align=center style='border-left:none; border-right:none;'><font color=blue>$point</font> <font size=2 ><b>p</b></font></td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$subtotalprice&nbsp;원</td>
			</form>
			");

		$counter++;

    endwhile;
 
      echo("<tr><td colspan=8  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 구매 금액: $totalprice 원</td></tr>");
	echo("<tr><td colspan=8  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 적립가능 포인트: $totalpoint p</td></tr></table>");
}



echo("
	<table>
	<tr height=20><td></td></tr>
	</table>
	<br>
	<table border=1 width=900 style='border:none;'>
		<tr>
		<td width=100 ><b>총 상품금액</b></td><td width=200 align=right style='border-bottom:1px solid black;'> $totalprice <font size=2pt>원</font></td>
		
		");
		if (!$subpoint) {
			$subpoint=0;
		}
		$result = mysql_query("select * from member where uid='$id'",$con);
		$point = mysql_result($result, 0, "point");
		$totaltotalprice = $totalprice + 2000 - $subpoint;
		
		echo("<td></td><td width=10 style='border-left:1px solid black;'></td>
		<td colspan=2 style='border-right:none;'><b>최종 결제금액</b></td>
		<td width=10></td>
		<td style='border-right:none;'></td>

		</tr>
		<tr>
		<td><b>총 추가금액</b></td>
		<td align=right style='border-bottom:1px solid black;'> 2000 <font size=2pt>원</font></td> 
		<td width=180 align=center>- <font size=2pt>배송비</font> 2000<font size=2pt>원</font></td>
		<td width=10 style='border-left:1px solid black;'></td>
		<td colspan=2 style='border-bottom:1px solid black;'>$totalprice&nbsp;+&nbsp;2000&nbsp;-&nbsp;0&nbsp;-&nbsp;$subpoint&nbsp;<font size=2pt>(사용포인트)</font>&nbsp;=&nbsp;$totaltotalprice&nbsp;<font size=2pt>원</font></td>
		<td width=68></td>
		</tr>
		<tr>
		<td><b>총 할인금액</b></td>
		<td><u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
		0 <font size=2pt>원</u></font></td>
		<td></td>
		<td width=10 style='border-left:1px solid black;'></td>
		<td width=100><b>보유포인트</b><br><font size=2pt><b>적립예상 포인트<br>(구매금액의 1%)</b></td>
		<td><form method=post action=pointprocess.php?subpoint=$subpoint&id=$id&mode=0>
		<input type=text size=5 name=subpoint style='margin-right:15px;margin-top:13px;border-right:none;border-left:none;border-top:none;border-bottom:1px solid black;' value=$point><input style=\"width:50px; height:25px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\" type=submit value=사용>
		<br><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font color=blue>$totalpoint</font> <b><font size=2pt>p</u></b>
		</td><td></td>
		</tr>
		</form>

	</table>
	<br>
	<table>
	<tr height=20><td></td></tr>
	</table>
");

echo ("<br>
		<table border=0 width=900>
        <tr><td align=center><font size=2>입금 계좌: <b>국민은행 012345-56-678789 (예금주: 손진일)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:070-8236-4423)로 연락주세요.
       </td></tr>
       </table>");

$result = mysql_query("select * from member where uid='$id'",$con);

echo("
    <br><br>
	<table width=900 border=0>
	<tr><td><font size=6><b>배송정보 입력</b></td></tr><tr>
	<td><font size=2pt>배송일 3일 이내 출고 예정(사정에 따라 변경될 수 있습니다.)</td>
	");
	if ($xid) {
		$uname = mysql_result($result, 0, "uname");
		$mphone = mysql_result($result, 0, "mphone");
		$zipcode = mysql_result($result, 0, "zipcode");
		$addr1 = mysql_result($result, 0, "addr1");
		$addr2 = mysql_result($result, 0, "addr2");
		
		
	} else if (!$xid) {
		
		
	}
	
	
	echo("
	
	<td><form method=post action=infoprocess.php?id='$id'&subpoint=$subpoint&mode=0>
	");
	
	if($xid) {
	echo("
	<input type=checkbox value=1 checked name=check onchange=\"this.form.submit()\">
	");
	} else {
		echo("
		<input type=checkbox value=0 name=check onchange=\"this.form.submit()\">
		");
	}
	echo("
	<font size=2>구매자 정보와 동일</font>
	</form>
	</td>
	</tr>
	</table>
	<table>
	<tr height=20><td></td></tr>
	</table>

	<table width=900 border=0>
	<form method=post action=endshopping.php?mode=$mode&totalpoint=$totalpoint&addpoint=$totalpoint&totaltotalprice=$totaltotalprice&id=$id&totalprice=$totalprice&subpoint=$subpoint name=buy>
	<tr><td width=120><b>수령인</td>
	<td><input type=text name=receiver size=10 value=$uname></td>
	</tr>
	<tr>
	<td ><b>전화번호</td>
	<td style='padding-top:13px;padding-bottom:13px;'><input type=text name=phone   size=20 value=$mphone></td>
	</tr>
	<tr><td height=30 ><b>주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly value=$zipcode>
	<font size=2><a href='javascript:go_zip()'><input type=button value='우편번호검색' style=\"height:25; border-radius:3px;background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></a><br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;' value='$addr1'>
	<br><input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;' value='$addr2'></td>
	<tr><td ><b>주문요구사항</td>
	<td><br><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr><td align=center colspan=2><br>
	<input type=submit value=구매완료  style=\"width:100px; height:50px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></td></tr>
	</table>
	<table>
	<tr height=20><td></td></tr>
	</table>
	</form>
	
");
include ("bottom.html");
echo ("</center>");
exit;
break;

case 1:

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=900 style='border-left:none; border-right:none;'>
    <tr bgcolor=#6C788C style='border-left:none; border-right:none;'><td width=100 align=center style='padding:10px; border-left:none; border-right:none;'><font size=2 color=white>상품사진</td>
	<td width=300 align=center style='border-left:none; border-right:none;'><font size=2 color=white>상품명</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>원산지</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>가격</td>
	<td width=50 align=center style='border-left:none; border-right:none;'><font size=2 color=white>수량</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>포인트(개당)</td>
	<td width=100 align=center style='border-left:none; border-right:none;'><font size=2 color=white>품목별합계</td>
	
	");

if (!$total) {
     echo("<tr><td colspan=10 align=center><font   size=2><b>쇼핑백에 담긴 상품이   없습니다.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // 총 구매 금액  

    while ($counter < $total) :
		$id = mysql_result($result, $counter, "id");
		$session = mysql_result($result, $counter, "session");
		$pcode = mysql_result($result, $counter, "pcode");
		$quantity = mysql_result($result, $counter, "quantity");
      
		$subresult = mysql_query("select * from product where code='$pcode'", $con);
		$userfile = mysql_result($subresult, 0, "userfile");
		$pname = mysql_result($subresult, 0, "name");
		$price = mysql_result($subresult, 0, "price2");
        $origin = mysql_result($subresult, 0, "origin");
	    $point = mysql_result($subresult, 0, "point");
		$subtotalprice = $quantity * $price;
		$totalprice = $totalprice + $subtotalprice; 
		$subtotalpoint = $quantity * $point;
	    $totalpoint = $totalpoint + $subtotalpoint;
		echo ("<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='border-left:none; border-right:none;'>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left style='border-left:none; border-right:none;'><font size=2><a   href=p-show.php?code=$pcode onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">$pname </a></td>
			<td align=center style='border-left:none; border-right:none;'><font size=2>$origin</td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$price&nbsp;원</td>
			<td align=center style='border-left:none; border-right:none;'>
			<font size=2>$quantity 개
			</td></form>
			<td align=center style='border-left:none; border-right:none;'><font color=blue>$point</font> <font size=2 ><b>p</b></font></td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$subtotalprice&nbsp;원</td>
			</form>
			");

		$counter++;

    endwhile;
 
      echo("<tr><td colspan=8  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 구매 금액: $totalprice 원</td></tr>");
	echo("<tr><td colspan=8  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 적립가능 포인트: $totalpoint p</td></tr></table>");
}



echo("
	<table>
	<tr height=20><td></td></tr>
	</table>
	<br>
	<table border=1 width=900 style='border:none;'>
		<tr>
		<td width=100 ><b>총 상품금액</b></td><td width=200 align=right style='border-bottom:1px solid black;'> $totalprice <font size=2pt>원</font></td>
		
		");
		if (!$subpoint) {
			$subpoint=0;
		}
		$result = mysql_query("select * from member where uid='$id'",$con);
		if($UserName){
			$point = mysql_result($result, 0, "point");
		}
		$totaltotalprice = $totalprice + 2000 - $subpoint;
		
		echo("<td></td><td width=10 style='border-left:1px solid black;'></td>
		<td colspan=2 style='border-right:none;'><b>최종 결제금액</b></td>
		<td width=10></td>
		<td style='border-right:none;'></td>

		</tr>
		<tr>
		<td><b>총 추가금액</b></td>
		<td align=right style='border-bottom:1px solid black;'> 2000 <font size=2pt>원</font></td> 
		<td width=180 align=center>- <font size=2pt>배송비</font> 2000<font size=2pt>원</font></td>
		<td width=10 style='border-left:1px solid black;'></td>
		<td colspan=2 style='border-bottom:1px solid black;'>$totalprice&nbsp;+&nbsp;2000&nbsp;-&nbsp;0&nbsp;-&nbsp;$subpoint&nbsp;<font size=2pt>(사용포인트)</font>&nbsp;=&nbsp;$totaltotalprice&nbsp;<font size=2pt>원</font></td>
		<td width=68></td>
		</tr>
		<tr>
		<td><b>총 할인금액</b></td>
		<td><u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
		0 <font size=2pt>원</u></font></td>
		<td></td>
		<td width=10 style='border-left:1px solid black;'></td>
		<td width=100><b>보유포인트</b><br><font size=2pt><b>적립예상 포인트<br>(구매금액의 1%)</b></td>
		<td><form method=post action=pointprocess.php?subpoint=$subpoint&id=$id&mode=1>
		<input type=text size=5 name=subpoint style='margin-right:15px;margin-top:13px;border-right:none;border-left:none;border-top:none;border-bottom:1px solid black;' value=$point><input style=\"width:50px; height:25px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\" type=submit value=사용>
		<br><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<font color=blue>$totalpoint</font> <b><font size=2pt>p</u></b>
		</td><td></td>
		</tr>
		</form>

	</table>
	<br>
	<table>
	<tr height=20><td></td></tr>
	</table>
");

echo ("<br>
		<table border=0 width=900>
        <tr><td align=center><font size=2>입금 계좌: <b>국민은행 012345-56-678789 (예금주: 손진일)</b><br><br>
		* 구입하신 물품은 입금 확인후 배송되며, 주문 진행 상황은 My Page에서 확인하실 수 있습니다.<br>
		* 물품 배송 이전에 주문 취소를 원하시면 My Page에서 직접 주문 취소 요청을 하시면 됩니다.<br>
		* 물품을 배송 받으신 후에 구매 취소를 원하시면 고객센터(전화:070-8236-4423)로 연락주세요.
       </td></tr>
       </table>");

$result = mysql_query("select * from member where uid='$id'",$con);

echo("
    <br><br>
	<table width=900 border=0>
	<tr><td><font size=6><b>배송정보 입력</b></td></tr><tr>
	<td><font size=2pt>배송일 3일 이내 출고 예정(사정에 따라 변경될 수 있습니다.)</td>
	");
	if ($xid) {
		$uname = mysql_result($result, 0, "uname");
		$mphone = mysql_result($result, 0, "mphone");
		$zipcode = mysql_result($result, 0, "zipcode");
		$addr1 = mysql_result($result, 0, "addr1");
		$addr2 = mysql_result($result, 0, "addr2");
		
		
	} else if (!$xid) {
		
		
	}
	
	
	echo("
	
	<td><form method=post action=infoprocess.php?id='$id'&subpoint=$subpoint&mode=1>
	");
	
	if($xid) {
	echo("
	<input type=checkbox value=1 checked name=check onchange=\"this.form.submit()\">
	");
	} else {
		echo("
		<input type=checkbox value=0 name=check onchange=\"this.form.submit()\">
		");
	}
	echo("
	<font size=2>구매자 정보와 동일</font>
	</form>
	</td>
	</tr>
	</table>
	<table>
	<tr height=20><td></td></tr>
	</table>

	<table width=900 border=0>
	<form method=post action=endshopping.php?mode=$mode&totalpoint=$totalpoint&addpoint=$totalpoint&totaltotalprice=$totaltotalprice&id=$id&totalprice=$totalprice&subpoint=$subpoint name=buy>
	<tr><td width=120><b>수령인</td>
	<td><input type=text name=receiver size=10 value=$uname></td>
	</tr>
	<tr>
	<td ><b>전화번호</td>
	<td style='padding-top:13px;padding-bottom:13px;'><input type=text name=phone   size=20 value=$mphone></td>
	</tr>
	<tr><td height=30 ><b>주소</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly value=$zipcode>
	<font size=2><a href='javascript:go_zip()'><input type=button value='우편번호검색' style=\"height:25; border-radius:3px;background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></a><br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;' value='$addr1'>
	<br><input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;' value='$addr2'></td>
	<tr><td ><b>주문요구사항</td>
	<td><br><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr><td align=center colspan=2><br>
	<input type=submit value=구매완료 style=\"width:100px; height:50px; background-color:FAF0E6;border:1px solid #6C788C;border-radius:4px;\"></td></tr>
	</table>
	<table>
	<tr height=20><td></td></tr>
	</table>
	</form>
	</center>
");
break;
}
mysql_close($con);	//데이터베이스 연결해제
?>

<center>
<? include ("bottom.html"); ?>
</center>