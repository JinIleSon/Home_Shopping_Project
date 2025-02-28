<center>
<? include ("top.html"); ?>
<?
echo("<style>
	table {border-collapse:collapse;}
</style>");
?>
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from product order by name", $con);

$total = mysql_num_rows($result);

echo ("<table border=1 width=900>
	<tr height=20 style='border-right:none;border-left:none;border-top:none;'><td colspan=8></td></tr>
	<tr bgcolor=#6C788C><td align=center style='padding:10px;'><font size=2 color=white>상품코드</td>
	<td colspan=2 align=center><font size=2 color=white>상품명</td>
	<td align=center><font size=2 color=white>원산지</td>
	<td align=center><font size=2 color=white>포인트</td>
	<td align=center><font size=2 color=white>권장가격</td>
	<td align=center><font size=2 color=white>판매가격</td>
	<td align=center><font size=2 color=white>수정/삭제</td></tr>");
							
if (!$total) {

  echo("<tr><td colspan=6 align=center>아직 등록된 상품이 없습니다</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");
		$price2=mysql_result($result,$counter,"price2");
		$origin=mysql_result($result,$counter,"origin");
		$point=mysql_result($result,$counter,"point");
		echo ("
		
		   <tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
			 <td width=100 align=center><font size=2>$code</td>
			 <td align=center width=30><img src=./photo/$userfile width=40 height=40 border=0></td>
			   <td width=350 align=left><a href=p-show.php?code=$code onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><font size=2>$name</a></td>
			   <td align=center width=70><font size=2>$origin</td>
			   <td align=right width=70><font size=2>$point p</td>
			   <td align=right width=70><font size=2><strike>$price1&nbsp;원</strike></td>
			   <td align=right width=70><font size=2><font color=red>$price2</font>&nbsp;원</td>
			   <td width=70 align=center><font size=2><a href=p-modify.php?code=$code onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">수정</a>/<a href=p-delete.php?code=$code onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">삭제</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("<tr height=20 style='border-right:none;border-left:none;border-top:none;'><td colspan=8></td></tr></table>");
	     
mysql_close($con);

?>
<? include ("bottom.html"); ?>
</center>