<center>
<?include ("top.html");?>

<table width=900 align=center border=0>
<tr height=20><td></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;<font size=6><b>MANAGEMENT</b></font></td></tr>
<tr><td><hr size=2 color=lightgray width=100%></td></tr>
<tr height=40><td></td></tr>	
</table>

<table border=0 width=900 align=center>
<tr><td height=80></td></tr>
<tr><td><center><img src=./image/member.png width=200 height=200></td>
	<td><center><img src=./image/product.jpg width=200 height=200></td>
	<td><center><img src=./image/order.png width=200 height=200></td></tr>
<tr><td height=40></td></tr>
<tr><td align=center><form method=post action=membershow.php>
<input type=submit value='회원 목록 조회' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
<td align=center>
<form method=post action=p-input.php>
<input type=submit value='신규 판매상품 등록' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
<td align=center>
<form method=post action=orderlist.php>
<input type=submit value='주문 내역 조회' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
</tr>
<tr><td></td>
<td align=center>
<form method=post action=p-adminlist.php>
<input type=submit value='판매상품 수정/삭제' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
<tr>
<td align=center>
<form method=post action=input4.php?board=adminboard>
<input type=submit value='공지사항 글쓰기' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
<td align=center><form method=post action=show4.php?board=adminboard>
<input type=submit value='공지사항' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form></td>
<td align=center>
<form method=post action=input5.php?board=qnaboard>
<input type=submit value='자주 묻는 질문, 답변 글쓰기' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:20%; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form>
</td>
</tr>
</table>



