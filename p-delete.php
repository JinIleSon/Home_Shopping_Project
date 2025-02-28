<center>
<? include ("top.html"); ?>
<?

$con=mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall", $con);

$result = mysql_query("select * from product where code='$code'", $con);

$name=mysql_result($result,0,"name");
$origin=mysql_result($result,0,"origin");
echo ("
    <table border=0 width=650 align=center>
	<tr height=30><td></td></tr>
	<tr><td colspan=2 align=right><form method=post action=p-adminlist.php><input type=submit value='돌아가기' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form></td></tr>
	<tr height=50><td width=100 align=center><b>코드</b></td>
     <td width=550><b>$code</b></td></tr>
	<tr height=50><td align=center><b>이름</b></td><td><b>$name</b></td></tr>
	<tr height=50><td align=center><b>원산지</b></td><td><b>$origin</b></td></tr>
	<tr><td colspan=2 height=50 align=center valign=center>위 상품을 삭제하시겠습니까?</td></tr> 
	<tr><td colspan=2 align=center><form method=post action=p-delete2.php?code=$code><input type=submit value='삭제' style='background-color:#6C788C; border:1px solid #6C788C; border-radius:4px; color:white; padding-left:15px;padding-right:15px;padding-top:8px;padding-bottom:8px;'></form></td></tr>
	
	
	<tr height=400><td></td></tr>
	</table>");
	
mysql_close($con);

?>
<? include ("bottom.html"); ?>
</center>