<center>
<? include ("top.html"); ?>
<?

if (!isset($UserID)) {
	$UserID = 'hello';
}
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// 전체 쇼핑백 테이블에서 특정 사용자의 구매 정보만을 읽어낸다
$result = mysql_query("select * from heart where session='$Session'", $con);
$total = mysql_num_rows($result);
echo("
<table height=70><tr><td></td></tr>
</table>
<table width=900 border=0>
<tr><td><font size=6><b>찜 목록(&nbsp;$total&nbsp;)</b></td></tr>
<tr><td align=right><font size=2><b>$UserName</b>님의 현재 찜한 목록</td>
</table>
");

echo("
<style>
	table{border-collapse:collapse;}
</style>
");


echo ("
	<table border=1 width=900 style='border-left:none; border-right:none;'>
    <tr bgcolor=#6C788C style='border-left:none; border-right:none;'><td width=100 align=center style='padding:10px; border-left:none; border-right:none;'><font size=2 color=white>상품사진</td>
	<td width=300 align=center style='border-left:none; border-right:none;'><font size=2 color=white>상품명</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>원산지</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>가격</td>
	<td width=50 align=center style='border-left:none; border-right:none;'><font size=2 color=white>수량</td>
	<td width=90 align=center style='border-left:none; border-right:none;'><font size=2 color=white>포인트(개당)</td>
	<td width=100 align=center style='border-left:none; border-right:none;'><font size=2 color=white>품목별합계</td>
	<td width=50 align=center style='border-left:none; border-right:none;'><font size=2 color=white>삭제</td>
	<td align=center width=130 style='border-left:none; border-right:none;'><font size=2 color=white>장바구니로 옮기기</td></tr>
");

if (!$total) {
     echo("<tr><td colspan=10 align=center><font size=2>찜한 상품이 없습니다.</td></tr></table>");
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
	   $origin = mysql_result($subresult, 0, "origin");
	   $point = mysql_result($subresult, 0, "point");
       $price = mysql_result($subresult, 0, "price2");
       
       $subtotalprice = $quantity * $price;
       $totalprice = $totalprice + $subtotalprice; 
	   $subtotalpoint = $quantity * $point;
	   $totalpoint = $totalpoint + $subtotalpoint;
		echo ("<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='border-left:none; border-right:none;'>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left style='border-left:none; border-right:none;'><font size=2><a   href=p-show.php?code=$pcode onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>$pname </a></td>
			<td align=center style='border-left:none; border-right:none;'><font size=2>$origin</td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$price&nbsp;원</td>
			<td align=center style='border-left:none; border-right:none;'>
			<form method=post action=hmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=submit value=변경>
			</td></form>
			<td align=center style='border-left:none; border-right:none;'><font color=blue>$point</font> <font size=2 ><b>p</b></font></td>
			<td align=right style='border-left:none; border-right:none;'><font size=2>$subtotalprice&nbsp;원</td>
			<td align=center style='border-left:none; border-right:none;'>
			<a href=heartdelete.php?pcode=$pcode><img src='delete.png' width=20 height=20></a></form>
			
			
			</td>
			<td valign=middle style='border-left:none; border-right:none;'><form method=post action=heartprocess.php?id=$id&session=$session&pcode=$pcode&quantity=$quantity><input type=submit value='장바구니로 옮기기'></form></td>
			</tr>");

		$counter++;
    endwhile;
 	
     echo("<tr><td colspan=9  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 구매 금액: $totalprice 원</td></tr>");
	echo("<tr><td colspan=9  style='padding-top:5px; padding-bottom:5px;' onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>총 적립가능 포인트: $totalpoint p</td></tr></table>");
}

mysql_close($con);	//데이터베이스 연결해제

echo ("<table width=900 border=0>
	<tr height=20><td></td></tr>
	<tr><td width=400></td><td align=right valign=top><font size=2><form method=post action=buy.php?mode=0><input type=submit value=구매결정 style='padding-top:10px;padding-bottom:10px;padding-left:38px;padding-right:38px;'></form></td>
	<td align=right valign=top><form method=post action=p-list.php><input type=submit value=쇼핑계속 style='padding-top:10px;padding-bottom:10px;padding-left:38px;padding-right:38px;'></form></td>
	<td align=right valign=top><form method=post action=showbag.php><input type=submit value='장바구니 목록 보기' style='padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;'></form></td>
	<tr></tr></table>");


?>
<table height=120><tr><td></td></tr>
</table>
<? include ("bottom.html"); ?>
</center>