<?


 echo (" <style>
		a {text-decoration:none;}
	</style>
");
 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from $board order by id desc", $con);
$total = mysql_num_rows($result);




echo("
	<table>
		<tr><td height=30></td></tr>
	</table>

	<center>
	<table border=0 width=900 style='border-collapse:collapse;'>
	<tr><td colspan=2 align=center><h1>공지사항</h1></td></tr>
	<tr><td align=right>
	<form method=post action=search4.php?board=$board>
	<select name=field style='width:90px; height:30px; vertical-align:bottom'>
	<option value=writer>글쓴이</option>
	<option value=topic>제목</option>
	<option value=content>내용</option>
	</select>
	&nbsp;&nbsp;<input type=text name=key size=13 style='width:300px; height:30px;'>
	<input type='image' src='lens.png' width=20 height=20 style='vertical-align:middle'>
	</td>
	</form>
	<td align=right></td></tr>
	</table>
	<table border=1 width=900 style='border-left:none; border-right:none;border-collapse:collapse;'>
	<tr bgcolor=#6C788C style='border-left:none; border-right:none;'>
	<td align=center width=50 style='border-left:none; border-right:none;padding:10px;'><b><font color=white>번호</font></b></td>
	<td  align=center width=100 style='border-left:none; border-right:none;padding:10px;'><b><font color=white>작성자</font></b></td>
	<td align=center width=400 style='border-left:none; border-right:none;padding:10px;'><b><font color=white>제목</font></b></td>
	<td align=center width=150 style='border-left:none; border-right:none;padding:10px;'><b><font color=white>작성일</font></b></td>
	<td align=center width=50 style='border-left:none; border-right:none;padding:10px;'><b><font color=white>조회</font></b></td>
	</tr>
");

if (!$total){
	echo("
		<tr><td colspan=5 align=center>아직 등록된 글이 없습니다.</td></tr>
	");
	echo("
		<tr style='border-bottom:none;'>
			<td style='vertical-align:middle;' height=50 colspan=10 align=right>
				<a href=input4.php?board=$board><img src='pencil.png' width=25 height=25></a>&nbsp;&nbsp;&nbsp;
				<a href=show4.php?board=$board><img src='catalog.png' width=25 height=25></a>
			</td>
		</tr>
	</table>");
} else {

	if   ($cpage=='') $cpage=1;    // $cpage -  현재 페이지 번호
	$pagesize = 5;                // $pagesize - 한 페이지에 출력할 목록 개수

	$totalpage = (int)($total/$pagesize);
	if (($total%$pagesize)!=0) $totalpage = $totalpage + 1;

	$counter=0;

	while($counter<$pagesize):
		$newcounter=($cpage-1)*$pagesize+$counter;
		if ($newcounter == $total) break;
		
		$id=mysql_result($result,$newcounter,"id");
		$writer=mysql_result($result,$newcounter,"writer");
		$topic=mysql_result($result,$newcounter,"topic");
		$hit=mysql_result($result,$newcounter,"hit");
		$wdate=mysql_result($result,$newcounter,"wdate");
		$space=mysql_result($result,$newcounter,"space");
		$filename=mysql_result($result,$newcounter,"filename");
		
		$t="";

		if   ($space>0) {
			for ($i=0 ; $i<=$space ; $i++)
				$t = $t . "&nbsp;";     // 답변 글의 경우 제목 앞 부분에 공백을 채움
		}
		
		$result2 = mysql_query("select * from adminboardreply where id=$id", $con);
		$total2 = mysql_num_rows($result2);
		if (!$filename) {
			if (!$total2) {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;border-left:none; border-right:none;'>$t<a href=content4.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic</a></td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$wdate</td><td align=center style='border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			} else {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;border-left:none; border-right:none;'>$t<a href=content4.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic [$total2]</a></td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$wdate</td><td align=center style='border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			}
		} else {
			if (!$total2) {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='padding:10px;'>$id</td>
					<td align=center style='padding:10px;'>$writer</td>
					<td align=left style='padding:10px;'>$t<a href=content4.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic <img width=15 height=15 src='floppy2.png'/></a></td>
					<td align=center style='padding:10px;'>$wdate</td><td align=center style='padding:10px;border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			} else {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='padding:10px;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;'>$t<a href=content4.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic [$total2] <img width=15 height=15 src='floppy2.png'/></a></td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$wdate</td><td align=center style='padding:10px;border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			}
		}
		$counter = $counter + 1;

	endwhile;

	echo("
		<tr style='border-bottom:none;'>
			<td style='vertical-align:middle;' height=50 colspan=10 align=right>
				<a href=input4.php?board=$board><img src='pencil.png' width=25 height=25></a>&nbsp;&nbsp;&nbsp;
				<a href=show4.php?board=$board><img src='catalog.png' width=25 height=25></a>
			</td>
		</tr>
	</table>");

	echo ("<br>
		  <table border=0 width=350>
		  <tr align=center>");
		   
	// 화면 하단에 페이지 번호 출력
	if ($cblock=='') $cblock=1;   // $cblock - 현재 페이지 블록값
	$blocksize = 5;             // $blocksize - 화면상에 출력할 페이지 번호 개수

	$pblock = $cblock - 1;      // 이전 블록은 현재 블록 - 1
	$nblock = $cblock + 1;     // 다음 블록은 현재 블록 + 1
		
	// 현재 블록의 첫 페이지 번호
	$startpage = ($cblock - 1) * $blocksize + 1;	

	$pstartpage = $startpage - 1;  // 이전 블록의 마지막 페이지 번호
	$nstartpage = $startpage + $blocksize;  // 다음 블록의 첫 페이지 번호
	if ($pblock > 0 && $cpage != 1) {
			echo ("
				<td align=center width=70>
				<form action=admin.php?board=$board&cblock=$pblock&cpage=1 method=post>
					<input type=submit value='<<' name=pstartpage
					onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
					style='width:40; height:40; border-style:solid; border-width:1px;'>
				</form>
				</td>");
		}

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("
			<td align=center width=70>
			<form action=admin.php?board=$board&cblock=$pblock&cpage=$pstartpage method=post>
				<input type=submit value='<' name=pstartpage
				onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
				style='width:40; height:40; border-style:solid; border-width:1px;'>
			</form>
			</td>");
	// 현재 블록에 속한 페이지 번호를 출력	
	$i =   $startpage;
	while($i < $nstartpage):
	   if ($i > $totalpage) break;  // 마지막 페이지를 출력했으면 종료함
	   echo ("
			<td align=center height=50 width=70>
			<form action=admin.php?board=$board&cblock=$cblock&cpage=$i method=post>
		");
		if ($i == $cpage) {
			echo ("
				<input type=submit value=$i name=i 
				style='background-color:#BDBDBD; color:white; border-style:solid; border-width:1px; width:40; height:40;'>
			");
		} else {
			echo ("
				<input type=submit value=$i name=i 
				onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
				style='width:40; height:40; border-style:solid; border-width:1px;'>
			");
		}
		echo ("
			</form>
			</td>");
	   $i = $i + 1;
	endwhile;
	 
	// 다음 블록의 시작 페이지가 전체 페이지 수보다 작으면 [다음블록] 버튼 활성화  
	if ($nstartpage <= $totalpage)   
		echo ("
			<td align=center width=70>
			<form action=admin.php?board=$board&cblock=$nblock&cpage=$nstartpage method=post>
				<input type=submit value='>' name=nstartpage
				onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
				style='width:40; height:40; border-style:solid; border-width:1px;'>
			</form>
			</td>");
		if ($nstartpage <= $totalpage && $cpage!=$totalpage) {
			echo ("
				<td align=center width=70>
				<form action=admin.php?board=$board&cblock=$nblock&cpage=$totalpage method=post>
					<input type=submit value='>>' name=totalpage
					onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
					style='width:40; height:40; border-style:solid; border-width:1px;'>
				</form>
				</td>");
		}
	echo ("</td></tr></table>");
}
	echo ("<table><tr><td height=200></td></tr></table></center>");
mysql_close($con);

?>
<? include ("bottom.html");?>
</center>
