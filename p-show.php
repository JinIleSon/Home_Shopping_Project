<center>
<? include ("top.html"); ?>
<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$userfile=mysql_result($result,0,"userfile");
$userfile2=mysql_result($result,0,"userfile2");
$userfile3=mysql_result($result,0,"userfile3");
$userfile4=mysql_result($result,0,"userfile4");
$userfile5=mysql_result($result,0,"userfile5");
$point=mysql_result($result,0,"point");

// 상품의 조회수를 읽어와서 1 증가시킨 다음 업데이트 쿼리를 적용
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("
	<table width=900 border=0>
	<tr height=50><td></td></tr>
    <tr><td width=250 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=400 border=1></a></td>
    <td width=400 valign=top>
    <table border=0 width=100%>
	  <tr><td align=center><b>이름 </b></td>
	  <td>&nbsp;&nbsp;<b>$name</b></td></tr>
	  <tr><td align=center><b>상품가격 </b></td>
	  <td>&nbsp;&nbsp;<strike>$price1&nbsp;<font style=\"font-size:10pt;\">원</font></strike></td></tr>
	  <tr><td align=center><b>할인가격 </b</td>
	  <td>&nbsp;&nbsp;<b><font color=red>$price2</font>&nbsp;<font style=\"font-size:10pt;\">원</font></b></td></tr>
");
	$price3 = $price2-($price2/10);
echo("	  
	  <tr><td width=80 align=center><b>카드혜택가<br>(10%할인!!) </b></td>
	  <td width=320>&nbsp;&nbsp;<font color=red><b>$price3</font>&nbsp;<font style=\"font-size:10pt;\">원</b></font></td></tr>
	  <tr><td width=80 align=center><b>포인트 </b></td>
	  <td width=320>&nbsp;&nbsp;<font color=blue><b>$point</b></font> <font style=\"font-size:10pt;\"><b>p</b></font></td></tr>
	  <tr><td width=80 align=center><b>코드 </b></td>
	  <td width=320>&nbsp;&nbsp;$code</td></tr>
	  <tr><td width=80 align=center><b>배송안내 </b></td>
	  <td width=320>&nbsp;&nbsp;예상출고일 3일 이내</td></tr>
	  
    	  <tr><td align=center valign=top style='padding-top:8px;'><b>수량</b></td>
		  <td height=50 valign=bottom style='padding-left:12px;'>
	     <form method=post action=tobag.php?code=$code>
	     <input type=text size=3 name=quantity value=1 style='border-top:none;border-left:none;border-right:none;border-bottom:3px solid black;'>&nbsp;
	     <input type=submit value=담기 onmouseover=\"this.style.color='white'; this.style.background='#222222';\" onmouseout=\"this.style.color='white';this.style.background='#222222';\"  style='background-color:#222222; border:1px solid #222222; border-radius:4px; color:white;'>
	     </td></tr>
		 <tr><td valign=top><input valign=top type=submit value=장바구니 onmouseover=\"this.style.color='black'; this.style.background='pink';\" onmouseout=\"this.style.color='white';this.style.background='#222222';\"  style='background-color:#222222; border:1px solid #222222; border-radius:4px; color:white;padding-top:10px; padding-bottom:10px;padding-left:43px;padding-right:43px;'></form></td>
			 
			 <td><form method=post action=toheart.php?code=$code>&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value='♡찜해놓기' onmouseover=\"this.style.color='white'; this.style.background='#222222';\" onmouseout=\"this.style.color='black';this.style.background='pink';\" style='background-color:pink; border:1px solid #222222;border-radius:4px;padding-top:10px;padding-bottom:10px;padding-left:38px;padding-right:38px;'></form></td></tr>
		 </form>
	</table>
	</td>
	</tr>
	</table>	
	<br>
	
	<table width=650 border=0>
		<tr><td align=center bgcolor=#222222 width=200 height=50 style=\"border-right:1px solid #808080;\"><font color=white><b>상품 상세 설명</b></font></td>
		</tr>
		<tr><td colspan=3 style='border-top: 1px solid #808080;'></td></tr>
		<tr align=center><td colspan=3><img src='./photo/$userfile2' border=0 width=900></td></tr>
		<tr align=center><td colspan=3><img src='./photo/$userfile3' border=0 width=900></td></tr>
		<tr align=center><td colspan=3><img src='./photo/$userfile4' border=0 width=900></td></tr>
		<tr align=center><td colspan=3><img src='./photo/$userfile5' border=0 width=891></td></tr>
		<tr><td height=20></td></tr>
		");
		$con=mysql_connect("localhost","root","apmsetup");
		mysql_select_db("shopmall",$con);

 	
	
		$result =   mysql_query("select * from boardreply where code='$code'", $con);

		$total =   mysql_num_rows($result);
		echo("
		<tr><td align=center bgcolor=#222222 width=200 height=50 style=\"border-right:1px solid #808080;\"><font color=white><b>구매후기 (&nbsp;$total&nbsp;)</b></font></td>
		</tr>
	</table>
");


$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

 	echo ("<br>
	<style>
		table { border-collapse:collapse; }
	</style>
	");
	
	$result =   mysql_query("select * from boardreply where code='$code'", $con);

	$total =   mysql_num_rows($result);
	if (!$total)   {
	echo ("
		<table width=900><tr><td align=center>아직 등록된 글이 없습니다<br></td></tr></table>");
	echo ("
		<table border=0 width=900>
			<tr>
				<td>
					구매후기 <font color='red'>$total</font> 개
				</td>
			</tr>
	");
	} else {
		$i = 0;
		echo ("
		<table border=0 width=900>
			<tr>
				<td>
					구매후기 <font color='red'>$total</font> 개
				</td>
			</tr>
		");
		while ($i < $total):
			
			$name = mysql_result($result, $i, "name");
			$wdate = mysql_result($result, $i, "wdate");
			$content = mysql_result($result, $i, "content");
			$passwd = mysql_result($result, $i, "passwd");
			$star = mysql_result($result, $i, "star");
			$code=	mysql_result($result, $i, "code");
			$UserID2 = substr($name, 0, 3);
			$USERID = $UserID2 . "*******";
			echo ("
				<table border=1 width=900>
					<tr height=70 onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
						<td width=100 align=center style='border-right:hidden;'><b>$USERID</b></td>
						");
						switch ($star):
							case 1:
								echo("<td width=100 align=center style='border-right:hidden;'>별점<br>★</td>");
								break;
							case 2:
								echo("<td width=100 align=center style='border-right:hidden;'>별점<br>★★</td>");
								break;
							case 3:
								echo("<td width=100 align=center style='border-right:hidden;'>별점<br>★★★</td>");
								break;
							case 4:
								echo("<td width=100 align=center style='border-right:hidden;'>별점<br>★★★★</td>");
								break;
							case 5:
								echo("<td width=100 align=center style='border-right:hidden;'>별점<br>★★★★★</td>");
								break;
						endswitch;
						
		
						
				
						
						if($UserID == "admin" || $UserID == $name){
							
							echo("
							<td width=500 style='border-right:hidden;padding-bottom:10px;'><font size=2>$wdate</font> <br><br> $content</td>
							<td width=50 align=center><a href=rpass.php?code=$code&mode=0&wdate=$wdate onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">수정</a><br><a href=rpass.php?code=$code&mode=1&wdate=$wdate onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">삭제</a></td>");
						} else {
							echo("<td width=500 style='hidden;padding-bottom:10px;'><font size=2>$wdate</font> <br><br> $content</td>");
						}
					echo("</tr>
				</table>
				
			");
			$i++;
		endwhile;
	}
	if (!$UserID) {
		echo("<br>구매후기는 로그인 후 이용 가능합니다.<br><br>");
	}
	else {
		$result =   mysql_query("select * from member where uid='$UserID'", $con);
		$upass = mysql_result($result, 0, "upass");
		
		echo ("
		<br>
		<form action=memo.php?code=$code&name=$UserID&upass=$upass method=post>
		<table border=1 width=900 height=70>
			<tr>
				<td align=center style='border-right:hidden;'>
					<b>&nbsp;&nbsp;$UserID</b><br>
					
				</td>");
				echo("<td align=center style='border-right:hidden;'>
					&nbsp;&nbsp;&nbsp;&nbsp;별점<br>&nbsp;&nbsp;&nbsp;&nbsp;<select name=star>
				<option value=1 align=center>★</option>
				<option value=2 align=center>★★</option>
				<option value=3 align=center>★★★</option>
				<option value=4 align=center>★★★★</option>
				<option value=5 align=center>★★★★★</option>
				</select></td>");
				echo("
				
				<td colspan=2 align=center style='border-right:hidden;'>
					<textarea name=wmemo rows=3 cols=60></textarea>
					
				</td>
				<td align=center style='border-right:hidden;'>
					암호&nbsp;&nbsp;&nbsp;&nbsp;<br>
					<input type=password name=passwd size=5>&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td align=center>
					<input type=submit value='등록'>
				</td>
			</tr>
	
	
	
		</table>
		
		<br>
	");
	}

mysql_close($con);

?>
<? include ("bottom.html"); ?>
</center>
