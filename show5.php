<center>
<?include ("top.html");?>
<!doctype html>
<html>
<head>
<style>
/* FAQ */
.faq{border-bottom:0px solid #ddd;margin:1em 0;}
.faq .faqHeader{position:relative;zoom:1}
.faq .faqHeader .showAll{position:absolute;bottom:0;right:0;border:0;padding:0;overflow:visible;background:none;cursor:pointer}
.faq .faqBody{margin:0;padding:0}
.faq .faqBody .article{list-style:none}
.faq .q{margin:}
.faq .q a{display:block;text-align:left; 
    background:url("faq1_icon_q.png") no-repeat 0 0;
    padding:0 0 0 35px;
    font-size:18px;
    color:#5e5e5e;
    font-weight:bold;
    line-height: 27px;
    cursor:pointer;
    margin: 10px 0; !important}
.faq .q a:hover, .faq .q a:active, .faq .q a:focus{}
.faq .a{background:#f8f8f8 url("faq1_icon_a.png") no-repeat 40px 10px;padding: 10px 75px 10px 75px;
    font-size: 16px;
    color: #444444;
    line-height: 22px;
    border-top: 1px solid #bdbdbd;
    margin:5px 0 0 0;}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>

</head>
<?

echo ("
	<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
	<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
	<link href=\"https://fonts.googleapis.com/css2?family=Hi+Melody&family=Sunflower:wght@300&display=swap\" rel=\"stylesheet\">
	<style type='text/css'>
		table {
			
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
			font-size:17px;
		}
		h1 {
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
			
		}
		input {
			font-family: 'Hi Melody', cursive;
			font-family: 'Sunflower', sans-serif;
		}
	</style>
");
 
 echo (" <style>
		a {text-decoration:none;}
	</style>
");
 
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
$result = mysql_query("select * from $board order by id desc", $con);
$total = mysql_num_rows($result);

echo ("<style type='text/css'>
		table {border-collapse:collapse;
			border-right:none;
			border-left:none;
		}
	</style>
");


echo("
	<table>
		<tr><td height=30></td></tr>
	</table>

	<center>
	<table border=0 width=900>
	<tr><td colspan=2 align=center><h1>자주 묻는 질문, 답변</h1></td></tr>
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
	<table border=1 width=900 style='border-left:none; border-right:none;'>
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
				<a href=input5.php?board=$board><img src='pencil.png' width=25 height=25></a>&nbsp;&nbsp;&nbsp;
				<a href=show5.php?board=$board><img src='catalog.png' width=25 height=25></a>
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
?>
<div class="faq">
    <div class="faqHeader">	

<?	
		$result2 = mysql_query("select * from qnaboardreply where id=$id", $con);
		$total2 = mysql_num_rows($result2);
		if (!$filename) {
			if (!$total2) {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;border-left:none; border-right:none;'>$t<a href=content5.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic</a></td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$wdate</td><td align=center style='border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			} else {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\">
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;border-left:none; border-right:none;'>$t<a href=content5.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic [$total2]</a></td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$wdate</td><td align=center style='border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			}
		} else {
			if (!$total2) {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='padding:10px;'>$id</td>
					<td align=center style='padding:10px;'>$writer</td>
					<td align=left style='padding:10px;'>$t<a href=content5.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic <img width=15 height=15 src='floppy2.png'/></a></td>
					<td align=center style='padding:10px;'>$wdate</td><td align=center style='padding:10px;border-left:none; border-right:none;'>$hit</td>
					</tr>
				");
			} else {
				echo("
					<tr onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"><td align=center style='padding:10px;'>$id</td>
					<td align=center style='padding:10px;border-left:none; border-right:none;'>$writer</td>
					<td align=left style='padding:10px;'>$t<a href=content5.php?board=$board&id=$id&cpage=$cpage onmouseover=\"this.style.color='white';\" onmouseout=\"this.style.color='blue';\">$topic [$total2] <img width=15 height=15 src='floppy2.png'/></a></td>
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
			
			
			");
			
			if ($UserID == "admin"){
			echo("
				<a href=input5.php?board=$board><img src='pencil.png' width=25 height=25></a>&nbsp;&nbsp;&nbsp;
			");}
			echo("
				<a href=show5.php?board=$board><img src='catalog.png' width=25 height=25></a>
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
				<form action=show5.php?board=$board&cblock=$pblock&cpage=1 method=post>
					<input type=submit value='<<' name=pstartpage
					onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
					style='width:40; height:40; border-style:solid; border-width:1px;'>
				</form>
				</td>");
		}

	if ($pblock > 0)        // 이전 블록이 존재하면 [이전블록] 버튼을 활성화
		echo ("
			<td align=center width=70>
			<form action=show5.php?board=$board&cblock=$pblock&cpage=$pstartpage method=post>
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
			<form action=show5.php?board=$board&cblock=$cblock&cpage=$i method=post>
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
			<form action=show5.php?board=$board&cblock=$nblock&cpage=$nstartpage method=post>
				<input type=submit value='>' name=nstartpage
				onmouseover=\"this.style.color='white'; this.style.background='#BDBDBD';\" onmouseout=\"this.style.color='black';this.style.background='';\"
				style='width:40; height:40; border-style:solid; border-width:1px;'>
			</form>
			</td>");
		if ($nstartpage <= $totalpage && $cpage!=$totalpage) {
			echo ("
				<td align=center width=70>
				<form action=show5.php?board=$board&cblock=$nblock&cpage=$totalpage method=post>
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
</div>
<?include ("bottom.html");?>
</center>
<script>
jQuery(function($){
    // Frequently Asked Question
    var article = $('.faq>.faqBody>.article');
    article.addClass('hide');
    article.find('.a').hide();
    article.eq(0).removeClass('hide');
    article.eq(0).find('.a').show();
    $('.faq>.faqBody>.article>.q>a').click(function(){
        var myArticle = $(this).parents('.article:first');
        if(myArticle.hasClass('hide')){
            article.addClass('hide').removeClass('show');
            article.find('.a').slideUp(100);
            myArticle.removeClass('hide').addClass('show');
            myArticle.find('.a').slideDown(100);
        } else {
            myArticle.removeClass('show').addClass('hide');
            myArticle.find('.a').slideUp(100);
        }
        return false;
    });
    $('.faq>.faqHeader>.showAll').click(function(){
        var hidden = $('.faq>.faqBody>.article.hide').length;
        if(hidden > 0){
            article.removeClass('hide').addClass('show');
            article.find('.a').slideDown(100);
        } else {
            article.removeClass('show').addClass('hide');
            article.find('.a').slideUp(100);
        }
    });
});
</script>
</body>
</html>